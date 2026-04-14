<div x-data="{ 
    formData: { id_equipement: '', type: 'entree', quantite: 1 },
    submitting: false,
    async submit() {
        this.submitting = true;
        const success = await submitMovement(this.formData);
        if (success) {
            this.formData = { id_equipement: '', type: 'entree', quantite: 1 };
        }
        this.submitting = false;
    }
}">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Enregistrer un Mouvement</h2>
        <p class="text-sm text-slate-500 mt-1">Saisissez les détails de l'entrée ou de la sortie de matériel pour mettre à jour l'inventaire.</p>
    </div>

    <!-- Form -->
    <form @submit.prevent="submit()" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Sélectionner l'Équipement</label>
                    <select x-model="formData.id_equipement" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                        <option value="">-- Choisir un article --</option>
                        <template x-for="item in stock" :key="item.id_equipement">
                            <option :value="item.id_equipement" x-text="item.nom + ' (Stock: ' + item.quantite + ')'"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Type de mouvement</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" value="entree" x-model="formData.type" class="sr-only peer">
                            <div class="w-full py-3 text-center text-sm font-bold text-slate-500 bg-slate-50 border border-slate-200 rounded-2xl peer-checked:bg-green-50 peer-checked:text-green-600 peer-checked:border-green-200 transition-all">
                                Entrée en Stock
                            </div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" value="sortie" x-model="formData.type" class="sr-only peer">
                            <div class="w-full py-3 text-center text-sm font-bold text-slate-500 bg-slate-50 border border-slate-200 rounded-2xl peer-checked:bg-red-50 peer-checked:text-red-600 peer-checked:border-red-200 transition-all">
                                Sortie de Stock
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Quantité</label>
                    <div class="relative">
                        <input type="number" x-model.number="formData.quantite" min="1" required class="w-full pl-4 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none">
                        <span class="absolute right-4 top-3 text-slate-400 text-xs font-bold uppercase">Unités</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Motif ou Commentaire</label>
                    <textarea rows="4" placeholder="Ex: Livraison fournisseur #REF-123, Distribution au service des urgences, Maintenance annuelle..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-all outline-none resize-none"></textarea>
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
            <button type="button" @click="currentTab = 'consulter'" class="px-8 py-3.5 text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition-colors">
                Annuler
            </button>
            <button type="submit" 
                    :disabled="submitting"
                    class="px-8 py-3.5 bg-primary-600 text-white font-bold rounded-2xl shadow-lg shadow-primary-200 hover:bg-primary-700 transition-all flex items-center gap-2">
                <svg x-show="submitting" class="animate-spin h-5 w-5 text-white" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span x-text="submitting ? 'Traitement...' : 'Confirmer le mouvement'"></span>
            </button>
        </div>
    </form>
</div>
