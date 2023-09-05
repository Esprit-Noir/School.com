<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): RedirectResponse | View
    {
//        dd(Hash::make('password'));
        if (!empty(Auth::check()))
        {
            if (Auth::user()->user_type == 1) return redirect()->intended('admin/dashboard');
           if (Auth::user()->user_type == 2) return redirect()->intended('teacher/dashboard');
           if (Auth::user()->user_type == 3) return redirect()->intended('student/dashboard');
           if (Auth::user()->user_type == 4) return redirect()->intended('parent/dashboard');
        }
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember')))
        {
            if (Auth::user()->user_type == 1) return redirect()->intended('admin/dashboard');
            if (Auth::user()->user_type == 2)  return redirect()->intended('teacher/dashboard');
            if (Auth::user()->user_type == 3)  return redirect()->intended('student/dashboard');
            if (Auth::user()->user_type == 4)  return redirect()->intended('parent/dashboard');
        }
        else
        {
            return redirect()->back()->with('error','l\'email ou le Mot de passe incorrect');
        }
    }

    public function authForgotPassword()
    {
        return view('auth.forgot');
    }

    public function authSendMail(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success','Consulter votre boite mail pour réinitialiser votre mot de passe');
        }
        else
        {
            return redirect()->back()->with('error','Cette adresse email n\'existe pas dans la base de données');
        }
    }

    public function authGetUser($token)
    {
        $user = User::getTokenSingle($token);
        if (!empty($user))
        {
            return view('auth.reset', compact('user'));
        }
        else
        {
            abort(404);
        }
    }

    public function authResetPassword($token, Request $request)
    {
        if ($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect()->intended('/')->with('success', 'Votre mot de passe a été modifié avec succès');
        }
        else
        {
            return redirect()->back()->with('error','Les deux mots de passe sont différents');
        }
    }

    public function authLogout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
