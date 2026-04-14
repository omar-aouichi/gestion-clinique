@extends('layouts.app')

@section('title', 'Inscription Patient - Secretary Portal')

@section('sidebar')
    @include('secretary.partials.sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    
    <!-- Emergency Header -->
    <div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative group">
        <div class="absolute -right-4 -top-4 w-32 h-32 bg-rose-100/50 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
        <div class="relative flex items-center gap-4">
            <div class="w-12 h-12 bg-rose-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-rose-200 animate-pulse">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h2 class="text-xl font-black text-rose-900 leading-tight">Urgence Vitale</h2>
                <p class="text-rose-600 text-sm font-medium">Création immédiate de dossier anonyme "Sous X"</p>
            </div>
        </div>
        
        <form action="{{ route('secretary.store-urgence') }}" method="POST">
            @csrf
            <button type="submit" class="px-8 py-3.5 bg-rose-600 text-white font-bold rounded-2xl shadow-xl shadow-rose-200 hover:bg-rose-700 active:scale-95 transition-all flex items-center gap-3">
                <span>Créer Dossier Patient Sous X</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
            </button>
        </form>
    </div>

    <!-- Main Registration Section -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Inscription Standard</h1>
                <p class="text-slate-400 text-sm mt-0.5">Veuillez renseigner les informations d'identité officielles du patient.</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
            </div>
        </div>

        <form action="{{ route('secretary.store-patient') }}" method="POST" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <!-- Identity Section -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                        Identité Civile
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">CIN (Identifiant)</label>
                        <input type="text" name="login" value="{{ old('login') }}" required placeholder="Ex: G123456" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none @error('login') border-red-500 @enderror">
                        @error('login') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nom</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required placeholder="Nom de famille" 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required placeholder="Prénom" 
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Date de Naissance</label>
                        <input type="date" name="dateNaissance" required 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                        Coordonnées
                    </h3>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Numéro de Téléphone</label>
                        <input type="tel" name="contact" value="{{ old('contact') }}" required placeholder="+216 -- --- ---" 
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                    </div>

                    <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex gap-4">
                        <div class="w-10 h-10 bg-white shadow-sm border border-slate-100 rounded-xl flex-shrink-0 flex items-center justify-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-[10px] text-slate-500 leading-relaxed font-medium">
                            <strong>Note de Données:</strong> Les informations saisies seront utilisées pour la génération automatique du dossier médical numérique.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex justify-end gap-4 border-t border-slate-50">
                <a href="{{ route('secretary.patients') }}" class="px-8 py-3.5 text-slate-500 font-bold rounded-2xl hover:bg-slate-50 transition-colors capitalize">
                    Annuler
                </a>
                <button type="submit" class="px-10 py-3.5 bg-primary-600 text-white font-black rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 active:scale-95 transition-all">
                    Finaliser l'Inscription
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
