<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#caf0f8] min-h-screen">
    <div class="w-full h-screen relative overflow-hidden">
        <!-- User Badge -->
         <div class = "h-[77px] w-[180px] top-4 left-4 bg-[#90E0EF] backdrop-blur-md rounded-[20px] px-4 py-2 flex items-center space-x-3 mt-5 ml-5">
            <img src="{{ asset('images/iconoir_profile-circle.svg') }}" alt="User Avatar" class="w-10 h-10 rounded-full border-2 border-white">
            <div class="w-24 h-7 justify-start text-sky-600 text-2xl font-bold font-['Roboto']">Siswa</div>
         </div>
         
         <!-- Search bar -->
          <div class="absolute left-[360px] top-[125px] w-[720px] max-w-[720px] h-[83px]">
            <div class="flex items-center h-full bg-white border border-[#00b4d8] rounded-[28px] px-2 shadow-sm">
                <!-- Menu Icon -->
                <div class="flex items-center justify-center w-12 h-12 flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors cursor-pointer">
                        <svg class="w-6 h-6 text-[#1d1b20]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Search Input -->
                <input 
                    type="text" 
                    placeholder="Cari Buku" 
                    class="flex-1 h-full px-5 text-[#49454f] text-base font-normal font-['Roboto'] tracking-[0.5px] bg-transparent border-none outline-none focus:outline-none"
                >
                
                <!-- Search Icon -->
                <div class="flex items-center justify-center w-12 h-12 flex-shrink-0">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-100 transition-colors cursor-pointer">
                        <svg class="w-6 h-6 text-[#1d1b20]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
          </div>
    </div>
</body>
</html>