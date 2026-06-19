<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate. If any rule fails, Laravel auto-redirects back with the
        // user's input preserved and the error messages stashed in the session.
        $validated = $request->validate([
            'firstName'     => 'required|string|min:2|max:50',
            'lastName'      => 'required|string|min:2|max:50',
            'contactNumber' => 'nullable|string|max:20',
            'email'         => 'required|email|max:100',
            'question'      => 'nullable|string|max:2000',
            'terms'         => 'accepted',
        ], [
            'terms.accepted' => 'You must agree to the terms and conditions.',
        ]);

        // For Deliverable C we just flash a thank-you message.
        // Real email sending could be added in Deliverable D.
        return redirect()
            ->route('contact.show')
            ->with('success', 'Thank you, ' . $validated['firstName'] . '! We have received your question and will be in touch shortly.');
    }
}