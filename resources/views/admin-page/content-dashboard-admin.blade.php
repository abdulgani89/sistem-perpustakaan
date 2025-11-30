<div>
    <h1 class="text-3xl font-bold text-[#03045E] mb-6">Dashboard Perpustakaan</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Tabel Hari Ini -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-[#03045E] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Hari Ini
        </h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Jumlah Peminjam</span>
                <span class="text-2xl font-bold text-[#0077B6]">{{ $peminjamHariIni }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Buku Dipinjam</span>
                <span class="text-2xl font-bold text-green-600">{{ $bukuDipinjamHariIni }}</span>
            </div>
        </div>
    </div>
    
    <!-- Tabel Bulan Ini -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-[#03045E] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Bulan Ini
        </h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-purple-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Jumlah Peminjam</span>
                <span class="text-2xl font-bold text-purple-600">{{ $peminjamBulanIni }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-indigo-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Buku Dipinjam</span>
                <span class="text-2xl font-bold text-indigo-600">{{ $bukuDipinjamBulanIni }}</span>
            </div>
        </div>
    </div>
    
    <!-- Tabel Tahun Ini -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-[#03045E] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Tahun Ini
        </h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-orange-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Jumlah Peminjam</span>
                <span class="text-2xl font-bold text-orange-600">{{ $peminjamTahunIni }}</span>
            </div>
            <div class="flex justify-between items-center p-4 bg-red-50 rounded-lg">
                <span class="text-gray-700 font-semibold">Buku Dipinjam</span>
                <span class="text-2xl font-bold text-red-600">{{ $bukuDipinjamTahunIni }}</span>
            </div>
        </div>
    </div>
    
</div>