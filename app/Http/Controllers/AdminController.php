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
     
    
            $user->fill($request->only(['name', 'email', 'role_id']))->save();
            return Inertia::location('/role');
    }
    
    
}
