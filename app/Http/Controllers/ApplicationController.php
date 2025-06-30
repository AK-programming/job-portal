<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Application;

class ApplicationController extends Controller
{
    // 1. Show applications for the employer's jobs
    public function index()
    {
        $user = Session::get('user');

        if (!$user || $user->UserType !== 'employer') {
            return redirect()->route('login');
        }

        // Get employer ID based on current logged-in user
        $employerId = DB::table('employers')
                        ->where('UserID', $user->UserID)
                        ->value('EmployerID');

        // Get applications for this employer's jobs
        $applications = DB::table('applications as a')
            ->join('jobs as j', 'a.JobID', 'j.JobID')
            ->join('jobseekers as s', 'a.SeekerID', 's.SeekerID')
            ->join('users as u', 's.UserID', 'u.UserID')
            ->where('j.EmployerID', $employerId)
            ->select(
                'a.ApplicationID',
                'j.Title as JobTitle',
                'u.Name as SeekerName',
                'a.AppliedDate',
                'a.Status'
            )
            ->orderBy('a.AppliedDate', 'desc')
            ->get();

        return view('employer.applications.index', compact('applications'));
    }

    // 2. Approve application
    public function approve($id)
    {
        DB::table('applications')->where('ApplicationID', $id)
            ->update(['Status' => 'Approved']);

        return back()->with('success', 'Application approved.');
    }

    // 3. Reject application
    public function reject($id)
    {
        DB::table('applications')->where('ApplicationID', $id)
            ->update(['Status' => 'Rejected']);

        return back()->with('success', 'Application rejected.');
    }
    public function myApplications()
{
    $user = Session::get('user');

    if (!$user || $user->UserType !== 'jobseeker') {
        return redirect()->route('login');
    }

    $seekerId = DB::table('jobseekers')
                  ->where('UserID', $user->UserID)
                  ->value('SeekerID');

    $applications = DB::table('applications as a')
        ->join('jobs as j', 'a.JobID', 'j.JobID')
        ->where('a.SeekerID', $seekerId)
        ->select(
            'a.ApplicationID',
            'j.Title as JobTitle',
            'a.AppliedDate',
            'a.Status'
        )
        ->orderBy('a.AppliedDate', 'desc')
        ->get();

    return view('jobseeker.applications.index', compact('applications'));
}

}