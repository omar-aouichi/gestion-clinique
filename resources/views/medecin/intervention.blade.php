@extends('layouts.app')

@section('title', 'Médecin - Dossier Patient')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ activeTab: 'dossier' }">

    <!-- Back + Patient Info -->
    <div class="flex items-center gap-4">
        <a href="{{ route('medecin.dashboard') }}" class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center hover:bg-slate-200 transition-colors">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">{{ $patient->nom }} {{ $patient->prenom }}</h1>
            <p class="text-slate-400 font-medium">ID: {{ $patient->login }} — {{ $result['message'] }}</p>
        </div>
        @if($result['new_dossier'] ?? false)
        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-lg uppercase border border-emerald-100">Nouveau Dossier</span>
        @endif
    </div>

    @if($dossier)
    <!-- Tabs -->
    <div class="flex bg-slate-100 p-1.5 rounded-2xl w-fit">
        <button @click="activeTab = 'dossier'" :class="activeTab === 'dossier' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Dossier</button>
        <button @click="activeTab = 'intervention'" :class="activeTab === 'intervention' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Interventions</button>
        <button @click="activeTab = 'actes'" :class="activeTab === 'actes' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Ajouter Acte</button>
    </div>

    <!-- Dossier Tab -->
    <div x-show="activeTab === 'dossier'" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
                <h2 class="text-lg font-black text-slate-800">Actes & Historique</h2>
                <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase {{ $dossier->state->value === 'ACTIF' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-slate-100 text-slate-500' }}">
                    {{ $dossier->state->value }}
                </span>
            </div>
            @if(count($dossier->actes) > 0)
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Acte</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Praticien</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($dossier->actes as $acte)
                    <tr>
                        <td class="px-8 py-4 text-sm font-bold text-slate-700">{{ $acte['type'] }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $acte['date'] }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $acte['medecin'] ?? $acte['auteur'] ?? 'Inconnu' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="p-12 text-center">
                <p class="text-sm text-slate-400 font-bold">Aucun acte médical enregistré.</p>
            </div>
            @endif
        </div>

        <!-- RG20: Validate Results -->
        <div class="space-y-6">
            <div class="bg-indigo-900 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-200">
                <h3 class="text-lg font-black mb-2">Validation Résultats</h3>
                <p class="text-indigo-200 text-xs font-medium mb-6">En validant, le patient pourra consulter ses résultats.</p>
                <p class="text-sm font-bold mb-4">
                    Statut actuel:
                    <span class="{{ $dossier->resultats_valides ? 'text-green-400' : 'text-amber-400' }}">
                        {{ $dossier->resultats_valides ? 'Validés ✓' : 'En attente' }}
                    </span>
                </p>
                @if(!$dossier->resultats_valides)
                <form action="{{ route('medecin.valider-resultats', $dossier->id) }}" method="POST">
                    @csrf
                    <button class="w-full py-3 bg-white text-indigo-900 font-black text-sm rounded-xl hover:bg-slate-50 transition-colors">
                        Valider les résultats
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Interventions Tab -->
    <div x-show="activeTab === 'intervention'" class="space-y-6">
        @forelse($interventions as $intervention)
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-800">Intervention #{{ $intervention->id }}</h3>
                        <p class="text-xs text-slate-400 font-medium">{{ $intervention->date }}</p>
                    </div>
                    <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                        @if($intervention->state->value === 'PLANIFIEE') bg-blue-50 text-blue-600 border border-blue-100
                        @elseif($intervention->state->value === 'EN_COURS') bg-amber-50 text-amber-600 border border-amber-100
                        @else bg-green-50 text-green-600 border border-green-100 @endif">
                        {{ str_replace('_', ' ', $intervention->state->value) }}
                    </span>
                </div>

                <!-- State Transition Buttons -->
                <div class="flex gap-3 mb-6">
                    @if($intervention->state->value === 'PLANIFIEE')
                    <form action="{{ route('medecin.demarrer-intervention', $intervention->id) }}" method="POST">
                        @csrf
                        <button class="px-6 py-3 bg-primary-600 text-white font-black text-xs rounded-2xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all">Démarrer Intervention</button>
                    </form>
                    @elseif($intervention->state->value === 'EN_COURS')
                        <!-- Compte Rendu Form -->
                        <form action="{{ route('medecin.compte-rendu', $intervention->id) }}" method="POST" class="flex-1">
                            @csrf
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Compte-Rendu Clinique</label>
                            <textarea name="compte_rendu" rows="4" placeholder="Rédiger le compte-rendu de l'intervention..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-medium outline-none focus:ring-4 focus:ring-primary-500/10 mb-3">{{ $intervention->compte_rendu }}</textarea>
                            <div class="flex gap-3">
                                <button type="submit" class="px-6 py-3 bg-slate-800 text-white font-bold text-xs rounded-2xl hover:bg-slate-900 transition-colors">Sauvegarder</button>
                            </div>
                        </form>
                    @endif

                    @if($intervention->state->value === 'EN_COURS')
                    <form action="{{ route('medecin.cloturer-intervention', $intervention->id) }}" method="POST">
                        @csrf
                        <button class="px-6 py-3 bg-emerald-600 text-white font-black text-xs rounded-2xl shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all">Clôturer</button>
                    </form>
                    @endif
                </div>

                @if($intervention->compte_rendu && $intervention->state->value === 'TERMINEE')
                <div class="p-4 bg-slate-50 rounded-2xl">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Compte-Rendu Final</p>
                    <p class="text-sm text-slate-700 font-medium">{{ $intervention->compte_rendu }}</p>
                </div>
                @endif
            </div>
        @empty
            <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <p class="text-slate-400 font-bold">Aucune intervention planifiée pour ce dossier.</p>
            </div>
        @endforelse
    </div>

    <!-- Add Acte Tab -->
    <div x-show="activeTab === 'actes'" class="max-w-2xl">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-10">
            <h3 class="text-xl font-black text-slate-800 mb-6">Ajouter un Acte Médical</h3>
            <form action="{{ route('medecin.ajouter-acte', $dossier->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Type d'Acte</label>
                    <select name="type_acte" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-primary-500/10">
                        <option value="Consultation Générale">Consultation Générale</option>
                        <option value="Analyse Sanguine">Analyse Sanguine</option>
                        <option value="Radiographie">Radiographie</option>
                        <option value="IRM">IRM</option>
                        <option value="Échographie">Échographie</option>
                        <option value="Biopsie">Biopsie</option>
                    </select>
                </div>
                <button type="submit" class="px-8 py-4 bg-primary-600 text-white font-black rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 active:scale-95 transition-all">
                    Enregistrer l'Acte
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
