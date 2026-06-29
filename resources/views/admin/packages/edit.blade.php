@extends('layouts.admin')

@section('title', 'Edit Paket')
@section('page_title', 'Edit Paket')
@section('page_subtitle', "Edit informasi paket: {$package->display_name}")

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
            <h2 class="text-base font-extrabold text-gray-800 tracking-tight">Edit Informasi Paket</h2>
            <p class="text-xs text-gray-400 mt-0.5">Semua field bertanda * wajib diisi.</p>
        </div>

        <form method="POST" action="{{ route('admin.packages.update', $package->id) }}" enctype="multipart/form-data"
              class="px-6 py-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama Slug --}}
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Nama Slug <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}"
                       placeholder="contoh: paket-basic"
                       class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-colors outline-none
                              {{ $errors->has('name') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200' : 'border-yellow-100 bg-[#fdfcf9] focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100' }}"
                       required>
                @error('name')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Tampilan --}}
            <div>
                <label for="display_name" class="block text-sm font-bold text-gray-700 mb-1.5">
                    Nama Tampilan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="display_name" id="display_name"
                       value="{{ old('display_name', $package->display_name) }}"
                       placeholder="contoh: Paket Basic"
                       class="w-full px-3.5 py-2.5 rounded-xl border text-sm transition-colors outline-none
                              {{ $errors->has('display_name') ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-2 focus:ring-red-200' : 'border-yellow-100 bg-[#fdfcf9] focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100' }}"
                       required>
                @error('display_name')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700 mb-1.5">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Deskripsi singkat tentang paket ini..."
                          class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100 resize-none">{{ old('description', $package->description) }}</textarea>
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
                    <input type="number" name="price" id="price"
                           value="{{ old('price', $package->price) }}" min="0" step="1000"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100"
                           required>
                    @error('price')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kategori" class="block text-sm font-bold text-gray-700 mb-1.5">Kategori</label>
                    <input type="text" name="kategori" id="kategori"
                           value="{{ old('kategori', $package->kategori) }}"
                           placeholder="contoh: English"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-yellow-100 bg-[#fdfcf9] text-sm transition-colors outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-100">
                    @error('kategori')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Paket Gratis --}}
            <div class="flex items-center gap-3 p-3.5 rounded-xl bg-yellow-50/40 border border-yellow-100/60">
                <input type="checkbox" name="is_free" id="is_free" value="1"
                       {{ old('is_free', $package->is_free) ? 'checked' : '' }}
                       class="w-4 h-4 rounded accent-yellow-600">
                <label for="is_free" class="text-sm font-bold text-gray-700 cursor-pointer select-none">
                    Paket Gratis
                    <span class="font-normal text-gray-400 text-xs ml-1">— centang jika tidak berbayar</span>
                </label>
            </div>

            {{-- Thumbnail saat ini --}}
            @if($package->thumbnail)
            <div>
                <p class="text-sm font-bold text-gray-700 mb-2">Thumbnail Saat Ini</p>
                <img src="{{ Storage::url($package->thumbnail) }}"
                     alt="{{ $package->display_name }}"
                     class="w-28 h-28 object-cover rounded-xl border border-yellow-100 shadow-sm">
            </div>
            @endif

            {{-- Upload Thumbnail --}}
            <div>
                <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-1.5">
                    {{ $package->thumbnail ? 'Ganti Thumbnail' : 'Upload Thumbnail' }}
                    <span class="font-normal text-gray-400 text-xs ml-1">jpg, jpeg, png — maks 2MB</span>
                </label>
                <input type="file" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-950 hover:file:bg-yellow-100 border border-yellow-100/80 rounded-xl px-2 py-1.5">
                @if($package->thumbnail)
                    <p class="mt-1 text-xs text-gray-450 font-medium">Kosongkan jika tidak ingin mengubah thumbnail.</p>
                @endif
                @error('thumbnail')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2 flex gap-3">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-sm font-extrabold px-6 py-3 rounded-xl shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Simpan Perubahan
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
