<div class="bg-white rounded-[20px] p-6 shadow-lg transition-transform duration-300 ease-in-out">
    <h2 class="text-[#0077B6] text-3xl font-bold font-['Roboto'] mb-6">Daftar Buku</h2>
    
    <div class="p-6 max-h-[500px] overflow-y-auto custom-scrollbar space-y-4">
        @foreach($books as $book)
        <div class="bg-[#caf0f8] rounded-lg p-4 flex items-center justify-between hover:bg-[#90e0ef] transition-colors">
            <div class="flex-1">
                <div class="flex items-center gap-3">
                    <h3 class="text-[#0077B6] text-xl font-bold font-['Roboto']">{{ $book['judul_buku'] }}</h3>
                    @if($book->status === 'tersedia')
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Tersedia</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Dipinjam</span>
                    @endif
                </div>
                <p class="text-[#49454f] text-sm font-['Roboto'] mt-1">Penulis: {{ $book['pengarang'] }}</p>
                <p class="text-[#49454f] text-xs font-['Roboto'] mt-1">Stok: {{ $book->stok ?? 0 }}</p>
            </div>
            @if($book->status === 'tersedia')
                <button onclick="pinjamBuku({{ $book->id_buku }}, '{{ addslashes($book->judul_buku) }}', '{{ addslashes($book->pengarang) }}')" 
                        class="bg-[#0077B6] text-white px-6 py-2 rounded-lg hover:bg-[#005a8c] transition-colors font-['Roboto'] font-bold">
                    Pinjam
                </button>
            @else
                <button onclick="bukuTidakTersedia('{{ addslashes($book->judul_buku) }}')" 
                        class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-['Roboto'] font-bold">
                    Tidak Tersedia
                </button>
            @endif
        </div>
        @endforeach
    </div>
    
    <button onclick="closeContent()" class="mt-6 bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-['Roboto'] font-bold">
        Tutup
    </button>
</div>
