<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/perpus.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body class="bg-[#CAF0F8] min-h-screen">
    <div class = "w-full h-screen relative overflow-hidden">
        <!-- sidebar --> 
        <div class="h-[94px] w-[305px] bg-[#03045E] backdrop-blur-md px-6 py-4 absolute left-0 top-0 flex flex-col items-center"></div>
        <div class="h-full w-[305px] bg-[#90E0EF] mt-[94px] pt-[23px] pl-2">
            <nav class="flex flex-col gap-2">
                <button type="button" id="dashButton" class="group flex items-center justify-between h-[60px] pl-2 pr-2 bg-[#CAF0F8] border-l-4 border-[#03045E] text-[#03045E] font-[Roboto] font-bold text-xl " >
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
        <!-- content -->
         <div class ="ml-[305px] pt-6 pb-6 pr-6 pl-6">
            <div id="admin-content" class="opacity-0 transition-all duration-500 ease-in-out translate-y-4">
                <!-- Dynamic content will be loaded here -->
            </div>

         </div>
    </div>
</body>