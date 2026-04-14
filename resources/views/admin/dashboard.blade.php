@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">System Administration</h1>
            <p class="text-sm text-slate-500 mt-1">Manage system access, user credentials, and technical configurations.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium shadow-sm shadow-primary-600/20 transition-all flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Create System User
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-primary-500">
            <p class="text-sm font-medium text-slate-500">Total System Users</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">245</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-emerald-500">
            <p class="text-sm font-medium text-slate-500">Active Sessions</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">42</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-amber-500">
            <p class="text-sm font-medium text-slate-500">Pending Password Resets</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">3</p>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm border-l-4 border-l-rose-500">
            <p class="text-sm font-medium text-slate-500">Failed Logins (24h)</p>
            <p class="text-2xl font-bold text-slate-900 mt-2">12</p>
        </div>
    </div>

    <!-- User Management Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ showResetModal: false, selectedUser: '' }">
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <h2 class="text-lg font-semibold text-slate-800">User Access Management</h2>
            <div class="flex gap-3">
                <select class="border border-slate-300 rounded-lg px-3 py-1.5 text-sm bg-white outline-none focus:ring-2 focus:ring-primary-500">
                    <option>All Roles</option>
                    <option>Doctors</option>
                    <option>Nurses</option>
                    <option>Secretary</option>
                    <option>HR</option>
                    <option>Admin</option>
                </select>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search username..." class="pl-9 pr-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 outline-none w-full sm:w-64">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                        <th class="p-4">User Details</th>
                        <th class="p-4">Contact</th>
                        <th class="p-4">Role & Access</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <!-- User 1 -->
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-4">
                            <div>
                                <p class="font-semibold text-slate-900">Dr. Sarah Smith</p>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">@sarah.smith</p>
                                <p class="text-[10px] text-slate-400 mt-1">DOB: 12/05/1980</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="text-slate-800">sarah.smith@docdialy.com</p>
                            <p class="text-xs text-slate-500">+212 611 111 111</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-100 text-primary-800">
                                Doctor
                            </span>
                            <p class="text-[10px] text-slate-500 mt-1">Last login: 2h ago</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="showResetModal = true; selectedUser = '@sarah.smith'" class="px-2.5 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded transition-colors" title="Force Password Reset">
                                    Reset Pwd
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded transition-colors" title="Edit User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Disable User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- User 2 -->
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-4">
                            <div>
                                <p class="font-semibold text-slate-900">Salma Tazi</p>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">@salma.tazi</p>
                                <p class="text-[10px] text-slate-400 mt-1">DOB: 14/09/1990</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="text-slate-800">sec.salma@docdialy.com</p>
                            <p class="text-xs text-slate-500">+212 622 222 222</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-fuchsia-100 text-fuchsia-800">
                                Secretary
                            </span>
                            <p class="text-[10px] text-slate-500 mt-1">Last login: 5m ago</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="showResetModal = true; selectedUser = '@salma.tazi'" class="px-2.5 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded transition-colors" title="Force Password Reset">
                                    Reset Pwd
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded transition-colors" title="Edit User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Disable User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- User 3 -->
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-4">
                            <div>
                                <p class="font-semibold text-slate-900">Youssef Benali</p>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">@youssef.hr</p>
                                <p class="text-[10px] text-slate-400 mt-1">DOB: 03/01/1985</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="text-slate-800">hr.head@docdialy.com</p>
                            <p class="text-xs text-slate-500">+212 633 333 333</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                HR Manager
                            </span>
                            <p class="text-[10px] text-slate-500 mt-1">Last login: 1d ago</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Active
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button @click="showResetModal = true; selectedUser = '@youssef.hr'" class="px-2.5 py-1.5 text-xs font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded transition-colors" title="Force Password Reset">
                                    Reset Pwd
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded transition-colors" title="Edit User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded transition-colors" title="Disable User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- User 4 (Locked) -->
                    <tr class="hover:bg-slate-50/50 bg-rose-50/20">
                        <td class="p-4">
                            <div>
                                <p class="font-semibold text-slate-900">Admin Staff</p>
                                <p class="text-xs font-mono text-slate-500 mt-0.5">@admin_temp</p>
                                <p class="text-[10px] text-slate-400 mt-1">DOB: --/--/----</p>
                            </div>
                        </td>
                        <td class="p-4">
                            <p class="text-slate-800">temp@docdialy.com</p>
                            <p class="text-xs text-slate-500">N/A</p>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-800 text-white">
                                Super Admin
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200">
                                Locked (Failed Logins)
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="px-2.5 py-1.5 text-xs font-medium text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 rounded transition-colors">
                                    Unlock
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Password Reset Modal (Alpine) -->
        <div x-show="showResetModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showResetModal" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showResetModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-semibold text-slate-900" id="modal-title">
                                    Force Password Reset
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-600">
                                        You are about to force a password reset for <strong x-text="selectedUser"></strong>. 
                                        The user will be required to change their password upon their next login. 
                                    </p>
                                    <form class="mt-4">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1">Temporary Password Generation</label>
                                        <div class="flex items-center gap-2">
                                            <input type="text" value="T3mpP@ss#2023" readonly class="bg-slate-100 border border-slate-300 rounded px-3 py-1.5 text-sm text-slate-600 flex-1 font-mono">
                                            <button type="button" class="px-3 py-1.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-medium rounded transition-colors">Copy</button>
                                        </div>
                                        <p class="text-[10px] text-slate-500 mt-1">Please securely communicate this temporary password to the user.</p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-200">
                        <button type="button" @click="showResetModal = false" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-amber-600 text-base font-medium text-white hover:bg-amber-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Confirm Reset
                        </button>
                        <button type="button" @click="showResetModal = false" class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
