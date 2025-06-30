<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) return redirect()->route('login');
        $users = User::all(); 
        return view('users.index', compact('users'));
    }
}
