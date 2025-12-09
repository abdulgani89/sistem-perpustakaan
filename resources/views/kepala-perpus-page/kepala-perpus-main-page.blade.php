<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Perpustakaan - Kepala Perpus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/kepala-perpus.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-[#caf0f8] min-h-screen" 
      data-chart-labels="{{ json_encode($chartLabels) }}"
      data-chart-peminjam="{{ json_encode($chartDataBulan) }}"
      data-chart-hilang="{{ json_encode($chartDataHilang) }}"
      data-buku-tersedia="{{ $bukuTersedia }}"
      data-buku-dipinjam="{{ $bukuDipinjam }}"
      data-buku-hilang="{{ $bukuHilang }}">
    <div class="min-h-screen p-5 space-y-5">

        <!-- User Badge -->
        <div class="w-fit bg-[#90E0EF] backdrop-blur-md rounded-[20px] px-4 py-2 flex items-center gap-3 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-[#03045E] flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
            <div class="text-sky-600 text-base font-bold whitespace-nowrap">L-Cerdas Kepala Perpustakaan </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            <!-- Card 1  -->
            <div class="lg:col-span-3 bg-white rounded-[20px] shadow-lg p-5 space-y-4">
                <h3 class="text-xl font-bold font-[Roboto] text-[#03045E]">Informasi Peminjaman</h3>
                
                <div class="space-y-3">
                    <p class="font-bold text-lg text-gray-600">Bulan ini</p>
                    <div class="flex justify-between items-center p-4 bg-blue-100 rounded-lg">
                        <span class="text-gray-700 font-semibold text-sm">Jumlah Peminjam</span>
                        <span class="text-2xl font-bold text-[#0077B6]">{{ $peminjamHariIni }}</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-green-100 rounded-lg">
                        <span class="text-gray-700 font-semibold text-sm">Buku Dipinjam</span>
                        <span class="text-2xl font-bold text-green-600">{{ $bukuDipinjamHariIni }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <p class="font-bold text-lg text-gray-600">Tahun ini</p>
                    <div class="flex justify-between items-center p-4 bg-blue-100 rounded-lg">
                        <span class="text-gray-700 font-semibold text-sm">Jumlah Peminjam</span>
                        <span class="text-2xl font-bold text-[#0077B6]">{{ $peminjamTahunIni }}</span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-green-100 rounded-lg">
                        <span class="text-gray-700 font-semibold text-sm">Buku Dipinjam</span>
                        <span class="text-2xl font-bold text-green-600">{{ $bukuDipinjamTahunIni }}</span>
                    </div>
                </div>
                <form method="GET" action="{{ route('kepala.exportJSON') }}" class="flex gap-2 mt-4">
                    <select name="bulan" class="border-[2px] px-3 h-10 rounded-[20px] bg-white text-[#0077B6] font-bold focus:outline-none focus:ring-2 focus:ring-[#0077B6]">
                        @foreach(range(1, 12) as $bulan)
                            <option value="{{ $bulan }}" {{ $bulan == now()->month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($bulan)->locale('id')->monthName }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="border-[2px] px-4 h-10 rounded-[20px] bg-white text-[#0077B6] font-bold hover:bg-[#caf0f8] transition-colors">
                        Unduh Laporan
                    </button>
                </form>
            </div>

            <!-- Middle Column (Card 2 & 3) -->
            <div class="lg:col-span-6 space-y-5">
                <!-- Card 2  -->
                <div class="bg-white rounded-[20px] shadow-lg p-5 duration-300">
                    <h3 class="text-xl font-bold text-[#03045E] mb-4">Statistik Peminjam per Bulan ({{ date('Y') }})</h3>
                    <div class="w-full h-[220px]">
                        <canvas id="chartPeminjamPerBulan"></canvas>
                    </div>
                </div>

                <!-- Card 3  -->
                <div class="bg-white rounded-[20px] shadow-lg p-5">
                    <h3 class="text-xl font-bold text-[#03045E] mb-4">Statistik Buku Hilang per Bulan ({{ date('Y') }})</h3>
                    <div class="w-full h-[220px]">
                        <canvas id="chartBukuHilangPerBulan"></canvas>
                    </div>
                </div>
            </div>

            <!-- Card 4  -->
            <div class="lg:col-span-3 bg-white rounded-[20px] shadow-lg p-5">
                <h3 class="text-xl font-bold text-[#03045E] mb-4">Status Buku Real-Time</h3>
                <div class="w-full h-[500px] flex items-center justify-center">
                    <canvas id="chartStatusBuku"></canvas>
                </div>
            </div>

        </div>
         <div class="absolute bottom-10 right-12">
            <button onclick= "window.location.href='{{ route('logout') }}'" class="flex items-center justify-center bg-[#0077B6] text-white px-4 py-2 rounded-full w-16 h-16 hover:scale-110 hover:shadow-lg transition-transform duration-300 ease-in-out">
                <img src="{{ asset('images/siswa-page/material-symbols_logout.svg') }}" alt="Exit" class="w-8 h-8">
            </button>
         </div> 
    </div>
</body>
</html>