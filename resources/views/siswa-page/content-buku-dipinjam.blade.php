<div class="bg-white rounded-[20px] shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="flex justify-between items-center px-6 py-4 sticky top-0 bg-white/95 backdrop-blur-md border-b z-10">
        <h2 class="text-2xl font-bold text-[#0077B6]">Buku Sedang Dipinjam</h2>
        <button onclick="closeContent()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
    </div>

    <!-- Scrollable Content -->
    <div class="p-6 max-h-[500px] overflow-y-auto custom-scrollbar">
        @if($pinjam->count() > 0)
            <div class="space-y-4">
                @foreach($pinjam as $item)
                <div class="bg-gradient-to-br from-[#CAF0F8] to-[#90E0EF] rounded-xl p-5 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-[#023E8A] text-xl font-bold mb-2">{{ $item->buku->judul_buku }}</h3>
                            <p class="text-gray-700 text-sm mb-1">
                                <span class="font-semibold">Pengarang:</span> {{ $item->buku->pengarang }}
                            </p>
                            <p class="text-gray-600 text-sm mb-1">
                                <span class="font-semibold">Penerbit:</span> {{ $item->buku->penerbit }}
                            </p>
                            <div class="mt-3 flex gap-4 flex-wrap">
                                <p class="text-gray-700 text-sm">
                                    📅 <span class="font-semibold">Dipinjam:</span> 
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                </p>
                                <p class="text-orange-600 text-sm font-semibold">
                                    ⏰ <span>Batas:</span> 
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                        
                        @php
                            $batasKembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                            $isOverdue = $batasKembali->isPast();
                        @endphp
                        
                        @if($isOverdue)
                            <span class="bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-bold whitespace-nowrap">
                                Terlambat
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm font-bold whitespace-nowrap">
                                Aktif
                            </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <p class="text-gray-500 text-xl font-medium">Tidak ada buku yang sedang dipinjam</p>
                <p class="text-gray-400 text-sm mt-2">Mulai pinjam buku dari daftar buku</p>
            </div>
        @endif
    </div>
</div>
