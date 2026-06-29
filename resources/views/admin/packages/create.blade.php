@extends('layouts.admin')

@section('title', 'Tambah Paket')

@section('content')
<a class="back-link" href="{{ route('admin.packages.index') }}">&larr; Kembali ke daftar</a>

<div class="form-card">
    <h2>Tambah Paket Baru</h2>

    <form method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Nama (slug) --}}
        <div class="form-group">
            <label for="name">Nama Slug <span style="color:red">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   placeholder="contoh: paket-basic" required>
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama Tampilan --}}
        <div class="form-group">
            <label for="display_name">Nama Tampilan <span style="color:red">*</span></label>
            <input type="text" name="display_name" id="display_name" value="{{ old('display_name') }}"
                   placeholder="contoh: Paket Basic" required>
            @error('display_name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                      placeholder="Deskripsi singkat paket ini...">{{ old('description') }}</textarea>
            @error('description')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga & Kategori --}}
        <div class="form-grid">
            <div class="form-group">
                <label for="price">Harga (Rp) <span style="color:red">*</span></label>
                <input type="number" name="price" id="price" value="{{ old('price', 0) }}"
                       min="0" step="1000" required>
                @error('price')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}"
                       placeholder="contoh: English">
                @error('kategori')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Paket Gratis --}}
        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="is_free" value="1"
                       {{ old('is_free') ? 'checked' : '' }}>
                <span>Paket Gratis (centang jika tidak berbayar)</span>
            </label>
        </div>

        {{-- Thumbnail --}}
        <div class="form-group">
            <label for="thumbnail">Thumbnail (jpg, jpeg, png — maks 2MB)</label>
            <input type="file" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png">
            @error('thumbnail')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="button success">Simpan Paket</button>
    </form>
</div>
@endsection
