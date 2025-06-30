<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::has('user')) return redirect()->route('login');

        $totalJobs = DB::table('jobs')->count();
        $totalApplications = DB::table('applications')->count();
        $totalEmployers = DB::table('employers')->count();

        $highlightJobs = DB::table('jobs')
            ->join('employers', 'jobs.EmployerID', '=', 'employers.EmployerID')
            ->select('jobs.Title as title', 'employers.CompanyName as company', 'jobs.Location as location')
            ->orderByDesc('jobs.PostedDate')
            ->limit(5)
            ->get();

        return view('dashboard', compact('totalJobs', 'totalApplications', 'totalEmployers', 'highlightJobs'));
    }
} 