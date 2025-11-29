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
        })
        .catch(error => {
            console.error('Error fetching content:', error);
            contentDiv.innerHTML = '<div class="bg-red-100 text-red-700 p-4 rounded-lg">Terjadi kesalahan saat memuat konten.</div>';
            contentDiv.classList.remove('opacity-0', 'translate-y-4');
            contentDiv.classList.add('opacity-100', 'translate-y-0');
        });
}