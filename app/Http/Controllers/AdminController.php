<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function list() : View
    {
        $header_title = 'Liste d\'administrateurs';
        $user = Auth::user();
        $admins = User::getAdmin();
        return view('dashboard.admin.list', compact('user', 'header_title', 'admins'));
    }
    public function add() : View
    {
        $header_title = 'Ajouter administrateur';
        $user = Auth::user();
        return view('dashboard.admin.add', compact('user', 'header_title'));
    }

    public function createAdmin(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // Créer un nouvel administrateur
        $admin = new User();
        $admin->name = trim($validatedData['name']);
        $admin->email = trim($validatedData['email']);
        $admin->password = bcrypt(trim($validatedData['password']));
        $admin->remember_token = $request->_token;
        $admin->user_type = 1;
        $admin->save();

        // Rediriger vers une page de confirmation ou une autre action
        return redirect()->intended('admin/list')->with('success', 'Administrateur créé avec succès');
    }

    public function getAdminEdit($id){
        $admin =  User::findOrFail($id);
        $user = Auth::user();
        return view('dashboard.admin.add', compact('admin', 'user'));
    }

    public function edit(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'user_type' => 'required|max:1|min:1',

        ]);
       $admin = User::findOrFail($id);
        $admin->name = trim($validatedData['name']);
        $admin->email = trim($validatedData['email']);
        $admin->password = bcrypt(trim($validatedData['password']));
        $admin->user_type = $validatedData['user_type'];
        $admin->save();
        return redirect()->intended('admin/list')->with('success', 'Administrateur modifié avec succès');

    }

}
