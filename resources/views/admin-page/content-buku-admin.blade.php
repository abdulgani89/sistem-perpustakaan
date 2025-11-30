<div>
    <h1 class="text-3xl font-bold text-[#03045E] mb-6">Manajemen Buku</h1>
    
    <!-- Layout Grid: 1 card besar di kiri, 3 card kecil di kanan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Card Utama Kiri (Span 2 kolom) -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#03045E]">Daftar Buku</h2>
                <button id="btnTambahBuku" class="px-4 py-2 bg-[#03045E] text-white rounded-lg hover:bg-[#023E8A] transition">
                    + Tambah Buku
                </button>
            </div>
            
            <!-- Tabel Buku -->
            <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                <table class="min-w-full">
                    <thead class="bg-[#03045E] text-white sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Kode</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Judul</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Pengarang</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Penerbit</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Tahun</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Kategori</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Stok</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr class="border-b hover:bg-[#CAF0F8] transition duration-150">
                            <td class="px-4 py-3 text-sm">{{ $book->kode_buku ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $book->judul_buku }}</td>
                            <td class="px-4 py-3 text-sm">{{ $book->pengarang }}</td>
                            <td class="px-4 py-3 text-sm">{{ $book->penerbit }}</td>
                            <td class="px-4 py-3 text-sm">{{ $book->tahun_terbit ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $book->kategori }}</td>
                            <td class="px-4 py-3 text-sm">{{ $book->stok }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-semibold 
                                    {{ $book->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button class="btnEditBuku text-[#0077B6] hover:text-[#023E8A] text-sm font-semibold mr-3" data-id="{{ $book->id_buku }}">Edit</button>
                                <button class="btnHapusBuku text-red-600 hover:text-red-800 text-sm font-semibold" data-id="{{ $book->id_buku }}">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <p class="font-semibold">Belum ada data buku</p>
                                    <p class="text-sm">Klik tombol "Tambah Buku" untuk menambahkan buku baru</p>
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
            
            <!-- Card 1: Total Buku -->
            <div class="bg-gradient-to-br from-[#0077B6] to-[#023E8A] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Total Buku</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $totalBuku ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 2: Buku Tersedia -->
            <div class="bg-gradient-to-br from-[#0096C7] to-[#0077B6] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Buku Tersedia</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $bukuTersedia ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Card 3: Buku Dipinjam -->
            <div class="bg-gradient-to-br from-[#00B4D8] to-[#0096C7] rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-90">Buku Dipinjam</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $bukuDipinjam ?? 0 }}</h3>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Modal Tambah Buku -->
<div id="modalTambahBuku" style="display: none; background-color: rgba(0, 0, 0, 0.3);" class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform transition-all duration-300" style="transform: scale(0.95); opacity: 0;" id="modalContent">
        <div class="bg-[#03045E] text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-2xl font-bold">Tambah Buku Baru</h3>
            <button id="closeModalTambah" type="button" class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>
        
        <form id="formTambahBuku" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Buku -->
                <div class="col-span-2 md:col-span-1">
                    <label for="kode_buku" class="block text-sm font-bold text-gray-700 mb-2">Kode Buku</label>
                    <input type="text" id="kode_buku" name="kode_buku" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: BK001">
                    <span class="text-red-500 text-sm" id="error_kode_buku"></span>
                </div>

                <!-- Judul Buku -->
                <div class="col-span-2 md:col-span-1">
                    <label for="judul_buku" class="block text-sm font-bold text-gray-700 mb-2">Judul Buku <span class="text-red-500">*</span></label>
                    <input type="text" id="judul_buku" name="judul_buku" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Laskar Pelangi">
                    <span class="text-red-500 text-sm" id="error_judul_buku"></span>
                </div>

                <!-- Pengarang -->
                <div class="col-span-2 md:col-span-1">
                    <label for="pengarang" class="block text-sm font-bold text-gray-700 mb-2">Pengarang <span class="text-red-500">*</span></label>
                    <input type="text" id="pengarang" name="pengarang" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Andrea Hirata">
                    <span class="text-red-500 text-sm" id="error_pengarang"></span>
                </div>

                <!-- Penerbit -->
                <div class="col-span-2 md:col-span-1">
                    <label for="penerbit" class="block text-sm font-bold text-gray-700 mb-2">Penerbit <span class="text-red-500">*</span></label>
                    <input type="text" id="penerbit" name="penerbit" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Bentang Pustaka">
                    <span class="text-red-500 text-sm" id="error_penerbit"></span>
                </div>

                <!-- Tahun Terbit -->
                <div class="col-span-2 md:col-span-1">
                    <label for="tahun_terbit" class="block text-sm font-bold text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit" min="1900" max="{{ date('Y') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: 2005">
                    <span class="text-red-500 text-sm" id="error_tahun_terbit"></span>
                </div>

                <!-- Kategori -->
                <div class="col-span-2 md:col-span-1">
                    <label for="kategori" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="kategori" name="kategori" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Contoh: Fiksi, Non-Fiksi, Sejarah">
                    <span class="text-red-500 text-sm" id="error_kategori"></span>
                </div>

                <!-- Stok -->
                <div class="col-span-2 md:col-span-1">
                    <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                    <input type="number" id="stok" name="stok" min="1" value="1" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent"
                           placeholder="Jumlah buku">
                    <span class="text-red-500 text-sm" id="error_stok"></span>
                </div>

                <!-- Status -->
                <div class="col-span-2 md:col-span-1">
                    <label for="status" class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                        <option value="tersedia" selected>Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                    </select>
                    <span class="text-red-500 text-sm" id="error_status"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="btnCancelTambah" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300">
                    Batal
                </button>
                <button type="submit" id="btnSubmitTambah" class="px-6 py-2 bg-[#03045E] hover:bg-[#023E8A] text-white font-bold rounded-lg transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Buku -->
<div id="modalEditBuku" style="display: none; background-color: rgba(0, 0, 0, 0.3);" class="fixed inset-0 z-50 flex items-center justify-center transition-all duration-300">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto transform transition-all duration-300" style="transform: scale(0.95); opacity: 0;" id="modalEditContent">
        <div class="bg-[#03045E] text-white px-6 py-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-2xl font-bold">Edit Buku</h3>
            <button id="closeModalEdit" type="button" class="text-white hover:text-gray-300 text-3xl font-bold">&times;</button>
        </div>
        
        <form id="formEditBuku" class="p-6">
            @csrf
            <input type="hidden" id="edit_id_buku" name="id_buku">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Buku -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_kode_buku" class="block text-sm font-bold text-gray-700 mb-2">Kode Buku</label>
                    <input type="text" id="edit_kode_buku" name="kode_buku" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_kode_buku"></span>
                </div>

                <!-- Judul Buku -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_judul_buku" class="block text-sm font-bold text-gray-700 mb-2">Judul Buku <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_judul_buku" name="judul_buku" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_judul_buku"></span>
                </div>

                <!-- Pengarang -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_pengarang" class="block text-sm font-bold text-gray-700 mb-2">Pengarang <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_pengarang" name="pengarang" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_pengarang"></span>
                </div>

                <!-- Penerbit -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_penerbit" class="block text-sm font-bold text-gray-700 mb-2">Penerbit <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_penerbit" name="penerbit" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_penerbit"></span>
                </div>

                <!-- Tahun Terbit -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_tahun_terbit" class="block text-sm font-bold text-gray-700 mb-2">Tahun Terbit</label>
                    <input type="number" id="edit_tahun_terbit" name="tahun_terbit" min="1900" max="{{ date('Y') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_tahun_terbit"></span>
                </div>

                <!-- Kategori -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_kategori" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="edit_kategori" name="kategori" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_kategori"></span>
                </div>

                <!-- Stok -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_stok" class="block text-sm font-bold text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                    <input type="number" id="edit_stok" name="stok" min="1" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                    <span class="text-red-500 text-sm" id="edit_error_stok"></span>
                </div>

                <!-- Status -->
                <div class="col-span-2 md:col-span-1">
                    <label for="edit_status" class="block text-sm font-bold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select id="edit_status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#03045E] focus:border-transparent">
                        <option value="tersedia">Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                    </select>
                    <span class="text-red-500 text-sm" id="edit_error_status"></span>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" id="btnCancelEdit" class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition duration-300">
                    Batal
                </button>
                <button type="submit" id="btnSubmitEdit" class="px-6 py-2 bg-[#03045E] hover:bg-[#023E8A] text-white font-bold rounded-lg transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>