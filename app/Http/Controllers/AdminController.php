<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Allow only UserID = 13 and UserType = 'employer'
    private function guardAdmin()
    {
        $user = Session::get('user');
        if (!$user || $user->UserID !== 13 || $user->UserType !== 'employer') {
            abort(403, 'Unauthorized.');
        }
    }

    // Show Admin Page
    public function index()
    {
        $this->guardAdmin();

        // Get unverified employers
        $employers = DB::table('users')
            ->join('employers', 'users.UserID', '=', 'employers.UserID')
            ->where('users.UserType', 'employer')
            ->where('employers.VerifiedStatus', false)
            ->select(
                'users.UserID',
                'users.Name',
                'users.Email',
                'employers.VerifiedStatus',
                'employers.EmployerID'
            )
            ->get();

        // Get pending applications
        $applications = DB::table('applications')
            ->where('Status', 'Pending')
            ->get();

        return view('admin', compact('employers', 'applications'));
    }

    // Update Employer's VerifiedStatus
    public function updateEmployer(Request $request, $id)
    {
        $this->guardAdmin();

        $verified = $request->input('VerifiedStatus') === '1';

        DB::table('employers')
            ->where('UserID', $id)
            ->update(['VerifiedStatus' => $verified]);

        return redirect()->route('admin.page')->with('success', 'Employer verification status updated.');
    }

    // Update Application Status
    public function updateApplication(Request $request, $id)
    {
        $this->guardAdmin();

        // Make sure status is valid (based on DB CHECK constraint)
        $allowedStatuses = ['Pending', 'Reviewed', 'Interview', 'Offered', 'Rejected'];
        $status = $request->input('status');

        if (!in_array($status, $allowedStatuses)) {
            return redirect()->route('admin.page')->with('error', 'Invalid status.');
        }

        DB::table('applications')
            ->where('ApplicationID', $id)
            ->update(['Status' => $status]);

        return redirect()->route('admin.page')->with('success', 'Application status updated.');
    }
}
