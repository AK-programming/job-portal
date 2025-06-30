<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;

class JobSeekerController extends Controller
{
    public function index()
    {
         if (!session()->has('user')) {
        return redirect()->route('login');
    }

        $jobseekers = JobSeeker::all();
        return view('jobseekers.index', compact('jobseekers'));
    }
}
