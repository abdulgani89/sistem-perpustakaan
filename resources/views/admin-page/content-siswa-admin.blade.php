<div>
    <h1 class="text-3xl font-bold text-[#03045E] mb-6">Manajemen Siswa</h1>
    
    <!-- Layout Grid: 1 card besar di kiri, 3 card kecil di kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Card Utama Kiri (Span 2 kolom) -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#03045E]">Daftar Siswa</h2>
                <button id="btnTambahSiswa" class="px-4 py-2 bg-[#0077B6] text-white rounded-lg hover:bg-[#023E8A] transition">
                    + Tambah Siswa
                </button>
            </div>
            
            <!-- Tabel Siswa -->
            <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                <table class="min-w-full">
                    <thead class="bg-[#03045E] text-white sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">NIS</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Nama Siswa</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Kelas</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Alamat</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Username</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr class="border-b hover:bg-[#CAF0F8] transition duration-150">
                            <td class="px-4 py-3 text-sm">{{ $student->nis }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $student->nama_siswa }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->kelas }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->alamat }}</td>
                            <td class="px-4 py-3 text-sm">{{ $student->user->username ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <button class="btnEditSiswa text-[#0077B6] hover:text-[#023E8A] text-sm font-semibold mr-3" data-id="{{ $student->id_siswa }}">Edit</button>
                                <button class="btnHapusSiswa text-red-600 hover:text-red-800 text-sm font-semibold" data-id="{{ $student->id_siswa }}">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <p class="font-semibold">Belum ada data siswa</p>
                                    <p class="text-sm">Klik tombol "Tambah Siswa" untuk menambahkan siswa baru</p>
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
            
            <!-- Card 1: Total Siswa -->
            <div class="bg-gradient-to-br from-[#0077B6] to-[#023E8A] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Siswa</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalSiswa ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 2: Siswa Aktif Meminjam -->
            <div class="bg-gradient-to-br from-[#0096C7] to-[#0077B6] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Siswa Aktif Meminjam</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $siswaAktif ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 3: Total Kelas -->
            <div class="bg-gradient-to-br from-[#00B4D8] to-[#0096C7] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Kelas</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalKelas ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div id="modalTambahSiswa" style="display: none; background-color: rgba(0, 0, 0, 0.3);" class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform transition-all duration-300" style="transform: scale(0.95); opacity: 0;" id="modalSiswaContent">
        <div class="bg-[#03045E] text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-2xl font-bold">Tambah Siswa Baru</h3>
            <button id="closeModalTambahSiswa" type="button" class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>
        
        <form id="formTambahSiswa" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NIS -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nis" class="block text-sm font-bold text-gray-700 mb-2">NIS <span class="text-red-500">*</span></label>
                    <input type="number" id="nis" name="nis" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: 12345">
                    <span class="text-red-500 text-sm" id="error_nis"></span>
                </div>

                <!-- Nama Siswa -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nama_siswa" class="block text-sm font-bold text-gray-700 mb-2">Nama Siswa <span class="text-red-500">*</span></label>
                    <input type="text" id="nama_siswa" name="nama_siswa" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Ahmad Zaki">
                    <span class="text-red-500 text-sm" id="error_nama_siswa"></span>
                </div>

                <!-- Kelas -->
                <div class="col-span-2 md:col-span-1">
                    <label for="kelas" class="block text-sm font-bold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                    <input type="text" id="kelas" name="kelas" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: XII IPA 1">
                    <span class="text-red-500 text-sm" id="error_kelas"></span>
                </div>

                <!-- Alamat -->
                <div class="col-span-2 md:col-span-1">
                    <label for="alamat" class="block text-sm font-bold text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" id="alamat" name="alamat" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Jl. Merdeka No. 10">
                    <span class="text-red-500 text-sm" id="error_alamat"></span>
                </div>

                <!-- Username -->
                <div class="col-span-2 md:col-span-1">
                    <label for="username" class="block text-sm font-bold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Username untuk login">
                    <span class="text-red-500 text-sm" id="error_username"></span>
                </div>

                <!-- Password -->
                <div class="col-span-2 md:col-span-1">
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Minimal 6 karakter">
                    <span class="text-red-500 text-sm" id="error_password"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="btnCancelTambahSiswa" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300">
                    Batal
                </button>
                <button type="submit" id="btnSubmitTambahSiswa" class="px-6 py-2 bg-[#03045E] hover:bg-[#023E8A] text-white font-bold rounded-lg transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div id="modalEditSiswa" style="display: none; background-color: rgba(0, 0, 0, 0.3);" class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform transition-all duration-300" style="transform: scale(0.95); opacity: 0;" id="modalEditSiswaContent">
        <div class="bg-[#03045E] text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-2xl font-bold">Edit Siswa</h3>
            <button id="closeModalEditSiswa" type="button" class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>
        
        <form id="formEditSiswa" class="p-6">
            @csrf
            <input type="hidden" id="edit_id_siswa" name="id_siswa">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- NIS -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_nis" class="block text-sm font-bold text-gray-700 mb-2">NIS <span class="text-red-500">*</span></label>
                    <input type="number" id="edit_nis" name="nis" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_nis"></span>
                </div>

                <!-- Nama Siswa -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_nama_siswa" class="block text-sm font-bold text-gray-700 mb-2">Nama Siswa <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_nama_siswa" name="nama_siswa" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_nama_siswa"></span>
                </div>

                <!-- Kelas -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_kelas" class="block text-sm font-bold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_kelas" name="kelas" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_kelas"></span>
                </div>

                <!-- Alamat -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_alamat" class="block text-sm font-bold text-gray-700 mb-2">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_alamat" name="alamat" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_alamat"></span>
                </div>

                <!-- Username (readonly) -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_username" class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <input type="text" id="edit_username" name="username" readonly
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                    <span class="text-xs text-gray-500">Username tidak dapat diubah</span>
                </div>

                <!-- Password (optional) -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_password" class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                    <input type="password" id="edit_password" name="password"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                    <span class="text-red-500 text-sm" id="edit_error_password"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="btnCancelEditSiswa" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300">
                    Batal
                </button>
                <button type="submit" id="btnSubmitEditSiswa" class="px-6 py-2 bg-[#03045E] hover:bg-[#023E8A] text-white font-bold rounded-lg transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>