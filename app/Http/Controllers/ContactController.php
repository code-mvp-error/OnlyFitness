<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactNotification;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $selectedPlan = $request->query('plan');

        return view('contact', compact('selectedPlan'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        Mail::to(config('mail.from.address'))
            ->send(new ContactNotification($contact));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Thank you! We'll contact you within 24 hours.",
            ]);
        }

        return back()->with('success', "Thank you! We'll get back to you shortly.");
    }
}
