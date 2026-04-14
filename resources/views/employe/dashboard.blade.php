@extends('layouts.app')

@section('title', 'Portail Employé - Hospital RH')

@section('sidebar')
<nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Mon Profil</p>
    <a href="{{ route('employe.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-bold bg-primary-50 text-primary-700 rounded-xl transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
        Mon Statut
    </a>
</nav>

<div class="p-6">
    <div class="p-4 bg-primary-50 rounded-2xl border border-primary-100 italic">
        <p class="text-[10px] font-black text-primary-600 uppercase tracking-widest mb-1">Badge Actuel</p>
        <p class="text-sm font-bold text-primary-900">Actif (Présent)</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    
    <!-- Self Service -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Bonjour, Omar</h1>
            <p class="text-slate-400 font-medium">Portail de gestion autonome des présences et demandes.</p>
            
            <div class="mt-8 flex gap-4">
                <form action="{{ route('employe.pointer') }}" method="POST">
                    @csrf
                    <button class="px-8 py-4 bg-primary-600 text-white font-black rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 active:scale-95 transition-all flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pointer Présence
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50">
                <h3 class="text-lg font-black text-slate-800">Mon Planning Hebdomadaire</h3>
            </div>
            <table class="w-full text-left">
                <tbody>
                    @foreach($planning as $p)
                    <tr class="border-b border-slate-50">
                        <td class="px-8 py-4 text-sm font-bold text-slate-700">{{ $p['jour'] }}</td>
                        <td class="px-8 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-black rounded-lg uppercase italic">{{ $p['shift'] }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Requests -->
    <div class="space-y-8">
        <div class="bg-indigo-900 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-200">
            <h3 class="text-xl font-black mb-4">Déposer une Demande</h3>
            <form action="{{ route('employe.deposer-demande') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <select name="type" class="w-full bg-indigo-800/50 border border-indigo-700 rounded-xl px-4 py-3 text-sm font-bold outline-none">
                        <option value="conge">Demande de Congé</option>
                        <option value="demission">Déposer Démission</option>
                        <option value="mutation">Demande Mutation</option>
                    </select>
                </div>
                <button type="submit" class="w-full py-4 bg-white text-indigo-900 font-black rounded-xl hover:bg-slate-50 transition-colors">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
