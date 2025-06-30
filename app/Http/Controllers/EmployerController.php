<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
class EmployerController extends Controller
{
    
public function index() {
     if (!session()->has('user')) {
        return redirect()->route('login');
    }

    $employers = Employer::all();
    return view('employers.index', compact('employers'));
}
}
