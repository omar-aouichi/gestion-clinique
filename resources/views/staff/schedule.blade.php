@extends('layouts.app')

@section('title', 'Medical Staff - Schedule')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">Medical Staff</div>
        <a href="/staff" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            My Schedule
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=10b981&color=fff" alt="User" class="w-10 h-10 rounded-full border border-slate-200 shadow-sm">
            <div>
                <div class="text-sm font-semibold text-slate-800">Dr. Sarah Smith</div>
                <div class="text-xs text-slate-500">Doctor (Cardiology)</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">My Schedule</h1>
            <p class="text-sm text-slate-500 mt-1">View your upcoming interventions, consultations, and operations.</p>
        </div>
        <div class="flex items-center gap-3 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
            <button class="px-3 py-1.5 text-sm font-medium bg-primary-50 text-primary-700 rounded-md">Day</button>
            <button class="px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-md">Week</button>
            <button class="px-3 py-1.5 text-sm font-medium text-slate-600 hover:bg-slate-50 rounded-md">Month</button>
        </div>
    </div>

    <!-- Stats summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Today's Patients</p>
                <p class="text-2xl font-bold text-slate-900 mt-1">12</p>
            </div>
            <div class="w-10 h-10 bg-primary-50 rounded-full flex items-center justify-center text-primary-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Surgeries</p>
                <p class="text-2xl font-bold text-slate-900 mt-1">2</p>
            </div>
            <div class="w-10 h-10 bg-rose-50 rounded-full flex items-center justify-center text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Pending</p>
                <p class="text-2xl font-bold text-slate-900 mt-1">4</p>
            </div>
            <div class="w-10 h-10 bg-amber-50 rounded-full flex items-center justify-center text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between border-l-4 border-l-primary-500">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Next Slot</p>
                <p class="text-lg font-bold text-slate-900 mt-1">10:30 AM</p>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">Ready</span>
            </div>
        </div>
    </div>

    <!-- Calendar View Detailed List -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Today's Interventions
            </h2>
            <div class="text-sm font-medium text-slate-600">
                Oct 12, 2023
            </div>
        </div>
        
        <div class="divide-y divide-slate-100">
            <!-- Intervention 1 -->
            <div class="p-6 flex flex-col md:flex-row gap-6 hover:bg-slate-50/50 transition-colors">
                <div class="min-w-[120px]">
                    <div class="text-lg font-bold text-slate-900">09:00 AM</div>
                    <div class="text-sm text-slate-500">1 Hour</div>
                    <span class="inline-flex items-center px-2 py-0.5 mt-2 rounded text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">Completed</span>
                </div>
                
                <div class="border-l-4 border-emerald-400 pl-4 flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-semibold text-slate-900">General Consultation</h3>
                                <span class="bg-slate-100 text-slate-600 text-[10px] uppercase font-bold px-2 py-0.5 rounded tracking-wide">INT-C0123</span>
                            </div>
                            <p class="text-sm text-slate-600 mt-1"><span class="font-medium">Patient:</span> John Doe (PT-2023-8942)</p>
                        </div>
                        <div class="text-right flex flex-col items-end">
                            <span class="text-xs font-semibold px-2 py-1 bg-slate-100 rounded text-slate-600">Room 102</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 bg-slate-50 rounded-lg p-3 border border-slate-100 flex flex-wrap gap-4 text-sm">
                        <div>
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Resp. Doctor</span>
                            <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" class="w-5 h-5 rounded-full" alt="">
                                Dr. Sarah Smith
                            </div>
                        </div>
                        <div>
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Assigned Nurses</span>
                            <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                <img src="https://ui-avatars.com/api/?name=Emma+B&background=random" class="w-5 h-5 rounded-full" alt="">
                                Nurse Emma B.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Intervention 2 (Surgery) -->
            <div class="p-6 flex flex-col md:flex-row gap-6 hover:bg-slate-50/50 transition-colors">
                <div class="min-w-[120px]">
                    <div class="text-lg font-bold text-slate-900">10:30 AM</div>
                    <div class="text-sm text-slate-500">2 Hours</div>
                    <span class="inline-flex items-center px-2 py-0.5 mt-2 rounded text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">Confirmed</span>
                </div>
                
                <div class="border-l-4 border-rose-500 pl-4 flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-semibold text-slate-900">Appendectomy Surgery</h3>
                                <span class="bg-rose-100 text-rose-700 text-[10px] uppercase font-bold px-2 py-0.5 rounded tracking-wide">INT-S0941</span>
                            </div>
                            <p class="text-sm text-slate-600 mt-1"><span class="font-medium">Patient:</span> Alice Cooper (PT-2021-1120)</p>
                        </div>
                        <div class="text-right flex flex-col items-end">
                            <span class="text-xs font-semibold px-2 py-1 bg-rose-50 border border-rose-200 rounded text-rose-700 font-bold">OR - Room 4</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 bg-slate-50 rounded-lg p-3 border border-slate-100 flex flex-wrap gap-4 text-sm">
                        <div>
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Resp. Doctor</span>
                            <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" class="w-5 h-5 rounded-full" alt="">
                                Dr. Sarah Smith
                            </div>
                        </div>
                        <div>
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Assigned Nurses</span>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                    <img src="https://ui-avatars.com/api/?name=Liam+O&background=random" class="w-5 h-5 rounded-full" alt="">
                                    Liam O.
                                </div>
                                <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                    <img src="https://ui-avatars.com/api/?name=Noah+W&background=random" class="w-5 h-5 rounded-full" alt="">
                                    Noah W.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Intervention 3 -->
            <div class="p-6 flex flex-col md:flex-row gap-6 hover:bg-slate-50/50 transition-colors">
                <div class="min-w-[120px]">
                    <div class="text-lg font-bold text-slate-900">02:00 PM</div>
                    <div class="text-sm text-slate-500">30 Mins</div>
                    <span class="inline-flex items-center px-2 py-0.5 mt-2 rounded text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">Pending</span>
                </div>
                
                <div class="border-l-4 border-amber-400 pl-4 flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-semibold text-slate-900">MRI Imaging Follow-up</h3>
                                <span class="bg-slate-100 text-slate-600 text-[10px] uppercase font-bold px-2 py-0.5 rounded tracking-wide">INT-I4029</span>
                            </div>
                            <p class="text-sm text-slate-600 mt-1"><span class="font-medium">Patient:</span> Mark Johnson (PT-2023-0091)</p>
                        </div>
                        <div class="text-right flex flex-col items-end">
                            <span class="text-xs font-semibold px-2 py-1 bg-slate-100 rounded text-slate-600">Imaging Cntr</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 bg-slate-50 rounded-lg p-3 border border-slate-100 flex flex-wrap gap-4 text-sm">
                        <div>
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Resp. Doctor</span>
                            <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=random" class="w-5 h-5 rounded-full" alt="">
                                Dr. Sarah Smith
                            </div>
                        </div>
                        <div class="col-span-2">
                            <span class="text-slate-500 block text-xs font-semibold mb-0.5">Notes</span>
                            <p class="text-slate-700 italic">Check for ligament tear progression.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
