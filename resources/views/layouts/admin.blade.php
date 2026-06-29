<!DOCTYPE html>
<html lang="id" class="h-full bg-[#fbfaf7]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Learning Studio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="h-full antialiased text-gray-800">

<div class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 flex-shrink-0 flex flex-col bg-[#1a1815] text-gray-300 border-r border-yellow-950/20 overflow-y-auto">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-6 py-6">
            <div class="w-10 h-10 rounded-xl bg-yellow-400 text-[#1a1815] font-black flex items-center justify-center text-base flex-shrink-0 shadow-lg shadow-yellow-400/10">
                SP
            </div>
            <div>
                <p class="font-extrabold text-white text-base leading-tight tracking-wide">Learning Studio</p>
                <p class="text-[10px] text-yellow-400/80 uppercase font-bold tracking-widest mt-0.5">Admin Panel</p>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mx-5 border-t border-white/5 mb-5"></div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 space-y-1.5">
            <p class="px-3.5 text-[10px] font-black uppercase tracking-widest text-yellow-400/50 mb-3">Menu Konten</p>

            <a href="{{ route('learning.materials.index') }}"
               class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-200
                      {{ request()->routeIs('learning.*') ? 'bg-yellow-400 text-yellow-950 font-bold shadow-md shadow-yellow-400/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Materi Learning
            </a>

            <a href="{{ route('admin.packages.index') }}"
               class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-200
                      {{ request()->routeIs('admin.packages.*') ? 'bg-yellow-400 text-yellow-950 font-bold shadow-md shadow-yellow-400/10' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
                Paket Kursus
            </a>
        </nav>

    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="flex-shrink-0 bg-white border-b border-yellow-100 px-8 py-5 flex items-center justify-between shadow-sm shadow-yellow-500/5">
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 tracking-tight">@yield('page_title', 'Dashboard')</h1>
                <p class="text-xs text-gray-400 font-medium mt-0.5">@yield('page_subtitle', '')</p>
            </div>
            <div class="flex items-center gap-3">
                @yield('header_actions')
            </div>
        </header>

        {{-- Scrollable body --}}
        <main class="flex-1 overflow-y-auto p-8 bg-[#fdfcf9]">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
