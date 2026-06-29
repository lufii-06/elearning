@extends('layouts.admin')

@section('title', 'Learning Materials')
@section('page_title', 'Learning Materials')
@section('page_subtitle', 'Kelola video pembelajaran, audio, dokumen PDF, dan materi learning.')

@section('header_actions')
    <a href="{{ route('learning.materials.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Materi
    </a>
@endsection

@section('content')

@if(session('success'))
    <div class="mb-6 flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- Stats strip --}}
<div class="flex gap-3 mb-6 flex-wrap">
    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm">
        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        {{ $materials->count() }} materi
    </div>
    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm">
        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
        </svg>
        {{ $materials->whereNotNull('video')->count() }} video
    </div>
    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm">
        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
        </svg>
        {{ $materials->whereNotNull('audio')->count() }} audio
    </div>
    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm">
        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
        </svg>
        {{ $materials->whereNotNull('pdf')->count() }} PDF
    </div>
    <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm">
        <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        {{ $materials->whereNotNull('learning_guide')->count() }} guide
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-800">Daftar Materi</h2>
            <p class="text-xs text-gray-400 mt-0.5">Terbaru di atas</p>
        </div>
    </div>

    @if($materials->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700">Belum ada materi learning.</p>
            <p class="text-xs text-gray-400 mt-1">Klik "Tambah Materi" untuk mulai menambahkan.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">Materi</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Kategori</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Paket Kursus</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">File Video / Audio</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">File Dokumen</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Dibuat</th>
                        <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($materials as $material)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-green-50 text-green-700 text-xs font-black flex items-center justify-center flex-shrink-0 border border-green-100">
                                    {{ $loop->iteration }}
                                </span>
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $material->title }}</p>
                                    <p class="text-xs text-gray-400 truncate max-w-xs">{{ $material->description ?: '—' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-semibold">
                                {{ $material->kategori }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            @if($material->package)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 text-xs font-semibold">
                                    {{ $material->package->display_name }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 space-y-1">
                            @if($material->video)
                                <div>
                                    <a href="{{ asset('storage/' . $material->video) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                        </svg>
                                        Video
                                    </a>
                                </div>
                            @endif
                            @if($material->audio)
                                <div>
                                    <a href="{{ asset('storage/' . $material->audio) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 hover:bg-emerald-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                        </svg>
                                        Audio
                                    </a>
                                </div>
                            @endif
                            @if(!$material->video && !$material->audio)
                                <span class="text-gray-300 text-xs font-semibold">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 space-y-1">
                            @if($material->pdf)
                                <div>
                                    <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>
                                        PDF
                                    </a>
                                </div>
                            @endif
                            @if($material->learning_guide)
                                <div>
                                    <a href="{{ asset('storage/' . $material->learning_guide) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Guide (PDF)
                                    </a>
                                </div>
                            @endif
                            @if(!$material->pdf && !$material->learning_guide)
                                <span class="text-gray-300 text-xs font-semibold">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-gray-400 text-xs">
                            {{ $material->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('learning.materials.edit', $material->id) }}"
                                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('learning.materials.destroy', $material->id) }}"
                                      method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
