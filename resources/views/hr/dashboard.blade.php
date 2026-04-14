@extends('layouts.app')

@section('title', 'HR Manager Dashboard')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">HR Manager</div>
        <a href="/hr" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Staff & Departments
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=Youssef+B&background=eab308&color=fff" alt="User" class="w-10 h-10 rounded-full border border-slate-200 shadow-sm">
            <div>
                <div class="text-sm font-semibold text-slate-800">Youssef B.</div>
                <div class="text-xs text-slate-500">Head of HR</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">HR Manager Dashboard</h1>
            <p class="text-sm text-slate-500 mt-1">Manage employee lifecycle, departments, and roles.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-lg font-medium shadow-sm transition-all text-sm">
                Manage Departments
            </button>
            <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium shadow-sm shadow-primary-600/20 transition-all flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Onboard Employee
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Total Active Staff</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-2xl font-bold text-slate-900">142</p>
                    <span class="text-xs font-medium text-emerald-600">+4 this month</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Departments</p>
                <p class="text-2xl font-bold text-slate-900">8</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase">Contract Renewals (30d)</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-2xl font-bold text-slate-900">7</p>
                    <span class="text-xs font-medium text-amber-600">Action Needed</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Departments Overview Sidebar -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-semibold text-slate-800">Functional Departments</h2>
            </div>
            <div class="p-3 divide-y divide-slate-50">
                <a href="#" class="block p-3 rounded-lg hover:bg-primary-50 transition-colors group">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-slate-800 group-hover:text-primary-700">Cardiology</span>
                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full">15 Staff</span>
                    </div>
                    <p class="text-xs text-slate-500">Head: Dr. Sarah Smith</p>
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-primary-50 transition-colors group">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-slate-800 group-hover:text-primary-700">Emergency / Trauma</span>
                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full">32 Staff</span>
                    </div>
                    <p class="text-xs text-slate-500">Head: Dr. Ahmed Bennani</p>
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-primary-50 transition-colors group">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-slate-800 group-hover:text-primary-700">Pediatrics</span>
                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full">24 Staff</span>
                    </div>
                    <p class="text-xs text-slate-500">Head: Dr. Leila Tazi</p>
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-primary-50 transition-colors group">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-slate-800 group-hover:text-primary-700">Surgery / OR</span>
                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full">41 Staff</span>
                    </div>
                    <p class="text-xs text-slate-500">Head: Dr. Karim Fassi</p>
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-primary-50 transition-colors group">
                    <div class="flex justify-between items-center mb-1">
                        <span class="font-semibold text-slate-800 group-hover:text-primary-700">Administration & HR</span>
                        <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2 py-0.5 rounded-full">12 Staff</span>
                    </div>
                    <p class="text-xs text-slate-500">Head: Youssef Benali</p>
                </a>
            </div>
        </div>

        <!-- Employee Directory / Contract Lifecycle -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-lg font-semibold text-slate-800">Employee Directory & Lifecycle</h2>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search staff..." class="pl-9 pr-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none w-full sm:w-64">
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="p-4">Employee</th>
                            <th class="p-4">Role & Category</th>
                            <th class="p-4">Department</th>
                            <th class="p-4">Contract Status</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($employes as $emp)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($emp->nom) }}&background=F0F9FF&color=0284c7" alt="" class="w-9 h-9 rounded-full">
                                    <div>
                                        <form action="{{ route('rh.modifier-employe', $emp->id) }}" method="POST" class="flex gap-2 items-center">
                                            @csrf @method('PUT')
                                            <input type="text" name="nom" value="{{ $emp->nom }}" class="font-semibold text-slate-900 border border-transparent hover:border-slate-300 px-1 py-0.5 rounded text-sm w-32 focus:outline-none focus:ring-1 focus:ring-primary-500">
                                            <button type="submit" class="text-xs bg-slate-100 px-2 py-0.5 rounded text-slate-600 hover:bg-slate-200">Save</button>
                                        </form>
                                        <p class="text-xs text-slate-500">Employé #{{ $emp->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <p class="font-medium text-slate-800">Staff</p>
                                <p class="text-xs text-slate-500">Cat B</p>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('rh.affecter-employe') }}" method="POST" class="flex gap-1 items-center">
                                    @csrf
                                    <input type="hidden" name="employe_id" value="{{ $emp->id }}">
                                    <select name="departement_id" onchange="this.form.submit()" class="bg-primary-50 text-primary-700 text-xs font-semibold px-2 py-1 rounded-lg border-none outline-none">
                                        <option value="">Dept: {{ $emp->departement_id }}</option>
                                        <option value="1">Cardiology (1)</option>
                                        <option value="2">Surgery (2)</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $emp->state->value }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <form action="{{ route('rh.retirer-employe') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="employe_id" value="{{ $emp->id }}">
                                    <button type="submit" class="text-xs text-red-600 hover:text-red-800 font-medium bg-red-50 px-2 py-1 rounded">Retirer Dept</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-between items-center text-sm text-slate-500">
                <span>Showing 1 to 4 of 142 entries</span>
                <div class="flex gap-1">
                    <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100 disabled:opacity-50" disabled>Prev</button>
                    <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100 bg-white shadow-sm font-medium text-slate-800">1</button>
                    <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100 bg-white">2</button>
                    <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100 bg-white">3</button>
                    <button class="px-3 py-1 border border-slate-300 rounded hover:bg-slate-100 bg-white">Next</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
