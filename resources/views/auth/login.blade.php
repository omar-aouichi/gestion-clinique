<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In - DocDialy</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#f0f9ff', 100: '#e0f2fe', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1', 900: '#0c4a6e' }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased text-slate-800 font-sans h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/" class="flex items-center justify-center gap-2 text-primary-600 mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            <span class="text-3xl font-bold tracking-tight">DocDialy</span>
        </a>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-slate-900">Sign in to your account</h2>
        <p class="mt-2 text-center text-sm text-slate-600">
            Or
            <a href="/signup" class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                create a new patient account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl shadow-slate-200/50 sm:rounded-2xl sm:px-10 border border-slate-100">
            <form class="space-y-6" action="/patient" method="GET">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email address or Patient ID</label>
                    <div class="mt-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <input id="email" name="email" type="email" required autocomplete="email" class="block w-full appearance-none rounded-lg border border-slate-300 px-3 pl-10 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="patient@example.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <input id="password" name="password" type="password" required autocomplete="current-password" class="block w-full appearance-none rounded-lg border border-slate-300 px-3 pl-10 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                        <label for="remember-me" class="ml-2 block text-sm text-slate-900">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Forgot your password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-lg border border-transparent bg-primary-600 py-2.5 px-4 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
                        Sign in
                    </button>
                </div>
            </form>
            
            <!-- Quick Demo Login Buttons for Frontend Mocking -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-2 text-slate-500 uppercase tracking-widest text-xs font-bold">Demo Logins (Frontend Only)</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="/secretary" class="inline-flex w-full justify-center rounded-md border border-slate-300 bg-white py-2 px-4 text-sm font-medium text-slate-500 shadow-sm hover:bg-slate-50">
                        <span class="sr-only">Secretary</span>
                        Secretary
                    </a>
                    <a href="/staff" class="inline-flex w-full justify-center rounded-md border border-slate-300 bg-white py-2 px-4 text-sm font-medium text-slate-500 shadow-sm hover:bg-slate-50">
                        <span class="sr-only">Doctor</span>
                        Doctor
                    </a>
                </div>
                <div class="mt-3 grid grid-cols-2 gap-3">
                    <a href="/hr" class="inline-flex w-full justify-center rounded-md border border-slate-300 bg-white py-2 px-4 text-sm font-medium text-slate-500 shadow-sm hover:bg-slate-50">
                        <span class="sr-only">HR</span>
                        HR
                    </a>
                    <a href="/admin" class="inline-flex w-full justify-center rounded-md border border-slate-300 bg-white py-2 px-4 text-sm font-medium text-slate-500 shadow-sm hover:bg-slate-50">
                        <span class="sr-only">Admin</span>
                        Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
