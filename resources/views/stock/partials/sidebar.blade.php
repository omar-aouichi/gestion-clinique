@section('sidebar')
<nav class="flex-1 px-4 py-6 space-y-1">
    <a href="{{ route('stock.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('stock.dashboard') ? 'text-white bg-primary-600 shadow-md shadow-primary-200' : 'text-slate-600 hover:text-primary-600 hover:bg-slate-50' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
        Consulter Stock
    </a>
    
    <a href="{{ route('stock.mouvement') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('stock.mouvement') ? 'text-white bg-primary-600 shadow-md shadow-primary-200' : 'text-slate-600 hover:text-primary-600 hover:bg-slate-50' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        Enregistrer Mouvement
    </a>
    
    <a href="{{ route('stock.administratif.dashboard') }}" 
       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('stock.administratif.*') ? 'text-white bg-primary-600 shadow-md shadow-primary-200' : 'text-slate-600 hover:text-primary-600 hover:bg-slate-50' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        Gestion Administrative
    </a>
    
    @include('partials.employe-link')
</nav>

<div class="p-4 mt-auto border-t border-slate-100">
    <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-2xl">
        <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600 font-bold">
            GS
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-700">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
            <p class="text-xs text-slate-500 capitalize">{{ auth()->user()->role->value }}</p>
        </div>
    </div>
</div>
@endsection
