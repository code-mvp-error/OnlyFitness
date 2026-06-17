<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

/**
 * @api {post} /api/register Register a new user
 * @apiName Register
 * @apiGroup Authentication
 * @apiParam {String} name User's full name
 * @apiParam {String} email User's email
 * @apiParam {String} phone User's phone number
 * @apiParam {String} password User's password
 * @apiParam {String} goal Fitness goal (lose_weight|build_muscle|improve_endurance|general_fitness)
 * @apiParam {Number} plan_id Selected plan ID
 * @apiSuccess {Object} data User object with token
 */
class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'regex:/^[\d\s\-\(\)\+]+$/'],
            'goal' => ['required', 'in:lose_weight,build_muscle,improve_endurance,general_fitness'],
            'plan_id' => ['required', 'exists:plans,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'goal' => $validated['goal'],
            'plan_id' => $validated['plan_id'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $this->formatUser($user),
                'token' => $token,
            ],
            'message' => 'Registration successful',
        ], 201);
    }

    /**
     * @api {post} /api/login Login
     * @apiName Login
     * @apiGroup Authentication
     * @apiParam {String} email User's email
     * @apiParam {String} password User's password
     * @apiSuccess {Object} data User object with token
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid email or password',
                'code' => 401,
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $this->formatUser($user),
                'token' => $token,
            ],
            'message' => 'Login successful',
        ]);
    }

    /**
     * @api {post} /api/logout Logout
     * @apiName Logout
     * @apiGroup Authentication
     * @apiHeader {String} Authorization Bearer token
     * @apiSuccess {String} message Success message
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * @api {get} /api/user Get current user
     * @apiName GetUser
     * @apiGroup User
     * @apiHeader {String} Authorization Bearer token
     * @apiSuccess {Object} data User with plan and bookings count
     */
    public function user(Request $request): JsonResponse
    {
        $user = $request->user()->load('plan');

        return response()->json([
            'success' => true,
            'data' => [
                'user' => $this->formatUser($user),
                'bookings_count' => $user->bookings()->count(),
            ],
            'message' => null,
        ]);
    }

    /**
     * @api {put} /api/user Update user profile
     * @apiName UpdateUser
     * @apiGroup User
     * @apiHeader {String} Authorization Bearer token
     * @apiParam {String} name User's name
     * @apiParam {String} phone User's phone
     * @apiParam {String} goal Fitness goal
     * @apiParam {String} [photo] Base64 encoded image
     * @apiSuccess {Object} data Updated user
     */
    public function updateUser(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[\d\s\-\(\)\+]+$/'],
            'goal' => ['required', 'in:lose_weight,build_muscle,improve_endurance,general_fitness'],
            'photo' => ['nullable', 'string'],
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'goal' => $validated['goal'],
        ];

        if (!empty($validated['photo'])) {
            $photoData = base64_decode($validated['photo']);
            $filename = 'avatars/' . $user->id . '_' . time() . '.png';
            Storage::disk('public')->put($filename, $photoData);
            $data['photo_url'] = Storage::url($filename);
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'data' => ['user' => $this->formatUser($user)],
            'message' => 'Profile updated',
        ]);
    }

    /**
     * @api {put} /api/user/password Update password
     * @apiName UpdatePassword
     * @apiGroup User
     * @apiHeader {String} Authorization Bearer token
     * @apiParam {String} current_password Current password
     * @apiParam {String} new_password New password
     * @apiParam {String} new_password_confirmation Confirm new password
     * @apiSuccess {String} message Success message
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Password updated successfully',
        ]);
    }

    private function formatUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'goal' => $user->goal,
            'plan' => $user->plan ? [
                'id' => $user->plan->id,
                'name' => $user->plan->name,
                'price_monthly' => $user->plan->price_monthly,
            ] : null,
            'photo_url' => $user->photo_url ?? null,
            'is_admin' => $user->is_admin,
            'created_at' => $user->created_at,
        ];
    }
}
