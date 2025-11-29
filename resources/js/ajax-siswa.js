import { set } from "lodash";

document.addEventListener('DOMContentLoaded', function() {
    const dftButton = document.getElementById('dftButton');
    const contentDiv = document.getElementById('siswa-content');
    const dftPinjamanButton = document.getElementById('dftPinjamanButton');
    const bkDipinjamButton = document.getElementById('bkDipinjamButton');

    
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

    window.pinjamBuku = function(idBuku){
        if(!confirm('Apakah Anda yakin ingin meminjam buku ini?')){
            return;
        }

        fetch('/siswa/pinjam-buku', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_buku: idBuku })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✓ ' + data.message + '\nID Peminjaman: ' + data.data.id_peminjaman);
                closeContent();
            } else {
                alert('✗ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat meminjam buku.');
        });
    };
});