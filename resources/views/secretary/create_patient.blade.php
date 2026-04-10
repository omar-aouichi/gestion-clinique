@extends('layouts.app')

@section('title', 'Create Patient Account')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">Secretary</div>
        <a href="/secretary" class="text-slate-600 hover:bg-slate-50 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Planner & Booking
        </a>
        <a href="/secretary/create-patient" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            New Patient
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=Salma+Tazi&background=a21caf&color=fff" alt="User" class="w-10 h-10 rounded-full border border-slate-200 shadow-sm">
            <div>
                <div class="text-sm font-semibold text-slate-800">Salma Tazi</div>
                <div class="text-xs text-slate-500">Secretary</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="/secretary" class="text-slate-400 hover:text-primary-600 transition-colors p-2 rounded-full hover:bg-primary-50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Create Patient Account</h1>
            <p class="text-sm text-slate-500 mt-1">Register a new patient before granting system access.</p>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-lg font-semibold text-slate-800">Patient Data</h2>
        </div>
        
        <form class="p-6 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- CIN -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">CIN (Identity Card)</label>
                    <input type="text" placeholder="e.g. CD123456" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
                </div>

                <!-- Empty space for grid alignment if needed, or put something else -->
                <div></div>

                <!-- First Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                    <input type="text" placeholder="John" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                    <input type="text" placeholder="Doe" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
                </div>

                <!-- DOB -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Date of Birth</label>
                    <input type="date" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow text-slate-700">
                </div>

                <!-- Gender (Optional but good for medical) -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Gender</label>
                    <select class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow bg-white text-slate-700">
                        <option>Select...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>

            <hr class="border-slate-100">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <input type="email" placeholder="patient@example.com" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Phone Number</label>
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <input type="tel" placeholder="+212 600 000 000" class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-shadow">
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" class="px-5 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-medium transition-colors">
                    Clear Form
                </button>
                <button type="button" class="px-5 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg shadow-sm shadow-primary-600/20 font-medium transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Create Account & Send Access
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
