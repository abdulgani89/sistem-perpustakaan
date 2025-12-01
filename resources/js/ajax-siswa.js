import { set } from "lodash";

document.addEventListener('DOMContentLoaded', function() {
    const dftButton = document.getElementById('dftButton');
    const contentDiv = document.getElementById('siswa-content');
    const dftPinjamanButton = document.getElementById('dftPinjamanButton');
    const bkDipinjamButton = document.getElementById('bkDipinjamButton');
    let bukuTerpilih = null;

    
    dftButton.addEventListener('click', () => {
        if (contentDiv.innerHTML.trim() !== '') {
            contentDiv.classList.remove('opacity-100', 'translate-y-0');
            contentDiv.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                loadContent('/siswa/daftar-buku');
            }, 300);
        } else {
            loadContent('/siswa/daftar-buku');
        }
    });

    dftPinjamanButton.addEventListener('click', () => {
        if (contentDiv.innerHTML.trim() !== '') {
            contentDiv.classList.remove('opacity-100', 'translate-y-0');
            contentDiv.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                loadContent('/siswa/riwayat-peminjaman');
            }, 300);
        } else {
            loadContent('/siswa/riwayat-peminjaman');
        }
    });

    bkDipinjamButton.addEventListener('click', () => {
        if (contentDiv.innerHTML.trim() !== '') {
            contentDiv.classList.remove('opacity-100', 'translate-y-0');
            contentDiv.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                loadContent('/siswa/buku-dipinjam');
            }, 300);
        } else {
            loadContent('/siswa/buku-dipinjam');
        }
    });

    function loadContent(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
                
                setTimeout(() => {
                    contentDiv.classList.remove('opacity-0', 'translate-y-4');
                    contentDiv.classList.add('opacity-100', 'translate-y-0');
                }, 50);
            })
            .catch(error => {
                console.error('Error fetching daftar buku:', error);
            });
    }

    window.closeContent = function() {
        contentDiv.classList.remove('opacity-100', 'translate-y-0');
        contentDiv.classList.add('opacity-0', 'translate-y-4');
        
        setTimeout(() => {
            contentDiv.innerHTML = '';
        }, 500);
    };

    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    let searchTimeout ;

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();
            if (query.length > 0) {
                searchBooks(query);
            } else if (query.length === 0) {
                closeContent();
            }
        });

        // Handle Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query.length > 0) {
                    searchBooks(query);
                }
            }
        });

        searchButton?.addEventListener('click', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            if (query.length > 0) {
                searchBooks(query);
            } else if (query.length === 0) {
                closeContent();
            }
        });
    }

    function searchBooks(query) {
        // Fade out if content exists
        if (contentDiv.innerHTML.trim() !== '') {
            contentDiv.classList.remove('opacity-100', 'translate-y-0');
            contentDiv.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                loadSearchContent(query);
            }, 300);
        } else {
            loadSearchContent(query);
        }
    }

    function loadSearchContent(query) {
        fetch("/siswa/search-book?q=" + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
                
                setTimeout(() => {
                    contentDiv.classList.remove('opacity-0', 'translate-y-4');
                    contentDiv.classList.add('opacity-100', 'translate-y-0');
                }, 50);
            })
            .catch(error => {
                console.error('Error fetching search results:', error);
            });
    }

    window.pinjamBuku = function(idBuku, judulBuku, pengarang){
        bukuTerpilih = { id_buku: idBuku}

        document.getElementById('modalJudulBuku').innerText = judulBuku;
        document.getElementById('modalPengarang').innerText = pengarang;

        document.getElementById('durasiPeminjaman').value = 7;
        document.getElementById('modalPinjam').classList.remove('hidden');
    };

    window.batalPinjam = function(){
        document.getElementById('modalPinjam').classList.add('hidden');
        bukuTerpilih = null;
    };

    window.konfirmasiPinjam = function(){
        if (!bukuTerpilih) return;

        const durasi = document.getElementById('durasiPeminjaman').value;

        if (durasi < 1 || durasi > 14) {
            alert('Durasi peminjaman harus antara 1 hingga 14 hari.');
            return; 
        }

        fetch('/siswa/pinjam-buku', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id_buku: bukuTerpilih.id_buku,
                durasi: durasi
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Buku berhasil dipinjam!');
                window.location.reload();
            } else {
                alert('Gagal meminjam buku: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat meminjam buku.');
        });
    }

    window.bukuTidakTersedia = function(judulBuku) {
        alert('Buku "' + judulBuku + '" sedang tidak tersedia.\nAlasan buku tidak tersedia:\n• Buku sedang dipinjam oleh siswa lain\n• Stok buku habis\n• Buku dalam proses perawatan\n\nSilakan coba lagi nanti atau tanyakan status buku pada admin perpustakaan.\nTerima Kasih 🙏 ');
    };
    
});