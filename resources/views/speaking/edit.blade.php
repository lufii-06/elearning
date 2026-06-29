@extends('layouts.admin')

@section('title', 'Edit Speaking Material')
@section('page_title', 'Edit Speaking Material')
@section('page_subtitle', $material->title)

@section('header_actions')
    <a href="{{ route('learning.materials.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-yellow-100 hover:border-yellow-200 px-4 py-2 rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('speaking.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section 1: Informasi Utama --}}
        <div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-yellow-50 bg-[#faf9f6]">
                <h2 class="text-sm font-black uppercase tracking-wider text-gray-800">Informasi Utama</h2>
            </div>
            <div class="p-6 space-y-5">
                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-bold text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $material->title) }}" required placeholder="Masukkan judul..."
                           class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100 transition-colors">
                    @error('title')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" placeholder="Deskripsi ringkas..."
                              class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100 transition-colors resize-none">{{ old('description', $material->description) }}</textarea>
                    @error('description')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Section 2: Berkas & Media --}}
        <div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-yellow-50 bg-[#faf9f6]">
                <h2 class="text-sm font-black uppercase tracking-wider text-gray-800">Berkas & Media Pembelajaran</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Video --}}
                <div class="space-y-2">
                    <label for="video" class="block text-sm font-bold text-gray-700">
                        Upload Video Baru
                        <span class="font-normal text-gray-400 text-xs ml-1">(MP4, MOV, AVI — biarkan kosong jika tidak diubah)</span>
                    </label>
                    <input type="file" id="video" name="video" accept=".mp4,.mov,.avi"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-950 hover:file:bg-yellow-100 border border-yellow-100 rounded-xl px-2 py-1.5">
                    @if($material->video)
                        <div class="pt-1.5">
                            <span class="text-xs text-gray-400 font-bold mr-2">File aktif:</span>
                            <a href="{{ asset('storage/' . $material->video) }}" target="_blank"
                               class="inline-flex items-center gap-1 text-[11px] font-bold text-yellow-800 bg-yellow-50 hover:bg-yellow-100 px-2.5 py-1 rounded-lg transition-colors border border-yellow-100">
                                Buka Video
                            </a>
                        </div>
                    @endif
                    @error('video')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PDF --}}
                <div class="space-y-2">
                    <label for="pdf" class="block text-sm font-bold text-gray-700">
                        Upload PDF Baru
                        <span class="font-normal text-gray-400 text-xs ml-1">(PDF — biarkan kosong jika tidak diubah)</span>
                    </label>
                    <input type="file" id="pdf" name="pdf" accept=".pdf"
                           class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-950 hover:file:bg-yellow-100 border border-yellow-100 rounded-xl px-2 py-1.5">
                    @if($material->pdf)
                        <div class="pt-1.5">
                            <span class="text-xs text-gray-400 font-bold mr-2">File aktif:</span>
                            <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank"
                               class="inline-flex items-center gap-1 text-[11px] font-bold text-yellow-800 bg-yellow-50 hover:bg-yellow-100 px-2.5 py-1 rounded-lg transition-colors border border-yellow-100">
                                Buka PDF
                            </a>
                        </div>
                    @endif
                    @error('pdf')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-sm font-extrabold px-6 py-3.5 rounded-xl shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Update Materi
            </button>
            <a href="{{ route('learning.materials.index') }}"
               class="inline-flex items-center text-sm font-bold text-gray-600 bg-gray-150 hover:bg-gray-200 px-6 py-3.5 rounded-xl transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
