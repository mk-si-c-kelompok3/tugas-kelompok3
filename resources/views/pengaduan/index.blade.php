@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Daftar Pengaduan</h2>

                    {{-- Tombol buat pengaduan untuk user biasa --}}
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('pengaduan.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-xs font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                            + Buat Pengaduan
                        </a>
                    @endif
                </div>

                @if (session('ok'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('ok') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Waktu</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Judul</th>
                            <th class="px-4 py-2">Status</th>

                            {{-- Kolom Aksi hanya muncul kalau admin --}}
                            @if(auth()->user()->role === 'admin')
                                <th class="px-4 py-2 text-right">Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $row)
                            <tr class="border-b">
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ $row->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $row->nama }}
                                </td>
                                <td class="px-4 py-2 max-w-xs truncate">
                                    {{ $row->judul }}
                                </td>
                                <td class="px-4 py-2">
                                    @php
                                        $map = [
                                            'baru'     => 'bg-gray-200 text-gray-800',
                                            'diproses' => 'bg-yellow-200 text-yellow-800',
                                            'selesai'  => 'bg-green-200 text-green-800',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $map[$row->status] ?? 'bg-gray-200 text-gray-800' }}">
                                        {{ ucfirst($row->status) }}
                                    </span>
                                </td>

                                {{-- Aksi hanya admin --}}
                                @if(auth()->user()->role === 'admin')
                                    <td class="px-4 py-2 text-right space-x-1">

                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('pengaduan.show', $row) }}"
                                           class="inline-flex items-center px-2 py-1 border rounded text-xs text-gray-700 hover:bg-gray-100">
                                            Detail
                                        </a>

                                        {{-- Ubah Status (pakai method update) --}}
                                        <form action="{{ route('pengaduan.update', $row) }}"
                                              method="POST"
                                              class="inline-flex items-center space-x-1">
                                            @csrf
                                            @method('PUT')

                                            <select name="status"
                                                    class="text-xs border rounded px-1 py-0.5">
                                                <option value="baru"     @selected($row->status == 'baru')>Baru</option>
                                                <option value="diproses" @selected($row->status == 'diproses')>Diproses</option>
                                                <option value="selesai"  @selected($row->status == 'selesai')>Selesai</option>
                                            </select>

                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700">
                                                Simpan
                                            </button>
                                        </form>

                                        {{-- Hapus --}}
                                        <form action="{{ route('pengaduan.destroy', $row) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Hapus pengaduan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}"
                                    class="px-4 py-4 text-center text-gray-500">
                                    Belum ada pengaduan.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
