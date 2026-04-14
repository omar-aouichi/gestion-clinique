@extends('layouts.app')

@section('title', 'Direction Générale - Strategic Dashboard')

@section('sidebar')
    @include('hr.partials.sidebar')
@endsection

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Directeur Général</h1>
            <p class="text-slate-500 font-medium">Arbitrage stratégique et validation des ressources.</p>
        </div>
    </div>

    <!-- Demandes Table -->
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50 overflow-hidden">
        <div class="px-10 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
            <h2 class="text-xl font-black text-slate-800">Demandes de Ressources en Attente</h2>
            <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded-full uppercase tracking-widest border border-indigo-100">Action Requise</span>
        </div>
        
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-10 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Type / détails</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Statut Actuel</th>
                    <th class="px-10 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Décision Stratégique</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($demandes as $d)
                <tr class="hover:bg-slate-50/20 transition-colors">
                    <td class="px-10 py-6">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-500 border border-slate-200 uppercase">
                                {{ substr($d->demandeur_nom, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-800">{{ $d->demandeur_nom }}</p>
                                <p class="text-[9px] font-black text-primary-500 tracking-tighter">{{ $d->demandeur_role }}</p>
                            </div>
                        </div>
                        <div class="text-sm font-black text-slate-700 uppercase">{{ $d->type }}</div>
                        <div class="text-[11px] text-slate-500 font-medium mt-1 leading-relaxed">{{ $d->details }}</div>
                    </td>
                    <td class="px-6 py-6 text-center">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] font-black rounded-lg uppercase">
                            {{ str_replace('_', ' ', $d->state->value) }}
                        </span>
                    </td>
                    <td class="px-10 py-6">
                        <div class="flex items-center justify-end gap-2">
                            @if(in_array($d->state->value, ['NOUVELLE', 'ANALYSEE', 'EN_ATTENTE']))
                                <form action="{{ route('dg.valider-demande', $d->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="{{ $d->type === 'recrutement' ? 'recrutement' : 'valider' }}">
                                    <button class="px-4 py-2 bg-emerald-600 text-white text-[10px] font-black rounded-xl shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition-all uppercase">Approuver</button>
                                </form>
                                <form action="{{ route('dg.valider-demande', $d->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="refuser">
                                    <button class="px-4 py-2 bg-rose-600 text-white text-[10px] font-black rounded-xl shadow-lg shadow-rose-200 hover:bg-rose-700 transition-all uppercase">Refuser</button>
                                </form>
                            @else
                                <span class="text-[9px] font-bold text-slate-400 italic">Décision Finalisée</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Gestion des Cadres -->
    <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-200 lg:col-span-2 overflow-hidden relative">
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
        <div class="relative flex flex-col md:flex-row justify-between mb-8 gap-4">
            <div>
                <h3 class="text-2xl font-black mb-2">Gestion des Cadres</h3>
                <p class="text-slate-400 text-sm font-medium">Définissez les privilèges et auditez le statut des cadres administratifs.</p>
            </div>
            <form action="{{ route('dg.ajouter-cadre') }}" method="POST" class="flex items-center gap-2">
                @csrf
                <input type="text" name="nom" required placeholder="Nouveau cadre" class="bg-slate-800 border-none rounded-lg text-sm text-white px-4 py-2">
                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded-lg font-bold text-sm">Ajouter</button>
            </form>
        </div>
        <div class="flex flex-wrap gap-4 relative">
            @foreach($cadres as $c)
                <div class="bg-white/10 px-6 py-4 rounded-3xl border border-white/5 flex items-center gap-4">
                    <div class="w-8 h-8 bg-green-500 rounded-full animate-pulse border-4 border-white/10 flex-shrink-0"></div>
                    <div class="flex-1">
                        <p class="text-xs font-bold">{{ $c->nom }}</p>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">{{ $c->state->value }}</p>
                    </div>
                    <form action="{{ route('dg.modifier-statut-cadre', $c->id) }}" method="POST" class="flex items-center gap-1">
                        @csrf @method('PUT')
                        <select name="statut" onchange="this.form.submit()" class="bg-slate-800 text-[10px] rounded border-none py-1 px-2 text-white outline-none">
                            <option value="">Modifier</option>
                            <option value="ACTIF">ACTIF</option>
                            <option value="SUSPENDU">SUSPENDU</option>
                        </select>
                    </form>
                    <form action="{{ route('dg.retirer-cadre', $c->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300 ml-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
