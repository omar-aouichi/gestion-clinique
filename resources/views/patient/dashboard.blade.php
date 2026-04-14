@extends('layouts.app')
@section('title', 'Mon Espace Patient')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4" x-data="{ rdvTab: true }">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-tight">Bonjour, Karim 👋</h1>
        <p class="text-slate-500 mt-1">Gérez vos rendez-vous, factures et documents médicaux.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Appointments -->
            <section class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-800">Mes Prochains Rendez-vous</h2>
                    <span class="px-3 py-1 bg-primary-50 text-primary-600 text-[10px] font-bold uppercase rounded-xl border border-primary-100">Vue Lecture Seule</span>
                </div>
                <div class="divide-y divide-slate-50">
                    @forelse($rdvs as $r)
                    <div class="px-8 py-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center font-bold text-lg">
                                {{ substr($r->dateHeader, 8, 2) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ $r->medecinNom }}</h4>
                                <p class="text-sm text-slate-500">{{ \Carbon\Carbon::parse($r->dateHeader)->format('F Y') }} à {{ $r->heure }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-lg border uppercase">{{ $r->state->value }}</span>
                    </div>
                    @empty
                    <div class="p-12 text-center text-slate-400 italic">Aucun rendez-vous planifié.</div>
                    @endforelse
                </div>
            </section>

            <!-- Results Preview -->
            <section class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden opacity-60">
                <div class="px-8 py-6 border-b border-slate-100">
                    <h2 class="text-xl font-bold text-slate-800">Mes Résultats Médicaux</h2>
                </div>
                <div class="p-12 text-center text-slate-400 italic">Section disponible après votre première consultation effectuée.</div>
            </section>
        </div>

        <!-- Sidebar (Invoices) -->
        <div class="space-y-8">
            <section class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100">
                    <h2 class="text-xl font-bold text-slate-800">Mes Factures</h2>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($factures as $f)
                    <div class="p-4 rounded-2xl border border-slate-100 {{ $f->state->value === 'PAYEE' ? 'bg-green-50/30' : 'bg-slate-50/30' }}">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Facture #F-{{ $f->id }}</span>
                                <h5 class="text-sm font-bold text-slate-700">{{ number_format($f->montantTotal, 2) }} DH</h5>
                            </div>
                            <span class="px-2 py-0.5 {{ $f->state->value === 'PAYEE' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }} text-[9px] font-bold rounded uppercase">{{ $f->state->value }}</span>
                        </div>
                        @if($f->state->value !== 'PAYEE' && $f->state->value !== 'ANNULEE')
                        <form action="{{ route('patient.pay_facture', $f->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full mt-2 py-2 bg-primary-600 text-white text-xs font-bold rounded-xl hover:bg-primary-700 transition-all shadow-md shadow-primary-200">
                                Effectuer le Paiement
                            </button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
