<x-app-layout>
    <div class="max-w-2xl mx-auto mt-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Feed Resep</h1>

        @forelse ($resep as $r)
            <div class="bg-white shadow rounded-xl mb-6 overflow-hidden">
                {{-- Gambar Resep --}}
                @if($r->gambar)
                    <img src="{{ asset('storage/' . $r->gambar) }}" alt="{{ $r->judul }}" class="w-full h-60 object-cover">
                @else
                    <div class="w-full h-60 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif

                {{-- Konten --}}
                @php
                    $shouldOpenComments = old('resep_id') == $r->id ? 'true' : 'false';
                    $oldCommentValue = old('resep_id') == $r->id ? old('isi') : '';
                @endphp
                <div class="p-4" x-data="{ open: {{ $shouldOpenComments }} }">
                    <h2 class="text-lg font-semibold">{{ $r->judul }}</h2>
                    <p class="text-gray-600 mt-2">{{ $r->deskripsi }}</p>

                    <div class="mt-3 flex justify-between items-center text-sm text-gray-500">
                        <span>{{ $r->user->name ?? 'Anonim' }}</span>
                        <div class="flex items-center gap-3">
                            @auth
                                @php
                                    $liked = $r->likes->contains(fn ($like) => $like->user_id === auth()->id());
                                @endphp
                                <form method="POST" action="{{ route('resep.like', $r->id) }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 text-sm {{ $liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $liked ? 'currentColor' : 'none' }}" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2-1.676-3.75-3.75-3.75-1.49 0-2.777.835-3.436 2.058a.75.75 0 0 1-1.328 0A3.874 3.874 0 0 0 9.05 4.5C6.976 4.5 5.25 6.25 5.25 8.25c0 4.264 4.764 6.872 6.81 9.511a.75.75 0 0 0 1.182 0C16.236 15.122 21 12.514 21 8.25Z" />
                                        </svg>
                                        <span>{{ $r->likes->count() }}</span>
                                    </button>
                                </form>
                            @else
                                <div class="flex items-center gap-1 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2-1.676-3.75-3.75-3.75-1.49 0-2.777.835-3.436 2.058a.75.75 0 0 1-1.328 0A3.874 3.874 0 0 0 9.05 4.5C6.976 4.5 5.25 6.25 5.25 8.25c0 4.264 4.764 6.872 6.81 9.511a.75.75 0 0 0 1.182 0C16.236 15.122 21 12.514 21 8.25Z" />
                                    </svg>
                                    <span>{{ $r->likes->count() }}</span>
                                </div>
                            @endauth

                            <button type="button" @click="open = !open" :class="open ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500'" class="flex items-center gap-1 text-sm focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.5 8.25h9m-9 3h6.75m5.25 5.25-2.477-2.477a.75.75 0 0 0-.53-.22H6.75a2.25 2.25 0 0 1-2.25-2.25V6.75A2.25 2.25 0 0 1 6.75 4.5h10.5A2.25 2.25 0 0 1 19.5 6.75v9.75Z" />
                                </svg>
                                <span>{{ $r->komentar->count() }}</span>
                            </button>
                        </div>
                    </div>

                    {{-- Komentar --}}
                    <div class="mt-4 border-t pt-3" x-show="open" x-cloak x-transition.opacity.duration.150ms>
                        <h3 class="font-semibold mb-2 text-sm">Komentar</h3>
                        @forelse ($r->komentar as $komentar)
                            <div class="mb-2">
                                <span class="font-semibold text-gray-700">{{ $komentar->user->name ?? 'Anonim' }}:</span>
                                <span class="text-gray-600">{{ $komentar->isi }}</span>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm">Belum ada komentar</p>
                        @endforelse

                        @auth
                            <form method="POST" action="{{ route('resep.komentar', $r->id) }}" class="mt-3 flex items-start gap-2">
                                @csrf
                                <input type="hidden" name="resep_id" value="{{ $r->id }}">
                                <textarea name="isi" rows="2" class="flex-1 border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-orange-200" placeholder="Tulis komentar..." required>{{ $oldCommentValue }}</textarea>
                                <button type="submit" class="bg-orange-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-orange-600">Kirim</button>
                            </form>
                            @error('isi')
                                @if (old('resep_id') == $r->id)
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @endif
                            @enderror
                        @else
                            <p class="text-xs text-gray-400 mt-3">Login untuk memberikan komentar.</p>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada resep yang diposting.</p>
        @endforelse
    </div>
</x-app-layout>
