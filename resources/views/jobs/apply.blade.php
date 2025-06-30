@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Left Side: Illustration -->
        <div class="md:w-1/2 flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-100 p-6">
            <img src="{{ asset('images/submit_application.png') }}" alt="Job Application" class="w-full max-w-xs md:max-w-sm h-auto object-contain">
        </div>
        <!-- Right Side: Form -->
        <div class="md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-indigo-700 mb-4 text-center md:text-left">Apply for <span class="text-indigo-900">{{ $job->Title }}</span></h2>
            <form action="{{ route('jobs.apply.submit', $job->JobID) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Resume <span class="text-xs text-gray-400">(PDF, DOC, DOCX)</span></label>
                    <input type="file" name="resume" accept=".pdf,.doc,.docx" required class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                    <textarea name="cover_letter" rows="5" required placeholder="Write a short message..." class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow transition text-lg">Submit Application</button>
            </form>
            <div class="text-center mt-4">
                <a href="{{ route('jobs.index') }}" class="text-indigo-500 hover:underline text-sm">&larr; Back to Job Listings</a>
            </div>
        </div>
    </div>
</div>
@endsection
