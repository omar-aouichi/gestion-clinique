@extends('layouts.app')

@section('title', 'Gestion de Stock - Connected Health')

@include('stock.partials.sidebar')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" 
     x-data="stockManager()" 
     x-init="fetchStock()"
     :class="{ 'printing-active': isPrinting }">
    <!-- Top Welcome Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 print:hidden">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">Bonjour, Gérant de Stock 👋</h1>
            <p class="text-slate-500 mt-1">Voici l'état actuel de votre inventaire et de vos commandes.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm font-medium text-slate-400">Dimanche, 12 Avril 2026</span>
            <div class="h-8 w-px bg-slate-200 mx-2"></div>
            <button class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </div>
    </div>

    <!-- Stats & Alerts Overview -->
    <section id="overview" class="print:hidden">
        @include('stock.partials.alerts-panel')
    </section>

    <!-- Main Stock Consultation Table -->
    <section id="stock" class="scroll-mt-24 print:hidden" x-show="currentTab === 'consulter'" x-transition>
        @include('stock.partials.equipment-table')
    </section>

    <!-- Stock Movements Section (includes the modal logic) -->
    <section id="movements" class="scroll-mt-24 print:hidden" x-show="currentTab === 'mouvement'" x-transition>
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl">
             @include('stock.partials.movement-modal')
             
             <!-- Recent Movements Preview omitted for brevity or moved here -->
        </div>
    </section>

    <!-- Orders Tracking Section -->
    <section id="orders-container" class="scroll-mt-24 pb-12">
        @include('stock.partials.orders-table')
    </section>

    <!-- Global Modals -->
    @include('stock.partials.order-details-modal')
</div>

</style>

<script>
    function stockManager() {
        return {
            isPrinting: false,
            stock: [],
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
            },

            async submitMovement(data) {
                try {
                    const response = await fetch('/api/stock/mouvement', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok) {
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: result.message, type: 'success' } 
                        }));
                        await this.fetchStock();
                        return true;
                    } else {
                        window.dispatchEvent(new CustomEvent('notify', { 
                            detail: { message: result.message || 'Erreur lors du mouvement', type: 'error' } 
                        }));
                        return false;
                    }
                } catch (error) {
                    window.dispatchEvent(new CustomEvent('notify', { 
                        detail: { message: 'Erreur réseau', type: 'error' } 
                    }));
                    return false;
                }
            }
        }
    }
</script>
@endsection
