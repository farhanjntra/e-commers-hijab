<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showResetRequestForm()
    {
        return view('login.forget'); // Ensure this view exists
    }

    /**
     * Handle the form submission to send the password reset link.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLink(Request $request)
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email', // Ensure the email exists in the users table
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Attempt to send the password reset link
        $response = Password::sendResetLink($request->only('email'));

        // Check if the link was sent successfully
        return $response === Password::RESET_LINK_SENT
            ? back()->with(['status' => trans($response)]) // Send success message
            : back()->withErrors(['email' => trans($response)]); // Send error message
    }
}
