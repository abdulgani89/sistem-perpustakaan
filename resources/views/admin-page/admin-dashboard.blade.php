<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Perpustakaan - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/perpus.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-[#CAF0F8] min-h-screen">
    <div class="w-full min-h-screen relative flex">
        <!-- sidebar --> 
        <div class="fixed left-0 top-0 w-[305px] h-screen bg-[#90E0EF] z-10">
            <div class="h-[94px] w-full bg-[#03045E] backdrop-blur-md px-6 py-4 flex items-center justify-center">
                <div class="flex items-center space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <div class="text-white text-xl font-bold">
                        L-Cerdas Admin Console
                    </div>
                </div>
            </div>
            
            <div class="pt-[23px] pl-2">
                <nav class="flex flex-col gap-2">
                <button type="button" id="dashButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 top bg-[#CAF0F8] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl " >
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/perpus-page/dashboard-perpus.svg') }}" alt="Dashboard Icon" class="group-hover:scale-110 group-hover:rotate-10 transition ease-in-out duration-300 inline-block w-10 h-10">
                        <span class="group-hover:scale-110 transition ease-in-out duration-300">Dashboard</span>
                    </div>
                    <img src="{{ asset('images/perpus-page/arrow.svg') }}" alt="" class="inline-block w-6 h-15 ml-20 group-hover:translate-x-1 transition ease-in-out duration-300">
                </button> 
                <button type="button" id="bookButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 bg-[#90E0EF] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl" >
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/perpus-page/tdesign_book.svg') }}" alt="" class="group-hover:scale-110 group-hover:rotate-10 transition ease-in-out duration-300 inline-block w-10 h-10">
                        <span class="group-hover:scale-110 transition ease-in-out duration-300">Buku</span>
                    </div>
                    <img src="{{ asset('images/perpus-page/arrow.svg') }}" alt="" class="inline-block w-6 h-15 ml-20 group-hover:translate-x-1 transition ease-in-out duration-300">
                </button>
                <button type="button" id="studentButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 bg-[#90E0EF] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl " >
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/perpus-page/Group.svg') }}" alt="Dashboard Icon" class="group-hover:scale-110 group-hover:rotate-10 transition ease-in-out duration-300 inline-block w-10 h-10">
                        <span class="group-hover:scale-110 transition ease-in-out duration-300">Siswa</span>
                    </div>
                    <img src="{{ asset('images/perpus-page/arrow.svg') }}" alt="" class="inline-block w-6 h-15 ml-20 group-hover:translate-x-1 transition ease-in-out duration-300">
                </button>
                <button type="button" id="transactionButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 bg-[#90E0EF] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl " >
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/perpus-page/transaksi.svg') }}" alt="Dashboard Icon" class="group-hover:scale-110 group-hover:rotate-10 transition ease-in-out duration-300 inline-block w-10 h-10">
                        <span class="group-hover:scale-110 transition ease-in-out duration-300">Transaksi</span>
                    </div>
                    <img src="{{ asset('images/perpus-page/arrow.svg') }}" alt="" class="inline-block w-6 h-15 ml-20 group-hover:translate-x-1 transition ease-in-out duration-300">
                </button>
                <button type="button" id="activityButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 bg-[#90E0EF] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl " >
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/perpus-page/Vector.svg') }}" alt="Dashboard Icon" class="group-hover:scale-110 group-hover:rotate-10 transition ease-in-out duration-300 inline-block w-10 h-10">
                        <span class="group-hover:scale-110 transition ease-in-out duration-300">Aktivitas</span>
                    </div>
                    <img src="{{ asset('images/perpus-page/arrow.svg') }}" alt="" class="inline-block w-6 h-15 ml-20 group-hover:translate-x-1 transition ease-in-out duration-300">
                </button>
            </nav>
            </div>
        </div>
        
        <!-- content -->
        <div class="flex-1 ml-[305px] p-6">
            
            <div id="admin-content" class="transition-all duration-500 ease-in-out"></div>
        </div>

        <!-- logout -->
         <div class="absolute bottom-10 right-12">
            <button onclick= "window.location.href='{{ route('logout') }}'" class="flex items-center justify-center bg-[#0077B6] text-white px-4 py-2 rounded-full w-16 h-16 hover:scale-110 hover:shadow-lg transition-transform duration-300 ease-in-out">
                <img src="{{ asset('images/siswa-page/material-symbols_logout.svg') }}" alt="Exit" class="w-8 h-8">
            </button>
         </div>
    </div>
</body>