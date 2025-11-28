document.addEventListener('DOMContentLoaded', function() {
    const dftButton = document.getElementById('dftButton');
    const contentDiv = document.getElementById('siswa-content');
    const dftPinjamanButton = document.getElementById('dftPinjamanButton');

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
});