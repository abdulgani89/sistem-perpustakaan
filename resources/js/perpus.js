document.addEventListener('DOMContentLoaded', () => {
    const contentDiv = document.getElementById('admin-content');
    
    // Load dashboard default dan set sebagai active
    loadContent('/admin/dashboard');
    setActiveButton('dashButton');

    document.getElementById('dashButton').addEventListener('click', () => {
        loadContent('/admin/dashboard');
        setActiveButton('dashButton');
    });

    document.getElementById('bookButton').addEventListener('click', () => {
        loadContent('/admin/buku');
        setActiveButton('bookButton');
    });

    document.getElementById('studentButton').addEventListener('click', () => {
        loadContent('/admin/siswa');
        setActiveButton('studentButton');
    });

    document.getElementById('transactionButton').addEventListener('click', () => {
        loadContent('/admin/transaksi');
        setActiveButton('transactionButton');
    });

    document.getElementById('activityButton').addEventListener('click', () => {
        loadContent('/admin/aktivitas');
        setActiveButton('activityButton');
    });
});

function setActiveButton(buttonId) {
    // Remove active state dari semua tombol
    const allButtons = document.querySelectorAll('nav button');
    allButtons.forEach(btn => {
        btn.classList.remove('bg-[#CAF0F8]');
        btn.classList.add('bg-[#90E0EF]', 'group');
    });
    
    // Add active state ke tombol yang diklik
    const activeButton = document.getElementById(buttonId);
    if (activeButton) {
        activeButton.classList.remove('bg-[#90E0EF]', 'group');
        activeButton.classList.add('bg-[#CAF0F8]');
    }
}

function loadContent(url) {
    const contentDiv = document.getElementById('admin-content');
    
    if (contentDiv.innerHTML.trim() !== '') {
        contentDiv.classList.remove('opacity-100', 'translate-y-0');
        contentDiv.classList.add('opacity-0', 'translate-y-4');
        
        setTimeout(() => {
            fetchContent(url, contentDiv);
        }, 300);
    } else {
        fetchContent(url, contentDiv);
    }
}

function fetchContent(url, contentDiv) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            contentDiv.innerHTML = data;
            
            // Trigger animasi fade in
            setTimeout(() => {
                contentDiv.classList.remove('opacity-0', 'translate-y-4');
                contentDiv.classList.add('opacity-100', 'translate-y-0');
            }, 50);
            
            // Setup event listeners untuk konten yang baru dimuat
            setupDynamicEventListeners();
        })
        .catch(error => {
            console.error('Error fetching content:', error);
            contentDiv.innerHTML = '<div class="bg-red-100 text-red-700 p-4 rounded-lg">Terjadi kesalahan saat memuat konten: ' + error.message + '</div>';
            contentDiv.classList.remove('opacity-0', 'translate-y-4');
            contentDiv.classList.add('opacity-100', 'translate-y-0');
        });
}

// Setup event listeners untuk konten dinamis
function setupDynamicEventListeners() {
    // Modal Tambah Buku
    const btnTambahBuku = document.getElementById('btnTambahBuku');
    const modalTambahBuku = document.getElementById('modalTambahBuku');
    const modalContent = document.getElementById('modalContent');
    const closeModalTambah = document.getElementById('closeModalTambah');
    const btnCancelTambah = document.getElementById('btnCancelTambah');
    const formTambahBuku = document.getElementById('formTambahBuku');
    
    if (btnTambahBuku) {
        btnTambahBuku.addEventListener('click', () => {
            modalTambahBuku.style.display = 'flex';
            // Trigger animasi setelah modal muncul
            setTimeout(() => {
                modalContent.style.transform = 'scale(1)';
                modalContent.style.opacity = '1';
            }, 10);
        });
    }
    
    const closeModal = () => {
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        setTimeout(() => {
            modalTambahBuku.style.display = 'none';
            formTambahBuku.reset();
            clearErrors();
        }, 300);
    };
    
    if (closeModalTambah) {
        closeModalTambah.addEventListener('click', closeModal);
    }
    
    if (btnCancelTambah) {
        btnCancelTambah.addEventListener('click', closeModal);
    }
    
    // Close modal ketika klik di luar modal content
    if (modalTambahBuku) {
        modalTambahBuku.addEventListener('click', (e) => {
            if (e.target === modalTambahBuku) {
                closeModal();
            }
        });
    }
    
    if (formTambahBuku) {
        formTambahBuku.addEventListener('submit', handleSubmitTambahBuku);
    }
    
    // Event delegation untuk tombol Edit dan Hapus
    document.addEventListener('click', (e) => {
        // Tombol Edit
        if (e.target.classList.contains('btnEditBuku')) {
            const bookId = e.target.getAttribute('data-id');
            openEditModal(bookId);
        }
        
        // Tombol Hapus
        if (e.target.classList.contains('btnHapusBuku')) {
            const bookId = e.target.getAttribute('data-id');
            deleteBuku(bookId);
        }
    });
    
    // Modal Edit Buku
    const modalEditBuku = document.getElementById('modalEditBuku');
    const modalEditContent = document.getElementById('modalEditContent');
    const closeModalEdit = document.getElementById('closeModalEdit');
    const btnCancelEdit = document.getElementById('btnCancelEdit');
    const formEditBuku = document.getElementById('formEditBuku');
    
    const closeEditModal = () => {
        if (modalEditContent && modalEditBuku) {
            modalEditContent.style.transform = 'scale(0.95)';
            modalEditContent.style.opacity = '0';
            setTimeout(() => {
                modalEditBuku.style.display = 'none';
                if (formEditBuku) formEditBuku.reset();
                clearEditErrors();
            }, 300);
        }
    };
    
    if (closeModalEdit) {
        closeModalEdit.addEventListener('click', closeEditModal);
    }
    
    if (btnCancelEdit) {
        btnCancelEdit.addEventListener('click', closeEditModal);
    }
    
    if (modalEditBuku) {
        modalEditBuku.addEventListener('click', (e) => {
            if (e.target === modalEditBuku) {
                closeEditModal();
            }
        });
    }
    
    if (formEditBuku) {
        formEditBuku.addEventListener('submit', handleSubmitEditBuku);
    }
}

// Handle submit form tambah buku
function handleSubmitTambahBuku(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    // Disable button submit
    const btnSubmit = document.getElementById('btnSubmitTambah');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Menyimpan...';
    
    // Clear previous errors
    clearErrors();
    
    fetch('/admin/buku/store', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            // Tampilkan validation errors
            Object.keys(data.errors).forEach(key => {
                const errorSpan = document.getElementById(`error_${key}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[key][0];
                }
            });
        } else {
            // Success
            alert(data.message || 'Buku berhasil ditambahkan!');
            
            // Tutup modal dengan animasi
            const modalContent = document.getElementById('modalContent');
            modalContent.style.transform = 'scale(0.95)';
            modalContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalTambahBuku').style.display = 'none';
                document.getElementById('formTambahBuku').reset();
                
                // Reload content buku
                loadContent('/admin/buku');
            }, 300);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan data: ' + error.message);
    })
    .finally(() => {
        btnSubmit.disabled = false;
        btnSubmit.textContent = 'Simpan';
    });
}

// Clear error messages
function clearErrors() {
    const errorSpans = document.querySelectorAll('[id^="error_"]');
    errorSpans.forEach(span => {
        span.textContent = '';
    });
}

function clearEditErrors() {
    const errorSpans = document.querySelectorAll('[id^="edit_error_"]');
    errorSpans.forEach(span => {
        span.textContent = '';
    });
}

// Open edit modal dan load data buku
function openEditModal(bookId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch(`/admin/buku/${bookId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Isi form dengan data buku
        document.getElementById('edit_id_buku').value = data.id_buku;
        document.getElementById('edit_kode_buku').value = data.kode_buku || '';
        document.getElementById('edit_judul_buku').value = data.judul_buku;
        document.getElementById('edit_pengarang').value = data.pengarang;
        document.getElementById('edit_penerbit').value = data.penerbit;
        document.getElementById('edit_tahun_terbit').value = data.tahun_terbit || '';
        document.getElementById('edit_kategori').value = data.kategori;
        document.getElementById('edit_stok').value = data.stok;
        document.getElementById('edit_status').value = data.status;
        
        // Tampilkan modal
        const modalEditBuku = document.getElementById('modalEditBuku');
        const modalEditContent = document.getElementById('modalEditContent');
        modalEditBuku.style.display = 'flex';
        setTimeout(() => {
            modalEditContent.style.transform = 'scale(1)';
            modalEditContent.style.opacity = '1';
        }, 10);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal memuat data buku');
    });
}

// Handle submit form edit buku
function handleSubmitEditBuku(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const bookId = document.getElementById('edit_id_buku').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    const btnSubmit = document.getElementById('btnSubmitEdit');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Mengupdate...';
    
    clearEditErrors();
    
    fetch(`/admin/buku/${bookId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            Object.keys(data.errors).forEach(key => {
                const errorSpan = document.getElementById(`edit_error_${key}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[key][0];
                }
            });
        } else {
            alert(data.message || 'Buku berhasil diupdate!');
            
            const modalEditContent = document.getElementById('modalEditContent');
            modalEditContent.style.transform = 'scale(0.95)';
            modalEditContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalEditBuku').style.display = 'none';
                document.getElementById('formEditBuku').reset();
                loadContent('/admin/buku');
            }, 300);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengupdate data');
    })
    .finally(() => {
        btnSubmit.disabled = false;
        btnSubmit.textContent = 'Update';
    });
}

// Delete buku
function deleteBuku(bookId) {
    const confirmed = confirm('Apakah Anda yakin ingin menghapus buku ini?');
    
    if (!confirmed) {
        return; // Batalkan jika user pilih cancel
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch(`/admin/buku/${bookId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || 'Buku berhasil dihapus!');
        loadContent('/admin/buku');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menghapus buku');
    });
}