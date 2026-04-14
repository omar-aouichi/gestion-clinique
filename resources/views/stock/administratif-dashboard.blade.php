@extends('layouts.app')

@section('title', 'Gestion Administrative - Connected Health')

@include('stock.partials.sidebar')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Gestion Administrative du Stock</h1>
                <p class="text-slate-500">Interface de suivi des commandes et des alertes fournisseurs</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">Role: Administratif de Stock</span>
                <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center">
                    <i class="fas fa-user-tie text-slate-500"></i>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Alerts Inbox -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-5 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                        <h2 class="font-semibold text-slate-800 flex items-center">
                            <i class="fas fa-bell text-amber-500 mr-2"></i> Réception des Alertes
                        </h2>
                        <span class="bg-amber-100 text-amber-700 text-xs px-2 py-0.5 rounded-full">{{ $alerts->count() }}</span>
                    </div>
                    
                    <div class="p-4 space-y-4 max-h-[600px] overflow-y-auto">
                        @forelse($alerts as $alert)
                        <div class="p-4 rounded-xl border border-amber-100 bg-amber-50/30 hover:bg-amber-50 transition-colors">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">Critique</span>
                                <span class="text-[10px] text-slate-400">ID EQ: #{{ $alert->equipement_id ?? 'N/A' }}</span>
                            </div>
                            
                            @if($alert->equipement)
                                <h3 class="font-bold text-slate-800">{{ $alert->equipement->nom }}</h3>
                                <div class="flex items-center space-x-2 mt-1 mb-3">
                                    <span class="text-xs text-slate-500">Quantité restante:</span>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded-md {{ $alert->equipement->quantite == 0 ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $alert->equipement->quantite }} unité(s)
                                    </span>
                                </div>
                            @else
                                <p class="text-slate-700 text-sm font-medium mb-3">{{ $alert->clean_message ?? $alert->message }}</p>
                            @endif

                            <button 
                                onclick="openOrderModal({{ $alert->id }}, '{{ addslashes($alert->clean_message ?? $alert->message) }}')"
                                class="w-full mt-2 py-2 bg-white border border-amber-200 text-amber-700 text-xs font-semibold rounded-lg hover:bg-amber-100 hover:border-amber-300 transition-all flex items-center justify-center">
                                <i class="fas fa-envelope-open-text mr-2"></i> Contacter Fournisseur
                            </button>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <div class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-check-circle text-emerald-400 text-2xl"></i>
                            </div>
                            <p class="text-slate-400 text-sm">Aucune alerte en attente</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Side: Orders Management -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full">
                    <div class="p-5 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                        <h2 class="font-semibold text-slate-800 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-indigo-500 mr-2"></i> Gestion des Commandes
                        </h2>
                        <div class="flex space-x-2">
                            <div class="relative">
                                <input type="text" placeholder="Rechercher..." class="text-sm border-slate-200 rounded-lg pl-8 pr-4 py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                                <i class="fas fa-search absolute left-3 top-2.5 text-slate-300 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50/80 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">ID</th>
                                    <th class="px-6 py-4 font-semibold">Fournisseur</th>
                                    <th class="px-6 py-4 font-semibold">Produit</th>
                                    <th class="px-6 py-4 font-semibold">Date</th>
                                    <th class="px-6 py-4 font-semibold">Montant</th>
                                    <th class="px-6 py-4 font-semibold">État</th>
                                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 text-sm">
                                @forelse($commandes as $commande)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-700">ORD-{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded bg-indigo-50 text-indigo-600 flex items-center justify-center mr-3 text-xs font-bold">
                                                {{ substr($commande->fournisseur?->nom_fournisseur ?? '?', 0, 1) }}
                                            </div>
                                            <span class="text-slate-600">{{ $commande->fournisseur?->nom_fournisseur ?? 'Inconnu' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-slate-700 font-semibold">{{ $commande->produit ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 font-mono text-xs">{{ $commande->date_commande->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-semibold text-slate-700">{{ number_format($commande->montant, 2, ',', ' ') }} DH</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $stateClasses = [
                                                'CREEE' => 'bg-blue-50 text-blue-600 ring-1 ring-blue-100',
                                                'VALIDE' => 'bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100',
                                                'EN_ATTENTE' => 'bg-amber-50 text-amber-600 ring-1 ring-amber-100',
                                                'LIVRE' => 'bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100',
                                                'PAYEE' => 'bg-green-50 text-green-600 ring-1 ring-green-100',
                                                'ANNULE' => 'bg-rose-50 text-rose-600 ring-1 ring-rose-100',
                                            ];
                                            $cls = $stateClasses[$commande->etat] ?? 'bg-slate-100 text-slate-600';
                                        @endphp
                                        <span class="px-2 py-1 rounded text-[10px] font-bold {{ $cls }}">
                                            {{ $commande->etat }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($commande->etat === 'CREEE')
                                        <form action="{{ route('stock.administratif.valider', $commande->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-800 font-semibold px-3 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors text-xs">
                                                Valider
                                            </button>
                                        </form>
                                        @elseif($commande->etat === 'VALIDE' || $commande->etat === 'EN_ATTENTE')
                                        <form action="{{ route('stock.administratif.livrer', $commande->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-emerald-600 hover:text-emerald-800 font-semibold px-3 py-1 bg-emerald-50 hover:bg-emerald-100 rounded-lg transition-colors text-xs">
                                                Marquer Livré
                                            </button>
                                        </form>
                                        @elseif($commande->etat === 'LIVRE')
                                        <form action="{{ route('stock.administratif.envoyer_montant', $commande->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-amber-600 hover:text-amber-800 font-semibold px-3 py-1 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors text-xs">
                                                Envoyer Fonds
                                            </button>
                                        </form>
                                        @else
                                        <div class="flex gap-2 justify-end">
                                            <form action="{{ route('stock.administratif.facturer', $commande->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-800 font-semibold px-3 py-1 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors text-xs">
                                                    Archiver Facture
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">Aucune commande enregistrée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Contact Fournisseur -->
<div id="orderModal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all scale-95 opacity-0 duration-200" id="modalContainer">
        <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-indigo-600 text-white">
            <h3 class="text-xl font-bold">Draft: Nouvelle Commande</h3>
            <button onclick="closeOrderModal()" class="text-indigo-200 hover:text-white transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('stock.administratif.commander') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="alerte_id" id="modalAlerteId">
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Alerte liée (Ref #)</label>
                <div id="modalAlerteMessage" class="p-3 bg-amber-50 rounded-lg text-amber-800 text-sm border border-amber-100 italic"></div>
            </div>

            <div>
                <label for="fournisseur_id" class="block text-sm font-semibold text-slate-700 mb-1">Fournisseur</label>
                <select name="fournisseur_id" id="fournisseur_id" class="w-full border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                    <option value="">Sélectionner un fournisseur...</option>
                    @foreach($fournisseurs as $f)
                        <option value="{{ $f->id }}">{{ $f->nom_fournisseur }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="montant" class="block text-sm font-semibold text-slate-700 mb-1">Montant Estimé (DH)</label>
                <div class="relative">
                    <input type="number" step="0.01" name="montant" id="montant" placeholder="0,00" class="w-full border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm pl-4 pr-10" required>
                    <span class="absolute right-4 top-2 text-slate-400">DH</span>
                </div>
            </div>

            <div class="pt-4 flex space-x-3">
                <button type="button" onclick="closeOrderModal()" class="flex-1 py-2.5 px-4 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-colors text-sm">
                    Annuler
                </button>
                <button type="submit" class="flex-1 py-2.5 px-4 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all text-sm">
                    Créer la Commande
                </button>
            </div>
        </form>
    </div>
</div>



<script>
    function openOrderModal(alerteId, message) {
        document.getElementById('modalAlerteId').value = alerteId;
        document.getElementById('modalAlerteMessage').innerText = message;
        
        const modal = document.getElementById('orderModal');
        const container = document.getElementById('modalContainer');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeOrderModal() {
        const modal = document.getElementById('orderModal');
        const container = document.getElementById('modalContainer');
        
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endsection
