@extends('layouts.app')

@section('title', 'Médecin - Tableau de bord')

@section('sidebar')
    @include('medical.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Espace Médecin</h1>
            <p class="text-slate-400 font-medium mt-1">Tableau de bord clinique — Dr. {{ auth()->user()->nom }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Patient List -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50">
                <h2 class="text-lg font-black text-slate-800">Mes Patients</h2>
            </div>
            <div class="divide-y divide-slate-50">
                @foreach($patients as $patient)
                <a href="{{ route('medecin.dossier', $patient->id) }}" class="flex items-center justify-between px-8 py-5 hover:bg-slate-50/50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 font-bold text-sm">
                            {{ substr($patient->nom, 0, 1) }}{{ substr($patient->prenom, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $patient->nom }} {{ $patient->prenom }}</p>
                            <p class="text-[10px] text-slate-400 font-medium">ID: {{ $patient->login }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <form action="{{ route('medecin.archive', $patient->id) }}" method="POST" onsubmit="return confirm('Confirmer l\'archivage ?')">
                            @csrf
                            <button title="Archiver Dossier" class="p-2 text-slate-300 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            </button>
                        </form>
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-primary-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Interventions -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50">
                <h2 class="text-lg font-black text-slate-800">Interventions</h2>
            </div>
            <div class="divide-y divide-slate-50">
                @foreach($interventions as $intervention)
                <div class="px-8 py-5">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-bold text-slate-800">{{ $intervention->patient_nom }}</p>
                        <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                            @if($intervention->state->value === 'PLANIFIEE') bg-blue-50 text-blue-600 border border-blue-100
                            @elseif($intervention->state->value === 'EN_COURS') bg-amber-50 text-amber-600 border border-amber-100
                            @else bg-green-50 text-green-600 border border-green-100 @endif">
                            {{ str_replace('_', ' ', $intervention->state->value) }}
                        </span>
                    </div>
                    <p class="text-[10px] font-medium text-slate-400">{{ $intervention->date }} — {{ $intervention->medecin_nom }}</p>
                    <div class="mt-3 flex gap-2">
                        @if($intervention->state->value === 'PLANIFIEE')
                        <form action="{{ route('medecin.demarrer-intervention', $intervention->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-1.5 bg-primary-600 text-white text-[10px] font-black rounded-xl hover:bg-primary-700 transition-colors uppercase shadow-md shadow-primary-200">Démarrer</button>
                        </form>
                        @elseif($intervention->state->value === 'EN_COURS')
                        <form action="{{ route('medecin.cloturer-intervention', $intervention->id) }}" method="POST">
                            @csrf
                            <button class="px-4 py-1.5 bg-emerald-600 text-white text-[10px] font-black rounded-xl hover:bg-emerald-700 transition-colors uppercase shadow-md shadow-emerald-200">Clôturer</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
