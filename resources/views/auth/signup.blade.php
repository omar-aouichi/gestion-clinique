<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - DocDialy</title>
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
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-slate-900">Create a Patient Account</h2>
        <p class="mt-2 text-center text-sm text-slate-600">
            Already have an account?
            <a href="/login" class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                Sign in here
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow-xl shadow-slate-200/50 sm:rounded-2xl sm:px-10 border border-slate-100">
            <form class="space-y-6" action="/patient" method="GET">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-slate-700">First Name</label>
                        <div class="mt-1">
                            <input id="first_name" name="first_name" type="text" required class="block w-full appearance-none rounded-lg border border-slate-300 px-3 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="John">
                        </div>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-slate-700">Last Name</label>
                        <div class="mt-1">
                            <input id="last_name" name="last_name" type="text" required class="block w-full appearance-none rounded-lg border border-slate-300 px-3 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="Doe">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="cin" class="block text-sm font-medium text-slate-700">CIN (Identity Card)</label>
                    <div class="mt-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path></svg>
                        <input id="cin" name="cin" type="text" required class="block w-full appearance-none rounded-lg border border-slate-300 px-3 pl-10 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="CD123456">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                    <div class="mt-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <input id="email" name="email" type="email" required autocomplete="email" class="block w-full appearance-none rounded-lg border border-slate-300 px-3 pl-10 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="patient@example.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <div class="mt-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <input id="password" name="password" type="password" required class="block w-full appearance-none rounded-lg border border-slate-300 px-3 pl-10 py-2.5 placeholder-slate-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm transition-colors" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="agree" name="agree" type="checkbox" required class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                    <label for="agree" class="ml-2 block text-sm text-slate-600">
                        I agree to the <a href="#" class="text-primary-600 hover:underline">Terms of Service</a> and <a href="#" class="text-primary-600 hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="flex w-full justify-center rounded-lg border border-transparent bg-primary-600 py-3 px-4 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
