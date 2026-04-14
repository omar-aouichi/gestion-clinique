<nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Clinical Staff</p>
    
    @if(request()->segment(1) === 'medecin' || request()->routeIs('medecin.*'))
        <a href="{{ route('medecin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('medecin.dashboard') ? 'text-white bg-primary-600 shadow-xl shadow-primary-200' : 'text-slate-500 hover:text-primary-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            Tableau de Bord
        </a>
    @endif

    @include('partials.employe-link')
</nav>
