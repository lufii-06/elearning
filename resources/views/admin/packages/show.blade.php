@extends('layouts.admin')

@section('title', 'Detail Paket')
@section('page_title', 'Detail Paket')
@section('page_subtitle', $package->display_name)

@section('header_actions')
    <a href="{{ route('admin.packages.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:border-gray-300 px-4 py-2 rounded-lg shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="space-y-6">

    {{-- Package Overview Card --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden p-6">
        <div class="flex flex-col md:flex-row gap-6 items-start">
            {{-- Thumbnail --}}
            @if($package->thumbnail)
                <img src="{{ Storage::url($package->thumbnail) }}"
                     alt="{{ $package->display_name }}"
                     class="w-32 h-32 md:w-40 md:h-40 rounded-xl object-cover border border-gray-200 shadow-sm flex-shrink-0">
            @else
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-xl bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/>
                    </svg>
                </div>
            @endif

            {{-- Detail --}}
            <div class="flex-1 space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <h2 class="text-2xl font-black text-gray-900 leading-tight">{{ $package->display_name }}</h2>
                    <span class="text-xs text-gray-400 font-medium">({{ $package->name }})</span>
                </div>

                <div class="flex flex-wrap gap-2.5">
                    @if($package->kategori)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">
                            {{ $package->kategori }}
                        </span>
                    @endif
                    @if($package->is_free)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Gratis
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-orange-50 text-orange-700 text-xs font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> {{ $package->formatted_price }}
                        </span>
                    @endif
                </div>

                @if($package->description)
                    <p class="text-sm text-gray-650 font-medium leading-relaxed max-w-2xl">{{ $package->description }}</p>
                @else
                    <p class="text-sm text-gray-400 italic">Tidak ada deskripsi untuk paket ini.</p>
                @endif

                <div class="pt-2 flex gap-2">
                    <a href="{{ route('admin.packages.edit', $package->id) }}"
                       class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 bg-gray-100 hover:bg-gray-250 px-4 py-2 rounded-lg transition-colors border border-gray-200/60 shadow-sm">
                        Edit Paket
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Materials List Table --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-[#fcfcfc]">
            <div>
                <h3 class="text-base font-black text-gray-900">Materi di dalam Paket</h3>
                <p class="text-xs text-gray-400 mt-0.5">{{ $package->materials->count() }} materi terhubung</p>
            </div>
            <a href="{{ route('learning.materials.create', ['package_id' => $package->id]) }}"
               class="inline-flex items-center gap-1 text-xs font-bold text-white bg-green-700 hover:bg-green-800 px-3.5 py-2 rounded-lg transition-colors shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah & Hubungkan Materi
            </a>
        </div>

        @if($package->materials->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="w-12 h-12 rounded-xl bg-gray-55 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-sm font-bold text-gray-700">Belum ada materi di paket ini</p>
                <p class="text-xs text-gray-400 mt-1">Klik tombol di atas untuk membuat materi baru dan menghubungkannya.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">No</th>
                            <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Materi</th>
                            <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Kategori</th>
                            <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Media</th>
                            <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($package->materials as $material)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-500 w-12">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900">{{ $material->title }}</p>
                                    @if($material->description)
                                        <p class="text-xs text-gray-400 truncate max-w-xs mt-0.5">{{ $material->description }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-700 text-xs font-semibold">
                                    {{ $material->kategori }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Video --}}
                                    @if($material->video)
                                        <a href="{{ asset('storage/' . $material->video) }}" target="_blank"
                                           class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-colors shadow-sm"
                                           title="Buka Video">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="w-8 h-8 rounded-lg bg-gray-50 text-gray-300 border border-gray-100/80 flex items-center justify-center cursor-not-allowed"
                                              title="Video Tidak Tersedia">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                            </svg>
                                        </span>
                                    @endif

                                    {{-- Audio --}}
                                    @if($material->audio)
                                        <a href="{{ asset('storage/' . $material->audio) }}" target="_blank"
                                           class="w-8 h-8 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center transition-colors shadow-sm"
                                           title="Buka Audio">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="w-8 h-8 rounded-lg bg-gray-50 text-gray-300 border border-gray-100/80 flex items-center justify-center cursor-not-allowed"
                                              title="Audio Tidak Tersedia">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                            </svg>
                                        </span>
                                    @endif

                                    {{-- PDF --}}
                                    @if($material->pdf)
                                        <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank"
                                           class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition-colors shadow-sm"
                                           title="Buka PDF Bacaan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="w-8 h-8 rounded-lg bg-gray-50 text-gray-300 border border-gray-100/80 flex items-center justify-center cursor-not-allowed"
                                              title="PDF Tidak Tersedia">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                            </svg>
                                        </span>
                                    @endif

                                    {{-- Learning Guide --}}
                                    @if($material->learning_guide)
                                        <a href="{{ asset('storage/' . $material->learning_guide) }}" target="_blank"
                                           class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 hover:bg-purple-100 flex items-center justify-center transition-colors shadow-sm"
                                           title="Buka Learning Guide (PDF)">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="w-8 h-8 rounded-lg bg-gray-50 text-gray-300 border border-gray-100/80 flex items-center justify-center cursor-not-allowed"
                                              title="Learning Guide Tidak Tersedia">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('learning.materials.edit', $material->id) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-gray-750 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
@endsection
