<div class="bg-white rounded-[20px] shadow-lg overflow-hidden custom-scrollbar">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 sticky top-0 bg-white/95 backdrop-blur-md border-b z-10">
        <h2 class="text-2xl font-bold text-[#0077B6]">Hasil Pencarian</h2>
        <button onclick="closeContent()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
    </div>

    <!-- Scrollable Content -->
    <div class="p-6 max-h-[500px] overflow-y-auto custom-scrollbar">

    @if($buku->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($buku as $book)
            <div class="bg-gradient-to-br from-[#CAF0F8] to-[#90E0EF] rounded-xl shadow-md p-4 hover:shadow-xl transition-all duration-300 hover:scale-105">
                @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" 
                     alt="{{ $book->judul_buku }}" 
                     class="w-full h-48 object-cover rounded-lg mb-3">
                @else
                <div class="w-full h-48 bg-white/50 rounded-lg mb-3 flex items-center justify-center">
                    <svg class="w-16 h-16 text-[#0077B6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                @endif
                
                <h3 class="font-bold text-lg mb-2 text-[#023E8A] line-clamp-2">{{ $book->judul_buku }}</h3>
                <p class="text-gray-700 text-sm mb-1"><span class="font-semibold">Pengarang:</span> {{ $book->pengarang }}</p>
                <p class="text-gray-600 text-xs mb-1"><span class="font-semibold">Penerbit:</span> {{ $book->penerbit }}</p>
                <p class="text-gray-600 text-xs mb-3"><span class="font-semibold">Kategori:</span> {{ $book->kategori }}</p>
                
                <div class="flex justify-between items-center pt-3 border-t border-white/30">
                    <span class="text-green-700 text-sm font-bold bg-green-100 px-3 py-1 rounded-full">✓ Tersedia</span>
                    <button onClick="pinjamBuku('{{ $book->id_buku }}')" class="bg-[#0077B6] text-white px-4 py-2 rounded-lg hover:bg-[#023E8A] transition-colors font-semibold shadow-md">
                        Pinjam
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-500 text-xl font-medium">Tidak ada buku yang ditemukan</p>
            <p class="text-gray-400 text-sm mt-2">Coba kata kunci lain</p>
        </div>
    @endif
    </div>
</div>