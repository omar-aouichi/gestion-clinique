@extends('layouts.app')

@section('title', 'Gestion de la Facturation - Secretary Portal')

@section('sidebar')
    @include('secretary.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ showModal: false, search: '', filter: 'Tous' }">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Facturation & Paiements</h1>
            <p class="text-slate-500 mt-1">Émettez des factures, suivez les règlements et gérez les relances.</p>
        </div>
        <div class="flex items-center gap-3">
            <button @click="showModal = true" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouvelle Facture
            </button>
        </div>
    </div>

    <!-- Modal Nouvelle Facture -->
    <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm" style="display: none;">
        <div class="bg-white rounded-[2.5rem] w-full max-w-md p-8 shadow-2xl animate-in zoom-in-95 duration-200" @click.away="showModal = false">
            <h2 class="text-2xl font-black text-slate-800 mb-6">Émettre une Facture</h2>
            <form action="{{ route('secretary.store-facture') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Patient</label>
                    <select name="patient_id" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-primary-500/10">
                        @foreach(\App\Models\Utilisateur::where('role', 'patient')->get() as $p)
                            <option value="{{ $p->id }}">{{ $p->nom }} {{ $p->prenom }} ({{ $p->login }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Montant (DT)</label>
                    <input type="number" step="0.01" name="montant" required placeholder="0.00" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-primary-500/10">
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showModal = false" class="flex-1 py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition-colors uppercase text-xs">Annuler</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-black rounded-2xl hover:bg-indigo-700 transition-colors uppercase text-xs">Créer la Facture</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Chiffre d'Affaires</div>
            <div class="text-2xl font-black text-slate-800">45,800 DT</div>
            <div class="mt-2 text-xs text-green-500 font-bold flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
                +12.5% vs mois dernier
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Factures Impayées</div>
            <div class="text-2xl font-black text-red-500">12</div>
            <div class="mt-2 text-xs text-slate-400">Total: 2,450 DT</div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">En attente</div>
            <div class="text-2xl font-black text-amber-500">5</div>
            <div class="mt-2 text-xs text-slate-400">Prises en charge mutuelles</div>
        </div>
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Taux de Recouvrement</div>
            <div class="text-2xl font-black text-primary-600">94%</div>
            <div class="mt-2 text-xs text-green-500 font-bold">Excellent</div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-wrap items-center gap-4">
        <div class="flex-1 relative min-w-[300px]">
            <svg class="w-5 h-5 absolute left-4 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input x-model="search" type="text" placeholder="Rechercher par patient ou n° de facture..." class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
        </div>
        <select x-model="filter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 focus:ring-2 focus:ring-primary-500/20 outline-none">
            <option value="Tous">Tous les statuts</option>
            <option value="PAYEE">Payée</option>
            <option value="IMPAYEE">Impayée</option>
            <option value="EMISE">Émise</option>
        </select>
    </div>

    <!-- Factures Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">N° Facture</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Patient</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Date</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Montant</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Statut</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($factures as $facture)
                <tr class="hover:bg-slate-50/50 transition-colors group" 
                    x-show="(search === '' || '{{ strtolower($facture->patient?->nom . ' ' . $facture->patient?->prenom . ' FAC-' . $facture->id) }}'.includes(search.toLowerCase())) && (filter === 'Tous' || '{{ $facture->state->value }}' === filter)">
                    <td class="px-8 py-5">
                        <span class="text-sm font-bold text-slate-800">#FAC-{{ str_pad($facture->id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="text-sm font-medium text-slate-700">{{ $facture->patient?->nom }} {{ $facture->patient?->prenom }}</div>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-500">
                        {{ date('d/m/Y') }}
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-sm font-black text-slate-800">{{ number_format($facture->montant, 2) }} DT</span>
                    </td>
                    <td class="px-6 py-5">
                        @php
                            $badgeClass = match($facture->state->value) {
                                'PAYEE' => 'bg-green-50 text-green-600 border-green-100',
                                'IMPAYEE' => 'bg-red-50 text-red-600 border-red-100',
                                'EMISE' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                default => 'bg-slate-50 text-slate-500 border-slate-100',
                            };
                        @endphp
                        <span class="px-3 py-1 {{ $badgeClass }} text-[10px] font-bold rounded-full border uppercase">
                            {{ $facture->state->value }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button title="Imprimer" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2z"></path></svg>
                            </button>
                            @if($facture->state->value !== 'PAYEE')
                            <form action="{{ route('secretary.encaisser', $facture->id) }}" method="POST">
                                @csrf
                                <button type="submit" title="Encaisser" class="px-4 py-1.5 bg-green-600 text-white text-[10px] font-bold rounded-lg hover:bg-green-700 transition-all">
                                    Encaisser
                                </button>
                            </form>
                            @else
                            <form action="{{ route('secretary.emettre-recu', $facture->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white text-[10px] font-bold rounded-lg hover:bg-blue-700 transition-all">
                                    Reçu
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-12 text-center text-slate-400 italic">Aucune facture enregistrée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
