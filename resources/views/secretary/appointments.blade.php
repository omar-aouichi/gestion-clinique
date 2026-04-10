@extends('layouts.app')

@section('title', 'Secretary Dashboard - Appointments & Planning')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">Secretary</div>
        <a href="/secretary" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Planner & Booking
        </a>
        <a href="/secretary/create-patient" class="text-slate-600 hover:bg-slate-50 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
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
<div class="space-y-6" x-data="{ emergencyMode: false }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Resource & Appointment Planning</h1>
            <p class="text-sm text-slate-500 mt-1">Manage schedules, doctor availability, and book interventions.</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/secretary/create-patient" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-lg font-medium shadow-sm transition-all flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                New Patient
            </a>
            
            <!-- Emergency Toggle -->
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="emergencyMode" class="sr-only peer">
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                <span class="ml-3 text-sm font-medium" :class="emergencyMode ? 'text-red-600 font-bold' : 'text-slate-600'">Emergency Mode</span>
            </label>
        </div>
    </div>

    <!-- Emergency Form (Visible only when emergencyMode is true) -->
    <div x-show="emergencyMode" x-collapse>
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 shadow-sm mb-6">
            <div class="flex items-start gap-4">
                <div class="bg-red-100 p-3 rounded-full text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-base font-bold text-red-800">Immediate Intervention "Under X"</h2>
                    <p class="text-sm text-red-600 mt-1">Bypass standard planning. This will immediately page available on-call doctors and reserve emergency equipment.</p>
                    
                    <form class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-red-700 mb-1">Patient Name (Unknown "X" if blank)</label>
                            <input type="text" placeholder="Patient X" class="w-full bg-white border border-red-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-red-700 mb-1">Intervention Type</label>
                            <select class="w-full bg-white border border-red-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option>Trauma Surgery</option>
                                <option>Cardiac Arrest</option>
                                <option>Severe Accident</option>
                                <option>Other Emergency</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg px-4 py-2 transition-colors">
                                Trigger Alert & Assign
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Interface & Visual Planner -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col md:flex-row h-[700px]">
        
        <!-- Sidebar filters -->
        <div class="w-full md:w-72 border-r border-slate-200 bg-slate-50/50 p-4 overflow-y-auto flex-shrink-0">
            <h3 class="font-semibold text-slate-800 mb-4">Book New Appointment</h3>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Patient Search</label>
                    <div class="relative">
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="CIN, Name or Phone..." class="w-full pl-9 pr-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Intervention Type</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                        <option>Consultation</option>
                        <option>Surgery</option>
                        <option>Analysis</option>
                        <option>Imaging</option>
                    </select>
                </div>

                <div class="pt-2 pb-2 border-y border-slate-200 my-4">
                    <h4 class="text-xs font-semibold text-slate-700 uppercase tracking-wider mb-3">Required Resources</h4>
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" checked class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700">Doctor</span>
                        </label>
                        <select class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm bg-white">
                            <option>Any Available Doctor</option>
                            <option>Dr. Sarah Smith (Cardiology)</option>
                            <option>Dr. Ahmed Bennani (General)</option>
                        </select>

                        <div class="h-2"></div>
                        
                        <label class="flex items-center gap-2">
                            <input type="checkbox" checked class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700">Nurse Assistance</span>
                        </label>
                        
                        <div class="h-2"></div>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700">Required Equipment</span>
                        </label>
                        <select class="w-full px-3 py-1.5 border border-slate-300 rounded-lg text-sm bg-white">
                            <option>Echograph</option>
                            <option>MRI Scanner</option>
                            <option>X-Ray Machine</option>
                        </select>
                    </div>
                </div>

                <button type="button" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg px-4 py-2 mt-2 transition-colors">
                    Find Slot & Book
                </button>
            </form>
        </div>

        <!-- Visual Planner Calendar -->
        <div class="flex-1 flex flex-col bg-white overflow-hidden relative">
            <div class="h-14 border-b border-slate-200 flex items-center justify-between px-6 bg-white">
                <div class="flex items-center gap-4">
                    <button class="p-1 hover:bg-slate-100 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                    <span class="font-semibold text-slate-800">Today, Oct 12, 2023</span>
                    <button class="p-1 hover:bg-slate-100 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                </div>
                <!-- Timeline/Resource View Toggle -->
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button class="px-3 py-1 text-sm font-medium bg-white shadow-sm rounded-md text-slate-800">Timeline</button>
                    <button class="px-3 py-1 text-sm font-medium text-slate-500 hover:text-slate-800">Rooms</button>
                </div>
            </div>
            
            <div class="flex-1 overflow-auto relative bg-slate-50/30">
                <!-- Grid Lines representing hours -->
                <div class="absolute inset-x-0 top-0 h-full">
                    @for ($i = 8; $i <= 18; $i++)
                    <div class="border-b border-slate-200 h-20 flex">
                        <div class="w-16 border-r border-slate-200 flex-shrink-0 flex items-center justify-center text-xs font-medium text-slate-400 bg-white">
                            {{ $i }}:00
                        </div>
                        <div class="flex-1 grid grid-cols-3 divide-x divide-slate-100/50">
                            <div></div><div></div><div></div>
                        </div>
                    </div>
                    @endfor
                </div>

                <!-- Resource Header (Mocking Simultaneous Availability) -->
                <div class="absolute top-0 left-16 right-0 h-10 border-b border-slate-200 flex z-10 bg-white/90 backdrop-blur text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <div class="flex-1 flex items-center justify-center border-r border-slate-100">Dr. Sarah (Cardio)</div>
                    <div class="flex-1 flex items-center justify-center border-r border-slate-100">Dr. Ahmed (Gen)</div>
                    <div class="flex-1 flex items-center justify-center">Echograph Room</div>
                </div>

                <!-- Scheduled Events Overlay -->
                <div class="absolute top-10 left-16 right-0 bottom-0 grid grid-cols-3 z-10 pt-4">
                    <!-- Column 1: Dr Sarah -->
                    <div class="relative px-2">
                        <!-- Example Event -->
                        <div class="absolute top-10 left-2 right-2 h-20 bg-primary-50 border-l-4 border-primary-500 rounded-md p-2 shadow-sm flex flex-col justify-between overflow-hidden cursor-pointer hover:shadow-md transition-shadow">
                            <div>
                                <span class="text-xs font-semibold text-primary-700 block">Consultation - John Doe</span>
                                <span class="text-[10px] text-primary-600 block">09:00 - 10:00 • Confirmed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Dr Ahmed -->
                    <div class="relative px-2">
                        <div class="absolute top-32 left-2 right-2 h-16 bg-emerald-50 border-l-4 border-emerald-500 rounded-md p-2 shadow-sm flex flex-col justify-between overflow-hidden cursor-pointer hover:shadow-md transition-shadow">
                            <div>
                                <span class="text-xs font-semibold text-emerald-700 block">Consultation - Jane Roe</span>
                                <span class="text-[10px] text-emerald-600 block">10:00 - 10:45 • Completed</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column 3: Equipment Room -->
                    <div class="relative px-2">
                        <!-- Simultaneous availability block -->
                        <div class="absolute top-10 left-2 right-2 h-20 bg-primary-50 border-l-4 border-primary-500 rounded-md p-2 shadow-sm opacity-50">
                            <!-- Linked to Dr Sarah's event -->
                            <div>
                                <span class="text-xs font-semibold text-slate-700 block">In Use (Dr. Sarah)</span>
                            </div>
                        </div>
                        
                        <!-- Maintenance Block -->
                        <div class="absolute top-64 left-2 right-2 h-20 bg-slate-100 border-l-4 border-slate-400 rounded-md p-2 shadow-sm">
                            <span class="text-xs font-semibold text-slate-600 block">Maintenance</span>
                        </div>
                    </div>
                </div>

                <!-- Current Time Indicator -->
                <div class="absolute top-48 left-0 right-0 z-20 flex items-center pointer-events-none">
                    <div class="w-16 flex justify-end pr-2"><span class="text-[10px] font-bold text-red-500">10:30</span></div>
                    <div class="flex-1 border-t-2 border-red-500 relative">
                        <div class="absolute -left-1 -top-1 w-2 h-2 rounded-full bg-red-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
