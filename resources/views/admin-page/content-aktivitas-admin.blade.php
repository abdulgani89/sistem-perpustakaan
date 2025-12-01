<div>
    <h1 class="text-3xl font-bold text-[#03045E] mb-6">Log Aktivitas Pengembalian</h1>
    
    <!-- Layout Grid: 1 card besar di kiri, 3 card kecil di kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Card Utama Kiri (Span 2 kolom) -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#03045E]">Riwayat Pengembalian Buku</h2>
                <div class="flex gap-2">
                    <button id="btnFilterHariIni" class="px-4 py-2 bg-[#0077B6] text-white rounded-lg hover:bg-[#023E8A] transition text-sm">
                        Hari Ini
                    </button>
                    <button id="btnFilterSemua" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                        Semua
                    </button>
                    <button id="btnFilterDenda" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                        Ada Denda
                    </button>
                </div>
            </div>
            
            <!-- Tabel Log Pengembalian -->
            <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                <table class="min-w-full">
                    <thead class="bg-[#03045E] text-white sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">ID Pengembalian</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Siswa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Buku</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Kembali</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Denda</th>
                        </tr>
                    </thead>
                    <tbody id="tablePengembalianBody">
                        @forelse($pengembalian as $item)
                        @php
                            $tanggalPengembalian = \Carbon\Carbon::parse($item->tanggal_pengembalian);
                            $isToday = $tanggalPengembalian->isToday();
                            $hasDenda = $item->denda > 0;
                        @endphp
                        <tr class="border-b hover:bg-[#CAF0F8] transition duration-150 {{ $hasDenda ? 'bg-red-50' : '' }}" 
                            data-filter="{{ $isToday ? 'today' : 'all' }}"
                            data-denda="{{ $hasDenda ? 'yes' : 'no' }}">
                            <td class="px-4 py-3 text-sm font-medium">{{ $item->id_pengembalian }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->peminjaman->siswa->nama_siswa ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->peminjaman->buku->judul_buku ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($item->peminjaman->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $tanggalPengembalian->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($hasDenda)
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">
                                        Rp {{ number_format($item->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">
                                        Lunas
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="font-semibold">Belum ada log pengembalian</p>
                                    <p class="text-sm">Data akan muncul setelah ada transaksi pengembalian</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Main card container -->
        <div class="space-y-6">
            
            <!-- Card 1: Total Pengembalian -->
            <div class="bg-gradient-to-br from-[#0077B6] to-[#023E8A] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Pengembalian</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalPengembalian ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 2: Pengembalian Hari Ini -->
            <div class="bg-gradient-to-br from-[#0096C7] to-[#0077B6] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Pengembalian Hari Ini</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $pengembalianHariIni ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 3: Total Denda -->
            <div class="bg-gradient-to-br from-[#00B4D8] to-[#0096C7] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Denda</p>
                        <h3 class="text-3xl font-bold mt-1">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
