@extends('layouts.app')

@section('title', 'Gestion des Patients - Secretary Portal')

@section('sidebar')
    @include('secretary.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ 
    showEditModal: false, 
    search: '',
    filter: 'Tous',
    editingPatient: {id: null, nom: '', prenom: '', email: '', telephone: ''},
    openEdit(p) {
        this.editingPatient = {...p};
        this.showEditModal = true;
    }
}">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Répertoire des Patients</h1>
            <p class="text-slate-500 mt-1">Gérez les dossiers patients, les inscriptions et le suivi administratif.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('secretary.create-patient') }}" class="flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouveau Patient
            </a>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-wrap items-center gap-4">
        <div class="flex-1 relative min-w-[300px]">
            <svg class="w-5 h-5 absolute left-4 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input x-model="search" type="text" placeholder="Rechercher par nom, CIN ou numéro de dossier..." class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
        </div>
        <select x-model="filter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 focus:ring-2 focus:ring-primary-500/20 outline-none">
            <option value="Tous">Tous les statuts</option>
            <option value="ACTIF">Actif</option>
            <option value="ARCHIVE">Archivé</option>
        </select>
    </div>

    <!-- Patients List -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Patient</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Contact</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dernière Visite</th>
                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Statut</th>
                    <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($patients as $patient)
                <tr class="hover:bg-slate-50/50 transition-colors group" 
                    x-show="(search === '' || '{{ strtolower($patient->nom . ' ' . $patient->prenom . ' ' . $patient->login) }}'.includes(search.toLowerCase())) && (filter === 'Tous' || '{{ $patient->statut }}' === filter)">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">
                                {{ substr($patient->nom, 0, 1) }}{{ substr($patient->prenom, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-800">{{ $patient->nom }} {{ $patient->prenom }}</div>
                                <div class="text-[10px] text-slate-400 font-medium">ID: #PAT-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-600">
                        {{ $patient->telephone }}<br>
                        <span class="text-[10px] text-slate-400">{{ $patient->email }}</span>
                    </td>
                    <td class="px-6 py-5 text-sm text-slate-500">
                        12/04/2026
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full border border-green-100 uppercase">Actif</span>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="openEdit({
                                id: {{ $patient->id }},
                                nom: '{{ $patient->nom }}',
                                prenom: '{{ $patient->prenom }}',
                                email: '{{ $patient->email }}',
                                telephone: '{{ $patient->telephone }}'
                            })" title="Modifier" class="p-2 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </button>
                            <a href="{{ route('secretary.view-dossier', $patient->id) }}" title="Dossier Médical" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-12 text-center text-slate-400 italic">Aucun patient trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div x-show="showEditModal" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showEditModal" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="showEditModal = false"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div x-show="showEditModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form :action="'/secretary/patients/' + editingPatient.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-8 pt-6 pb-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-6">Modifier le Profil Patient</h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nom</label>
                                    <input type="text" name="nom" x-model="editingPatient.nom" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 outline-none">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Prénom</label>
                                    <input type="text" name="prenom" x-model="editingPatient.prenom" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email</label>
                                <input type="email" name="email" x-model="editingPatient.email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Téléphone</label>
                                <input type="text" name="telephone" x-model="editingPatient.telephone" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 outline-none">
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-8 py-4 flex flex-row-reverse gap-3 border-t border-slate-100">
                        <button type="submit" class="px-6 py-2 bg-primary-600 text-white text-sm font-bold rounded-xl shadow-lg hover:bg-primary-700 transition-all">Enregistrer</button>
                        <button type="button" @click="showEditModal = false" class="px-6 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition-all">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
