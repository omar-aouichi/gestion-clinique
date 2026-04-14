<div class="flex flex-col h-full">
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">System Admin</p>

        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'text-white bg-primary-600 shadow-xl shadow-primary-200' : 'text-slate-500 hover:text-primary-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Access Management
        </a>

        <a href="{{ route('admin.logs.index') }}" 
           class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs('admin.logs.*') ? 'text-white bg-primary-600 shadow-xl shadow-primary-200' : 'text-slate-500 hover:text-primary-600 hover:bg-slate-50' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            System Activity
        </a>

        @include('partials.employe-link')

        <div class="pt-4 mt-4 border-t border-slate-100">
            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Maintenance</p>
            <form action="{{ route('admin.backup.run') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-500 hover:text-primary-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    Database Backup
                </button>
            </form>
        </div>
    </nav>

    <!-- Sidebar Footer Profile -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-xs">SA</div>
            <div class="flex-1 overflow-hidden">
                <p class="text-[11px] font-black text-slate-800 truncate">Super Admin</p>
                <p class="text-[9px] text-slate-400 font-bold truncate">IT Department</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </div>
</div>
