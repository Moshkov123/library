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
    return Inertia::render('Role', compact('users','role'));
}
}
