<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden" x-data="{ filter: 'all' }">
    <!-- Header/Filters -->
    <div class="px-8 py-6 border-b border-slate-100">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Consulter Stock</h2>
                <p class="text-sm text-slate-500">Gérez et consultez l'inventaire des équipements et médicaments.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none w-64">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <select x-model="sortCritere" @change="fetchStock()" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-primary-500/20 transition-all outline-none">
                    <option value="">Classer par...</option>
                    <option value="niveau_risque">Niveau de risque</option>
                    <option value="fonctionnalite">Fonctionnalité</option>
                    <option value="usage">Usage</option>
                </select>
                <button @click="$dispatch('open-add-stock-modal')" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold flex items-center gap-2 px-4 py-2.5 rounded-xl transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Ajouter
                </button>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto relative min-h-[400px]">
        <!-- Loading Overlay -->
        <div x-show="loading" class="absolute inset-0 bg-white/60 backdrop-blur-[1px] z-10 flex items-center justify-center">
            <div class="flex items-center gap-2 text-primary-600 font-bold">
                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Chargement...
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nom Équipement</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Catégorie</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Quantité</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Expiration</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">État</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($equipements as $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 text-sm font-medium text-slate-400">#EQ-{{ $item->id_equipement }}</td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-800">{{ $item->nom }}</span>
                                <span class="text-[10px] text-slate-400">{{ $item->categorie }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="text-xs font-medium px-3 py-1 bg-blue-50 text-blue-600 rounded-full">{{ $item->categorie }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="{{ $item->quantite <= $item->seuil_minimal ? 'text-red-500 bg-red-50 px-3 py-1 rounded-lg' : 'text-slate-700' }} font-bold">{{ $item->quantite }}</span>
                        </td>
                        <td class="px-6 py-5 text-sm font-semibold text-slate-600">{{ number_format($item->prix, 2, ',', ' ') }} MAD</td>
                        <td class="px-6 py-5 text-center text-sm text-slate-500">{{ $item->date_expiration ? $item->date_expiration : 'N/A' }}</td>
                        <td class="px-6 py-5 text-center">
                            @if($item->etat === 'VALIDE' || $item->etat === 'FONCTIONNEL')
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span> Fonctionnel
                                </span>
                            @elseif($item->etat === 'EXPIRE')
                                <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span> Expiré
                                </span>
                            @elseif($item->etat === 'RETIRE' || $item->etat === 'EN_PANNE')
                                <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full">
                                    En Panne / Retiré
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-full">
                                    {{ $item->etat }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <form action="{{ url('/stock/equipement/' . $item->id_equipement) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-rose-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Retirer" onclick="return confirm('Êtes-vous sûr de vouloir retirer cet équipement ?');">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-slate-500 text-sm">
                            Aucun équipement trouvé dans la base de données.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Mock -->
    <div class="px-8 py-4 border-t border-slate-100 flex items-center justify-between">
        <span class="text-xs font-medium text-slate-400 italic">Affichage de {{ count($equipements) }} article(s)</span>
        <div class="flex gap-2">
            <button class="p-2 border border-slate-200 rounded-lg text-slate-400 hover:bg-slate-50 disabled:opacity-50" disabled>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button class="p-2 border border-slate-200 rounded-lg text-slate-400 hover:bg-slate-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</div>
