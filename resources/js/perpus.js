document.addEventListener('DOMContentLoaded', () => {
    const contentDiv = document.getElementById('admin-content');
    
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
    const allButtons = document.querySelectorAll('nav button');
    allButtons.forEach(btn => {
        btn.classList.remove('bg-[#CAF0F8]');
        btn.classList.add('bg-[#90E0EF]', 'group');
    });
    
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
    const btnTambahBuku = document.getElementById('btnTambahBuku');
    const modalTambahBuku = document.getElementById('modalTambahBuku');
    const modalContent = document.getElementById('modalContent');
    const closeModalTambah = document.getElementById('closeModalTambah');
    const btnCancelTambah = document.getElementById('btnCancelTambah');
    const formTambahBuku = document.getElementById('formTambahBuku');
    
    if (btnTambahBuku) {
        btnTambahBuku.addEventListener('click', () => {
            modalTambahBuku.style.display = 'flex';
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
    
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('btnEditBuku')) {
            const bookId = e.target.getAttribute('data-id');
            openEditModal(bookId);
        }
        
        if (e.target.classList.contains('btnHapusBuku')) {
            const bookId = e.target.getAttribute('data-id');
            deleteBuku(bookId);
        }
        
        if (e.target.classList.contains('btnEditSiswa')) {
            const siswaId = e.target.getAttribute('data-id');
            openEditSiswaModal(siswaId);
        }
        
        if (e.target.classList.contains('btnHapusSiswa')) {
            const siswaId = e.target.getAttribute('data-id');
            deleteSiswa(siswaId);
        }
        
        if (e.target.classList.contains('btnProsesPengembalian')) {
            const idPeminjaman = e.target.getAttribute('data-id');
            const namaSiswa = e.target.getAttribute('data-siswa');
            const judulBuku = e.target.getAttribute('data-buku');
            const terlambat = e.target.getAttribute('data-terlambat');
            const hariTerlambat = e.target.getAttribute('data-hari');
            openPengembalianModal(idPeminjaman, namaSiswa, judulBuku, terlambat, hariTerlambat);
        }
    });
    
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
    
    const btnTambahSiswa = document.getElementById('btnTambahSiswa');
    const modalTambahSiswa = document.getElementById('modalTambahSiswa');
    const modalSiswaContent = document.getElementById('modalSiswaContent');
    const closeModalTambahSiswa = document.getElementById('closeModalTambahSiswa');
    const btnCancelTambahSiswa = document.getElementById('btnCancelTambahSiswa');
    const formTambahSiswa = document.getElementById('formTambahSiswa');
    
    if (btnTambahSiswa) {
        btnTambahSiswa.addEventListener('click', () => {
            modalTambahSiswa.style.display = 'flex';
            setTimeout(() => {
                modalSiswaContent.style.transform = 'scale(1)';
                modalSiswaContent.style.opacity = '1';
            }, 10);
        });
    }
    
    const closeSiswaModal = () => {
        if (modalSiswaContent && modalTambahSiswa) {
            modalSiswaContent.style.transform = 'scale(0.95)';
            modalSiswaContent.style.opacity = '0';
            setTimeout(() => {
                modalTambahSiswa.style.display = 'none';
                if (formTambahSiswa) formTambahSiswa.reset();
                clearSiswaErrors();
            }, 300);
        }
    };
    
    if (closeModalTambahSiswa) {
        closeModalTambahSiswa.addEventListener('click', closeSiswaModal);
    }
    
    if (btnCancelTambahSiswa) {
        btnCancelTambahSiswa.addEventListener('click', closeSiswaModal);
    }
    
    if (modalTambahSiswa) {
        modalTambahSiswa.addEventListener('click', (e) => {
            if (e.target === modalTambahSiswa) {
                closeSiswaModal();
            }
        });
    }
    
    if (formTambahSiswa) {
        formTambahSiswa.addEventListener('submit', handleSubmitTambahSiswa);
    }
    
    const modalEditSiswa = document.getElementById('modalEditSiswa');
    const modalEditSiswaContent = document.getElementById('modalEditSiswaContent');
    const closeModalEditSiswa = document.getElementById('closeModalEditSiswa');
    const btnCancelEditSiswa = document.getElementById('btnCancelEditSiswa');
    const formEditSiswa = document.getElementById('formEditSiswa');
    
    const closeEditSiswaModal = () => {
        if (modalEditSiswaContent && modalEditSiswa) {
            modalEditSiswaContent.style.transform = 'scale(0.95)';
            modalEditSiswaContent.style.opacity = '0';
            setTimeout(() => {
                modalEditSiswa.style.display = 'none';
                if (formEditSiswa) formEditSiswa.reset();
                clearEditSiswaErrors();
            }, 300);
        }
    };
    
    if (closeModalEditSiswa) {
        closeModalEditSiswa.addEventListener('click', closeEditSiswaModal);
    }
    
    if (btnCancelEditSiswa) {
        btnCancelEditSiswa.addEventListener('click', closeEditSiswaModal);
    }
    
    if (modalEditSiswa) {
        modalEditSiswa.addEventListener('click', (e) => {
            if (e.target === modalEditSiswa) {
                closeEditSiswaModal();
            }
        });
    }
    
    if (formEditSiswa) {
        formEditSiswa.addEventListener('submit', handleSubmitEditSiswa);
    }
    
    setupTransaksiEventListeners();
    setupAktivitasEventListeners();
}

function handleSubmitTambahBuku(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    const btnSubmit = document.getElementById('btnSubmitTambah');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Menyimpan...';
    
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
            Object.keys(data.errors).forEach(key => {
                const errorSpan = document.getElementById(`error_${key}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[key][0];
                }
            });
        } else {
            alert(data.message || 'Buku berhasil ditambahkan!');
            
            const modalContent = document.getElementById('modalContent');
            modalContent.style.transform = 'scale(0.95)';
            modalContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalTambahBuku').style.display = 'none';
                document.getElementById('formTambahBuku').reset();
                
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
        btnSubmit.textContent = 'Proses Pengembalian';
    });
}

function setupAktivitasEventListeners() {
    const btnFilterHariIni = document.getElementById('btnFilterHariIni');
    const btnFilterSemua = document.getElementById('btnFilterSemua');
    const btnFilterDenda = document.getElementById('btnFilterDenda');
    
    if (btnFilterHariIni) {
        btnFilterHariIni.addEventListener('click', () => {
            filterPengembalian('today');
            btnFilterHariIni.classList.remove('bg-gray-200', 'text-gray-700');
            btnFilterHariIni.classList.add('bg-[#0077B6]', 'text-white');
            btnFilterSemua.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterSemua.classList.add('bg-gray-200', 'text-gray-700');
            btnFilterDenda.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterDenda.classList.add('bg-gray-200', 'text-gray-700');
        });
    }
    
    if (btnFilterSemua) {
        btnFilterSemua.addEventListener('click', () => {
            filterPengembalian('all');
            btnFilterSemua.classList.remove('bg-gray-200', 'text-gray-700');
            btnFilterSemua.classList.add('bg-[#0077B6]', 'text-white');
            btnFilterHariIni.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterHariIni.classList.add('bg-gray-200', 'text-gray-700');
            btnFilterDenda.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterDenda.classList.add('bg-gray-200', 'text-gray-700');
        });
    }
    
    if (btnFilterDenda) {
        btnFilterDenda.addEventListener('click', () => {
            filterPengembalian('denda');
            btnFilterDenda.classList.remove('bg-gray-200', 'text-gray-700');
            btnFilterDenda.classList.add('bg-[#0077B6]', 'text-white');
            btnFilterHariIni.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterHariIni.classList.add('bg-gray-200', 'text-gray-700');
            btnFilterSemua.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterSemua.classList.add('bg-gray-200', 'text-gray-700');
        });
    }
}

function filterPengembalian(filter) {
    const rows = document.querySelectorAll('#tablePengembalianBody tr');
    
    rows.forEach(row => {
        const filterAttr = row.getAttribute('data-filter');
        const dendaAttr = row.getAttribute('data-denda');
        
        if (!filterAttr) {
            row.style.display = '';
            return;
        }
        
        if (filter === 'all') {
            row.style.display = '';
        } else if (filter === 'today') {
            row.style.display = filterAttr === 'today' ? '' : 'none';
        } else if (filter === 'denda') {
            row.style.display = dendaAttr === 'yes' ? '' : 'none';
        }
    });
}

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


function deleteBuku(bookId) {
    const confirmed = confirm('Apakah Anda yakin ingin menghapus buku ini?');
    
    if (!confirmed) {
        return; 
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


function clearSiswaErrors() {
    const errorSpans = document.querySelectorAll('[id^="error_"]');
    errorSpans.forEach(span => {
        span.textContent = '';
    });
}

function clearEditSiswaErrors() {
    const errorSpans = document.querySelectorAll('[id^="edit_error_"]');
    errorSpans.forEach(span => {
        span.textContent = '';
    });
}


function handleSubmitTambahSiswa(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    const btnSubmit = document.getElementById('btnSubmitTambahSiswa');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Menyimpan...';
    
    clearSiswaErrors();
    
    fetch('/admin/siswa/store', {
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
                const errorSpan = document.getElementById(`error_${key}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[key][0];
                }
            });
        } else {
            alert(data.message || 'Siswa berhasil ditambahkan!');
            
            const modalSiswaContent = document.getElementById('modalSiswaContent');
            modalSiswaContent.style.transform = 'scale(0.95)';
            modalSiswaContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalTambahSiswa').style.display = 'none';
                document.getElementById('formTambahSiswa').reset();
                loadContent('/admin/siswa');
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

function openEditSiswaModal(siswaId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch(`/admin/siswa/${siswaId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit_id_siswa').value = data.id_siswa;
        document.getElementById('edit_nis').value = data.nis;
        document.getElementById('edit_nama_siswa').value = data.nama_siswa;
        document.getElementById('edit_kelas').value = data.kelas;
        document.getElementById('edit_alamat').value = data.alamat;
        document.getElementById('edit_username').value = data.user.username;
        document.getElementById('edit_password').value = '';
        
        const modalEditSiswa = document.getElementById('modalEditSiswa');
        const modalEditSiswaContent = document.getElementById('modalEditSiswaContent');
        modalEditSiswa.style.display = 'flex';
        setTimeout(() => {
            modalEditSiswaContent.style.transform = 'scale(1)';
            modalEditSiswaContent.style.opacity = '1';
        }, 10);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal memuat data siswa');
    });
}


function handleSubmitEditSiswa(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const siswaId = document.getElementById('edit_id_siswa').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    const btnSubmit = document.getElementById('btnSubmitEditSiswa');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Mengupdate...';
    
    clearEditSiswaErrors();
    
    fetch(`/admin/siswa/${siswaId}`, {
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
            alert(data.message || 'Siswa berhasil diupdate!');
            
            const modalEditSiswaContent = document.getElementById('modalEditSiswaContent');
            modalEditSiswaContent.style.transform = 'scale(0.95)';
            modalEditSiswaContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalEditSiswa').style.display = 'none';
                document.getElementById('formEditSiswa').reset();
                loadContent('/admin/siswa');
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


function deleteSiswa(siswaId) {
    const confirmed = confirm('Apakah Anda yakin ingin menghapus siswa ini? Data user juga akan terhapus.');
    
    if (!confirmed) {
        return;
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch(`/admin/siswa/${siswaId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message || 'Siswa berhasil dihapus!');
        loadContent('/admin/siswa');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal menghapus siswa');
    });
}


function setupTransaksiEventListeners() {
    // Filter buttons
    const btnFilterSemua = document.getElementById('btnFilterSemua');
    const btnFilterTerlambat = document.getElementById('btnFilterTerlambat');
    
    if (btnFilterSemua) {
        btnFilterSemua.addEventListener('click', () => {
            filterPeminjaman('semua');
            btnFilterSemua.classList.remove('bg-gray-200', 'text-gray-700');
            btnFilterSemua.classList.add('bg-[#0077B6]', 'text-white');
            btnFilterTerlambat.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterTerlambat.classList.add('bg-gray-200', 'text-gray-700');
        });
    }
    
    if (btnFilterTerlambat) {
        btnFilterTerlambat.addEventListener('click', () => {
            filterPeminjaman('terlambat');
            btnFilterTerlambat.classList.remove('bg-gray-200', 'text-gray-700');
            btnFilterTerlambat.classList.add('bg-[#0077B6]', 'text-white');
            btnFilterSemua.classList.remove('bg-[#0077B6]', 'text-white');
            btnFilterSemua.classList.add('bg-gray-200', 'text-gray-700');
        });
    }
    
    // Modal Pengembalian
    const modalPengembalian = document.getElementById('modalPengembalian');
    const modalPengembalianContent = document.getElementById('modalPengembalianContent');
    const closeModalPengembalian = document.getElementById('closeModalPengembalian');
    const btnCancelPengembalian = document.getElementById('btnCancelPengembalian');
    const formPengembalian = document.getElementById('formPengembalian');
    
    const closePengembalianModal = () => {
        if (modalPengembalianContent && modalPengembalian) {
            modalPengembalianContent.style.transform = 'scale(0.95)';
            modalPengembalianContent.style.opacity = '0';
            setTimeout(() => {
                modalPengembalian.style.display = 'none';
                if (formPengembalian) formPengembalian.reset();
            }, 300);
        }
    };
    
    if (closeModalPengembalian) {
        closeModalPengembalian.addEventListener('click', closePengembalianModal);
    }
    
    if (btnCancelPengembalian) {
        btnCancelPengembalian.addEventListener('click', closePengembalianModal);
    }
    
    if (modalPengembalian) {
        modalPengembalian.addEventListener('click', (e) => {
            if (e.target === modalPengembalian) {
                closePengembalianModal();
            }
        });
    }
    
    if (formPengembalian) {
        formPengembalian.addEventListener('submit', handleSubmitPengembalian);
    }
}

function filterPeminjaman(filter) {
    const rows = document.querySelectorAll('#tablePeminjamanBody tr');
    rows.forEach(row => {
        const status = row.getAttribute('data-status');
        if (filter === 'semua') {
            row.style.display = '';
        } else if (filter === 'terlambat') {
            row.style.display = status === 'terlambat' ? '' : 'none';
        }
    });
}

function openPengembalianModal(idPeminjaman, namaSiswa, judulBuku, terlambat, hariTerlambat) {
    document.getElementById('id_peminjaman').value = idPeminjaman;
    document.getElementById('info_siswa').textContent = namaSiswa;
    document.getElementById('info_buku').textContent = judulBuku;
    

    const now = new Date();
    const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    document.getElementById('tanggal_pengembalian').value = localDateTime;
    

    const dendaContainer = document.getElementById('dendaContainer');
    if (terlambat === '1') {
        dendaContainer.style.display = 'block';
        document.getElementById('info_status').innerHTML = '<span class="text-red-600 font-bold">Terlambat ' + hariTerlambat + ' hari</span>';
        document.getElementById('info_hari_terlambat').textContent = hariTerlambat;
        
        // Hitung denda otomatis (Rp 1000/hari)
        const dendaTotal = parseInt(hariTerlambat) * 1000;
        document.getElementById('denda').value = dendaTotal;
    } else {
        dendaContainer.style.display = 'none';
        document.getElementById('info_status').innerHTML = '<span class="text-green-600 font-bold">Normal</span>';
        document.getElementById('denda').value = 0;
    }
    

    const modalPengembalian = document.getElementById('modalPengembalian');
    const modalPengembalianContent = document.getElementById('modalPengembalianContent');
    modalPengembalian.style.display = 'flex';
    setTimeout(() => {
        modalPengembalianContent.style.transform = 'scale(1)';
        modalPengembalianContent.style.opacity = '1';
    }, 10);
}

function handleSubmitPengembalian(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    const btnSubmit = document.getElementById('btnSubmitPengembalian');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Memproses...';
    
    fetch('/admin/transaksi/pengembalian', {
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
                const errorSpan = document.getElementById(`error_${key}`);
                if (errorSpan) {
                    errorSpan.textContent = data.errors[key][0];
                }
            });
        } else {
            alert(data.message || 'Pengembalian berhasil diproses!');
            
            const modalPengembalianContent = document.getElementById('modalPengembalianContent');
            modalPengembalianContent.style.transform = 'scale(0.95)';
            modalPengembalianContent.style.opacity = '0';
            
            setTimeout(() => {
                document.getElementById('modalPengembalian').style.display = 'none';
                document.getElementById('formPengembalian').reset();
                loadContent('/admin/transaksi');
            }, 300);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pengembalian');
    })
    .finally(() => {
        btnSubmit.disabled = false;
        btnSubmit.textContent = 'Proses Pengembalian';
    });
}