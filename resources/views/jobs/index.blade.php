@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 py-12 mb-8">
    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-800 mb-2">Find Your Next Opportunity</h1>
        <p class="text-lg text-indigo-600 mb-6">Search thousands of jobs from top companies</p>
        <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-3 max-w-xl mx-auto bg-white rounded-xl shadow-lg px-4 py-2">
            <input type="text" name="q" value="{{ request('q') }}" class="flex-1 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-400 focus:outline-none text-gray-700" placeholder="Job title, keywords, or company">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition">Search</button>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">{{ session('success') }}</div>
    @endif

    @if($jobs->isEmpty())
        <p class="text-center text-gray-500">No jobs found. Try a different search term.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            @foreach($jobs as $job)
                <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition p-6 flex flex-col h-full border-t-4 border-indigo-400 group relative">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-indigo-100 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3V3h4v2h3a2 2 0 012 2v11a2 2 0 01-2 2z" /></svg>
                        </div>
                        <span class="text-indigo-700 font-semibold text-lg">{{ $job->Title }}</span>
                    </div>
                    <div class="text-gray-500 text-sm mb-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" /></svg>
                        {{ $job->Location }}
                    </div>
                    <div class="text-gray-600 text-sm mb-3 flex-1">{{ Str::limit($job->Description ?? '', 120) }}</div>
                    <div class="flex gap-2 mt-2">
                        <button type="button" @click="open = true" class="text-indigo-600 hover:underline font-medium transition">Show Details</button>
                        <a href="{{ route('jobs.apply', $job->JobID) }}" class="ml-auto bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-lg shadow transition">Apply Now</a>
                    </div>
                    <!-- Modal for Details -->
                    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-2 sm:p-4" style="display: none;">
                        <div @click.away="open = false" class="bg-white rounded-xl shadow-xl w-full sm:max-w-lg max-h-screen overflow-y-auto p-4 sm:p-8 relative scrollbar-thin">
                            <button @click="open = false" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2">{{ $job->Title }}</h3>
                            <div class="text-gray-500 mb-2"><strong>Location:</strong> {{ $job->Location }}</div>
                            <div class="text-gray-500 mb-2"><strong>Salary:</strong> {{ $job->SalaryRange ?? 'Not specified' }}</div>
                            <hr class="my-3">
                            <div class="mb-2"><strong>Description:</strong></div>
                            <div class="text-gray-700 mb-2">{{ $job->Description ?? 'No description provided.' }}</div>
                            <div class="mb-2"><strong>Requirements:</strong></div>
                            <div class="text-gray-700 mb-4">{{ $job->Requirements ?? 'No requirements provided.' }}</div>
                            <a href="{{ route('jobs.apply', $job->JobID) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition block text-center">Apply Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-4">
            {{ $jobs->withQueryString()->links() }}
        </div>
    @endif
</div>
<!-- Alpine.js for modal functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
