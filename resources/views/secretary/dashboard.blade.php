@extends('layouts.app')
@section('title', 'Portail Secrétariat')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4" x-data="{ tab: 'patients' }">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Gestion Administrative</h1>
            <p class="text-slate-500">Flux de travail du secrétariat et facturation</p>
        </div>
        <form action="{{ route('secretaire.sous_x') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-red-600 text-white font-bold rounded-2xl shadow-lg shadow-red-200 hover:bg-red-700 transition-all flex items-center gap-2 animate-pulse">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Urgence Vitale (Patient Sous X)
            </button>
        </form>
    </div>

    <!-- Sub-navigation -->
    <div class="flex gap-4 mb-8 bg-slate-100 p-1.5 rounded-2xl w-fit">
        <button @click="tab = 'patients'" :class="tab === 'patients' ? 'bg-white text-primary-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 text-sm font-bold rounded-xl transition-all">Patients</button>
        <button @click="tab = 'rdvs'" :class="tab === 'rdvs' ? 'bg-white text-primary-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 text-sm font-bold rounded-xl transition-all">Rendez-vous</button>
        <button @click="tab = 'billing'" :class="tab === 'billing' ? 'bg-white text-primary-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 text-sm font-bold rounded-xl transition-all">Facturation</button>
        <button @click="tab = 'logs'" :class="tab === 'logs' ? 'bg-white text-primary-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-5 py-2.5 text-sm font-bold rounded-xl transition-all">Traces Système</button>
    </div>

    <!-- Patients List -->
    <div x-show="tab === 'patients'" class="animate-in fade-in slide-in-from-bottom-2">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">CIN / ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Patient</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Contact</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($patients as $p)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-500">{{ $p->cin }}</td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-700">{{ $p->nom }} {{ $p->prenom }}</span>
                            @if($p->sousX) <span class="ml-1 px-1.5 py-0.5 bg-red-50 text-red-600 text-[10px] font-bold rounded uppercase border border-red-100">Sous X</span> @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500">{{ $p->email }}<br>{{ $p->telephone }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 {{ $p->state->value === 'ACTIF' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-red-50 text-red-600 border-red-100' }} text-[10px] font-bold rounded-lg border uppercase">{{ $p->state->value }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($p->state->value === 'ACTIF')
                            <form action="{{ route('secretaire.suspendre_patient', $p->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline text-xs font-bold">Suspendre</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Appointments -->
    <div x-show="tab === 'rdvs'" class="animate-in fade-in slide-in-from-bottom-2">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Date/Heure</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Patient</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Médecin</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Etat</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($rdvs as $r)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-500">{{ $r->dateHeader }} à {{ $r->heure }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ $r->patientNom }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-primary-600">{{ $r->medecinNom }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-lg border uppercase">{{ $r->state->value }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($r->state->value !== 'ANNULE')
                            <form action="{{ route('secretaire.annuler_rdv', $r->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 text-[10px] font-bold rounded-lg hover:bg-red-100 transition-colors uppercase">Annuler Tardivement</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Billing -->
    <div x-show="tab === 'billing'" class="animate-in fade-in slide-in-from-bottom-2">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">N° Facture</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase">Patient</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-right">Montant</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($factures as $f)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-slate-500">#F-{{ $f->id }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700">{{ $f->patientNom }}</td>
                        <td class="px-6 py-4 text-sm font-black text-slate-800 text-right">{{ number_format($f->montantTotal, 2) }} DH</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 {{ $f->state->value === 'PAYEE' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-amber-50 text-amber-600 border-amber-100' }} text-[10px] font-bold rounded-lg border uppercase">{{ $f->state->value }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($f->state->value !== 'ANNULEE')
                            <form action="{{ route('secretaire.annuler_facture', $f->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="motif" value="Erreur saisie">
                                <button type="submit" class="text-slate-400 hover:text-red-500 text-xs font-bold underline transition-colors">Annuler la facture</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- System Logs -->
    <div x-show="tab === 'logs'" class="animate-in fade-in slide-in-from-bottom-2">
        <div class="bg-slate-900 rounded-3xl border border-slate-800 shadow-2xl overflow-hidden p-8">
            <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
                Moniteur de Traçabilité Système
            </h3>
            <div class="space-y-3 font-mono text-[11px]">
                @foreach($logs as $l)
                <div class="text-slate-400">
                    <span class="text-slate-600">[{{ $l->timestamp }}]</span>
                    <span class="text-red-400 font-bold">{{ $l->action }}</span>
                    <span class="text-slate-300 mx-2">Cible: {{ $l->cible }}</span>
                    <span class="text-slate-500">Par: {{ $l->utilisateur }}</span>
                    <span class="text-slate-600 block pl-4 mt-0.5 ml-4 border-l border-slate-700">> {{ $l->details }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
