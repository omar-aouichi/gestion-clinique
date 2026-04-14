<nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Management Dashboard</p>
    
    <a href="{{ route('rh.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('rh.dashboard') ? 'text-white bg-primary-600 shadow-xl shadow-primary-200' : 'text-slate-500 hover:text-primary-600 hover:bg-slate-50' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        Gestion RH
    </a>

    @include('partials.employe-link')
</nav>
