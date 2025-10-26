<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-3xl font-bold text-center text-amber-700 mb-10">
            🍳 Dashboard — Resep & Komentar
        </h2>

        @if($resep->count() > 0)
            <div class="space-y-8">
                @foreach ($resep as $item)
                    <div class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        {{-- Gambar resep --}}
                        @if($item->gambar)
                            <img src="{{ asset('storage/'.$item->gambar) }}" 
                                 alt="{{ $item->judul }}" 
                                 class="h-56 w-full object-cover">
                        @else
                            <div class="h-56 w-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <span>Tidak ada gambar</span>
                            </div>
                        @endif

                        <div class="p-6">
                            {{-- Judul dan deskripsi --}}
                            <h3 class="text-2xl font-semibold text-gray-800 hover:text-amber-600 transition-colors mb-2">
                                {{ $item->judul }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ $item->deskripsi }}</p>

                            {{-- Tombol Like & jumlah komentar --}}
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                {{-- Like button --}}
                                <form action="{{ route('resep.like', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                             class="h-5 w-5 mr-1 {{ $item->likes->where('user_id', auth()->id())->count() ? 'text-red-500' : 'text-gray-400' }}" 
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" 
                                                  d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" 
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ $item->likes->count() }} Suka</span>
                                    </button>
                                </form>

                                {{-- Komentar count --}}
                                <div class="flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-5 w-5 mr-1 text-gray-400" 
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" 
                                              d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.08-3.239A8.962 8.962 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z" 
                                              clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $item->komentar->count() }} Komentar</span>
                                </div>
                            </div>

                            {{-- Form komentar --}}
                            <form action="{{ route('resep.komentar', $item->id) }}" method="POST" class="mt-4">
                                @csrf
                                <textarea name="isi" rows="2" placeholder="Tulis komentar..." 
                                          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
                                <button type="submit" 
                                        class="mt-2 bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 transition-colors">
                                    Kirim Komentar
                                </button>
                            </form>

                            {{-- Daftar komentar --}}
                            @if($item->komentar->count() > 0)
                                <div class="mt-5 space-y-3">
                                    @foreach ($item->komentar as $komen)
                                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                            <p class="text-sm text-gray-700">
                                                <strong class="text-amber-700">{{ $komen->user->name ?? 'Anonim' }}:</strong>
                                                {{ $komen->isi }}
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $komen->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-400 mt-3">Belum ada komentar.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 mt-20">
                <p class="text-lg">Belum ada resep tersedia 🥺</p>
                <a href="{{ route('resep.create') }}" 
                   class="mt-4 inline-block text-amber-600 font-medium hover:underline">
                   Tambah Resep Pertama
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
