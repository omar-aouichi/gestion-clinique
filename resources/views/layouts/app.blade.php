<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Connected Health')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Removed Vite directive to avoid ViteManifestNotFoundException -->
    
    <!-- Fallback/Preview with CDN, removing if actually built with Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        },
                        teal: {
                            50: '#f0fdfa',
                            500: '#14b8a6',
                            600: '#0d9488',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full flex overflow-hidden antialiased font-sans text-slate-800" 
      x-data="{ 
        currentTab: 'consulter',
        notifications: [], 
        add(n) { 
            this.notifications.push({ ...n, id: Date.now() }); 
            setTimeout(() => { if(this.notifications.length > 0) this.notifications.shift() }, 5000); 
        } 
      }" 
      @notify.window="add($event.detail)">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex z-10 print:hidden">
        <div class="h-16 flex items-center px-6 border-b border-slate-200">
            <div class="flex items-center gap-2 text-primary-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-xl font-bold">DocDialy</span>
            </div>
        </div>
        
        @yield('sidebar')
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full bg-slate-50 relative z-0">
        <!-- Topbar -->
        <header class="h-16 flex items-center justify-between px-6 bg-white border-b border-slate-200 md:justify-end shadow-sm z-10 relative print:hidden">
            <div class="flex items-center gap-2 md:hidden text-primary-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-lg font-bold">DocDialy</span>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="text-slate-400 hover:text-primary-600 transition-colors relative p-2 rounded-xl hover:bg-slate-50">
                        @if(($unreadCount ?? 0) > 0)
                            <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-red-500 text-white text-[9px] font-black rounded-full border-2 border-white flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 overflow-hidden" style="display: none;">
                        
                        <div class="px-4 py-2 border-b border-slate-50 flex items-center justify-between">
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Notifications</h3>
                            @if(($unreadCount ?? 0) > 0)
                                <form action="{{ route('notifications.read-all') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] text-primary-600 font-bold hover:underline">Tout marquer comme lu</button>
                                </form>
                            @endif
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            @forelse($unreadNotifications ?? [] as $notif)
                                <div class="px-4 py-4 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0 relative group">
                                    <p class="text-[11px] text-slate-600 leading-relaxed pr-6">{{ $notif->message }}</p>
                                    <p class="text-[9px] text-slate-400 mt-2 font-medium">{{ $notif->date_envoi->diffForHumans() }}</p>
                                    <form action="{{ route('notifications.read', $notif->id) }}" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        <button type="submit" class="text-slate-300 hover:text-primary-600" title="Marquer comme lu">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="px-4 py-10 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-slate-50 rounded-full mb-3">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    </div>
                                    <p class="text-xs text-slate-400 font-medium">Aucune nouvelle notification</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="h-6 w-px bg-slate-200"></div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-slate-800">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
                        <p class="text-[10px] font-bold text-primary-600 uppercase tracking-widest">{{ str_replace('_', ' ', auth()->user()->role->value) }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors bg-slate-50 rounded-xl border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-4 md:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Global Toast Toast UI -->
    <div class="fixed bottom-8 right-8 z-[100] space-y-3 pointer-events-none">
        <template x-for="n in notifications" :key="n.id">
            <div x-show="true" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="flex items-center gap-3 bg-slate-900/95 backdrop-blur text-white px-6 py-4 rounded-2xl shadow-2xl pointer-events-auto border border-white/10"
                 :class="n.type === 'error' ? 'bg-red-600/95' : 'bg-slate-900/95'">
                <svg x-show="n.type === 'success'" class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <svg x-show="n.type === 'error'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <svg x-show="n.type === 'info'" class="w-6 h-6 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm font-bold" x-text="n.message"></p>
            </div>
        </template>
    </div>
    <!-- Help Modal (Alpine.js) -->
    <div x-data="{ open: false }" @open-help.window="open = true">
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[150] flex items-center justify-center p-4" 
             style="display: none;">
            <div @click.away="open = false" 
                 class="bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden border border-slate-100">
                <div class="px-8 py-6 bg-primary-600 text-white flex items-center justify-between">
                    <h3 class="text-xl font-black italic">Support Technique</h3>
                    <button @click="open = false" class="text-white/80 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8 space-y-6">
                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Admin Technique</p>
                            <p class="text-sm font-bold text-slate-800">Omar Aouichi</p>
                            <p class="text-xs text-slate-500">Contact: support@docdialy.com</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <p class="text-sm font-medium text-slate-600 leading-relaxed">
                            Besoin d'aide pour une opération spécifique ? Consultez le <span class="text-primary-600 font-bold">Guide de l'Utilisateur</span> ou contactez l'administrateur système pour la réinitialisation de mots de passe.
                        </p>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="px-4 py-3 bg-slate-800 text-white text-xs font-bold rounded-xl hover:bg-slate-900 transition-colors uppercase">Ouvrir Ticket</button>
                            <button class="px-4 py-3 bg-primary-50 text-primary-600 text-xs font-bold rounded-xl hover:bg-primary-100 transition-colors uppercase">Guide PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            @if(session('success'))
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'success', message: "{{ session('success') }}" } }));
            @endif
            @if(session('error'))
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'error', message: "{{ session('error') }}" } }));
            @endif
            @if(session('info'))
                window.dispatchEvent(new CustomEvent('notify', { detail: { type: 'info', message: "{{ session('info') }}" } }));
            @endif
        }
    </script>
</body>
</html>
