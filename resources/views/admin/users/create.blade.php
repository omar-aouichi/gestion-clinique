@extends('layouts.app')

@section('title', 'Créer Utilisateur - Admin Portal')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Nouveau Compte</h1>
            <p class="text-slate-500 mt-1">Attribuez des identifiants et des rôles au personnel de l'établissement.</p>
        </div>
        <div class="w-12 h-12 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
    </div>

    <!-- Creation Form -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-10 space-y-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <!-- Security Section -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                        Accès & Sécurité
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Identifiant (Login)</label>
                        <input type="text" name="login" required placeholder="Ex: j.dupont" 
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Rôle Système</label>
                        <select name="role" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                            <option value="">-- Sélectionner un rôle --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->value }}">{{ str_replace('_', ' ', $role->value) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Personal Info Section -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                        Informations Personnelles
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nom</label>
                            <input type="text" name="nom" required placeholder="Nom" 
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Prénom</label>
                            <input type="text" name="prenom" required placeholder="Prénom" 
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Contact (Email)</label>
                        <input type="email" name="contact" required placeholder="staff@hospital.com" 
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                    </div>
                </div>
            </div>

            <!-- Notice box -->
            <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex gap-4">
                <div class="w-10 h-10 bg-white shadow-sm border border-slate-200 rounded-xl flex-shrink-0 flex items-center justify-center text-primary-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    <strong>Note Sécurité :</strong> Le mot de passe par défaut pour les nouveaux utilisateurs est <code class="bg-slate-200 px-1 rounded">password</code>. L'administrateur technique (Auteur) verra cette action enregistrée dans le journal de audit.
                </p>
            </div>

            <div class="pt-8 flex justify-end gap-4 border-t border-slate-50">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-4 text-slate-500 font-bold rounded-2xl hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-10 py-4 bg-primary-600 text-white font-black rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 hover:-translate-y-1 active:scale-95 transition-all">
                    Confirmer la Création
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
