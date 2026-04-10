<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DocDialy - Premium Healthcare</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif']
                    },
                    colors: {
                        primary: { 50: '#f0f9ff', 100: '#e0f2fe', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1', 900: '#0c4a6e' },
                        teal: { 50: '#f0fdfa', 500: '#14b8a6', 600: '#0d9488' }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased text-slate-800 font-sans selection:bg-primary-500 selection:text-white">
    
    <!-- Navbar -->
    <header class="fixed top-0 w-full bg-white/80 backdrop-blur-xl border-b border-white/20 z-50 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-2 text-primary-600 hover:scale-105 transition-transform">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-2xl font-display font-bold tracking-tight">DocDialy</span>
            </a>
            
            <!-- Navigation Links pointing to active sections -->
            <nav class="hidden md:flex gap-8 font-medium text-slate-600 text-sm">
                <a href="#services" class="hover:text-primary-600 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300 transition-colors py-1">Our Services</a>
                <a href="#specialists" class="hover:text-primary-600 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300 transition-colors py-1">Specialists</a>
                <a href="#about" class="hover:text-primary-600 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300 transition-colors py-1">About the Clinic</a>
                <a href="#contact" class="hover:text-primary-600 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300 transition-colors py-1">Contact</a>
            </nav>
            
            <div class="flex items-center gap-3">
                <a href="/login" class="px-5 py-2.5 text-sm font-semibold text-slate-700 hover:text-primary-600 bg-slate-50 hover:bg-primary-50 rounded-lg transition-all border border-slate-200 hover:border-primary-200">
                    Log In
                </a>
                <a href="/signup" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-500 rounded-lg shadow-lg shadow-primary-500/30 hover:shadow-primary-500/50 hover:-translate-y-0.5 transition-all">
                    Sign Up
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-50">
        <!-- Animated Background Blobs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-sky-300 rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
            <div>
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-md text-teal-700 text-xs font-bold uppercase tracking-wider mb-8 border border-white shadow-sm">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                    </span>
                    Your Health First
                </span>
                <h1 class="text-5xl lg:text-7xl font-display font-extrabold text-slate-900 leading-[1.1]">
                    The Future of <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-teal-500">Digital Health</span>
                </h1>
                <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-lg mb-10">
                    Experience healthcare reimagined. Book expert consultations, access secure medical records, and monitor your wellness seamlessly through our premier platform.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/signup" class="px-8 py-4 text-base font-bold text-white bg-slate-900 hover:bg-primary-600 rounded-full shadow-xl hover:shadow-primary-500/25 hover:-translate-y-1 transition-all">
                        Join as a Patient
                    </a>
                    <a href="#services" class="px-8 py-4 text-base font-bold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-full shadow-sm hover:shadow-md transition-all flex items-center gap-2">
                        Explore Features <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
                
                <div class="mt-12 flex items-center gap-4 text-sm font-medium text-slate-500">
                    <div class="flex -space-x-2">
                        <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://ui-avatars.com/api/?name=Ali&background=random" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://ui-avatars.com/api/?name=Sara&background=random" alt="User">
                        <img class="w-8 h-8 rounded-full border-2 border-white object-cover" src="https://ui-avatars.com/api/?name=Omar&background=random" alt="User">
                        <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">+2k</div>
                    </div>
                    <p>Trusted by thousand of patients daily.</p>
                </div>
            </div>
            
            <!-- Graphic Presentation -->
            <div class="relative animate-float lg:ml-10">
                <div class="relative bg-white/80 backdrop-blur-2xl border border-white/50 shadow-2xl shadow-primary-900/10 rounded-3xl p-8 transform rotate-1">
                    
                    <!-- Floating Badge Top Left -->
                    <div class="absolute -top-8 -left-8 bg-white p-4 rounded-2xl shadow-xl border border-slate-100/50 flex items-center gap-4 transform -rotate-6 transition-transform hover:rotate-0 hover:scale-105 duration-300 z-20">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-500 rounded-xl flex items-center justify-center text-white shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">Lab Results Ready</p>
                            <p class="text-xs text-slate-500 font-medium">All markers Normal</p>
                        </div>
                    </div>

                    <!-- Floating Badge Bottom Right -->
                    <div class="absolute -bottom-6 -right-6 bg-slate-900 text-white p-4 rounded-2xl shadow-xl flex items-center gap-3 transform rotate-3 transition-transform hover:rotate-0 hover:scale-105 duration-300 z-20">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex flex-col items-center justify-center">
                            <span class="text-sm font-bold leading-none">24</span>
                        </div>
                        <div>
                            <p class="text-sm font-bold">Upcoming Surgery</p>
                            <p class="text-xs text-slate-400">Dr. Smith • Room 402</p>
                        </div>
                    </div>

                    <!-- Main Card content -->
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-display font-bold text-slate-800">Your Health Overview</h3>
                            <p class="text-sm text-slate-500">Live dashboard synchronization</p>
                        </div>
                        <div class="w-10 h-10 bg-primary-50 rounded-full flex items-center justify-center text-primary-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="group flex items-center gap-4 p-4 hover:bg-slate-50 rounded-2xl border border-slate-100 transition-colors">
                            <img src="https://ui-avatars.com/api/?name=Doc+Bennani&background=0ea5e9&color=fff" class="w-12 h-12 rounded-xl object-cover shadow-sm group-hover:scale-110 transition-transform">
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900">Dr. Ahmed Bennani</h4>
                                <p class="text-xs text-slate-500">General Consultation</p>
                            </div>
                            <span class="bg-primary-50 text-primary-700 px-3 py-1 text-xs font-bold rounded-lg border border-primary-100">Confirmed</span>
                        </div>
                        
                        <div class="group flex items-center gap-4 p-4 hover:bg-slate-50 rounded-2xl border border-slate-100 transition-colors">
                            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-500 shadow-sm group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-900">Echography Session</h4>
                                <p class="text-xs text-slate-500">Imaging Department</p>
                            </div>
                            <span class="bg-amber-50 text-amber-700 px-3 py-1 text-xs font-bold rounded-lg border border-amber-100">Pending</span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- 1. Our Services Section -->
    <section id="services" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Capabilities</span>
                <h2 class="text-4xl font-display font-bold text-slate-900 mt-2">Comprehensive Features</h2>
                <p class="mt-4 text-slate-600">State-of-the-art technological integrations allowing instant communication across medical departments.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-primary-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-primary-600 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Smart Scheduling</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Book appointments with visual planners that verify Simultaneous Availability of doctors, nurses, and required equipment.</p>
                </div>
                <!-- Service 2 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-teal-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-teal-600 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">E-Prescripts</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Instantly receive and track digital prescriptions from your treating doctor, integrated securely into your dashboard.</p>
                </div>
                <!-- Service 3 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-rose-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-rose-500 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Under-X Interventions</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Dedicated emergency protocols for secretaries to bypass standard bookings to save lives when seconds matter most.</p>
                </div>
                <!-- Service 4 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-indigo-500 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Laboratory & Imaging</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">All blood tests, MRIs, and X-Rays are directly uploaded to your portal the moment the results are finalized by our lab technicians.</p>
                </div>
                <!-- Service 5 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-amber-500 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Family Account Links</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Manage your children's or elderly parents' medical records from a single master account using our advanced relation mapping.</p>
                </div>
                <!-- Service 6 -->
                <div class="p-8 rounded-3xl bg-slate-50 border border-slate-100 hover:-translate-y-2 hover:shadow-2xl hover:shadow-fuchsia-100 transition-all duration-300">
                    <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-fuchsia-500 mb-6 border border-slate-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Telehealth Consults</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Schedule secure video calls with your specialists for follow-ups without leaving the comfort of your living room.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Specialists Section -->
    <section id="specialists" class="py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
                <div class="max-w-2xl">
                    <span class="text-primary-400 font-bold tracking-wider uppercase text-sm">Our Elite Team</span>
                    <h2 class="text-4xl font-display font-bold mt-2">World-Class Specialists</h2>
                    <p class="mt-4 text-slate-400 text-lg">Compassionate care led by experts. Our clinical team represents the top tier of medical academia and practical excellence.</p>
                </div>
                <a href="/login" class="px-6 py-3 border border-slate-700 hover:border-primary-500 hover:bg-primary-500 text-white rounded-full transition-all whitespace-nowrap self-start md:self-auto font-medium">
                    View Full Directory
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Doctor 1 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-primary-500/20 backdrop-blur-md text-primary-200 border border-primary-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Cardiology</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Sarah Smith</h4>
                        <p class="text-sm text-slate-300 mt-1">Chief of Cardiology</p>
                    </div>
                </div>
                <!-- Doctor 2 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-teal-500/20 backdrop-blur-md text-teal-200 border border-teal-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Pediatrics</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Ahmed Bennani</h4>
                        <p class="text-sm text-slate-300 mt-1">Senior Pediatrician</p>
                    </div>
                </div>
                <!-- Doctor 3 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1594824436998-d88d9def225d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700 text-top" style="object-position: top;">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-rose-500/20 backdrop-blur-md text-rose-200 border border-rose-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Trauma / OR</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Karim Fassi</h4>
                        <p class="text-sm text-slate-300 mt-1">Lead Surgeon</p>
                    </div>
                </div>
                 <!-- Doctor 4 -->
                 <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-indigo-500/20 backdrop-blur-md text-indigo-200 border border-indigo-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Neurology</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Leila Tazi</h4>
                        <p class="text-sm text-slate-300 mt-1">Neurology Expert</p>
                    </div>
                </div>
                <!-- Doctor 5 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1527613426441-4da17471b66d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-amber-500/20 backdrop-blur-md text-amber-200 border border-amber-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Orthopedics</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Youssef Alami</h4>
                        <p class="text-sm text-slate-300 mt-1">Orthopedic Surgeon</p>
                    </div>
                </div>
                <!-- Doctor 6 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1651008376811-b90baee60c1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700 text-top" style="object-position: top;">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-fuchsia-500/20 backdrop-blur-md text-fuchsia-200 border border-fuchsia-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Dermatology</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Sofia Mansouri</h4>
                        <p class="text-sm text-slate-300 mt-1">Cosmetic & Medical</p>
                    </div>
                </div>
                <!-- Doctor 7 -->
                <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-sky-500/20 backdrop-blur-md text-sky-200 border border-sky-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Oncology</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Hassan Zaki</h4>
                        <p class="text-sm text-slate-300 mt-1">Head of Oncology</p>
                    </div>
                </div>
                 <!-- Doctor 8 -->
                 <div class="group relative overflow-hidden rounded-3xl cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent z-10"></div>
                    <img src="https://images.unsplash.com/photo-1594824436998-d88d9def225d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Doctor" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700" style="object-position: right;">
                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full transform group-hover:-translate-y-2 transition-transform">
                        <span class="bg-emerald-500/20 backdrop-blur-md text-emerald-200 border border-emerald-500/30 text-[10px] uppercase font-bold tracking-wider px-2 py-1 rounded inline-block mb-2">Psychiatry</span>
                        <h4 class="text-xl font-bold text-white leading-tight">Dr. Amina Chakir</h4>
                        <p class="text-sm text-slate-300 mt-1">Clinical Psychiatrist</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. About the Clinic Section -->
    <section id="about" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Data / Stats -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center transform translate-y-8">
                        <span class="text-4xl font-display font-black text-primary-600 mb-2">24/7</span>
                        <span class="text-sm font-semibold text-slate-600">Emergency Care</span>
                    </div>
                    <div class="bg-primary-600 p-6 rounded-3xl shadow-xl shadow-primary-600/20 flex flex-col justify-center items-center text-center text-white">
                        <span class="text-4xl font-display font-black mb-2">140+</span>
                        <span class="text-sm font-medium text-primary-100">Medical Specialists</span>
                    </div>
                    <div class="bg-slate-900 p-6 rounded-3xl shadow-xl flex flex-col justify-center items-center text-center text-white transform translate-y-8">
                        <span class="text-4xl font-display font-black mb-2">12k+</span>
                        <span class="text-sm font-medium text-slate-400">Patients Cured</span>
                    </div>
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex flex-col justify-center items-center text-center">
                        <span class="text-4xl font-display font-black text-teal-500 mb-2">15</span>
                        <span class="text-sm font-semibold text-slate-600">Operating Rooms</span>
                    </div>
                </div>
                
                <!-- Text Content -->
                <div>
                    <span class="text-teal-600 font-bold tracking-wider uppercase text-sm">About DocDialy</span>
                    <h2 class="text-4xl font-display font-bold text-slate-900 mt-2 mb-6">Excellence in Healthcare, Enabled by Technology.</h2>
                    <p class="text-lg text-slate-600 mb-6 leading-relaxed">
                        DocDialy isn't just a clinic; it's a completely connected healthcare establishment. Our unique internal software seamlessly links our HR managers, Secretaries, Doctors, and Patients into one continuous loop of care.
                    </p>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3 text-slate-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center">✓</div>
                            Paperless digital health records
                        </li>
                        <li class="flex items-center gap-3 text-slate-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center">✓</div>
                            Real-time resource and room bookings
                        </li>
                        <li class="flex items-center gap-3 text-slate-700 font-medium">
                            <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center">✓</div>
                            Instant laboratory result distributions
                        </li>
                    </ul>
                    <a href="/login" class="inline-flex items-center gap-2 group text-primary-600 font-bold hover:text-primary-800 transition-colors">
                        Learn more about our technology 
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Patient Testimonials Section -->
    <section class="py-24 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-primary-600 font-bold tracking-wider uppercase text-sm">Patient Voices</span>
                <h2 class="text-4xl font-display font-bold text-slate-900 mt-2">Millions of Lives Improved</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 relative">
                    <div class="text-amber-400 flex gap-1 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current text-amber-200" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-700 italic mb-6">"The ability to see my operation scheduled instantly on my portal, with the names of the surgeon and nurses assigned, removed all my pre-surgery anxiety. DocDialy is phenomenal."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Khadija+M&background=random" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Khadija M.</h4>
                            <p class="text-xs text-slate-500">Recovering Patient</p>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="bg-white p-8 rounded-3xl border border-primary-100 shadow-xl shadow-primary-100/50 relative transform md:-translate-y-4">
                    <div class="text-amber-400 flex gap-1 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M..."></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-700 italic mb-6">"I manage my parents' health profiles using the connected accounts feature. I get notifications when their prescriptions are ready or if Dr. Bennani changes their dosage. Highly secure and life-saving."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Tarik+B&background=random" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Tarik B.</h4>
                            <p class="text-xs text-slate-500">Family Caretaker</p>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100 relative">
                    <div class="text-amber-400 flex gap-1 mb-4">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M..."></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-700 italic mb-6">"Having all my lab tests integrated into one dashboard as soon as the technician approves them completely eliminates the unnecessary visits just to 'pick up results'. Very modern clinic."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Laila+N&background=random" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Laila N.</h4>
                            <p class="text-xs text-slate-500">Regular Patient</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Contact / Call to Action Section -->
    <section id="contact" class="py-24 bg-primary-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 text-white">
            <h2 class="text-4xl md:text-5xl font-display font-bold mb-6">Ready to take control of your health?</h2>
            <p class="text-lg text-primary-100 mb-10 max-w-2xl mx-auto">
                Sign up today and get immediate access to top doctors, transparent scheduling, and an interface that puts your wellbeing right at your fingertips.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/signup" class="px-8 py-4 text-lg font-bold text-primary-700 bg-white hover:bg-slate-50 rounded-full shadow-xl hover:shadow-cyan-500/20 hover:-translate-y-1 transition-all">
                    Create Your Account
                </a>
                <a href="tel:+212500000000" class="px-8 py-4 text-lg font-bold text-white bg-primary-700 hover:bg-primary-800 border border-primary-500 rounded-full transition-all flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Call Emergency
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-16 pb-8 border-t border-slate-800 text-slate-400">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-2 text-white mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-2xl font-display font-bold tracking-tight">DocDialy</span>
                </div>
                <p class="max-w-sm text-sm leading-relaxed">
                    A unified digital healthcare establishment meant to completely reimagine the relationship between patient, doctor, and administration.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#services" class="hover:text-primary-400 transition-colors">Our Services</a></li>
                    <li><a href="#specialists" class="hover:text-primary-400 transition-colors">Specialists</a></li>
                    <li><a href="#about" class="hover:text-primary-400 transition-colors">About Us</a></li>
                    <li><a href="/login" class="hover:text-primary-400 transition-colors">Patient Login</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 text-center text-sm border-t border-slate-800 pt-8">
            <p>© 2023 DocDialy Connected Healthcare. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
