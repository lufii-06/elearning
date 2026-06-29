@extends('layouts.admin')

@section('title', 'Tambah Materi')
@section('page_title', 'Tambah Materi')
@section('page_subtitle', 'Upload video pembelajaran, audio, PDF pendukung, serta hubungkan ke paket kursus.')

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
        </div>

        <form action="{{ route('learning.materials.store') }}" method="POST" enctype="multipart/form-data"
              class="px-6 py-6 space-y-5">
            @csrf

            {{-- Judul --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors">
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hubungkan Ke Paket Kursus --}}
            <div>
                <label for="package_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Hubungkan ke Paket Kursus</label>
                <select id="package_id" name="package_id"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors">
                    <option value="">Pilih Paket Kursus (Opsional)</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" @selected(old('package_id', request('package_id')) == $package->id)>
                            {{ $package->display_name }} ({{ $package->formatted_price }})
                        </option>
                    @endforeach
                </select>
                @error('package_id')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                <select id="kategori" name="kategori" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm outline-none focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-colors">
                    <option value="">Pilih kategori</option>
                    <option value="Vocabulary"     @selected(old('kategori') === 'Vocabulary')>Vocabulary</option>
                    <option value="Grammar"        @selected(old('kategori') === 'Grammar')>Grammar</option>
                    <option value="Quiz"           @selected(old('kategori') === 'Quiz')>Quiz</option>
                    <option value="Daily Practice" @selected(old('kategori') === 'Daily Practice')>Daily Practice</option>
                </select>
                @error('kategori')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Video --}}
            <div>
                <label for="video" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Video <span class="text-red-500">*</span>
                    <span class="font-normal text-gray-400 text-xs ml-1">MP4, MOV, AVI</span>
                </label>
                <input type="file" id="video" name="video" accept=".mp4,.mov,.avi" required
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('video')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Audio --}}
            <div>
                <label for="audio" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Audio File
                    <span class="font-normal text-gray-400 text-xs ml-1">MP3, WAV, M4A (Opsional)</span>
                </label>
                <input type="file" id="audio" name="audio" accept=".mp3,.wav,.m4a,.aac"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('audio')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- PDF --}}
            <div>
                <label for="pdf" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    PDF Document
                    <span class="font-normal text-gray-400 text-xs ml-1">Opsional</span>
                </label>
                <input type="file" id="pdf" name="pdf" accept=".pdf"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('pdf')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Learning Guide --}}
            <div>
                <label for="learning_guide" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Learning Guide (PDF)
                    <span class="font-normal text-gray-400 text-xs ml-1">Opsional</span>
                </label>
                <input type="file" id="learning_guide" name="learning_guide" accept=".pdf"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 border border-gray-200 rounded-xl px-2 py-1.5">
                @error('learning_guide')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Simpan Materi
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
            <h3 class="font-bold text-sm">Detail Upload</h3>
        </div>
        <div class="px-5 py-4 space-y-3">
            @foreach([['Kategori','Wajib dipilih'],['Paket','Opsional'],['Video','MP4 / MOV / AVI'],['Audio','MP3 / WAV'],['PDF','Opsional'],['Learning Guide','PDF Opsional']] as [$k,$v])
            <div class="flex items-center justify-between text-sm border-b border-white/10 pb-3 last:border-0 last:pb-0">
                <span class="text-green-300 font-semibold">{{ $k }}</span>
                <span class="text-white/70">{{ $v }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
