@extends('layouts.app')
@section('title', 'Buat Pengaduan')

@section('content')
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <h2 class="text-xl font-semibold mb-4">Buat Pengaduan</h2>

                {{-- Tampilkan error validasi kalau ada --}}
                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pengaduan.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input
                            type="text"
                            name="nama"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('nama', auth()->user()->name ?? '') }}"
                        >
                    </div>

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul Pengaduan</label>
                        <input
                            type="text"
                            name="judul"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            value="{{ old('judul') }}"
                        >
                    </div>

                    {{-- Isi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Isi Pengaduan</label>
                        <textarea
                            name="isi"
                            rows="5"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >{{ old('isi') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('pengaduan.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md text-xs font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-xs font-semibold text-white uppercase tracking-widest hover:bg-indigo-700">
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
