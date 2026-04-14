@extends('layouts.app')

@section('title', 'Modifier Utilisateur - Admin Portal')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Modifier le Profil</h1>
            <p class="text-slate-500 mt-1">Mettez à jour les informations et le rôle de <strong>{{ $user->prenom }} {{ $user->nom }}</strong>.</p>
        </div>
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-10 space-y-10">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <!-- Access Section -->
                <div class="space-y-6">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                        Accès & Sécurité
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Identifiant (Login)</label>
                        <input type="text" name="login" value="{{ $user->login }}" required 
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Rôle Système</label>
                        <select name="role" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                            @foreach($roles as $role)
                                <option value="{{ $role->value }}" {{ $user->role === $role ? 'selected' : '' }}>
                                    {{ str_replace('_', ' ', $role->value) }}
                                </option>
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
                            <input type="text" name="nom" value="{{ $user->nom }}" required 
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Prénom</label>
                            <input type="text" name="prenom" value="{{ $user->prenom }}" required 
                                   class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Contact (Email)</label>
                        <input type="email" name="contact" value="{{ $user->contact }}" required 
                               class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all outline-none">
                    </div>
                </div>
            </div>

            <div class="pt-8 flex justify-end gap-4 border-t border-slate-50">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-4 text-slate-500 font-bold rounded-2xl hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-10 py-4 bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 active:scale-95 transition-all">
                    Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
