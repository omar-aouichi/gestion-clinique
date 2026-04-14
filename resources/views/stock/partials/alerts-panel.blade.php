<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- PUMP Widget -->
    <div class="md:col-span-1 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Prix Unitaire Moyen Pondéré (PUMP)</h3>
            <div class="p-2 bg-teal-50 text-teal-600 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div>
            <span class="text-4xl font-bold text-slate-800">{{ number_format($pump, 2, ',', ' ') }}</span>
            <span class="text-lg font-medium text-slate-400 ml-1">DH</span>
        </div>
        <div class="mt-4 flex items-center text-xs text-teal-600 font-medium">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Automatisé via StockService
        </div>
    </div>

    <!-- Low Stock Alerts Panel -->
    <div class="md:col-span-2 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Alertes de Stock Bas
            </h3>
            <span class="bg-red-100 text-red-600 text-xs font-bold px-3 py-1 rounded-full">{{ $alertes->count() }} Articles critiques</span>
        </div>

        <div class="space-y-4 max-h-[250px] overflow-y-auto pr-2">
            @forelse($alertes as $alerte)
            <div class="flex items-center justify-between p-4 {{ $alerte->quantite <= ($alerte->seuil_minimal / 2) ? 'bg-red-50/50 border-red-100' : 'bg-orange-50/50 border-orange-100' }} border rounded-2xl animate-in fade-in slide-in-from-right-4 duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center {{ $alerte->quantite <= ($alerte->seuil_minimal / 2) ? 'text-red-500' : 'text-orange-500' }} shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ $alerte->nom }}</p>
                        <p class="text-xs text-slate-500 uppercase tracking-tighter">Stock: <span class="font-bold {{ $alerte->quantite <= ($alerte->seuil_minimal / 2) ? 'text-red-600' : 'text-orange-600' }}">{{ $alerte->quantite }}</span> / Seuil: {{ $alerte->seuil_minimal }}</p>
                    </div>
                </div>
                <form action="{{ route('stock.signaler_administratif', $alerte->id_equipement) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white text-[10px] uppercase font-black px-4 py-2.5 rounded-xl shadow-lg shadow-primary-200 transition-all active:scale-95">
                        Alerter
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center py-10">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-sm font-bold text-slate-400">Stock optimal. Aucune alerte.</p>
            </div>
            @endforelse
        </div>
    </div>
    </div>
</div>
