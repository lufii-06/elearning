@extends('layouts.admin')

@section('title', 'Paket Kursus')
@section('page_title', 'Paket Kursus')
@section('page_subtitle', 'Kelola semua paket kursus yang tersedia di platform.')

@section('header_actions')
    <a href="{{ route('admin.packages.create') }}"
       class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Paket
    </a>
@endsection

@section('content')

{{-- Alert success --}}
@if(session('success'))
    <div class="mb-6 flex items-start gap-3 bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 text-sm font-medium">
        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- Table Card --}}
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

    {{-- Card header --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h2 class="text-base font-bold text-gray-800">Daftar Paket</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $packages->count() }} paket tersedia</p>
        </div>
    </div>

    @if($packages->isEmpty())
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-700">Belum ada paket kursus</p>
            <p class="text-xs text-gray-400 mt-1">Klik "Tambah Paket" untuk mulai menambahkan.</p>
        </div>
    @else
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/60">
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">Nama Paket</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Kategori</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Harga</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Status</th>
                        <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3">Materi</th>
                        <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($packages as $package)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        {{-- Nama + thumbnail --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($package->thumbnail)
                                    <img src="{{ Storage::url($package->thumbnail) }}"
                                         alt="{{ $package->display_name }}"
                                         class="w-11 h-11 rounded-xl object-cover flex-shrink-0 border border-gray-200">
                                @else
                                    <div class="w-11 h-11 rounded-xl bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 truncate">{{ $package->display_name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $package->name }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Kategori --}}
                        <td class="px-4 py-4">
                            @if($package->kategori)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold">
                                    {{ $package->kategori }}
                                </span>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>

                        {{-- Harga --}}
                        <td class="px-4 py-4 font-semibold text-gray-800">
                            {{ $package->formatted_price }}
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-4">
                            @if($package->is_free)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Gratis
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Berbayar
                                </span>
                            @endif
                        </td>

                        {{-- Jumlah Materi --}}
                        <td class="px-4 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-gray-700 text-sm font-bold">
                                {{ $package->materials_count }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            {{-- show disini untuk melihat, di satu paket ini sudah ada materi apa saja --}}
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.packages.show', $package->id) }}"
                                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-650 hover:text-emerald-750 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Detail
                                </a>

                                <a href="{{ route('admin.packages.edit', $package->id) }}"
                                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus paket \'{{ addslashes($package->display_name) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916"/>
                                        </svg>
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
