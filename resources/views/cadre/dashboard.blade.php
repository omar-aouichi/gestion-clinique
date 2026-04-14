@extends('layouts.app')

@section('title', 'Cadre Administratif - Portail')

@section('sidebar')
    @include('hr.partials.sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="bg-indigo-600 p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-200 text-white relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        <div class="relative">
            <h1 class="text-3xl font-black mb-2">Structure Administrative</h1>
            <p class="text-indigo-100 font-medium">Soumettez vos besoins de recrutement ou d'acquisition de matériel à la direction.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10">
        <h3 class="text-xl font-black text-slate-800 mb-8 border-l-4 border-indigo-500 pl-4">Nouvelle Demande Stratégique</h3>
        
        <form action="{{ route('cadre.soumettre') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Type de Besoin</label>
                    <select name="type" class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none focus:ring-4 focus:ring-indigo-500/10">
                        <option value="recrutement">Autorisation de Recrutement</option>
                        <option value="budget">Allocation Budgétaire</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Niveau de Priorité</label>
                    <select class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold outline-none">
                        <option>Normal</option>
                        <option>Critique (Court Terme)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Justificatif / Détails</label>
                <textarea name="details" rows="4" placeholder="Expliquez le besoin stratégique..." 
                          class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-medium outline-none focus:ring-4 focus:ring-indigo-500/10"></textarea>
            </div>

            <button type="submit" class="px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                Soumettre à la Direction Générale
            </button>
        </form>
    </div>
</div>
@endsection
