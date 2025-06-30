<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('user')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('Email', $credentials['email'])->first();

        if ($user && $user->Password === $credentials['password']) {
            Session::put('user', $user);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['Invalid email or password']);
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,Email',
            'password' => 'required|min:6',
            'user_type' => 'required|in:jobseeker,employer',
        ]);

        $user = new User();
        $user->Name = $request->name;
        $user->Email = $request->email;
        $user->Password = $request->password; // Hash in production
        $user->UserType = $request->user_type;
        $user->save();

        Session::put('user', $user);

        if ($user->UserType === 'jobseeker') {
            DB::table('jobseekers')->insert([
                'UserID' => $user->UserID,
                'DateOfBirth' => now(),
                'Address' => 'N/A',
                'ProfileSummary' => 'New user',
            ]);
        } elseif ($user->UserType === 'employer') {
            DB::table('employers')->insert([
                'UserID' => $user->UserID,
                'CompanyName' => 'N/A',
                'CompanyDescription' => 'New employer',
                'CompanyWebsite' => '#',
                'VerifiedStatus' => false,
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function showProfile()
    {
        if (!Session::has('user')) return redirect()->route('login');

        $user = Session::get('user');

        $profile = ($user->UserType === 'jobseeker')
            ? DB::table('jobseekers')->where('UserID', $user->UserID)->first()
            : DB::table('employers')->where('UserID', $user->UserID)->first();

        if (!$profile) {
            if ($user->UserType === 'jobseeker') {
                DB::table('jobseekers')->insert([
                    'UserID' => $user->UserID,
                    'DateOfBirth' => now(),
                    'Address' => 'N/A',
                    'ProfileSummary' => 'Autocreated',
                ]);
            } else {
                DB::table('employers')->insert([
                    'UserID' => $user->UserID,
                    'CompanyName' => 'N/A',
                    'CompanyDescription' => 'Autocreated',
                    'CompanyWebsite' => '#',
                    'VerifiedStatus' => false,
                ]);
            }

            $profile = ($user->UserType === 'jobseeker')
                ? DB::table('jobseekers')->where('UserID', $user->UserID)->first()
                : DB::table('employers')->where('UserID', $user->UserID)->first();
        }

        $verifiedStatus = null;
        if ($user->UserType === 'employer') {
            $verifiedStatus = $profile->VerifiedStatus ?? 0;
        }

        return view('profile', compact('user', 'profile', 'verifiedStatus'));
    }

   public function updateProfile(Request $request)
{
    $user = Session::get('user');

    $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    if ($user->UserType === 'jobseeker') {
        $rules += [
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'profile_summary' => 'required|string',
        ];
    } else {
        $rules += [
            'CompanyName' => 'required|string|max:255',
            'company_description' => 'required|string',
            'company_website' => 'nullable|url',
        ];
    }

    $data = $request->validate($rules);

    // Update users table
    DB::table('users')
        ->where('UserID', $user->UserID)
        ->update([
            'Name' => $data['name'],
            'Email' => $data['email'],
        ]);

    // Update jobseeker/employer specific info
    if ($user->UserType === 'jobseeker') {
        DB::table('jobseekers')
            ->where('UserID', $user->UserID)
            ->update([
                'DateOfBirth' => $data['date_of_birth'],
                'Address' => $data['address'],
                'ProfileSummary' => $data['profile_summary'],
            ]);
    } else {
        DB::table('employers')
            ->where('UserID', $user->UserID)
            ->update([
                'CompanyName' => $data['CompanyName'],
                'CompanyDescription' => $data['company_description'],
                'CompanyWebsite' => $data['company_website'] ?? '#',
            ]);
    }

    // Refresh user session after update
    $updatedUser = DB::table('users')->where('UserID', $user->UserID)->first();
    Session::put('user', $updatedUser);

    return back()->with('success', 'Profile updated successfully.');
}


    public function myApplications()
    {
        $user = session('user');

        if (!$user || $user->UserType !== 'jobseeker') {
            return redirect()->route('login');
        }

        $seekerId = DB::table('jobseekers')->where('UserID', $user->UserID)->value('SeekerID');

        $applications = DB::table('applications as a')
            ->join('jobs as j', 'a.JobID', '=', 'j.JobID')
            ->where('a.SeekerID', $seekerId)
            ->select('a.ApplicationID', 'j.Title as JobTitle', 'a.AppliedDate', 'a.Status')
            ->orderBy('a.AppliedDate', 'desc')
            ->get();

        return view('jobseekers.applications.index', compact('applications'));
    }

    public function updateCompanyName(Request $request)
    {
        $user = Session::get('user');

        if (!$user || $user->UserType !== 'employer') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'CompanyName' => 'required|string|max:255',
        ]);

        DB::table('employers')
            ->where('UserID', $user->UserID)
            ->update([
                'CompanyName' => $request->input('CompanyName'),
            ]);

        return redirect()->back()->with('company_success', 'Company name updated successfully.');
    }
}
