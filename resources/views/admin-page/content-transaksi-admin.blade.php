<div>
    <h1 class="text-3xl font-bold text-[#03045E] mb-6">Transaksi Pengembalian Buku</h1>
    
    <!-- Layout Grid: 1 card besar di kiri, 3 card kecil di kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Card Utama Kiri (Span 2 kolom) -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#03045E]">Daftar Peminjaman Aktif</h2>
                <div class="flex gap-2">
                    <button id="btnFilterSemua" class="px-4 py-2 bg-[#0077B6] text-white rounded-lg hover:bg-[#023E8A] transition text-sm">
                        Semua
                    </button>
                    <button id="btnFilterTerlambat" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm">
                        Terlambat
                    </button>
                </div>
            </div>
            
            <!-- Tabel Peminjaman -->
            <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                <table class="min-w-full">
                    <thead class="bg-[#03045E] text-white sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">ID Pinjam</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Siswa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Buku</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Pinjam</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tgl Hrs Kembali</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tablePeminjamanBody">
                        @forelse($peminjaman as $pinjam)
                        @php
                            $tanggalKembali = \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->addDays(7);
                            $today = \Carbon\Carbon::now();
                            $terlambat = $today->gt($tanggalKembali);
                            $selisihHari = $terlambat ? $today->diffInDays($tanggalKembali) : 0;
                        @endphp
                        <tr class="border-b hover:bg-[#CAF0F8] transition duration-150" data-status="{{ $terlambat ? 'terlambat' : 'normal' }}">
                            <td class="px-4 py-3 text-sm font-medium">{{ $pinjam->id_peminjaman }}</td>
                            <td class="px-4 py-3 text-sm">{{ $pinjam->siswa->nama_siswa }}</td>
                            <td class="px-4 py-3 text-sm">{{ $pinjam->buku->judul_buku }}</td>
                            <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $tanggalKembali->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($terlambat)
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">
                                        Terlambat {{ $selisihHari }} hari
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">
                                        Normal
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="btnProsesPengembalian px-3 py-1 bg-[#03045E] hover:bg-[#023E8A] text-white text-sm font-semibold rounded transition" 
                                        data-id="{{ $pinjam->id_peminjaman }}"
                                        data-siswa="{{ $pinjam->siswa->nama_siswa }}"
                                        data-buku="{{ $pinjam->buku->judul_buku }}"
                                        data-terlambat="{{ $terlambat ? '1' : '0' }}"
                                        data-hari="{{ $selisihHari }}">
                                    Proses Pengembalian
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="font-semibold">Tidak ada peminjaman aktif</p>
                                    <p class="text-sm">Semua buku sudah dikembalikan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Card Kecil Kanan (Stack 3 cards vertikal) -->
        <div class="space-y-6">
            
            <!-- Card 1: Total Dipinjam -->
            <div class="bg-gradient-to-br from-[#0077B6] to-[#023E8A] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Dipinjam</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalDipinjam ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 2: Pengembalian Hari Ini -->
            <div class="bg-gradient-to-br from-[#0096C7] to-[#0077B6] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Dikembalikan Hari Ini</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $pengembalianHariIni ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 3: Terlambat -->
            <div class="bg-gradient-to-br from-[#00B4D8] to-[#0096C7] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Terlambat</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalTerlambat ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Modal Proses Pengembalian -->
<div id="modalPengembalian" style="display: none; background-color: rgba(0, 0, 0, 0.3);" class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-lg mx-4 transform transition-all duration-300" style="transform: scale(0.95); opacity: 0;" id="modalPengembalianContent">
        <div class="bg-[#03045E] text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-2xl font-bold">Proses Pengembalian Buku</h3>
            <button id="closeModalPengembalian" type="button" class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>
        
        <form id="formPengembalian" class="p-6">
            @csrf
            <input type="hidden" id="id_peminjaman" name="id_peminjaman">
            
            <div class="space-y-4">
                <!-- Info Peminjaman -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-bold text-gray-700 mb-2">Informasi Peminjaman</h4>
                    <div class="space-y-1 text-sm">
                        <p><span class="font-semibold">Siswa:</span> <span id="info_siswa"></span></p>
                        <p><span class="font-semibold">Buku:</span> <span id="info_buku"></span></p>
                        <p><span class="font-semibold">Status:</span> <span id="info_status"></span></p>
                    </div>
                </div>

                <!-- Tanggal Pengembalian -->
                <div>
                    <label for="tanggal_pengembalian" class="block text-sm font-bold text-gray-700 mb-2">Tanggal Pengembalian <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="tanggal_pengembalian" name="tanggal_pengembalian" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="error_tanggal_pengembalian"></span>
                </div>

                <!-- Denda (jika terlambat) -->
                <div id="dendaContainer" style="display: none;">
                    <label for="denda" class="block text-sm font-bold text-gray-700 mb-2">Denda Keterlambatan</label>
                    <input type="number" id="denda" name="denda" min="0" value="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Denda: Rp 1.000/hari. Keterlambatan: <span id="info_hari_terlambat"></span> hari</p>
                    <span class="text-red-500 text-sm" id="error_denda"></span>
                </div>

                <!-- Catatan -->
                <div>
                    <label for="catatan" class="block text-sm font-bold text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea id="catatan" name="catatan" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                              placeholder="Kondisi buku, catatan tambahan, dll"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="btnCancelPengembalian" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300">
                    Batal
                </button>
                <button type="submit" id="btnSubmitPengembalian" class="px-6 py-2 bg-[#03045E] hover:bg-[#023E8A] text-white font-bold rounded-lg transition duration-300">
                    Proses Pengembalian
                </button>
            </div>
        </form>
    </div>
</div>