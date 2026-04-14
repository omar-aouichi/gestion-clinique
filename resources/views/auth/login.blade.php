<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Clinique Connectée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50:'#eff6ff', 100:'#dbeafe', 200:'#bfdbfe', 500:'#3b82f6', 600:'#2563eb', 700:'#1d4ed8' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; }
        .glass { backdrop-filter: blur(16px); background: rgba(255, 255, 255, 0.95); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-slate-950">

    <div class="w-full max-w-md">
        <!-- Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary-600 shadow-xl shadow-primary-500/20 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h1 class="text-2xl font-black text-white px-2">Clinique Connectée</h1>
            <p class="text-slate-500 text-sm font-medium mt-1">Plateforme de Gestion Intégrée</p>
        </div>

        <!-- Login Card -->
        <div class="glass rounded-[2rem] shadow-2xl p-8 border border-white/20">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-slate-800">Content de vous revoir</h2>
                <p class="text-slate-400 text-sm">Veuillez entrer vos identifiants pour continuer</p>
            </div>

            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-50 text-blue-700 text-sm rounded-xl border border-blue-100 font-medium">
                    {{ session('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 text-red-700 text-sm rounded-xl border border-red-100 font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Identifiant</label>
                    <input type="text" name="login" required autofocus placeholder="Nom d'utilisateur"
                        class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 outline-none transition-all text-sm">
                </div>

                <div class="space-y-1.5" x-data="{ show: false }">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Mot de passe</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
                            class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 outline-none transition-all text-sm">
                        <button type="button" @click="show = !show" class="absolute right-3 top-3.5 text-slate-400 hover:text-slate-600">
                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                    <label for="remember" class="ml-2 text-sm text-slate-500">Se souvenir de moi</label>
                </div>

                <button type="submit" class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-xl shadow-lg shadow-primary-500/20 active:scale-[0.98] transition-all">
                    Se connecter
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-400 font-medium tracking-tight">
                    &copy; {{ date('Y') }} Connected Health Establishment. Tous droits réservés.
                </p>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
