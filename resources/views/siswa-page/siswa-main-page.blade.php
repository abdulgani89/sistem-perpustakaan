<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Perpustakaan - Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax-siswa.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-[#caf0f8] min-h-screen">
    <div class="w-full h-screen relative overflow-hidden">
        <!-- User Badge -->
         <div class = "h-[77px] w-[180px] top-4 left-4 bg-[#90E0EF] backdrop-blur-md rounded-[20px] px-4 py-2 flex items-center space-x-3 mt-5 ml-5">
            <img src="{{ asset('images/siswa-page/iconoir_profile-circle.svg') }}" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-white">
            <div class="w-24 h-7 justify-start text-sky-600 text-2xl font-bold font-['Roboto']">Siswa</div>
         </div>
         
         <!-- Search bar -->
          <div class="absolute left-1/2 transform -translate-x-1/2 top-[125px] w-[720px] max-w-[720px] h-[83px]">
            <div class="flex items-center h-full bg-white border border-[#00b4d8] rounded-[28px] px-2 shadow-sm">
                <!-- Menu Icon -->
                <div class="flex items-center justify-center w-12 h-12 flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors cursor-pointer">
                        <img src="{{ asset('images/siswa-page/Icon.svg') }}" alt="Menu" class="w-6 h-6">
                    </div>
                </div>
                
                <!-- Search Input -->
                <input
                    id="searchInput"
                    type="text" 
                    placeholder="Cari Buku" 
                    class="flex-1 h-full px-5 text-[#49454f] text-base font-normal font-['Roboto'] tracking-[0.5px] bg-transparent border-none outline-none focus:outline-none"
                >
                
                <!-- Search Icon -->
                <div class="flex items-center justify-center w-12 h-12 flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors cursor-pointer">
                        <img src="{{ asset('images/siswa-page/icon-search-bar.svg') }}" alt="Search" class="w-6 h-6">
                    </div>
                </div>
            </div>
          </div>

          <!-- List button -->
        <div class="flex gap-[93px] mt-60 absolute left-1/2 transform -translate-x-1/2 w-[1200px] max-w-[1200px]">
            <button id="dftButton" class="flex flex-col items-center justify-center bg-[#90E0EF] text-white px-4 py-2 rounded-[20px] w-[323px] h-[240px] px-[89px] transition-transform duration-300 ease-in-out hover:scale-110 hover:shadow-lg active:scale-90 duration-200" >
                <img src="{{ asset('images/siswa-page/tdesign_book.svg') }}" alt="List Buku">
                <div class = "font-[Roboto] font-bold text-2xl text-[#0077B6] mt-2">Daftar Buku</div>
            </button>
            <button id="dftPinjamanButton" class="flex flex-col items-center justify-center bg-[#90E0EF] text-white px-4 py-2 rounded-[20px] w-[323px] h-[240px] px-[46px] transition-transform duration-300 ease-in-out hover:scale-110 hover:shadow-lg active:scale-90 duration-200">
                <img src="{{ asset('images/siswa-page/solar_history-line-duotone.svg') }}" alt="History">
                <span class = "font-[Roboto] font-bold text-2xl text-[#0077B6] mt-2">Riwayat Peminjaman</span>
            </button>
            <button id="bkDipinjamButton" class="flex flex-col items-center justify-center bg-[#90E0EF] text-white px-4 py-2 rounded-[20px] w-[323px] h-[240px] px-[89px] transition-transform duration-300 ease-in-out hover:scale-110 hover:shadow-lg active:scale-90 duration-200">
                <img src="{{ asset('images/siswa-page/tabler_refresh.svg') }}" alt="Peminjaman">
                <span class = "font-[Roboto] font-bold text-2xl text-[#0077B6] mt-2">Buku Dipinjam</span>
            </button>
        </div>

        <!-- AJAX Content Container -->
         <div id="siswa-content" class="mt-[160px] absolute left-1/2 transform -translate-x-1/2 w-[1200px] max-w-[1200px] opacity-0 transition-all duration-500 ease-in-out translate-y-4 z-20">

         </div>

        <!-- logout button -->
         <div class="absolute bottom-10 right-12">
            <button onclick= "window.location.href='{{ route('logout') }}'" class="flex items-center justify-center bg-[#0077B6] text-white px-4 py-2 rounded-full w-16 h-16 hover:scale-110 hover:shadow-lg transition-transform duration-300 ease-in-out">
                <img src="{{ asset('images/siswa-page/material-symbols_logout.svg') }}" alt="Exit" class="w-8 h-8">
            </button>
         </div>
    </div>
</body>
</html>