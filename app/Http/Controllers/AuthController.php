<?php

namespace App\Http\Controllers;

use App\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    public function registerForm()
    {

    }

    public function register()
    {

    }

    public function userLoginView()
    {
        $username = 'username';
        if(Auth::check() || backpack_auth()->check()){
            return redirect()->route('home');
        }
        return view('auth.login',compact('username'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'=>['required'],
            'password' => ['required','min:8']
        ]);

        if(Auth::check() || backpack_auth()->check()){
            return redirect()->route('home');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            backpack_auth()->login($user);
            if ($user->can([Constants::PERMISSION_DASHBOARD])) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home');
            }
        }
        throw ValidationException::withMessages(['username'=>'Incorrect credential']);
    }
}
