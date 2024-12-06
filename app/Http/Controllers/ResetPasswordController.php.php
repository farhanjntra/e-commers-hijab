<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /**
     * Show the form for resetting the password.
     *
     * @param string|null $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        ); // Pastikan view ini ada
    }

    /**
     * Handle the form submission to reset the password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email', // Pastikan email ada di tabel users
            'password' => 'required|confirmed|min:6', // Validasi password
            'token' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Attempt to reset the password
        $credentials = $request->only('email', 'password', 'password_confirmation', 'token');

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        // Check if the password was reset successfully
        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', trans($response)) // Redirect ke login
            : back()->withErrors(['email' => trans($response)]); // Kembali dengan error
    }
}
