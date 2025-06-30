@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-indigo-700 mb-6 text-center">My Profile</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-center">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            <!-- Common Fields -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->Name) }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->Email) }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
            </div>

            @if($user->UserType === 'jobseeker')
                <div class="border-t pt-4">
                    <div class="mb-2 text-indigo-600 font-semibold">Jobseeker Profile</div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->DateOfBirth ?? '') }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" name="address" value="{{ old('address', $profile->Address ?? '') }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Summary</label>
                        <textarea name="profile_summary" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none" rows="4" required>{{ old('profile_summary', $profile->ProfileSummary ?? '') }}</textarea>
                    </div>
                </div>
            @else
                <div class="border-t pt-4">
                    <div class="mb-2 text-indigo-600 font-semibold">Employer Profile</div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="CompanyName" value="{{ old('CompanyName', $profile->CompanyName) }}" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                        <textarea name="company_description" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none resize-none" rows="4" required>{{ old('company_description', $profile->CompanyDescription ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Website</label>
                        <input type="url" name="company_website" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" value="{{ old('company_website', $profile->CompanyWebsite ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Verified Status</label><br>
                        @if(isset($profile->VerifiedStatus) && $profile->VerifiedStatus)
                            <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
                        @else
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">Not Verified</span>
                        @endif
                    </div>
                </div>
            @endif
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow transition text-lg mt-2">Update Profile</button>
        </form>
    </div>
</div>
@endsection
