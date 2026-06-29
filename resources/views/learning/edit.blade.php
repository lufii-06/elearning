@extends('layouts.admin')

@section('title', 'Edit Materi')
@section('page_title', 'Edit Materi')
@section('page_subtitle', $material->title)

@section('header_actions')
    <a href="{{ route('learning.materials.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-gray-200 hover:border-gray-300 px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

    {{-- Form --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-base font-bold text-gray-800">Informasi Materi</h2>
            <p class="text-xs text-gray-400 mt-0.5">Kosongkan field file jika tidak ingin mengubahnya.</p>
        </div>

        <form action="{{ route('learning.materials.update', $material->id) }}" method="POST"
              enctype="multipart/form-data" class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $material->title) }}" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors">
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors resize-none">{{ old('description', $material->description) }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                <select id="kategori" name="kategori" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors">
                    <option value="">Pilih kategori</option>
                    <option value="Vocabulary"     @selected(old('kategori', $material->kategori) === 'Vocabulary')>Vocabulary</option>
                    <option value="Grammar"        @selected(old('kategori', $material->kategori) === 'Grammar')>Grammar</option>
                    <option value="Quiz"           @selected(old('kategori', $material->kategori) === 'Quiz')>Quiz</option>
                    <option value="Daily Practice" @selected(old('kategori', $material->kategori) === 'Daily Practice')>Daily Practice</option>
                </select>
                @error('kategori')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="video" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Video Baru
                    <span class="font-normal text-gray-400 text-xs ml-1">MP4, MOV, AVI — kosongkan jika tidak diubah</span>
                </label>
                <input type="file" id="video" name="video" accept=".mp4,.mov,.avi"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('video')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pdf" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    PDF Baru
                    <span class="font-normal text-gray-400 text-xs ml-1">Opsional — kosongkan jika tidak diubah</span>
                </label>
                <input type="file" id="pdf" name="pdf" accept=".pdf"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('pdf')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Update Materi
                </button>
                <a href="{{ route('learning.materials.index') }}"
                   class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Info Panel --}}
    <div class="bg-[#0f2f24] rounded-2xl overflow-hidden text-white">
        <div class="px-5 py-4 border-b border-white/10">
            <h3 class="font-bold text-sm">File Saat Ini</h3>
        </div>
        <div class="px-5 py-4 space-y-4">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-green-400/70 mb-1.5">Kategori</p>
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-white/10 text-sm font-semibold">
                    {{ $material->kategori }}
                </span>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-green-400/70 mb-1.5">Video</p>
                @if($material->video)
                    <a href="{{ asset('storage/' . $material->video) }}" target="_blank"
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-300 hover:text-blue-200 bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"/>
                        </svg>
                        Buka Video
                    </a>
                @else
                    <span class="text-xs text-white/40">Belum ada video</span>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-green-400/70 mb-1.5">PDF</p>
                @if($material->pdf)
                    <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank"
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-300 hover:text-amber-200 bg-white/10 hover:bg-white/20 px-3 py-1.5 rounded-lg transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                        </svg>
                        Buka PDF
                    </a>
                @else
                    <span class="text-xs text-white/40">Belum ada PDF</span>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
