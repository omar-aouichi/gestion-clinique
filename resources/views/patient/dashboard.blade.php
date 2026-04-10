@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">Patient Menu</div>
        <a href="/patient" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            My Dashboard
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=John+Doe&background=0284c7&color=fff" alt="User" class="w-10 h-10 rounded-full border border-slate-200 shadow-sm">
            <div>
                <div class="text-sm font-semibold text-slate-800">John Doe</div>
                <div class="text-xs text-slate-500">Patient</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Patient Dashboard</h1>
            <p class="text-sm text-slate-500 mt-1">Welcome back, check your health records and appointments.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium shadow-sm shadow-primary-600/20 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Book Appointment
            </button>
        </div>
    </div>

    <!-- Personal Data Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Personal Information
            </h2>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                Verified
            </span>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <dt class="text-sm font-medium text-slate-500">Full Name</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">John Doe</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500">CIN</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">CD123456</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500">Date of Birth</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">15/04/1985 (39 years)</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500">Email Address</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">john.doe@example.com</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500">Phone</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">+212 600 000 000</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-500">Patient ID</dt>
                <dd class="mt-1 text-sm font-semibold text-slate-900">PT-2023-8942</dd>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Appointments (Takes up 2 columns on large screens) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ showCancelModal: false, selectedApt: null }">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Upcoming Appointments
                    </h2>
                </div>
                
                <div class="divide-y divide-slate-100">
                    <!-- Apt 1 -->
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-primary-50 rounded-xl flex flex-col items-center justify-center text-primary-700 flex-shrink-0">
                                <span class="text-sm font-bold leading-none">12</span>
                                <span class="text-xs font-semibold uppercase leading-none mt-1">Oct</span>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-slate-900 flex items-center gap-2">
                                    Cardiology Consultation
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">Dr. Sarah Smith • Room 102</p>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="inline-flex items-center text-xs text-slate-500 bg-white border border-slate-200 px-2 py-1 rounded">10:00 AM - 10:30 AM</span>
                                </div>
                            </div>
                        </div>
                        <button @click="showCancelModal = true; selectedApt = 'Cardiology Consultation'" class="text-sm text-red-600 hover:text-red-700 font-medium px-3 py-1.5 border border-red-200 hover:bg-red-50 rounded-lg transition-colors whitespace-nowrap">
                            Cancel
                        </button>
                    </div>

                    <!-- Apt 2 -->
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/80 transition-colors">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-primary-50 rounded-xl flex flex-col items-center justify-center text-primary-700 flex-shrink-0">
                                <span class="text-sm font-bold leading-none">28</span>
                                <span class="text-xs font-semibold uppercase leading-none mt-1">Oct</span>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-slate-900 flex items-center gap-2">
                                    General Checkup
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">Confirmed</span>
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">Dr. Ahmed Bennani • Room 45</p>
                            </div>
                        </div>
                        <button @click="showCancelModal = true; selectedApt = 'General Checkup'" class="text-sm text-red-600 hover:text-red-700 font-medium px-3 py-1.5 border border-red-200 hover:bg-red-50 rounded-lg transition-colors whitespace-nowrap">
                            Cancel
                        </button>
                    </div>
                </div>

                <!-- Cancel Modal (Alpine) -->
                <div x-show="showCancelModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="showCancelModal" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div x-show="showCancelModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-semibold text-slate-900" id="modal-title">
                                            Cancel Appointment
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-slate-600">
                                                Are you sure you want to cancel your <strong x-text="selectedApt"></strong> appointment?
                                            </p>
                                            <div class="mt-4 bg-amber-50 border border-amber-200 rounded-lg p-3 flex gap-3 text-sm text-amber-800">
                                                <svg class="w-5 h-5 flex-shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <p>Warning: Cancellation is only permitted up to <strong>24 hours</strong> before the scheduled time. Missed appointments without notice may incur a fee.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                                <button type="button" @click="showCancelModal = false" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                    Confirm Cancellation
                                </button>
                                <button type="button" @click="showCancelModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                    Keep Appointment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Past History -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-lg font-semibold text-slate-800">Recent History</h2>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                <th class="p-4">Date</th>
                                <th class="p-4">Intervention</th>
                                <th class="p-4">Doctor</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 align-top text-sm">
                            <tr>
                                <td class="p-4 text-slate-900 font-medium">10 Sep 2023</td>
                                <td class="p-4 text-slate-600">Blood Test</td>
                                <td class="p-4 text-slate-600">Lab Tech. Ali</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Completed</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-4 text-slate-900 font-medium">05 Aug 2023</td>
                                <td class="p-4 text-slate-600">Consultation</td>
                                <td class="p-4 text-slate-600">Dr. Sarah Smith</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">Canceled</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Prescriptions & Results) -->
        <div class="space-y-6">
            <!-- Test Results -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50 border-t-4 border-t-teal-500 flex justify-between items-center">
                    <h2 class="text-base font-semibold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        Test Results & Lab
                    </h2>
                    <a href="#" class="text-xs text-primary-600 hover:text-primary-700 font-medium">View All</a>
                </div>
                <div class="p-4 space-y-4">
                    <a href="#" class="block p-3 rounded-lg border border-slate-200 hover:border-primary-300 hover:ring-1 hover:ring-primary-300 transition-all group">
                        <div class="flex justify-between items-start">
                            <h3 class="text-sm font-semibold text-slate-800 group-hover:text-primary-700">Complete Blood Count (CBC)</h3>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">10 Sep 2023 • Validated by Dr. Hassan</p>
                    </a>
                    <a href="#" class="block p-3 rounded-lg border border-slate-200 hover:border-primary-300 hover:ring-1 hover:ring-primary-300 transition-all group">
                        <div class="flex justify-between items-start">
                            <h3 class="text-sm font-semibold text-slate-800 group-hover:text-primary-700">Chest X-Ray</h3>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">02 Jun 2023 • Validated by Dr. Idrissi</p>
                    </a>
                </div>
            </div>

            <!-- Prescriptions -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50 border-t-4 border-t-primary-500 flex justify-between items-center">
                    <h2 class="text-base font-semibold text-slate-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Active Prescriptions
                    </h2>
                </div>
                <div class="p-4 space-y-4">
                    <div class="flex gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-slate-800">Amoxicillin 500mg</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Take 1 pill every 8 hours for 7 days.</p>
                            <p class="text-xs font-medium text-primary-600 mt-1">Prescribed by Dr. Sarah Smith</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
