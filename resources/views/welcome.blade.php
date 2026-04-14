<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Launchpad - Hospital Connect</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
        </style>
    </head>
    <body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-6 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-indigo-50 via-slate-50 to-white">
        
        <div class="max-w-6xl w-full space-y-12 animate-in fade-in zoom-in duration-700">
            <!-- Header -->
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.3em] rounded-full shadow-lg shadow-indigo-100 mb-2">
                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                    Development Environment
                </div>
                <h1 class="text-5xl font-black tracking-tighter text-slate-900">Hospital Connect <span class="text-indigo-600">Hub</span></h1>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto italic select-none">Sélectionnez un portail applicatif pour accéder aux fonctionnalités spécifiques à chaque acteur de l'établissement.</p>
            </div>

            <!-- Grid of Portals -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Admin Technique -->
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-indigo-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Admin Technique</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Gestion des utilisateurs, logs système et sauvegardes.</p>
                </a>

                <!-- Ressources Humaines -->
                <a href="{{ route('rh.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-emerald-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-emerald-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Gestion RH</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Suivi des effectifs, départements et demandes de congés.</p>
                </a>

                <!-- Secrétariat -->
                <a href="{{ route('secretary.patients') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Secrétariat</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Admission des patients, facturation et prise de RDV.</p>
                </a>

                <!-- Stock -->
                <a href="{{ route('stock.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-amber-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Gestion Stock</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Inventaire médical, mouvements et alertes de péremption.</p>
                </a>

                <!-- Employé -->
                <a href="{{ route('employe.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-slate-300 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-slate-800 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Self-Service</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Pointage personnel, planning et démissions.</p>
                </a>

                <!-- Cadre -->
                <a href="{{ route('cadre.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-purple-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-purple-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Cadre Admin</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Demandes de budget et autorisations stratégiques.</p>
                </a>

                <!-- DG -->
                <a href="{{ route('dg.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-rose-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-rose-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A3.323 3.323 0 0010.605 8.9c.228.07.413.111.791.111.378 0 .563-.041.791-.111a3.323 3.323 0 001.036-1.928M5 5h5M5 8h2m6-3h2m-5 3h6m2-5h2M4 11h16M4 14h16M4 17h16M4 20h16"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Dir. Général</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Arbitrage stratégique, validations budgétaires et RH.</p>
                </a>

                <!-- Patient -->
                <a href="{{ route('patient.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-teal-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-teal-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Patient</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Dossier médical, RDV et paiement des factures.</p>
                </a>

                <!-- Médecin -->
                <a href="{{ route('medecin.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-cyan-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-cyan-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Médecin</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Interventions, dossiers et comptes-rendus cliniques.</p>
                </a>

                <!-- Infirmier -->
                <a href="{{ route('infirmier.dashboard') }}" class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-violet-100 transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-violet-600 text-white rounded-2xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 mb-2">Infirmier</h3>
                    <p class="text-xs text-slate-400 font-bold leading-relaxed">Assistance interventions et constantes vitales.</p>
                </a>

                 <!-- Login Mock -->
                 <a href="{{ route('login') }}" class="group bg-slate-900 p-8 rounded-[2.5rem] shadow-xl hover:shadow-2xl transition-all hover:-translate-y-2">
                    <div class="w-14 h-14 bg-white/10 text-white rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-2">Authentification</h3>
                    <p class="text-xs text-slate-500 font-bold leading-relaxed">Accès sécurisé à l'ensemble de l'infrastructure.</p>
                </a>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.4em]">Connected Healthcare Establishment</p>
            </div>
        </div>

    </body>
</html>
