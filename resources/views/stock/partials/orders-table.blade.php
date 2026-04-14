<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden" id="orders">
    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Suivi des Commandes</h2>
            <p class="text-sm text-slate-500">Statut des commandes envoyées aux fournisseurs.</p>
        </div>
        <button 
            @click="isPrinting = true; setTimeout(() => { window.print(); isPrinting = false; }, 1200)"
            :disabled="isPrinting"
            class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed print:hidden"
        >
            <!-- Loading Spinner (shown when preparing print) -->
            <svg x-show="isPrinting" class="animate-spin h-4 w-4 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            
            <!-- PDF Icon (shown when idle) -->
            <svg x-show="!isPrinting" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            
            <span x-text="isPrinting ? 'Préparation...' : 'Exporter PDF'"></span>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">ID Commande</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date de début</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Montant</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Fournisseur</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Statut</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider print:hidden"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <!-- Status: Créée -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-slate-700">#CMD-2024-001</td>
                    <td class="px-6 py-5 text-sm text-slate-500">12/04/2026</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-800">15,400.00 MAD</td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-600">MedEquip Solutions</td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                            Créée
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right print:hidden">
                        <button 
                            @click="$dispatch('open-order-details', {
                                id: '#CMD-2024-001',
                                date: '12/04/2026',
                                status: 'Créée',
                                supplier: 'MedEquip Solutions',
                                montant: '15,400.00 MAD',
                                items: [
                                    { name: 'Défibrillateur Automatique', qty: 2, price: 7500 },
                                    { name: 'Electrode pads (paquet)', qty: 10, price: 40 }
                                ]
                            })"
                            class="text-primary-600 hover:text-primary-700 text-xs font-bold underline transition-colors">Détails</button>
                    </td>
                </tr>

                <!-- Status: En Attente -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-slate-700">#CMD-2024-002</td>
                    <td class="px-6 py-5 text-sm text-slate-500">10/04/2026</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-800">2,850.00 MAD</td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-600">PharmaLink Maroc</td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full">
                            En Attente
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right print:hidden">
                        <button 
                            @click="$dispatch('open-order-details', {
                                id: '#CMD-2024-002',
                                date: '10/04/2026',
                                status: 'En Attente',
                                supplier: 'PharmaLink Maroc',
                                montant: '2,850.00 MAD',
                                items: [
                                    { name: 'Paracétamol 500mg (Boîte)', qty: 100, price: 25 },
                                    { name: 'Amoxicilline 1g (Boîte)', qty: 10, price: 35 }
                                ]
                            })"
                            class="text-primary-600 hover:text-primary-700 text-xs font-bold underline transition-colors">Détails</button>
                    </td>
                </tr>

                <!-- Status: Validée -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-slate-700">#CMD-2024-003</td>
                    <td class="px-6 py-5 text-sm text-slate-500">08/04/2026</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-800">45,000.00 MAD</td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-600">LaboTech SA</td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                            Validée
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right print:hidden">
                        <button 
                            @click="$dispatch('open-order-details', {
                                id: '#CMD-2024-003',
                                date: '08/04/2026',
                                status: 'Validée',
                                supplier: 'LaboTech SA',
                                montant: '45,000.00 MAD',
                                items: [
                                    { name: 'Analyseur Hématologique BC-500', qty: 1, price: 45000 }
                                ]
                            })"
                            class="text-primary-600 hover:text-primary-700 text-xs font-bold underline transition-colors">Détails</button>
                    </td>
                </tr>

                <!-- Status: Annulée -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-slate-700">#CMD-2024-004</td>
                    <td class="px-6 py-5 text-sm text-slate-500">05/04/2026</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-800">1,200.00 MAD</td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-600">MedPlus Distribution</td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                            Annulée
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right print:hidden">
                        <button 
                            @click="$dispatch('open-order-details', {
                                id: '#CMD-2024-004',
                                date: '05/04/2026',
                                status: 'Annulée',
                                supplier: 'MedPlus Distribution',
                                montant: '1,200.00 MAD',
                                items: [
                                    { name: 'Seringues 5ml (Boîte)', qty: 60, price: 20 }
                                ]
                            })"
                            class="text-primary-600 hover:text-primary-700 text-xs font-bold underline transition-colors">Détails</button>
                    </td>
                </tr>

                <!-- Status: Livrée -->
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-8 py-5 text-sm font-bold text-slate-700">#CMD-2024-005</td>
                    <td class="px-6 py-5 text-sm text-slate-500">01/04/2026</td>
                    <td class="px-6 py-5 text-sm font-bold text-slate-800">85,200.00 MAD</td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-600">General BioMed</td>
                    <td class="px-6 py-5 text-center">
                        <span class="inline-flex items-center px-3 py-1 bg-teal-100 text-teal-700 text-xs font-bold rounded-full">
                            Livrée
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right print:hidden">
                        <button 
                            @click="$dispatch('open-order-details', {
                                id: '#CMD-2024-005',
                                date: '01/04/2026',
                                status: 'Livrée',
                                supplier: 'General BioMed',
                                montant: '85,200.00 MAD',
                                items: [
                                    { name: 'Lit Médicalisé Électrique', qty: 3, price: 25000 },
                                    { name: 'Table d\'auscultation Inox', qty: 6, price: 1700 }
                                ]
                            })"
                            class="text-primary-600 hover:text-primary-700 text-xs font-bold underline transition-colors">Détails</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
