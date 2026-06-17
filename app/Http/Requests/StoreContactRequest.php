<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^[\d\s\-\+\(\)]+$/',
            'goal' => 'required|in:lose_weight,build_muscle,improve_endurance,general_fitness',
            'plan' => 'required|in:basic,pro,elite',
            'message' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Name must be at least 2 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'goal.required' => 'Please select a fitness goal.',
            'goal.in' => 'Please select a valid fitness goal.',
            'plan.required' => 'Please select a membership plan.',
            'plan.in' => 'Please select a valid plan.',
            'message.required' => 'Please write your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message cannot exceed 1000 characters.',
        ];
    }
}
