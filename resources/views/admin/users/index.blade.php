@extends('layouts.app')

@section('title', 'System Administration - Access Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">System Administration</h1>
            <p class="text-slate-500 font-medium">Manage system access, user credentials, and technical configurations.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary-600 text-white text-sm font-bold rounded-xl shadow-xl shadow-primary-200 hover:bg-primary-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Create System User
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border-l-4 border-primary-500 shadow-sm border border-slate-100">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total System Users</p>
            <p class="text-3xl font-black text-slate-800">245</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-l-4 border-emerald-500 shadow-sm border border-slate-100">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Active Sessions</p>
            <p class="text-3xl font-black text-slate-800">42</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-l-4 border-amber-500 shadow-sm border border-slate-100">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pending Password Resets</p>
            <p class="text-3xl font-black text-slate-800">3</p>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border-l-4 border-rose-500 shadow-sm border border-slate-100">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Failed Logins (24h)</p>
            <p class="text-3xl font-black text-slate-800">12</p>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="text-xl font-black text-slate-800">User Access Management</h2>
            <div class="flex items-center gap-3">
                <select class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 outline-none focus:ring-4 focus:ring-primary-500/10">
                    <option>All Roles</option>
                    <option>Doctors</option>
                    <option>Secretary</option>
                </select>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search username..." class="pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10 w-64">
                </div>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">User Details</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Contact</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Role & Access</th>
                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                    <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/30 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-white font-black text-xs">
                                {{ substr($user->nom, 0, 1) }}{{ substr($user->prenom, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-800">{{ $user->prenom }} {{ $user->nom }}</div>
                                <div class="text-[10px] text-slate-400 font-bold">@ {{ $user->login }}</div>
                                <div class="text-[9px] text-slate-300 font-bold mt-0.5">DOB: {{ $user->dateNaissance ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        <div class="text-[11px] font-bold text-slate-600">{{ $user->contact }}</div>
                        <div class="text-[10px] text-slate-400">+212 611 111 111</div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black rounded-lg uppercase tracking-tighter">
                            {{ str_replace('_', ' ', $user->role->value) }}
                        </span>
                        <div class="text-[9px] text-slate-400 font-bold mt-1">Last login: 2h ago</div>
                    </td>
                    <td class="px-6 py-6">
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-lg uppercase">Active</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <!-- Reset Password -->
                            <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-lg hover:bg-amber-100 active:scale-95 transition-all">
                                    Reset Pwd
                                </button>
                            </form>

                            <!-- Edit User -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>

                            <!-- Delete / Disable -->
                            @if($user->id !== 1)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
