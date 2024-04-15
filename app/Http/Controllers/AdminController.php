<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $role = Role::all();
        return Inertia::render('Role', compact('users', 'role'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        
        $users = User::all();
        $role = Role::all();
        return Inertia::render('Role', compact('users', 'role'));
    }
    
    public function edit($id){
        $user = User::find($id);
        
        $role = Role::all(); // Assuming you also need to pass roles for editing
        return Inertia::render('Edetrole', compact('user', 'role'));
    }
    public function update(Request $request){
        $user = User::find($request->id);
       
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id'); // Explicitly set the role_id
        $user->save();
    
        return Inertia::location('/role');
    }
    
}
