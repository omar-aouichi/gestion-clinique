@extends('layouts.app')

@section('title', 'Espace Infirmier')

@section('sidebar')
    @include('medical.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Espace Infirmier</h1>
            <p class="text-slate-400 font-medium mt-1">Assistance aux interventions et prise de constantes vitales.</p>
        </div>
        <form action="{{ route('employe.pointer') }}" method="POST">
            @csrf
            <button class="px-6 py-3 bg-primary-600 text-white font-black text-xs rounded-2xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all flex items-center gap-2 uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Pointer Présence
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        @foreach($interventions as $intervention)
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-black text-slate-800">{{ $intervention->patient_nom }}</h3>
                    <p class="text-xs text-slate-400 font-medium">{{ $intervention->date }} — {{ $intervention->medecin_nom }}</p>
                </div>
                <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                    @if($intervention->state->value === 'PLANIFIEE') bg-blue-50 text-blue-600 border border-blue-100
                    @elseif($intervention->state->value === 'EN_COURS') bg-amber-50 text-amber-600 border border-amber-100
                    @else bg-green-50 text-green-600 border border-green-100 @endif">
                    {{ str_replace('_', ' ', $intervention->state->value) }}
                </span>
            </div>

            <!-- Assignment Button -->
            @if($intervention->state->value !== 'TERMINEE' && !$intervention->infirmier_id)
            <form action="{{ route('infirmier.assister', $intervention->id) }}" method="POST" class="mb-6">
                @csrf
                <button class="w-full py-3 bg-primary-600 text-white font-black text-xs rounded-2xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all uppercase">
                    S'assigner à cette intervention
                </button>
            </form>
            @elseif($intervention->infirmier_id)
            <div class="px-4 py-2 bg-green-50 border border-green-100 rounded-xl mb-6 flex items-center gap-2">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-[10px] font-black text-green-700 uppercase">Infirmier(e) assigné(e)</span>
            </div>
            @endif

            <!-- Vitals Form (only if EN_COURS and assigned) -->
            @if($intervention->state->value === 'EN_COURS' && $intervention->infirmier_id)
            <div class="border-t border-slate-100 pt-6" x-data="{ expanded: false }">
                <button @click="expanded = !expanded" class="flex items-center justify-between w-full text-left mb-4">
                    <span class="text-sm font-black text-slate-700">Saisir les Constantes Vitales</span>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" :class="expanded && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <form x-show="expanded" x-transition action="{{ route('infirmier.vitals', $intervention->dossier_id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Tension</label>
                            <input type="text" name="tension" placeholder="12/8" class="w-full px-3 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10">
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Température</label>
                            <input type="text" name="temperature" placeholder="37.2°C" class="w-full px-3 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10">
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Pouls</label>
                            <input type="text" name="pouls" placeholder="72 bpm" class="w-full px-3 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Notes</label>
                        <textarea name="notes" rows="2" placeholder="Observations cliniques..." class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm outline-none focus:ring-4 focus:ring-primary-500/10"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-emerald-600 text-white font-bold text-xs rounded-xl hover:bg-emerald-700 transition-colors uppercase shadow-md shadow-emerald-200">
                        Enregistrer les constantes
                    </button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
