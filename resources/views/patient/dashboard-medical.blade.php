@extends('layouts.app')

@section('title', 'Mon Dossier Médical - Patient')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700" x-data="{ showCancelModal: false, cancelRdvId: null, cancelRdvName: '' }">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Mon Espace Patient</h1>
            <p class="text-slate-400 font-medium mt-1">Bienvenue, {{ $patient->prenom }} {{ $patient->nom }}</p>
        </div>
        @if($patient->absences_non_justifiees > 0)
        <div class="px-4 py-2 bg-amber-50 border border-amber-100 rounded-2xl flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
            <span class="text-xs font-black text-amber-700">{{ $patient->absences_non_justifiees }} absence(s) non justifiée(s)</span>
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Medical Record (Read-Only - RG13) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
                    <h2 class="text-lg font-black text-slate-800">Dossier Médical</h2>
                    @if($data['dossier'])
                    <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                        {{ $data['dossier']->statut === 'ACTIF' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-slate-100 text-slate-500' }}">
                        {{ $data['dossier']->statut }}
                    </span>
                    @else
                    <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase bg-amber-50 text-amber-600 border border-amber-100">
                        Non Créé
                    </span>
                    @endif
                </div>

                @if($data['resultats_disponibles'])
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Acte Médical</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Médecin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($data['actes_visibles'] as $acte)
                        <tr class="hover:bg-slate-50/20 transition-colors">
                            <td class="px-8 py-4 text-sm font-bold text-slate-700">{{ $acte['type'] }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $acte['date'] }}</td>
                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $acte['medecin'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <p class="text-sm font-bold text-slate-400">Vos résultats ne sont pas encore validés par le médecin.</p>
                    <p class="text-xs text-slate-300 mt-1 italic">Le médecin doit valider les résultats avant que vous puissiez les consulter.</p>
                </div>
                @endif
            </div>

            <!-- Rendez-Vous -->
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50">
                    <h2 class="text-lg font-black text-slate-800">Mes Rendez-vous</h2>
                </div>
                <div class="divide-y divide-slate-50">
                    @foreach($rdvs as $rdv)
                    <div class="px-8 py-5 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-slate-800">Dr. {{ $rdv->medecin?->nom }} {{ $rdv->medecin?->prenom }}</p>
                            <p class="text-xs text-slate-400 font-medium">{{ $rdv->date_heure->format('d/m/Y') }} à {{ $rdv->date_heure->format('H:i') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 text-[9px] font-black rounded-lg uppercase
                                @if($rdv->statut === 'PLANIFIE') bg-blue-50 text-blue-600 border border-blue-100
                                @elseif($rdv->statut === 'CONFIRME') bg-green-50 text-green-600 border border-green-100
                                @elseif($rdv->statut === 'ANNULE') bg-rose-50 text-rose-600 border border-rose-100
                                @else bg-slate-100 text-slate-500 @endif">
                                {{ $rdv->statut }}
                            </span>
                            @if($rdv->statut !== 'ANNULE' && $rdv->statut !== 'TERMINE')
                            <button @click="showCancelModal = true; cancelRdvId = {{ $rdv->id }}; cancelRdvName = 'Dr. {{ $rdv->medecin?->nom }} - {{ $rdv->date_heure->format('d/m/Y') }}'"
                                    class="px-3 py-1.5 bg-rose-50 text-rose-600 text-[10px] font-black rounded-xl hover:bg-rose-100 transition-colors uppercase">
                                Annuler
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar: Factures -->
        <div class="space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8">
                <h3 class="text-lg font-black text-slate-800 mb-6">Mes Factures</h3>
                <div class="space-y-4">
                    @foreach($factures as $facture)
                    <div class="p-4 bg-slate-50 rounded-2xl">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-bold text-slate-700">{{ number_format($facture->montant, 2) }} DT</span>
                            <span class="px-2 py-0.5 text-[8px] font-black rounded-md uppercase
                                {{ $facture->statut === 'PAYEE' ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $facture->statut }}
                            </span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium mb-3">{{ $facture->created_at->format('d/m/Y') }}</p>
                        @if($facture->statut !== 'PAYEE' && $facture->statut !== 'ANNULEE')
                        <form action="{{ route('patient.payer-facture', $facture->id) }}" method="POST">
                            @csrf
                            <button class="w-full py-2.5 bg-emerald-600 text-white text-[10px] font-black rounded-xl hover:bg-emerald-700 transition-colors uppercase shadow-lg shadow-emerald-200">
                                Payer maintenant
                            </button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modal (Alpine.js) -->
    <div x-show="showCancelModal" x-transition class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 backdrop-blur-sm" @click.self="showCancelModal = false">
        <div class="bg-white rounded-[2rem] p-10 max-w-md w-full mx-4 shadow-2xl" @click.stop>
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-amber-50 rounded-full mx-auto flex items-center justify-center">
                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-800">Confirmer l'annulation ?</h3>
                <p class="text-sm text-slate-500 font-medium leading-relaxed">
                    <strong class="text-amber-600">Attention :</strong> Si l'annulation a lieu à moins de 24h du rendez-vous, une <strong class="text-rose-600">absence non justifiée</strong> sera comptabilisée sur votre dossier.
                </p>
                <p class="text-xs text-slate-400 italic" x-text="cancelRdvName"></p>
            </div>
            <div class="flex gap-3 mt-8">
                <button @click="showCancelModal = false" class="flex-1 py-3 bg-slate-100 text-slate-600 font-bold text-sm rounded-xl hover:bg-slate-200 transition-colors">
                    Retour
                </button>
                <form :action="'/patient/annuler-rdv/' + cancelRdvId" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-rose-600 text-white font-bold text-sm rounded-xl hover:bg-rose-700 transition-colors">
                        Confirmer l'annulation
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
