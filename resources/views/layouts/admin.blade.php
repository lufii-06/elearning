<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Learning Studio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

<div class="flex h-screen overflow-hidden">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 flex-shrink-0 flex flex-col bg-[#0f2f24] text-white overflow-y-auto">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-5 py-6">
            <div class="w-10 h-10 rounded-lg bg-amber-400 text-[#0f2f24] font-black flex items-center justify-center text-sm flex-shrink-0">
                SP
            </div>
            <div>
                <p class="font-black text-base leading-tight">Learning Studio</p>
                <p class="text-[11px] text-green-300 leading-tight mt-0.5">Admin Panel</p>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mx-4 border-t border-white/10 mb-4"></div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 space-y-1">
            <p class="px-3 text-[10px] font-black uppercase tracking-widest text-green-400/70 mb-2">Konten</p>

            <a href="{{ route('learning.materials.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors
                      {{ request()->routeIs('learning.*') ? 'bg-white/20 text-white' : 'text-green-100 hover:bg-white/10' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Materi Learning
            </a>

            <a href="{{ route('admin.packages.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-semibold transition-colors
                      {{ request()->routeIs('admin.packages.*') ? 'bg-white/20 text-white' : 'text-green-100 hover:bg-white/10' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
                Paket Kursus
            </a>
        </nav>

        {{-- Footer note --}}
        <div class="mx-3 mb-5 mt-4 rounded-lg border border-white/10 bg-white/5 p-3 text-[12px] text-green-200 leading-relaxed">
            Kelola paket kursus dan materi pembelajaran dari satu panel.
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Topbar --}}
        <header class="flex-shrink-0 bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-xl font-black text-gray-900">@yield('page_title', 'Dashboard')</h1>
                <p class="text-sm text-gray-500 mt-0.5">@yield('page_subtitle', '')</p>
            </div>
            <div class="flex items-center gap-3">
                @yield('header_actions')
            </div>
        </header>

        {{-- Scrollable body --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
