<div class="bg-white rounded-[20px] p-6 shadow-lg transition-transform duration-300 ease-in-out">
    <h2 class="text-[#0077B6] text-3xl font-bold font-['Roboto'] mb-6">Riwayat Peminjaman</h2>
    
    <div class="p-6 max-h-[500px] overflow-y-auto custom-scrollbar space-y-4">
        @foreach($riwayat as $item)
        <div class="bg-[#caf0f8] rounded-lg p-4 hover:bg-[#90e0ef] transition-colors">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h3 class="text-[#0077B6] text-xl font-bold font-['Roboto']">{{ $item->buku->judul_buku }}</h3>
                    <p class="text-[#49454f] text-sm font-['Roboto'] mt-1">Penulis: {{ $item->buku->pengarang }}</p>
                    <p class="text-[#49454f] text-sm font-['Roboto']">Penerbit: {{ $item->buku->penerbit }} ({{ $item->buku->tahun_terbit }})</p>
                    <div class="mt-2 flex gap-4">
                        <p class="text-[#49454f] text-sm font-['Roboto']">📅 Dipinjam: {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</p>
                        <p class="text-green-600 text-sm font-['Roboto'] font-semibold">✓ Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-['Roboto'] font-semibold">
                    Selesai
                </span>
            </div>
        </div>
        @endforeach
    </div>
    
    <button onclick="closeContent()" class="mt-6 bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-['Roboto'] font-bold">
        Tutup
    </button>
</div>
