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
            // dd($user->hasRole(Constants::USER_TYPE_EMPLOYEE));
            if ($user->hasRole(Constants::USER_TYPE_EMPLOYEE)) {
                return redirect()->route('home');
            }
            else {
                return redirect()->route('dashboard');
            }
        }
        throw ValidationException::withMessages(['username'=>'Incorrect credential']);
    }
}
