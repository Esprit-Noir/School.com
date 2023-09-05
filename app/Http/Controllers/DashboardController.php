<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (!empty(Auth::check()))
        {
            $user = Auth::user();
            $header_title = 'Tableau de bord';
            if (Auth::user()->user_type == 1) return view('dashboard.admin.index', compact('user', 'header_title'));
           if (Auth::user()->user_type == 2) return view('dashboard.teacher.index', compact('user','header_title'));
           if (Auth::user()->user_type == 3) return view('dashboard.student.index', compact('user','header_title'));
           if (Auth::user()->user_type == 4)  return view('dashboard.parent.index', compact('user','header_title'));
        }
        return view('auth.login');
    }
}
