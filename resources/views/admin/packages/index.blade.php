@extends('layouts.admin')

@section('title', 'Paket Kursus')
@section('page_title', 'Paket Kursus')
@section('page_subtitle', 'Kelola semua paket kursus yang tersedia di platform.')

@section('header_actions')
    <a href="{{ route('admin.packages.create') }}"
       class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-yellow-950 text-sm font-extrabold px-4 py-2.5 rounded-xl transition-all duration-200 shadow-sm shadow-yellow-400/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Paket
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

{{-- Table Card --}}
<div class="bg-white rounded-2xl border border-yellow-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-yellow-50">
        <div>
            <h2 class="text-base font-extrabold text-gray-900 tracking-tight">Daftar Paket</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $packages->count() }} paket aktif terdaftar</p>
        </div>
    </div>

    @if($packages->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 rounded-2xl bg-yellow-50 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <p class="text-sm font-bold text-gray-800">Belum ada paket kursus</p>
            <p class="text-xs text-gray-400 mt-1">Klik tombol di atas untuk membuat paket pertama</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-yellow-50 bg-[#faf9f6]">
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Nama Paket</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Kategori</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Harga</th>
                        <th class="text-left text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Status</th>
                        <th class="text-center text-xs font-bold text-gray-500 uppercase tracking-wider px-4 py-3.5">Materi</th>
                        <th class="text-right text-xs font-bold text-gray-500 uppercase tracking-wider px-6 py-3.5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-yellow-50">
                    @foreach($packages as $package)
                    <tr class="hover:bg-yellow-50/20 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($package->thumbnail)
                                    <img src="{{ Storage::url($package->thumbnail) }}"
                                         alt="{{ $package->display_name }}"
                                         class="w-11 h-11 rounded-xl object-cover flex-shrink-0 border border-yellow-100/60 shadow-sm">
                                @else
                                    <div class="w-11 h-11 rounded-xl bg-yellow-50 border border-yellow-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-bold text-gray-900 truncate">{{ $package->display_name }}</p>
                                    <p class="text-xs text-gray-400 truncate">{{ $package->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            @if($package->kategori)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-yellow-100 text-yellow-900 text-xs font-semibold">
                                    {{ $package->kategori }}
                                </span>
                            @else
                                <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 font-bold text-gray-800">
                            {{ $package->formatted_price }}
                        </td>
                        <td class="px-4 py-4">
                            @if($package->is_free)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-extrabold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Gratis
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 text-[11px] font-extrabold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Berbayar
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-100 text-gray-700 text-xs font-extrabold">
                                {{ $package->materials_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.packages.edit', $package->id) }}"
                                   class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg transition-colors">
                                    Edit
                                </a>
                                <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus paket \'{{ addslashes($package->display_name) }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 text-xs font-bold text-red-700 hover:text-red-850 bg-red-50 hover:bg-red-105 px-3 py-1.5 rounded-lg transition-colors">
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
