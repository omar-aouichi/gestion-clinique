<div x-data="{ open: false, order: {} }" 
     @open-order-details.window="open = true; order = $event.detail"
     class="relative z-50">
    
    <!-- Backdrop -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
         style="display: none;"></div>

    <!-- Modal Content -->
    <div x-show="open" 
         class="fixed inset-0 overflow-y-auto"
         style="display: none;">
        <div class="flex min-h-full items-center justify-center p-4">
            <div @click.away="open = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden">
                
                <!-- Modal Header -->
                <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800" x-text="'Détails de la Commande ' + order.id"></h3>
                        <p class="text-xs text-slate-500 mt-1" x-text="'Émise le ' + order.date"></p>
                    </div>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600 transition-colors print:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-8 space-y-6">
                    <!-- Info Bar -->
                    <div class="grid grid-cols-2 gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Fournisseur</p>
                            <p class="text-sm font-bold text-slate-700" x-text="order.supplier"></p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Statut Actuel</p>
                            <span :class="{
                                'bg-blue-100 text-blue-700': order.status === 'Créée',
                                'bg-orange-100 text-orange-700': order.status === 'En Attente',
                                'bg-green-100 text-green-700': order.status === 'Validée',
                                'bg-red-100 text-red-700': order.status === 'Annulée',
                                'bg-teal-100 text-teal-700': order.status === 'Livrée'
                            }" class="inline-flex px-3 py-1 text-xs font-bold rounded-full" x-text="order.status"></span>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 pl-1">Liste des Articles</p>
                        <div class="border border-slate-100 rounded-2xl overflow-hidden">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase">Article</th>
                                        <th class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase text-center">Qté</th>
                                        <th class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase text-right">Unit.</th>
                                        <th class="px-4 py-3 text-[10px] font-bold text-slate-500 uppercase text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <template x-for="item in order.items" :key="item.name">
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-slate-800" x-text="item.name"></td>
                                            <td class="px-4 py-4 text-sm text-slate-600 text-center" x-text="item.qty"></td>
                                            <td class="px-4 py-4 text-sm text-slate-600 text-right" x-text="item.price + ' MAD'"></td>
                                            <td class="px-4 py-4 text-sm font-bold text-slate-800 text-right" x-text="(item.qty * item.price).toLocaleString() + ' MAD'"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="flex justify-end pt-4 border-t border-slate-100">
                        <div class="w-48 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Sous-total:</span>
                                <span class="text-slate-800 font-medium" x-text="order.montant"></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">TVA (0%):</span>
                                <span class="text-slate-800 font-medium">0.00 MAD</span>
                            </div>
                            <div class="flex justify-between text-lg font-extrabold text-primary-600 pt-2 border-t border-slate-100">
                                <span>TOTAL:</span>
                                <span x-text="order.montant"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex gap-3 print:hidden">
                    <button @click="open = false" class="flex-1 px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-colors">
                        Fermer
                    </button>
                    <button 
                        @click="isPrinting = true; setTimeout(() => { window.print(); isPrinting = false; }, 500)"
                        class="flex-2 px-6 py-3 bg-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-colors flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Imprimer Facture
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
