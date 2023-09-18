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
            'email' => 'required|email|unique:users',
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

    public function getAdminEdit(User $admin){
//        $admin =  User::findOrFail($id);
        $user = Auth::user();
        return view('dashboard.admin.add', compact('admin', 'user'));
    }

    public function edit(Request $request, User $admin)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'password' => 'nullable|min:6', // Vous pouvez spécifier des règles de validation ici
            'user_type' => 'required|max:1|min:1',
        ]);

        $admin->fill([
            'name' => trim($validatedData['name']),
            'email' => trim($validatedData['email']),
            'user_type' => $validatedData['user_type'],
        ]);

        if (!empty($validatedData['password'])) {
            $admin->password = bcrypt(trim($validatedData['password']));
        }
        $admin->save();

        return redirect()->intended('admin/list')->with('success', 'Administrateur modifié avec succès');
    }
    public function delete(User $admin){
        $admin->is_deleted = 1;
        $admin->save();
        return redirect()->intended('admin/list')->with('success', 'Administrateur supprimé avec succès');
    }

}
