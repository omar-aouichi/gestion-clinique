@extends('layouts.app')

@section('title', 'Gestion de Stock - Enregistrer Mouvement')

@section('sidebar')
    @include('stock.partials.sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Pending Stock Requests (Justification for Mouvements) -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden border-l-4 border-l-primary-500">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Demandes de Stock</h2>
                <p class="text-sm text-slate-500">Liste des ordres de distribution (Sortie) ou d'acquisition (Entrée) en attente.</p>
            </div>
            <span class="px-3 py-1 bg-primary-50 text-primary-600 text-[10px] font-bold uppercase rounded-full border border-primary-100 italic">Preuve requise</span>
        </div>
        <div class="overflow-x-auto text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-4 font-bold text-slate-400 uppercase tracking-widest">Type</th>
                        <th class="px-6 py-4 font-bold text-slate-400 uppercase tracking-widest">Article souhaité</th>
                        <th class="px-6 py-4 font-bold text-slate-400 uppercase tracking-widest text-center">Qté</th>
                        <th class="px-6 py-4 font-bold text-slate-400 uppercase tracking-widest text-center">Statut</th>
                        <th class="px-6 py-4 font-bold text-slate-400 uppercase tracking-widest">Demandeur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($demandes as $d)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-4">
                            @if($d->type === 'entree')
                                <span class="bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded-md font-bold uppercase">Acquisition</span>
                            @else
                                <span class="bg-amber-50 text-amber-600 px-2 py-0.5 rounded-md font-bold uppercase">Distribution</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-700">{{ $d->article }}</td>
                        <td class="px-6 py-4 text-center font-black text-slate-600">{{ $d->quantite }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($d->statut === 'Approuvé')
                                <span class="text-green-600 font-bold flex items-center justify-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    {{ $d->statut }}
                                </span>
                            @else
                                <span class="text-amber-500 font-bold flex items-center justify-center gap-1">
                                    <svg class="w-3 h-3 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                    {{ $d->statut }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $d->demandeur }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Header -->
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">Enregistrer un Mouvement</h1>
        <p class="text-slate-500">Saisissez les détails de l'entrée ou de la sortie de matériel pour mettre à jour l'inventaire.</p>
    </div>

    <!-- Mouvement Form -->
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50">
        <form action="{{ route('stock.mouvement.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Sélectionner l'Équipement</label>
                        <select name="id_equipement" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                            <option value="">-- Choisir un article --</option>
                            @foreach($equipements as $item)
                                <option value="{{ $item->id_equipement }}" {{ old('id_equipement') == $item->id_equipement ? 'selected' : '' }}>
                                    {{ $item->nom }} (Stock: {{ $item->quantite }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_equipement') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Type de mouvement</label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="entree" class="sr-only peer" {{ old('type', 'entree') == 'entree' ? 'checked' : '' }}>
                                <div class="w-full py-3 text-center text-sm font-bold text-slate-500 bg-slate-50 border border-slate-200 rounded-2xl peer-checked:bg-green-50 peer-checked:text-green-600 peer-checked:border-green-200 transition-all">
                                    Entrée en Stock
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="sortie" class="sr-only peer" {{ old('type') == 'sortie' ? 'checked' : '' }}>
                                <div class="w-full py-3 text-center text-sm font-bold text-slate-500 bg-slate-50 border border-slate-200 rounded-2xl peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-200 transition-all">
                                    Sortie de Stock
                                </div>
                            </label>
                        </div>
                        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Quantité</label>
                        <div class="relative">
                            <input type="number" name="quantite" value="{{ old('quantite', 1) }}" min="1" required class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                            <span class="absolute right-4 top-3 text-slate-400 text-xs font-bold uppercase">Unités</span>
                        </div>
                        @error('quantite') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Motif ou Commentaire</label>
                        <textarea name="commentaire" rows="4" placeholder="Ex: Livraison fournisseur #REF-123, Distribution au service des urgences, Maintenance annuelle..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none resize-none">{{ old('commentaire') }}</textarea>
                    </div>
                    
                    <div class="p-6 bg-primary-50 rounded-3xl border border-primary-100/50">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex-shrink-0 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-xs text-primary-700 leading-relaxed">
                                <strong>Note:</strong> L'enregistrement d'une sortie déclenchera automatiquement une alerte si le stock descend en dessous du seuil minimal configuré.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 flex justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('stock.dashboard') }}" class="px-8 py-3.5 text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-8 py-3.5 bg-primary-600 text-white font-bold rounded-2xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all flex items-center gap-2">
                    Confirmer le mouvement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
