@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 space-y-6">
    <h1 class="text-2xl font-bold mb-4 text-center">🍳 Feed Resep</h1>

    @foreach ($reseps as $resep)
        <div class="bg-white shadow-md rounded-lg overflow-hidden border">
            {{-- Gambar resep --}}
            @if($resep->gambar)
                <img src="{{ asset('storage/'.$resep->gambar) }}" alt="{{ $resep->judul }}" class="w-full h-64 object-cover">
            @endif

            {{-- Konten --}}
            <div class="p-4">
                <h2 class="text-xl font-semibold">{{ $resep->judul }}</h2>
                <p class="text-gray-600 mt-2">{{ $resep->deskripsi }}</p>

                {{-- Like & Komentar --}}
                <div class="flex items-center mt-4 space-x-4">
                    <form action="{{ route('resep.like', $resep->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-600">
                             {{ $resep->likes->count() }}
                        </button>
                    </form>

                    <span> {{ $resep->komentars->count() }}</span>
                </div>

                {{-- Form Komentar --}}
                <form action="{{ route('resep.komentar.store', $resep->id) }}" method="POST" class="mt-3">
                    @csrf
                    <input type="text" name="isi" placeholder="Tulis komentar..." class="w-full border rounded p-2">
                </form>

                {{-- Daftar komentar --}}
                <div class="mt-3 space-y-2">
                    @foreach ($resep->komentars as $komentar)
                        <div class="text-sm border-t pt-1">
                            <strong>{{ $komentar->user->name }}:</strong> {{ $komentar->isi }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
