<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Subject;
use App\Models\ClassSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassSubjectController extends Controller
{
    public function list(): View
    {
        $header_title = 'Liste des Sujets Assignés';
        $user = Auth::user();
        $classSubjects = ClassSubject::getClassSubjects();
        return view('dashboard.assignSubject.list', compact('user', 'header_title', 'classSubjects'));
    }

    public function add(): View
    {
        $header_title = 'Liste des Sujets Assignés';
        $user = Auth::user();
        return view('dashboard.assignSubject.add', compact('user', 'header_title'));
    }
}
