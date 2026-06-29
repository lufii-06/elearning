@extends('layouts.admin')

@section('title', 'Tambah Paket')
@section('page_title', 'Tambah Paket')
@section('page_subtitle', 'Isi form di bawah untuk menambahkan paket kursus baru.')

@section('header_actions')
    <a href="{{ route('admin.packages.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 bg-white border border-yellow-100 hover:border-yellow-200 px-4 py-2 rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
        </svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">

        <div class="px-6 py-4.5 border-b border-yellow-50">
            <h2 class="text-base font-extrabold text-gray-800 tracking-tight">Informasi Paket</h2>
            <p class="text-xs text-gray-400 mt-0.5">Field bertanda <span class="text-red-500">*</span> wajib diisi.</p>
        </div>

        <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data"
              class="px-6 py-6 space-y-5">
            @csrf

            {{-- Nama Slug --}}
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Nama Slug <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       placeholder="contoh: paket-basic" required
                       class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-colors outline-none
                              {{ $errors->has('name') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200' : 'border-yellow-100 bg-[#fdfcf9] focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100' }}">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Nama Tampilan --}}
            <div>
                <label for="display_name" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Nama Tampilan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="display_name" id="display_name" value="{{ old('display_name') }}"
                       placeholder="contoh: Paket Basic" required
                       class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-colors outline-none
                              {{ $errors->has('display_name') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200' : 'border-yellow-100 bg-[#fdfcf9] focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100' }}">
                @error('display_name')
                    <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Deskripsi singkat tentang paket ini..."
                          class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100 resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga & Kategori --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-bold text-gray-700 mb-1.5">
                        Harga (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price" value="{{ old('price', 0) }}"
                           min="0" step="1000" required
                           class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100">
                    @error('price')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-bold text-gray-700 mb-1.5">
                        Kategori
                    </label>
                    <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}"
                           placeholder="contoh: English"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100">
                    @error('kategori')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Thumbnail --}}
            <div>
                <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Thumbnail Paket
                    <span class="font-normal text-gray-400 text-xs ml-1">PNG, JPG, JPEG (Maks. 2MB)</span>
                </label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-950 hover:file:bg-yellow-100 border border-yellow-100/80 rounded-xl px-2 py-1.5">
                @error('thumbnail')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-sm font-extrabold px-6 py-3 rounded-xl shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Simpan Paket
                </button>
                <a href="{{ route('admin.packages.index') }}"
                   class="inline-flex items-center text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
