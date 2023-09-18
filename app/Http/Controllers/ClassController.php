<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClassController extends Controller
{
    public function list(): View
    {
        $header_title = 'Liste des classes';
        $user = Auth::user();
        $classes = Classe::getClasses();
        return view('dashboard.class.list', compact('user', 'header_title', 'classes'));
    }

    public function add(): View
    {
        $header_title = 'Liste des classes';
        $user = Auth::user();
        return view('dashboard.class.add', compact('user', 'header_title'));
    }

    public function createClass(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        // Créer un nouvel administrateur
        $class = new Classe;
        $class->name = trim( $validatedData['name']);
        $class->status = trim($validatedData['status']);
        $class->created_by = Auth::user()->id;
        $class->save();
        // Rediriger vers une page de confirmation ou une autre action
        return redirect()->intended('admin/class')->with('success', 'Classe créé avec succès');
    }

    public function getClassEdit($id){
        $class =  Classe::findOrFail($id);
        $user = Auth::user();
        return view('dashboard.class.add', compact('class', 'user'));
    }

    public function edit(Request $request , Classe $class){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        // Créer un nouvel administrateur
        $class->name = trim( $validatedData['name']);
        $class->status = trim($validatedData['status']);
        $class->save();
        // Rediriger vers une page de confirmation ou une autre action
        return redirect()->intended('admin/class')->with('success', 'Classe modifiée avec succès');
    }


    public function delete(Classe $class){
        $class->is_deleted = 1;
        $class->save();
        return redirect()->intended('admin/class')->with('success', 'Classe supprimé avec succès');
    }
}
