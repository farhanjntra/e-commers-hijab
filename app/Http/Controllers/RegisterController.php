<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login.register');
    }
    public function register(Request $request)
    {
        $validatedData=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed']

        ]);



        $validatedData['password']=bcrypt($validatedData['password']);
        $validatedData['email_verified_at']=now();
        $validatedData['role']='user';
        $validatedData['remember_token']=Str::random(10);
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }
}
