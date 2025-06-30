@extends('layouts.app')

@section('navbar-links')
    <a href="{{ route('dashboard') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">Home</a>
    <a href="{{ route('jobs.index') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('jobs.index') ? 'bg-white/10' : '' }}">View Jobs</a>
    @if(session('user') && session('user')->UserType === 'jobseeker')
        <a href="{{ route('jobseeker.applications') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('jobseeker.applications') ? 'bg-white/10' : '' }}">My Applications</a>
    @endif
    @if(session('user') && session('user')->UserType === 'employer')
        <a href="{{ route('jobs.create') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('jobs.create') ? 'bg-white/10' : '' }}">Post Job</a>
    @endif
    @if(session('user') && session('user')->UserID == 13 && session('user')->UserType === 'employer')
        <a href="{{ route('admin.page') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('admin.page') ? 'bg-white/10' : '' }}">Admin</a>
    @endif
    <a href="{{ route('profile') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium {{ request()->routeIs('profile') ? 'bg-white/10' : '' }}">Profile</a>
    <a href="{{ route('logout') }}" class="text-white/90 hover:text-white px-3 py-2 rounded transition font-medium">Logout</a>
@endsection

@section('content')
<!-- Professional Company Building Background -->
<div class="fixed inset-0 -z-10 bg-cover bg-center bg-no-repeat opacity-70" style="background-image: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=1500&q=80');"></div>

<div class="max-w-7xl mx-auto px-4 flex">
    <div class="flex-1">
        <!-- Hero Section -->
        <div class="relative flex flex-col items-center justify-center py-16 px-4 text-center mb-10">
            <!-- Glassmorphism Card -->
            <div class="relative max-w-2xl w-full mx-auto bg-white/60 backdrop-blur-md rounded-3xl shadow-2xl border-2 border-gradient-to-br from-indigo-400 via-blue-200 to-pink-200 p-10 flex flex-col items-center">
                <!-- Floating Icon -->
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gradient-to-tr from-indigo-400 via-blue-400 to-pink-400 rounded-full p-4 shadow-lg border-4 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-1.657-2.686-3-6-3s-6 1.343-6 3m12 0c0-1.657 2.686-3 6-3s6 1.343 6 3m-12 0v7m0 0c0 1.657 2.686 3 6 3s6-1.343 6-3m-12 0c0 1.657-2.686 3-6 3s-6-1.343-6-3" /></svg>
                </div>
                <h1 class="mt-8 text-4xl md:text-5xl font-extrabold text-indigo-800 mb-2 drop-shadow-lg tracking-tight">Welcome to <span class="bg-gradient-to-r from-indigo-500 via-blue-400 to-pink-400 bg-clip-text text-transparent">JOB SPHERE</span></h1>
                <p class="text-lg md:text-xl text-gray-700 mb-2 mt-2">Hello, <span class="font-semibold text-indigo-700">{{ session('user')->Name }}</span>! <span class="inline-block align-middle">👋</span></p>
                <p class="text-gray-600 mb-6">Connecting top talent with the best companies worldwide.</p>
                <a href="{{ route('jobs.index') }}" class="inline-block bg-gradient-to-r from-pink-500 via-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-pink-500 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition text-lg tracking-wide">Explore Job Openings</a>
            </div>
        </div>

        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
            <!-- Total Jobs -->
            <div class="rounded-xl bg-white shadow-lg p-6 flex flex-col items-center hover:shadow-2xl transition group border-t-4 border-indigo-500">
                <div class="bg-indigo-100 p-3 rounded-full mb-3">
                    <!-- Heroicon: Briefcase -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3V3h4v2h3a2 2 0 012 2v11a2 2 0 01-2 2z" /></svg>
                </div>
                <div class="text-3xl font-bold text-indigo-700 mb-1">{{ $totalJobs ?? '—' }}</div>
                <div class="text-gray-500 font-medium">Total Jobs</div>
            </div>
            <!-- Applications -->
            <div class="rounded-xl bg-white shadow-lg p-6 flex flex-col items-center hover:shadow-2xl transition group border-t-4 border-blue-500">
                <div class="bg-blue-100 p-3 rounded-full mb-3">
                    <!-- Heroicon: DocumentText -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0h6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3V3h4v2h3a2 2 0 012 2v11a2 2 0 01-2 2z" /></svg>
                </div>
                <div class="text-3xl font-bold text-blue-700 mb-1">{{ $totalApplications ?? '—' }}</div>
                <div class="text-gray-500 font-medium">Applications</div>
            </div>
            <!-- Employers -->
            <div class="rounded-xl bg-white shadow-lg p-6 flex flex-col items-center hover:shadow-2xl transition group border-t-4 border-purple-500">
                <div class="bg-purple-100 p-3 rounded-full mb-3">
                    <!-- Heroicon: UserGroup -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-4a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <div class="text-3xl font-bold text-purple-700 mb-1">{{ $totalEmployers ?? '—' }}</div>
                <div class="text-gray-500 font-medium">Employers</div>
            </div>
        </div>

        <!-- Mission & Vision Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-lg p-8 mb-10">
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-indigo-700 mb-2">Our Vision</h3>
                <p class="text-gray-600">To be the most innovative and inclusive career platform globally, empowering job seekers and companies alike.</p>
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700 mb-2">Our Mission</h3>
                <p class="text-gray-600">To deliver exceptional career opportunities through smart technology and personalized support.</p>
            </div>
        </div>
    </div>
    <!-- Right Sidebar: Animated Job Highlights -->
    <div class="hidden lg:flex flex-col w-80 ml-8 mt-2 sticky top-24 h-[32rem] px-2">
        <div x-data="{
            jobs: {{ json_encode($highlightJobs) }},
            start: 0,
            visible: 3,
            interval: null,
            next() {
                this.start = (this.start + this.visible) % this.jobs.length;
            }
        }"
        x-init="interval = setInterval(() => next(), 4000)"
        @mouseenter="clearInterval(interval)" @mouseleave="interval = setInterval(() => next(), 4000)"
        class="w-full h-full">
            <h3 class="text-2xl font-extrabold text-indigo-700 mb-8 tracking-wide drop-shadow-lg">Job Highlights</h3>
            <template x-if="jobs.length === 0">
                <div class="px-4 py-6 rounded-xl bg-gradient-to-r from-indigo-100 to-blue-50 shadow-lg text-gray-500 text-center">
                    No jobs to highlight yet.
                </div>
            </template>
            <div class="flex flex-col gap-4 transition-all duration-700">
                <template x-for="(job, idx) in jobs.slice(start, start + visible)" :key="idx">
                    <div class="px-4 py-4 rounded-xl border-l-4 border-indigo-400 bg-white/70 backdrop-blur-md shadow-lg flex flex-col items-center">
                        <div class="font-extrabold text-indigo-800 text-lg text-center break-words w-full" x-text="job.title"></div>
                        <div class="text-blue-700 font-semibold mt-1 text-center break-words w-full" x-text="job.company"></div>
                        <div class="text-xs text-gray-500 mt-1 text-center break-words w-full" x-text="job.location"></div>
                    </div>
                </template>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </div>
</div>
@endsection
