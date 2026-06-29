@extends('layouts.admin')

@section('title', 'Detail Paket')
@section('page_title', 'Detail Paket')
@section('page_subtitle', 'Melihat detail paket kursus dan daftar materi pembelajaran di dalamnya.')

@section('header_actions')
    <a href="{{ route('admin.packages.index') }}"
       class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-extrabold px-4 py-2.5 rounded-xl transition-all duration-200 shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')

@if(session('success'))
    <div class="mb-6 flex items-start gap-3 bg-yellow-50 border border-yellow-200 text-yellow-900 rounded-xl px-4 py-3.5 text-sm font-medium">
        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- Package Details Header Card --}}
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden p-6 mb-8">
    <div class="flex flex-col lg:flex-row gap-6">
        @if($package->thumbnail)
            <img src="{{ Storage::url($package->thumbnail) }}"
                 alt="{{ $package->display_name }}"
                 class="w-full lg:w-48 h-48 lg:h-32 object-cover rounded-xl border border-yellow-100/60 shadow-sm">
        @else
            <div class="w-full lg:w-48 h-48 lg:h-32 rounded-xl bg-yellow-50 border border-yellow-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/>
                </svg>
            </div>
        @endif

        <div class="flex-1">
            <div class="flex flex-wrap items-center gap-2 mb-2">
                @if($package->kategori)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-yellow-100 text-yellow-900 text-xs font-semibold">
                        {{ $package->kategori }}
                    </span>
                @endif
                @if($package->is_free)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-extrabold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Gratis
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-extrabold">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Berbayar
                    </span>
                @endif
            </div>

            <h1 class="text-xl font-extrabold text-gray-900 leading-tight mb-1">{{ $package->display_name }}</h1>
            <p class="text-sm text-gray-400 mb-3">{{ $package->name }}</p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-3 border-t border-b border-yellow-50 my-4">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Harga</p>
                    <p class="text-sm font-extrabold text-gray-800 mt-0.5">{{ $package->formatted_price }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold">Total Materi</p>
                    <p class="text-sm font-extrabold text-gray-800 mt-0.5">{{ $package->materials->count() }} materi</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold font-semibold">Dibuat Pada</p>
                    <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $package->created_at ? $package->created_at->format('d M Y') : '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-semibold font-semibold">Terakhir Diupdate</p>
                    <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $package->updated_at ? $package->updated_at->format('d M Y') : '—' }}</p>
                </div>
            </div>

            <div class="mt-3">
                <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Deskripsi Paket</p>
                <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ $package->description ?: 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-6 py-4 border-b border-yellow-50 gap-4">
        <div>
            <h2 class="text-base font-extrabold text-gray-900 tracking-tight">Materi di dalam Paket</h2>
            <p class="text-xs text-gray-400 mt-0.5">Daftar materi pembelajaran yang terhubung dengan paket ini</p>
        </div>
        <a href="{{ route('learning.materials.create', ['package_id' => $package->id]) }}"
           class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-xs font-extrabold px-3 py-2 rounded-xl transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Materi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-yellow-50 bg-[#faf9f6]">
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Materi</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Kategori</th>
                    <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Media Interaktif</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Dibuat</th>
                    <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-50">
                @forelse($package->materials ?? [] as $material)
                <tr class="hover:bg-yellow-50/20 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-yellow-100 text-yellow-950 text-xs font-extrabold flex items-center justify-center flex-shrink-0">
                                {{ $loop->iteration }}
                            </span>
                            <div class="min-w-0">
                                <p class="font-bold text-gray-900 truncate">{{ $material->title }}</p>
                                <p class="text-xs text-gray-400 truncate max-w-xs">{{ $material->description ?: '—' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-yellow-100 text-yellow-900 text-xs font-semibold">
                            {{ $material->kategori }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <div class="inline-flex items-center gap-1.5 justify-center">
                            {{-- Video Button --}}
                            @if($material->video)
                                <a href="{{ asset('storage/' . $material->video) }}" target="_blank" title="Buka Video"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                    </svg>
                                </a>
                            @else
                                <span class="inline-block" title="Video tidak tersedia">
                                    <button type="button" disabled
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                        </svg>
                                    </button>
                                </span>
                            @endif

                            {{-- Audio Button --}}
                            @if($material->audio)
                                <a href="{{ asset('storage/' . $material->audio) }}" target="_blank" title="Buka Audio"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                    </svg>
                                </a>
                            @else
                                <span class="inline-block" title="Audio tidak tersedia">
                                    <button type="button" disabled
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                        </svg>
                                    </button>
                                </span>
                            @endif

                            {{-- PDF Button --}}
                            @if($material->pdf)
                                <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank" title="Buka PDF"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                </a>
                            @else
                                <span class="inline-block" title="PDF tidak tersedia">
                                    <button type="button" disabled
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>
                                    </button>
                                </span>
                            @endif

                            {{-- Guide Button --}}
                            @if($material->learning_guide)
                                <a href="{{ asset('storage/' . $material->learning_guide) }}" target="_blank" title="Buka Guide"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </a>
                            @else
                                <span class="inline-block" title="Guide tidak tersedia">
                                    <button type="button" disabled
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-4 text-gray-400 text-xs font-medium">
                        {{ $material->created_at ? $material->created_at->format('d M Y') : '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('learning.materials.edit', $material->id) }}"
                               class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('learning.materials.destroy', $material->id) }}"
                                  method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-red-700 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-yellow-50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-gray-800">Belum ada materi untuk paket ini</p>
                            <p class="text-xs text-gray-400 mt-1">Klik tombol "Tambah Materi" di atas untuk menambahkan materi pertama</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
