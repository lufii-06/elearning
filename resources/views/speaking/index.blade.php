@extends('layouts.admin')

@section('title', 'Speaking Materials')
@section('page_title', 'Speaking Materials')
@section('page_subtitle', 'Kelola video pembelajaran, dokumen PDF, dan materi speaking.')

@section('header_actions')
    <a href="{{ route('speaking.materials.create') }}"
       class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-sm font-extrabold px-4 py-2.5 rounded-xl transition-all duration-200 shadow-sm shadow-yellow-400/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Materi
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

{{-- Stats Strip --}}
<div class="flex gap-3 mb-6 flex-wrap">
    <div class="flex items-center gap-2 bg-white border border-yellow-100 rounded-xl px-4 py-2.5 text-xs font-bold text-gray-600 shadow-sm">
        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        {{ $materials->count() }} MATERI SPEAKING
    </div>
    <div class="flex items-center gap-2 bg-white border border-yellow-100 rounded-xl px-4 py-2.5 text-xs font-bold text-gray-600 shadow-sm">
        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/>
        </svg>
        {{ $materials->whereNotNull('video')->count() }} VIDEO
    </div>
    <div class="flex items-center gap-2 bg-white border border-yellow-100 rounded-xl px-4 py-2.5 text-xs font-bold text-gray-600 shadow-sm">
        <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
        </svg>
        {{ $materials->whereNotNull('pdf')->count() }} PDF
    </div>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-yellow-50">
        <div>
            <h2 class="text-base font-extrabold text-gray-900 tracking-tight">Daftar Materi</h2>
            <p class="text-xs text-gray-400 mt-0.5">Semua data materi speaking tersusun di bawah</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-yellow-50 bg-[#faf9f6]">
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Materi</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Deskripsi</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Video</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Dokumen PDF</th>
                    <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Dibuat</th>
                    <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-50">
                @forelse($materials ?? [] as $material)
                <tr class="hover:bg-yellow-50/20 transition-colors duration-150">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-yellow-100 text-yellow-950 text-xs font-extrabold flex items-center justify-center flex-shrink-0">
                                {{ $loop->iteration }}
                            </span>
                            <p class="font-bold text-gray-900">{{ $material->title }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-4 max-w-xs truncate text-gray-600 font-medium">
                        {{ $material->description ?: '—' }}
                    </td>
                    <td class="px-4 py-4">
                        @if($material->video)
                            <a href="{{ asset('storage/' . $material->video) }}" target="_blank"
                               class="inline-flex items-center gap-1 text-[11px] font-bold text-blue-600 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                                </svg>
                                Video
                            </a>
                        @else
                            <span class="text-gray-300 text-xs font-semibold">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        @if($material->pdf)
                            <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank"
                               class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                PDF
                            </a>
                        @else
                            <span class="text-gray-300 text-xs font-semibold">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-4 py-4 text-gray-400 text-xs font-medium">
                        {{ $material->created_at ? $material->created_at->format('d M Y') : '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('speaking.materials.edit', $material->id) }}"
                               class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('speaking.materials.destroy', $material->id) }}"
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
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-yellow-50 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-bold text-gray-800">Belum ada materi speaking</p>
                            <p class="text-xs text-gray-400 mt-1">Klik tombol di atas untuk menambah materi baru</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
