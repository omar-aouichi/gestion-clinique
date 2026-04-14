@extends('layouts.app')

@section('title', 'Portail Secrétariat - Connected Health')

@section('sidebar')
    @include('secretary.partials.sidebar')
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ rdvModal: false, paymentModal: false }">
    
    <!-- Urgent Action Header -->
    <div class="bg-gradient-to-r from-red-600 to-rose-700 rounded-3xl p-8 shadow-xl shadow-red-200 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative">
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold text-white mb-2">Urgence Vitale</h1>
            <p class="text-red-50 text-lg opacity-90 max-w-xl">Admission immédiate pour les cas critiques. Le système générera un identifiant provisoire "Sous X" pour permettre les soins sans délai.</p>
        </div>
        <button 
            @click="$dispatch('notify', { message: 'URGENCE CRITIQUE: Patient Sous X admis avec l\'identifiant temporaire #SX-' + Math.floor(Math.random() * 1000), type: 'error' })"
            class="relative z-10 px-8 py-4 bg-white text-red-600 font-extrabold rounded-2xl shadow-xl hover:bg-red-50 hover:scale-105 transition-all flex items-center gap-3">
            <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            PATIENT SOUS X
        </button>
        <!-- Decorative SVG background -->
        <svg class="absolute right-0 top-0 h-full w-1/3 text-white/10" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 0 L100 0 L100 100 Z"></path>
        </svg>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Appointment Form -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 flex items-center justify-center bg-primary-100 text-primary-600 rounded-lg text-sm">1</span>
                    Nouveau Rendez-vous
                </h2>
                
                <form class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 pl-1">Sélectionner Patient</label>
                        <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                            <option>Rechercher par CIN ou Nom...</option>
                            <option>Alami Ahmed (BE123456)</option>
                            <option>Benjelloun Sara (CD987654)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 pl-1">Médecin</label>
                        <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                            <option>Dr. Mansouri (Généraliste)</option>
                            <option>Dr. Bennani (Cardiologue)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 pl-1">Date</label>
                            <input type="date" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 pl-1">Heure</label>
                            <input type="time" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="button" @click="$dispatch('notify', { message: 'Le rendez-vous a été planifié avec succès. SMS de confirmation envoyé.', type: 'success' })" class="w-full py-4 bg-primary-600 text-white font-extrabold rounded-2xl shadow-lg shadow-primary-100 hover:bg-primary-700 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            PLANIFIER LE RDV
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Quick Stats -->
            <div class="bg-slate-900 rounded-3xl p-6 text-white overflow-hidden relative">
                <div class="relative z-10 space-y-4">
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Rappels H-24</p>
                    <div>
                        <h4 class="text-3xl font-bold">12</h4>
                        <p class="text-slate-400 text-sm mt-1">Notifications envoyées aujourd'hui</p>
                    </div>
                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                        <div class="bg-primary-500 h-full w-[85%] rounded-full shadow-[0_0_10px_#0ea5e9]"></div>
                    </div>
                </div>
                <!-- Background Pattern -->
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-primary-600/10 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Right: Unpaid Invoices Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden h-full">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Factures Impayées</h2>
                        <p class="text-sm text-slate-500 mt-1">Liste des actes médicaux en attente de règlement.</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50">
                                <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest pl-10">Facture</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Patient</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Montant</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Statut</th>
                                <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right pr-10">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <!-- Unpaid Item 1 -->
                            <tr class="hover:bg-slate-50/80 transition-all group">
                                <td class="px-8 py-5">
                                    <span class="text-sm font-bold text-slate-700">#F2026-1001</span>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Émise le 12/04/26</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-700">Alami Ahmed</p>
                                    <p class="text-xs text-slate-500">BE123456</p>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-extrabold text-slate-900">450.00 MAD</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 text-[10px] font-extrabold rounded-full">IMPAYÉE</span>
                                </td>
                                <td class="px-8 py-5 text-right space-x-2">
                                    <button @click="$dispatch('notify', { message: 'Paiement enregistré. Reçu généré.', type: 'success' })" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-600 hover:bg-green-100 rounded-lg text-xs font-bold transition-all">
                                        Payer
                                    </button>
                                    <button @click="$dispatch('notify', { message: 'La facture a été annulée. Trace système enregistrée.', type: 'error' })" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition-all">
                                        Annuler
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Unpaid Item 2 -->
                            <tr class="hover:bg-slate-50/80 transition-all group">
                                <td class="px-8 py-5">
                                    <span class="text-sm font-bold text-slate-700">#F2026-1003</span>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Émise le 08/04/26</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-700">Benjelloun Sara</p>
                                    <p class="text-xs text-slate-500">CD987654</p>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="text-sm font-extrabold text-slate-900">300.00 MAD</span>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 text-[10px] font-extrabold rounded-full">IMPAYÉE</span>
                                </td>
                                <td class="px-8 py-5 text-right space-x-2">
                                    <button @click="$dispatch('notify', { message: 'Paiement enregistré. Reçu généré.', type: 'success' })" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-600 hover:bg-green-100 rounded-lg text-xs font-bold transition-all">
                                        Payer
                                    </button>
                                    <button @click="$dispatch('notify', { message: 'La facture a été annulée. Trace système enregistrée.', type: 'error' })" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-xs font-bold transition-all">
                                        Annuler
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
