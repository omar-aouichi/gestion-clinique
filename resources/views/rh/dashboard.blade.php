@extends('layouts.app')

@section('title', 'Gestion RH - Board')

@section('sidebar')
    @include('hr.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" 
     x-data="{ 
        tab: 'effectifs', 
        showEditModal: false, 
        showCreateModal: false,
        editEmploye: {id: null, nom: '', prenom: '', contact: ''} 
     }">
    <div class="flex items-center justify-between mb-6">
        <div class="flex bg-slate-100 p-1.5 rounded-2xl">
            <button @click="tab = 'effectifs'" :class="tab === 'effectifs' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Effectifs</button>
            <button @click="tab = 'depts'" :class="tab === 'depts' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Départements</button>
            <button @click="tab = 'pointages'" :class="tab === 'pointages' ? 'bg-white shadow-md text-primary-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-black rounded-xl transition-all">Pointages</button>
        </div>
        
        <button @click="showCreateModal = true" class="px-6 py-3 bg-slate-900 text-white font-black text-[10px] rounded-2xl hover:bg-primary-600 transition-all shadow-xl shadow-slate-200 uppercase tracking-widest flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Nouveau Employé
        </button>
    </div>

    <div class="flex flex-col mb-8">
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Ressources Humaines</h1>
        <p class="text-slate-400 font-medium text-xs mt-1">Gérez le personnel et les unités médicales de l'établissement.</p>
    </div>

    <!-- Effectifs Tab -->
    <div x-show="tab === 'effectifs'" class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Employé</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Département</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Statut</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($employes as $e)
                <tr class="hover:bg-slate-50/20 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-700 shadow-sm border border-slate-200">
                                {{ substr($e->nom, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-slate-800">{{ $e->nom }} {{ $e->prenom }}</span>
                                <span class="text-[9px] font-black text-primary-500 uppercase tracking-tighter">{{ $e->role->value }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <form action="{{ route('rh.affecter') }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="employe_id" value="{{ $e->id }}">
                            <select name="departement_id" onchange="this.form.submit()" class="bg-slate-50 border-none rounded-lg text-[10px] font-black text-slate-600 focus:ring-0 cursor-pointer">
                                <option value="">Non assigné</option>
                                @foreach($depts as $d)
                                    <option value="{{ $d->id }}" {{ $e->departement_id == $d->id ? 'selected' : '' }}>{{ $d->nom }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                            @if($e->state->value === 'ACTIF') bg-green-50 text-green-600 border border-green-100
                            @elseif($e->state->value === 'EN_CONGE') bg-amber-50 text-amber-600 border border-amber-100
                            @elseif($e->state->value === 'DEMISSIONNAIRE') bg-rose-50 text-rose-600 border border-rose-100
                            @else bg-slate-100 text-slate-500 @endif">
                            {{ str_replace('_', ' ', $e->state->value) }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="showEditModal = true; editEmploye = {id: {{ $e->id }}, nom: '{{ $e->nom }}', prenom: '{{ $e->prenom }}', contact: '{{ $e->contact }}'}"
                                    class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="{{ route('rh.destroy', $e->id) }}" method="POST" onsubmit="return confirm('Désactiver ou supprimer définitivement cet employé ? Cette action est irréversible.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Depts Tab -->
    <div x-show="tab === 'depts'" class="space-y-6">
        <div class="bg-primary-50 p-8 rounded-[2.5rem] border border-primary-100 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-black text-primary-900 leading-tight">Gérer les Départements</h3>
                <p class="text-primary-600 font-medium text-sm mt-1">Créez et gérez les unités médicales de l'établissement.</p>
            </div>
            <div x-data="{ showCreate: false }">
                <button @click="showCreate = !showCreate" class="px-6 py-3 bg-primary-600 text-white font-black text-xs rounded-2xl hover:bg-primary-700 transition-all shadow-lg shadow-primary-200 uppercase tracking-widest">
                    Nouveau Département
                </button>
                
                <div x-show="showCreate" x-transition class="mt-4 p-4 bg-white rounded-2xl shadow-xl border border-primary-100 animate-in zoom-in-95">
                    <form action="{{ route('rh.ajouter-departement') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="nom" placeholder="Nom du département..." required class="bg-slate-50 border-none rounded-xl text-xs font-bold text-slate-800 focus:ring-2 focus:ring-primary-500 w-64 outline-none">
                        <button type="submit" class="p-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($depts as $d)
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/30 flex items-center justify-between group hover:border-primary-200 transition-all">
                <div>
                    <p class="text-[10px] font-black text-primary-500 uppercase mb-1">Unité Médicale #{{ $d->id }}</p>
                    <p class="text-lg font-black text-slate-800 leading-tight">{{ $d->nom }}</p>
                    <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase">{{ $d->employes->count() }} Employés</p>
                </div>
                <form action="{{ route('rh.supprimer-departement', $d->id) }}" method="POST" onsubmit="return confirm('Supprimer ce département ?')">
                    @csrf @method('DELETE')
                    <button class="text-slate-200 group-hover:text-rose-500 transition-colors p-2 hover:bg-rose-50 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
            @empty
            <div class="col-span-3 py-12 text-center bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2.5rem]">
                <p class="text-slate-400 font-black text-sm uppercase">Aucun département configuré</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pointages Tab -->
    <div x-show="tab === 'pointages'" class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
            <div>
                <h3 class="text-lg font-black text-slate-800">Registre des Présences</h3>
                <p class="text-[10px] text-slate-400 font-bold uppercase mt-1">Flux de pointage en temps réel</p>
            </div>
        </div>
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date & Heure</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Description de l'action</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">ID Utilisateur</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($pointages as $p)
                <tr class="hover:bg-slate-50/20 transition-colors">
                    <td class="px-8 py-5">
                        <span class="text-xs font-black text-slate-700">{{ $p->created_at->format('d/m/Y H:i') }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></div>
                            <span class="text-xs font-medium text-slate-600">{{ $p->action }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg">#{{ $p->idUtilisateur }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-10 text-center text-slate-400 font-bold text-sm uppercase">Aucun pointage enregistré aujourd'hui</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Employee Modal -->
    <div x-show="showEditModal" x-transition class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 backdrop-blur-sm" @click.self="showEditModal = false" x-cloak>
        <div class="bg-white rounded-[2rem] p-10 max-w-md w-full mx-4 shadow-2xl" @click.stop>
            <form :action="'/rh/employes/' + editEmploye.id" method="POST">
                @csrf @method('PUT')
                <h3 class="text-xl font-black text-slate-800 mb-6">Modifier l'employé</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2">Nom</label>
                        <input type="text" name="nom" x-model="editEmploye.nom" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2">Prénom</label>
                        <input type="text" name="prenom" x-model="editEmploye.prenom" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2">Contact</label>
                        <input type="text" name="contact" x-model="editEmploye.contact" required class="w-full px-4 py-3 bg-slate-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="button" @click="showEditModal = false" class="flex-1 py-3 bg-slate-100 text-slate-600 font-bold text-sm rounded-xl hover:bg-slate-200 transition-colors">Annuler</button>
                    <button type="submit" class="flex-1 py-3 bg-primary-600 text-white font-bold text-sm rounded-xl hover:bg-primary-700 transition-colors shadow-lg shadow-primary-200 uppercase">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Create Employee Modal -->
    <div x-show="showCreateModal" x-transition class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 backdrop-blur-sm" @click.self="showCreateModal = false" x-cloak>
        <div class="bg-white rounded-[2.5rem] p-10 max-w-2xl w-full mx-4 shadow-2xl overflow-y-auto max-h-[90vh]" @click.stop>
            <form action="{{ route('rh.store-employe') }}" method="POST">
                @csrf
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800">Recruter un personnel</h3>
                        <p class="text-slate-400 text-xs font-medium">Créez un nouvel accès au portail de l'établissement.</p>
                    </div>
                    <button type="button" @click="showCreateModal = false" class="p-2 hover:bg-slate-100 rounded-full transition-colors">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Prénom</label>
                        <input type="text" name="prenom" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nom</label>
                        <input type="text" name="nom" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Rôle / Fonction</label>
                        <select name="role" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all appearance-none">
                            <option value="medecin">Médecin</option>
                            <option value="infirmier">Infirmier(e)</option>
                            <option value="secretaire">Secrétaire</option>
                            <option value="gerant_stock">Gérant de Stock</option>
                            <option value="rh">Responsable RH</option>
                            <option value="cadre_administratif">Cadre Administratif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Département</label>
                        <select name="departement_id" class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all appearance-none">
                            <option value="">Non assigné</option>
                            @foreach($depts as $d)
                                <option value="{{ $d->id }}">{{ $d->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Date de Naissance</label>
                        <input type="date" name="dateNaissance" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Contact (Téléphone)</label>
                        <input type="text" name="contact" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-50 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Identifiant de connexion</label>
                        <input type="text" name="login" required placeholder="ex: j.doe" class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mot de passe temporaire</label>
                        <input type="password" name="mdp" required class="w-full px-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl text-sm focus:ring-4 focus:ring-primary-500/10 outline-none transition-all">
                    </div>
                </div>

                <div class="flex gap-4 mt-10">
                    <button type="button" @click="showCreateModal = false" class="flex-1 py-4 bg-slate-100 text-slate-600 font-bold text-sm rounded-2xl hover:bg-slate-200 transition-colors">Annuler</button>
                    <button type="submit" class="flex-1 py-4 bg-primary-600 text-white font-black text-sm rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-200 uppercase tracking-widest">
                        Confirmer le Recrutement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
