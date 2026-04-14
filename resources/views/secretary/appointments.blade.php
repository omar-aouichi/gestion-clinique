@extends('layouts.app')

@section('title', 'Secretary Dashboard - Appointments & Planning')

@section('sidebar')
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-2 px-3">Secretary</div>
        <a href="/secretary" class="bg-primary-50 text-primary-700 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Planner & Booking
        </a>
        <a href="/secretary/create-patient" class="text-slate-600 hover:bg-slate-50 flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            New Patient
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold border border-slate-200 shadow-sm">
                {{ substr(auth()->user()->prenom, 0, 1) }}{{ substr(auth()->user()->nom, 0, 1) }}
            </div>
            <div>
                <div class="text-sm font-semibold text-slate-800">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</div>
                <div class="text-xs text-slate-500 uppercase font-bold tracking-tighter">{{ auth()->user()->role->value }}</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6" x-data="{ 
    emergencyMode: false, 
    view: 'timeline', 
    currentDate: new Date().toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' }),
    nextDay() { /* Logic to shift date visually or reload */ alert('Passage au jour suivant...'); },
    prevDay() { alert('Retour au jour précédent...'); }
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Resource & Appointment Planning</h1>
            <p class="text-sm text-slate-500 mt-1">Manage schedules, doctor availability, and book interventions.</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('secretary.create-patient') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-lg font-medium shadow-sm transition-all flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                New Patient
            </a>
            
            <!-- Emergency Toggle -->
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="emergencyMode" class="sr-only peer">
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                <span class="ml-3 text-sm font-medium" :class="emergencyMode ? 'text-red-600 font-bold' : 'text-slate-600'">Emergency Mode</span>
            </label>
        </div>
    </div>

    <!-- Emergency Form (Visible only when emergencyMode is true) -->
    <div x-show="emergencyMode" x-collapse>
        <div class="bg-red-50 border border-red-200 rounded-xl p-6 shadow-sm mb-6">
            <div class="flex items-start gap-4">
                <div class="bg-red-100 p-3 rounded-full text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-base font-bold text-red-800">Immediate Intervention "Under X"</h2>
                    <p class="text-sm text-red-600 mt-1">Bypass standard planning. This will immediately page available on-call doctors and reserve emergency equipment.</p>
                    
                    <form action="{{ route('secretary.sous-x') }}" method="POST" class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold text-red-700 mb-1">Patient Name (Unknown "X" if blank)</label>
                            <input type="text" name="nom" value="PATIENT X" class="w-full bg-white border border-red-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-red-700 mb-1">Intervention Type</label>
                            <select name="type" class="w-full bg-white border border-red-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                                <option>Trauma Surgery</option>
                                <option>Cardiac Arrest</option>
                                <option>Severe Accident</option>
                                <option>Other Emergency</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg px-4 py-2 transition-colors uppercase text-xs">
                                Trigger Alert & Assign
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Interface & Visual Planner -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col md:flex-row h-[700px]">
        
        <!-- Sidebar filters -->
        <div class="w-full md:w-72 border-r border-slate-200 bg-slate-50/50 p-4 overflow-y-auto flex-shrink-0">
            <h3 class="font-semibold text-slate-800 mb-4">Book New Appointment</h3>
            
            <form action="{{ route('secretary.book-appointment') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Patient</label>
                    <select name="patient_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                        @foreach(\App\Models\Utilisateur::where('role', 'patient')->get() as $p)
                            <option value="{{ $p->id }}">{{ $p->nom }} {{ $p->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Doctor</label>
                    <select name="medecin_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                        @foreach($doctors as $doc)
                            <option value="{{ $doc->id }}">Dr. {{ $doc->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Infirmier (Factultatif)</label>
                    <select name="infirmier_id" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                        <option value="">Aucun spécifique</option>
                        @foreach($infirmiers as $inf)
                            <option value="{{ $inf->id }}">{{ $inf->nom }} {{ $inf->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Date</label>
                        <input type="date" name="date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-1">Heure</label>
                        <input type="time" name="heure" required value="08:00" class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1">Type de Rendez-vous</label>
                    <select name="type" required class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white outline-none">
                        <option value="Consultation">Consultation Générale</option>
                        <option value="Radiologie">Examen Radiologie</option>
                        <option value="Chirurgie">Intervention Chirurgicale</option>
                        <option value="Suivi">Visite de Suivi</option>
                        <option value="Urgence">Urgence (Triage)</option>
                    </select>
                </div>

                <div class="pt-2 pb-2 border-y border-slate-200 my-4">
                    <h4 class="text-xs font-semibold text-slate-700 uppercase tracking-wider mb-3">Required Resources</h4>
                    
                    <div class="space-y-3">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="room" value="1" checked class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700">Medical Room</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-black rounded-lg px-4 py-2 mt-2 transition-colors uppercase text-[10px] shadow-lg shadow-primary-100">
                    Find Slot & Book
                </button>
            </form>
        </div>

        <!-- Visual Planner Calendar -->
        <div class="flex-1 flex flex-col bg-white overflow-hidden relative">
            <div class="h-14 border-b border-slate-200 flex items-center justify-between px-6 bg-white">
                <div class="flex items-center gap-4">
                    <button @click="prevDay()" class="p-1 hover:bg-slate-100 rounded transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                    <span class="font-semibold text-slate-800" x-text="currentDate">Today, Oct 12, 2023</span>
                    <button @click="nextDay()" class="p-1 hover:bg-slate-100 rounded transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                </div>
                <!-- Timeline/Resource View Toggle -->
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button @click="view = 'timeline'" :class="view === 'timeline' ? 'bg-white shadow-sm text-slate-800' : 'text-slate-500'" class="px-3 py-1 text-sm font-medium rounded-md transition-all">Timeline</button>
                    <button @click="view = 'rooms'" :class="view === 'rooms' ? 'bg-white shadow-sm text-slate-800' : 'text-slate-500'" class="px-3 py-1 text-sm font-medium rounded-md transition-all">Rooms</button>
                </div>
            </div>
            
            <div class="flex-1 overflow-auto relative bg-slate-50/30">
                <!-- Grid Lines representing hours -->
                <div class="absolute inset-x-0 top-0 h-full">
                    @for ($i = 8; $i <= 18; $i++)
                    <div class="border-b border-slate-200 h-20 flex">
                        <div class="w-16 border-r border-slate-200 flex-shrink-0 flex items-center justify-center text-xs font-medium text-slate-400 bg-white">
                            {{ $i }}:00
                        </div>
                                <div @click="$dispatch('notify', { message: 'Slot selected: ' + {{ $i }} + ':00. Fill patient details to confirm.', type: 'info' });" class="flex-1 grid grid-cols-3 divide-x divide-slate-100/50 cursor-pointer hover:bg-primary-50/30 transition-colors">
                                    <div></div><div></div><div></div>
                                </div>
                    </div>
                    @endfor
                </div>

                <!-- Resource Header (Mocking Simultaneous Availability) -->
                <div class="absolute top-0 left-16 right-0 h-10 border-b border-slate-200 flex z-30 bg-white/95 backdrop-blur text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <template x-if="view === 'timeline'">
                        <div class="flex w-full h-full divide-x divide-slate-100">
                            @forelse($doctors->take(3) as $doc)
                                <div class="flex-1 flex items-center justify-center italic">Dr. {{ $doc->nom }}</div>
                            @empty
                                <div class="flex-1 flex items-center justify-center italic text-slate-300">Aucun médecin disponible</div>
                            @endforelse
                        </div>
                    </template>
                    <template x-if="view === 'rooms'">
                        <div class="flex w-full h-full divide-x divide-slate-100 bg-slate-50">
                            <div class="flex-1 flex items-center justify-center italic bg-indigo-50/30 text-indigo-600">Bloc Opératoire A</div>
                            <div class="flex-1 flex items-center justify-center italic bg-emerald-50/30 text-emerald-600">Salle Radiologie</div>
                            <div class="flex-1 flex items-center justify-center italic">Consultation 102</div>
                        </div>
                    </template>
                </div>

                <!-- Scheduled Events Overlay -->
                <div class="absolute top-10 left-16 right-0 bottom-0 grid grid-cols-3 z-10 pt-4">
                    @php 
                        $doctorsList = $doctors->take(3); 
                    @endphp
                    
                    @foreach($doctorsList as $index => $doc)
                    <div class="relative px-2">
                        @foreach($appointments->where('medecin_id', $doc->id)->where('statut', '!=', 'ANNULE') as $apt)
                            @php
                                $hour = $apt->date_heure->format('G');
                                $minute = $apt->date_heure->format('i');
                                $top = (($hour - 8) * 80) + (($minute / 60) * 80);
                            @endphp
                            <div class="absolute left-2 right-2 bg-primary-50 border-l-4 border-primary-500 rounded-md p-2 shadow-sm flex flex-col justify-between overflow-hidden cursor-pointer hover:shadow-md transition-shadow group z-20"
                                 style="top: {{ $top }}px; height: 80px;">
                                <div>
                                    <span class="text-xs font-semibold text-primary-700 block line-clamp-1 truncate">{{ $apt->patient?->nom }} {{ $apt->patient?->prenom }}</span>
                                    <span class="text-[9px] font-black text-primary-900 bg-primary-100/50 px-1 rounded inline-block mb-1">{{ $apt->type }}</span>
                                    <span class="text-[10px] text-primary-600 block">{{ $apt->date_heure->format('H:i') }} • {{ $apt->statut }}</span>
                                </div>
                                <div class="flex gap-1 mt-1 transition-opacity">
                                    <form action="{{ route('secretary.update-appointment-status', $apt->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="ANNULE">
                                        <button class="text-[9px] bg-red-100 text-red-600 px-1.5 py-0.5 rounded font-bold uppercase transition-colors hover:bg-red-200">Annuler</button>
                                    </form>
                                    @if($apt->statut !== 'CONFIRME')
                                    <form action="{{ route('secretary.update-appointment-status', $apt->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="CONFIRME">
                                        <button class="text-[9px] bg-emerald-600 text-white px-1.5 py-0.5 rounded font-bold uppercase transition-colors hover:bg-emerald-700">Confirmer</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
