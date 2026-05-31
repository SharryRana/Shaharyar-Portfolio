@extends('blog::admin.layout')

@section('title', 'Admin Profile')

@section('content')
@php
    $inputClass = 'mt-2 block h-12 w-full rounded-lg border border-gray-200 bg-white px-4 text-sm font-semibold text-gray-800 shadow-sm transition placeholder:text-gray-400 focus:border-brand-accent focus:outline-none focus:ring-2 focus:ring-brand-accent/20 dark:border-gray-700 dark:bg-gray-900/60 dark:text-gray-100 dark:placeholder:text-gray-500';
    $labelClass = 'block text-sm font-semibold text-gray-700 dark:text-gray-300';
@endphp

<div class="px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8 md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">Admin Profile</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update your account details and password.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 dark:border-red-800 dark:bg-red-900/30 dark:text-red-300">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-100 bg-gray-50/80 px-6 py-5 dark:border-gray-700 dark:bg-gray-900/30">
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Account Settings</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">These details are used in the admin panel.</p>
        </div>

        <div class="p-6 sm:p-8">
            <form action="{{ route('blog-admin.profile.update') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="{{ $labelClass }}">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="{{ $inputClass }}" autocomplete="name">
                    </div>
                    
                    <div>
                        <label for="email" class="{{ $labelClass }}">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="{{ $inputClass }}" autocomplete="email">
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8 dark:border-gray-700">
                    <div class="mb-5">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Change Password</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave these fields blank to keep your current password.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="password" class="{{ $labelClass }}">New Password</label>
                            <input type="password" name="password" id="password" class="{{ $inputClass }}"
                                autocomplete="new-password" placeholder="Enter a new password">
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="{{ $labelClass }}">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="{{ $inputClass }}" autocomplete="new-password" placeholder="Repeat new password">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end border-t border-gray-100 pt-6 dark:border-gray-700">
                    <button type="submit" class="inline-flex h-11 items-center justify-center rounded-lg border border-transparent bg-brand-accent px-6 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e] focus:outline-none focus:ring-2 focus:ring-brand-accent/30 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-800">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
