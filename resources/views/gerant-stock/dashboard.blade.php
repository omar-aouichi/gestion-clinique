@extends('layouts.app')

@section('title', 'Gestion de Stock - Consulter Stock')

@section('sidebar')
    @include('stock.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" 
     x-data="stockManager()"
     :class="{ 'printing-active': isPrinting }">
    
    <!-- Top Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 print:hidden">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">Consultation du Stock 👋</h1>
            <p class="text-slate-500 mt-1">Gérez et visualisez l'état de votre inventaire en temps réel.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm font-medium text-slate-400">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Stats & Alerts Overview -->
    <section id="overview" class="print:hidden">
        @include('stock.partials.alerts-panel')
    </section>

    <!-- Main Stock Consultation Table -->
    <section id="stock" class="scroll-mt-24">
        @include('stock.partials.equipment-table')
    </section>

    <!-- Orders Tracking Section -->
    <section id="orders-container" class="scroll-mt-24 pb-12">
        @include('stock.partials.orders-table')
    </section>

    <!-- Modal Ajouter Equipement -->
    <div x-data="{ showModal: false }" 
         x-show="showModal" 
         @open-add-stock-modal.window="showModal = true"
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="showModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('stock.equipement.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-slate-900" id="modal-title">Ajouter Équipement</h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700">Nom</label>
                                        <input type="text" name="nom" required class="mt-1 w-full border border-slate-300 rounded-lg py-2 px-3 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700">Quantité</label>
                                            <input type="number" name="quantite" required min="1" value="1" class="mt-1 w-full border border-slate-300 rounded-lg py-2 px-3 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700">Seuil Minimal</label>
                                            <input type="number" name="seuil" required min="1" value="5" class="mt-1 w-full border border-slate-300 rounded-lg py-2 px-3 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700">Prix (MAD)</label>
                                        <input type="number" name="prix" required min="0" step="0.01" value="0.00" class="mt-1 w-full border border-slate-300 rounded-lg py-2 px-3 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-slate-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-semibold text-white hover:bg-primary-700 sm:ml-3 sm:w-auto sm:text-sm">Ajouter</button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-semibold text-slate-700 hover:bg-slate-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function stockManager() {
        return {
            isPrinting: false,
            stock: @json($equipements ?? []),
            loading: false,
            sortCritere: '',
            
            async fetchStock() {
                this.loading = true;
                try {
                    const url = this.sortCritere 
                        ? `/api/stock?classer_par=${this.sortCritere}`
                        : '/api/stock';
                    const response = await fetch(url);
                    const result = await response.json();
                    if (result.success) {
                        this.stock = result.data;
                    }
                } catch (error) {

                    console.error('Erreur lors du chargement du stock:', error);
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
@endsection
