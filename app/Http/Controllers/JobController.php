<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use Illuminate\Support\Facades\Session;

class JobController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('user')) return redirect()->route('login');

        $query = Job::with('employer');

        if ($request->has('q') && !empty($request->q)) {
            $query->where('Title', 'like', '%' . $request->q . '%')
                  ->orWhere('Location', 'like', '%' . $request->q . '%')
                  ->orWhere('Description', 'like', '%' . $request->q . '%');
        }

        $jobs = $query->orderBy('PostedDate', 'desc')->paginate(9);

        return view('jobs.index', compact('jobs'));
    }

    public function showApplyForm($jobId)
    {
        if (!session()->has('user')) return redirect()->route('login');

        $job = Job::findOrFail($jobId);
        return view('jobs.apply', compact('job'));
    }

    public function submitApplication(Request $request, $jobId)
    {
        if (!Session::has('user') || Session::get('user')->UserType !== 'jobseeker') {
            return redirect()->route('login')->withErrors('Only jobseekers can apply for jobs.');
        }

        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx',
            'cover_letter' => 'nullable|string',
        ]);

        $path = $request->file('resume')->store('resumes', 'public');

        $seekerId = DB::table('jobseekers')
            ->where('UserID', Session::get('user')->UserID)
            ->value('SeekerID');

        if (!$seekerId) {
            return redirect()->back()->withErrors('Your jobseeker profile is incomplete. Please update your profile before applying.');
        }

        $resumeId = DB::table('resumes')->insertGetId([
            'SeekerID' => $seekerId,
            'FilePath' => $path,
            'UploadDate' => now(),
            'LastUpdated' => now(),
        ]);

        DB::table('applications')->insert([
            'JobID' => $jobId,
            'SeekerID' => $seekerId,
            'ResumeID' => $resumeId,
            'AppliedDate' => now(),
            'Status' => 'Pending',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Application submitted!');
    }

    public function create()
    {
        if (!session()->has('user') || session('user')->UserType !== 'employer') {
            return redirect()->route('dashboard')->withErrors('Access denied.');
        }

        return view('jobs.create');
    }

    public function store(Request $request)
    {
        if (!session()->has('user') || session('user')->UserType !== 'employer') {
            return redirect()->route('dashboard')->withErrors('Access denied.');
        }

        $request->validate([
            'company_name' => 'required|string|max:255',  // ✅ new
            'title' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'salary' => 'required',
        ]);

        $userId = session('user')->UserID;

        // Check if employer already exists
        $employer = DB::table('employers')->where('UserID', $userId)->first();

        if (!$employer) {
            // Auto-create employer with given company name
            $employerId = DB::table('employers')->insertGetId([
                'UserID' => $userId,
                'CompanyName' => $request->company_name,
                'CompanyDescription' => 'Auto-generated',
                'CompanyWebsite' => '#',
                'VerifiedStatus' => false,
            ]);
        } else {
            // Optionally update the company name on job posting
            $employerId = $employer->EmployerID;
            DB::table('employers')->where('EmployerID', $employerId)->update([
                'CompanyName' => $request->company_name
            ]);
        }

        DB::table('jobs')->insert([
            'EmployerID' => $employerId,
            'Title' => $request->title,
            'Description' => $request->description,
            'Requirements' => $request->requirements,
            'Location' => $request->location,
            'SalaryRange' => $request->salary,
            'PostedDate' => now(),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
    }
}
