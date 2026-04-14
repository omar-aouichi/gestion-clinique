@extends('layouts.app')

@section('title', 'Logs Système - Admin Portal')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Journal des Actions</h1>
            <p class="text-slate-500 mt-1">Surveillez toutes les activités administratives et modifications du système.</p>
        </div>
        <div>
            <button class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2z"></path></svg>
                Exporter les logs (.CSV)
            </button>
        </div>
    </div>

    <!-- Timeline/Table View -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="px-8 py-4 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Activité Récente</span>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Temps Réel Actif</span>
            </div>
        </div>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/30 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Horodatage</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Action / Événement</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Auteur</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($logs as $log)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-5 text-xs font-mono text-slate-500 whitespace-nowrap">
                        {{ $log->timestamp }}
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full {{ str_contains($log->action, 'Suppression') ? 'bg-red-500' : (str_contains($log->action, 'Création') ? 'bg-green-500' : 'bg-primary-500') }}"></div>
                            <span class="text-sm font-medium text-slate-700 leading-relaxed">{{ $log->action }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-slate-800">{{ $log->user_name }}</div>
                                <div class="text-[10px] text-slate-400 uppercase tracking-tighter">ID: #{{ $log->user_id }}</div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
