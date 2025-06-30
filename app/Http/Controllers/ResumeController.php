<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
class ResumeController extends Controller
{
    
public function index() {
    $resumes = Resume::all();
    return view('resumes.index', compact('resumes'));
}
}
