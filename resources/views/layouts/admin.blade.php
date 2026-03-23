<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      class="h-full"
      x-data="{
        darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        sidebarOpen: false,
        sidebarCollapsed: false
      }"
      x-bind:class="{ 'dark': darkMode }"
      @keydown.escape.window="sidebarOpen = false">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FREE_CRM_LARA') }} — @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.8/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }

        :root {
            --accent-primary: #3b82f6;
            --accent-secondary: #6366f1;
            --sidebar-bg: #ffffff;
            --main-bg: #f8fafc;
            --card-border: rgba(0, 0, 0, 0.05);
        }

        .dark {
            --sidebar-bg: #09090b; /* Deep Zinc 950 */
            --main-bg: #020617;    /* Slate 950 */
            --card-border: rgba(255, 255, 255, 0.06);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
        }

        .dark .glass-panel {
            background: rgba(18, 18, 23, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-gradient-active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(99, 102, 241, 0.1) 100%);
            border-right: 3px solid var(--accent-primary);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
    </style>
</head>
<body class="h-full bg-[--main-bg] text-slate-900 dark:text-slate-100 antialiased transition-colors duration-300">

    <div class="fixed top-0 left-0 -z-10 h-full w-full overflow-hidden opacity-20 dark:opacity-10 pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] h-[40%] w-[40%] rounded-full bg-blue-500 blur-[120px]"></div>
        <div class="absolute top-[60%] -right-[5%] h-[30%] w-[30%] rounded-full bg-indigo-600 blur-[100px]"></div>
    </div>

    <div class="flex h-screen overflow-hidden p-0 lg:p-4 gap-4">

        <aside x-cloak
               x-show="sidebarOpen || window.innerWidth >= 1024"
               :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-72'"
               class="fixed inset-y-0 left-0 z-50 w-72 glass-panel lg:relative lg:rounded-3xl shadow-2xl lg:shadow-xl transform transition-all duration-300 lg:translate-x-0">

            <div class="flex items-center justify-between h-20 px-6">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="min-w-[40px] h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <i class="fa-solid fa-bolt-lightning text-lg"></i>
                    </div>
                    <span x-show="!sidebarCollapsed" class="text-xl font-bold tracking-tight bg-gradient-to-r from-slate-900 to-slate-600 dark:from-white dark:to-slate-400 bg-clip-text text-transparent whitespace-nowrap">
                        FREE_CRM_LARA
                    </span>
                </div>
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:flex text-slate-400 hover:text-blue-500 transition-colors">
                    <i class="fa-solid" :class="sidebarCollapsed ? 'fa-indent' : 'fa-outdent'"></i>
                </button>
            </div>

<nav class="px-3 py-4 space-y-2 overflow-y-auto h-[calc(100vh-14rem)]">
    @php
        $links = [
            [
                'route'  => 'dashboard',
                'icon'   => 'fa-grid-2',
                'label'  => 'Dashboard',
                'active' => 'dashboard' // Only active on the exact dashboard
            ],
            [
                'route'  => 'admin.customers.index',
                'icon'   => 'fa-user-group',
                'label'  => 'Customers',
                'active' => 'admin.customers*' // Active for index, create, edit, show
            ],
            [
                'route'  => 'admin.leads.index',
                'icon'   => 'fa-rocket',
                'label'  => 'Leads',
                'active' => 'admin.leads*'
            ],
            [
                'route'  => 'admin.tasks.index',
                'icon'   => 'fa-circle-check',
                'label'  => 'Tasks',
                'active' => 'admin.tasks*'
            ],
        ];
    @endphp

    @foreach($links as $link)
        @php
            // The magic happens here: routeIs() handles the wildcards perfectly
            $isActive = request()->routeIs($link['active']);
        @endphp

        <a href="{{ route($link['route']) }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 hover:scale-[1.02]
           {{ $isActive
                ? 'nav-gradient-active text-blue-600 dark:text-blue-400 font-semibold shadow-sm bg-blue-50/50 dark:bg-blue-500/5'
                : 'text-slate-500 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-white'
           }}">

            <i class="fa-solid {{ $link['icon'] }} w-6 text-center text-lg transition-transform group-hover:rotate-12 {{ $isActive ? 'text-blue-600' : '' }}"></i>

            <span x-show="!sidebarCollapsed" class="text-sm tracking-wide">
                {{ $link['label'] }}
            </span>
        </a>
    @endforeach
</nav>
            <div class="absolute bottom-4 inset-x-4 px-2">
                <div x-show="!sidebarCollapsed" class="mb-4 p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 text-xs font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                          <a href="/profile" class="">  <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p></a>
                            <p class="text-[10px] text-slate-400 uppercase tracking-tighter">Pro Plan</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center lg:justify-start gap-3 px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-all">
                        <i class="fa-solid fa-arrow-right-from-bracket w-6"></i>
                        <span x-show="!sidebarCollapsed" class="text-sm font-medium">Log out</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-h-screen overflow-hidden">

            <header class="h-20 flex items-center justify-between px-6 lg:px-8">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-500">
                        <i class="fa-solid fa-bars-staggered text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800 dark:text-white">@yield('title', 'Overview')</h1>
                        <p class="text-xs text-slate-400 hidden md:block">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden md:flex items-center px-4 py-2 bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl focus-within:ring-2 ring-blue-500/20 transition-all">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm"></i>
                        <input type="text" placeholder="Search anything..." class="bg-transparent border-none focus:ring-0 text-sm ml-2 w-48">
                    </div>

                    <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                            class="w-10 h-10 rounded-xl glass-panel flex items-center justify-center hover:scale-110 transition-all">
                        <i x-show="!darkMode" class="fa-solid fa-moon text-blue-600"></i>
                        <i x-show="darkMode" class="fa-solid fa-sun text-amber-400"></i>
                    </button>

                    <button class="relative w-10 h-10 rounded-xl glass-panel flex items-center justify-center hover:scale-110 transition-all">
                        <i class="fa-solid fa-bell text-slate-500"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-[--main-bg]"></span>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto px-6 lg:px-8 pb-12">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center gap-3 animate-in slide-in-from-top duration-300">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="animate-in fade-in zoom-in-95 duration-500">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
