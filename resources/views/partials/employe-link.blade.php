@unless(request()->routeIs('dg.*'))
<div class="pt-4 border-t border-slate-100">
    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Personnel</p>
    <a href="{{ route('employe.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-bold {{ request()->routeIs('employe.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-slate-500 hover:bg-slate-50 hover:text-primary-600' }} rounded-xl transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        Mon Espace (Employé)
    </a>
</div>
@endunless
