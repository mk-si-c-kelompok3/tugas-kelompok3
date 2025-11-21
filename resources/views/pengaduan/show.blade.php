@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@section('content')
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Detail Pengaduan</h2>

                <dl class="divide-y divide-gray-200 text-sm">
                    <div class="py-2 flex justify-between">
                        <dt class="font-medium text-gray-600">Waktu</dt>
                        <dd>{{ $pengaduan->created_at->format('d M Y H:i') }}</dd>
                    </div>
                    <div class="py-2 flex justify-between">
                        <dt class="font-medium text-gray-600">Nama</dt>
                        <dd>{{ $pengaduan->nama }}</dd>
                    </div>
                    <div class="py-2 flex justify-between">
                        <dt class="font-medium text-gray-600">Judul</dt>
                        <dd>{{ $pengaduan->judul }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="font-medium text-gray-600 mb-1">Isi Pengaduan</dt>
                        <dd class="whitespace-pre-line">{{ $pengaduan->isi }}</dd>
                    </div>
                </dl>

                <div class="mt-4">
                    <a href="{{ route('pengaduan.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-200 rounded text-xs font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
