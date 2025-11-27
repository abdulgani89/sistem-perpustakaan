document.addEventListener('DOMContentLoaded', function() {
    const dftButton = document.getElementById('dftButton');
    const contentDiv = document.getElementById('siswa-content');

    dftButton.addEventListener('click', () => {
        // Fade out terlebih dahulu jika ada konten
        if (contentDiv.innerHTML.trim() !== '') {
            contentDiv.classList.remove('opacity-100', 'translate-y-0');
            contentDiv.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                loadContent();
            }, 300);
        } else {
            loadContent();
        }
    });

    function loadContent() {
        fetch('/siswa/daftar-buku')
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
                
                // Trigger animasi fade in
                setTimeout(() => {
                    contentDiv.classList.remove('opacity-0', 'translate-y-4');
                    contentDiv.classList.add('opacity-100', 'translate-y-0');
                }, 50);
            })
            .catch(error => {
                console.error('Error fetching daftar buku:', error);
            });
    }

    // Fungsi global untuk menutup konten dengan animasi
    window.closeContent = function() {
        contentDiv.classList.remove('opacity-100', 'translate-y-0');
        contentDiv.classList.add('opacity-0', 'translate-y-4');
        
        setTimeout(() => {
            contentDiv.innerHTML = '';
        }, 500);
    };
});