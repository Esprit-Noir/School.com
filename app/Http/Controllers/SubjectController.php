<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function list(): View
    {
        $header_title = 'Liste des sujets';
        $user = Auth::user();
        $subjects = Subject::getSubject();
        return view('dashboard.subject.list', compact('user', 'header_title', 'subjects'));
    }

    public function add(): View
    {
        $header_title = 'Liste des Sujets';
        $user = Auth::user();
        return view('dashboard.subject.add', compact('user', 'header_title'));
    }

    public function createSubject(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required',
        ]);
        // Créer un nouvel administrateur
        $subject = new Subject();
        $subject->name = trim( $validatedData['name']);
        $subject->type = trim( $validatedData['type']);
        $subject->status = trim($validatedData['status']);
        $subject->created_by = Auth::user()->id;
        $subject->save();
        // Rediriger vers une page de confirmation ou une autre action
        return redirect()->intended('admin/subject')->with('success', 'Sujet créé avec succès');
    }

    public function getSubjectEdit($subject){
        $subject =  Subject::findOrFail($subject);
        $user = Auth::user();
        return view('dashboard.subject.add', compact('subject', 'user'));
    }

    public function edit(Request $request , Subject $subject){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required',
        ]);
        // Créer un nouvel administrateur
        $subject->name = trim( $validatedData['name']);
        $subject->type = trim( $validatedData['type']);
        $subject->status = trim($validatedData['status']);
        $subject->save();
        // Rediriger vers une page de confirmation ou une autre action
        return redirect()->intended('admin/subject')->with('success', 'Subject modifiée avec succès');
    }

    public function delete(Subject $subject){
        $subject->is_deleted = 1;
        $subject->save();
        return redirect()->intended('admin/subject')->with('success', 'Subject supprimé avec succès');
    }
}
