<div class="bg-white rounded-[20px] p-6 shadow-lg transition-transform duration-300 ease-in-out">
    <h2 class="text-[#0077B6] text-3xl font-bold font-['Roboto'] mb-6">Daftar Buku</h2>
    
    <div class="space-y-4">
        @foreach($books as $book)
        <div class="bg-[#caf0f8] rounded-lg p-4 flex items-center justify-between hover:bg-[#90e0ef] transition-colors">
            <div>
                <h3 class="text-[#0077B6] text-xl font-bold font-['Roboto']">{{ $book['title'] }}</h3>
                <p class="text-[#49454f] text-sm font-['Roboto']">Penulis: {{ $book['author'] }}</p>
            </div>
            <button class="bg-[#0077B6] text-white px-6 py-2 rounded-lg hover:bg-[#005a8c] transition-colors font-['Roboto'] font-bold">
                Pinjam
            </button>
        </div>
        @endforeach
    </div>
    
    <button onclick="closeContent()" class="mt-6 bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors font-['Roboto'] font-bold">
        Tutup
    </button>
</div>
