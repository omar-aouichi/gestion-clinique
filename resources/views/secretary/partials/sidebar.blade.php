<nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
    <a href="{{ route('secretary.appointments') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('secretary.appointments') ? 'bg-primary-50 text-primary-700 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700 font-medium' }} rounded-xl transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
        Administration
    </a>
    <a href="{{ route('secretary.patients') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('secretary.patients') ? 'bg-primary-50 text-primary-700 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700 font-medium' }} rounded-xl transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        Patients
    </a>
    <a href="{{ route('secretary.facturation') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('secretary.facturation') ? 'bg-primary-50 text-primary-700 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700 font-medium' }} rounded-xl transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Facturation
    </a>

    @include('partials.employe-link')

    <div class="pt-4 mt-4 border-t border-slate-100">
        <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Support</p>
        <a href="#" @click.prevent="$dispatch('open-help')" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Assistance
        </a>
    </div>
</nav>
