<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Cafe | Dijital Menü</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brandGreen: '#047857', brandGold: '#D4AF37', brandBlue: '#8B9BB4', brandDark: '#022C22', brandBg: '#F8FAFC' },
                    fontFamily: { sans: ['Outfit', 'sans-serif'], serif: ['Cinzel', 'serif'] }
                }
            }
        }
    </script>
    <style>
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.4s ease-out forwards; }
        @keyframes fadeOut { to { opacity: 0; visibility: hidden; } }
        .splash-screen { animation: fadeOut 0.5s ease-in-out 1.5s forwards; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(100%); } to { opacity: 1; transform: translateY(0); } }
        .slide-up { animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes spinY { from { transform: rotateY(0deg); } to { transform: rotateY(360deg); } }
        .globe-spin { animation: spinY 3s linear infinite; transform-style: preserve-3d; }
    </style>
</head>
<body class="bg-brandBg text-brandDark font-sans antialiased min-h-screen flex flex-col">

    <div class="splash-screen fixed inset-0 z-[100] bg-brandGreen flex flex-col items-center justify-center">
        <svg class="globe-spin w-20 h-20 text-brandGold mb-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M2 12h20 M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
        <h1 class="text-4xl font-serif text-white tracking-widest uppercase text-center drop-shadow-md">Center Cafe</h1>
        <p class="text-brandGold mt-3 tracking-[0.2em] font-light text-sm text-center uppercase">Lezzetin Merkezine<br>Hoş Geldiniz</p>
    </div>

    <div id="toast" class="fixed top-8 left-1/2 -translate-x-1/2 bg-brandGreen text-white px-6 py-3 rounded-full shadow-2xl transition-all duration-300 opacity-0 translate-y-[-20px] pointer-events-none z-[300] font-bold text-sm flex items-center gap-2">
        <i class="fa-solid fa-check-circle text-brandGold"></i> <span id="toast-message">Garson çağırıldı!</span>
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 md:px-8 flex flex-col flex-1 relative pb-24">

        <header class="sticky top-0 z-[60] bg-brandBg/95 backdrop-blur-md flex justify-between items-start py-4 md:py-6 border-b border-brandBlue/20 shadow-sm transition-all px-4 md:px-0 -mx-4 md:mx-0">
            <div class="flex items-center gap-3">
                <svg class="globe-spin w-10 h-10 text-brandGold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M2 12h20 M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                <div class="flex flex-col">
                    <span id="site-title" class="font-serif font-bold text-2xl tracking-[0.1em] uppercase text-brandGreen leading-none drop-shadow-sm">Center</span>
                    <span id="site-subtitle" class="text-[0.65rem] font-bold text-brandBlue tracking-widest uppercase mt-1">Cafe & Bistro</span>
                </div>
            </div>

            <div class="flex flex-col items-end gap-2 mt-1">
                <nav class="flex gap-4 md:gap-6 text-brandBlue font-semibold text-sm items-center">
                    <button onclick="switchTab('home')" id="nav-home" class="text-brandGreen border-b-2 border-brandGreen pb-1 transition-all">Vitrin</button>
                    <button onclick="switchTab('menu')" id="nav-menu" class="hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all">Menü</button>
                    <a href="/admin" class="flex items-center gap-1 text-brandBlue hover:text-brandGreen transition-all bg-brandBlue/10 px-3 py-1.5 rounded-full"><i class="fa-solid fa-lock text-xs"></i> Admin</a>
                    <a href="https://search.google.com/local/writereview?placeid=ChIJN1t_tDeuEmsRUsoyG83frY4" target="_blank" id="btn-yorum-yap" class="flex items-center gap-1 text-brandGold hover:text-brandGreen transition-all bg-brandGold/10 px-3 py-1.5 rounded-full"><i class="fa-solid fa-star text-xs"></i> Yorum Yap</a>
                </nav>
            </div>
        </header>

        <div id="home-section" class="flex-1 py-12 flex flex-col md:flex-row gap-10 fade-in">
            <div class="flex-1 flex flex-col justify-center">
                <h1 class="text-5xl md:text-7xl font-serif font-bold uppercase tracking-wide mb-6 text-brandGreen drop-shadow-sm">Lezzetin<br>Merkezi</h1>
                <p class="text-brandBlue text-lg md:text-xl font-light mb-8 max-w-lg">Dünya mutfağından seçkin lezzetler, taptaze kahveler ve unutulmaz anlar için doğru yerdesiniz.</p>
                <div class="flex gap-4 mb-10">
                    <button onclick="switchTab('menu')" class="bg-brandGold text-white px-8 py-3 rounded-full text-sm font-bold tracking-widest uppercase hover:bg-brandGreen hover:shadow-lg transition-all transform hover:-translate-y-1">Menüyü Keşfet</button>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-brandBlue/10 flex flex-col gap-4">
                    <h3 class="font-bold text-brandGreen uppercase tracking-wider mb-1 border-b border-brandBlue/10 pb-3">İşletme Bilgileri</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col gap-3">
                            <p id="info-adres" class="text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-location-dot text-brandGold text-lg w-5"></i> Merkez Mah. No:123</p>
                            <p id="info-telefon" class="text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-phone text-brandGold text-lg w-5"></i> +90 555 123 45 67</p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <p class="text-sm font-medium flex items-center gap-3"><i class="fa-regular fa-clock text-brandGold text-lg w-5"></i> Her Gün: 08:30 - 23:30</p>
                            <p id="info-wifi" class="text-sm font-medium flex items-center gap-3"><i class="fa-solid fa-wifi text-brandGold text-lg w-5"></i> Şifre: <span class="font-bold tracking-wider">center2026</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 hidden md:flex relative justify-end">
                <div class="w-4/5 h-[500px] rounded-[3rem] overflow-hidden shadow-2xl relative">
                    <img src="/images/OIP.jpg.webp" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&fit=crop'">
                    <div class="absolute inset-0 bg-gradient-to-t from-brandGreen/60 to-transparent"></div>
                </div>
            </div>
        </div>

        <div id="menu-section" class="flex-1 hidden flex-col py-8 fade-in">
            <div class="flex gap-2 mb-8 w-full max-w-3xl mx-auto">
                <div class="flex-1 bg-white rounded-full shadow-md px-6 h-14 flex items-center border border-brandBlue/20">
                    <i class="fa-solid fa-search text-brandBlue mr-3"></i>
                    <input type="text" id="menu-arama" placeholder="Menüde lezzet arayın..." oninput="tetikleAramaVeFiltre()" class="w-full bg-transparent outline-none text-base font-medium text-brandDark">
                </div>
                <button onclick="openFilterModal()" class="bg-brandGold text-white px-6 rounded-full shadow-md h-14 flex items-center gap-2 font-bold hover:bg-brandGreen transition-colors">
                    <i class="fa-solid fa-sliders"></i> <span class="hidden md:inline">Filtrele</span>
                </button>
            </div>

            <div class="relative mb-6"><div id="ana-kategoriler" class="flex gap-4 overflow-x-auto hide-scroll pb-4"></div></div>
            <div id="alt-kategoriler" class="flex gap-2 overflow-x-auto hide-scroll pb-6 mb-2"></div>

            <div class="flex justify-between items-end mb-8 border-b-2 border-brandGold/30 pb-3">
                <h2 id="kategori-baslik" class="text-3xl font-serif font-bold text-brandGreen uppercase tracking-wide">Kategori</h2>
                <span id="aktif-filtre-uyarisi" class="text-xs font-bold text-amber-500 bg-amber-50 px-3 py-1 rounded-full hidden">Filtreler Aktif <i class="fa-solid fa-filter"></i></span>
            </div>

            <div id="urun-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
            <div id="tavsiye-alani" class="mt-4"></div>
        </div>
    </div>

    <button onclick="openWaiterModal()" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 bg-brandGold text-white w-14 h-14 md:w-16 md:h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-brandGreen transition-all z-50">
        <i class="fa-solid fa-bell text-2xl"></i>
    </button>

    <div id="filter-modal" class="fixed inset-0 z-[250] bg-brandDark/70 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl p-6 md:p-8 w-full max-w-sm relative shadow-2xl slide-up border-t-4 border-brandGold">
            <button onclick="closeFilterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full bg-gray-50"><i class="fa-solid fa-xmark text-lg"></i></button>
            <h3 class="text-xl font-bold text-brandDark mb-6 uppercase tracking-wide border-b border-gray-100 pb-3"><i class="fa-solid fa-sliders text-brandGold mr-2"></i> Akıllı Filtreleme</h3>

            <div class="flex flex-col gap-6 mb-8">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Maksimum Bütçe (₺)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-gray-400 font-bold">₺</span>
                        <input type="number" id="filter-price" placeholder="Limit Yok" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl pl-8 pr-4 py-2.5 font-bold text-brandDark focus:outline-none focus:border-brandGreen transition-colors">
                    </div>
                </div>

                <div class="bg-brandBg border border-brandBlue/20 rounded-xl p-4 flex flex-col gap-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="filter-gluten" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                        <span class="ml-3 text-sm font-bold text-brandDark flex items-center gap-2">Sadece Glütensiz (GF)</span>
                    </label>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="filter-allergen" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brandGreen"></div>
                        <span class="ml-3 text-sm font-bold text-brandDark flex items-center gap-2">Alerjensiz Ürünler <i class="fa-solid fa-leaf text-brandGreen"></i></span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="clearFilters()" class="flex-1 bg-gray-100 text-gray-500 py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-gray-200 transition-colors">Temizle</button>
                <button onclick="applyFilters()" class="flex-[2] bg-brandGold text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-brandGreen transition-colors shadow-lg"><i class="fa-solid fa-check mr-1"></i> Sonuçları Gör</button>
            </div>
        </div>
    </div>

    <div id="waiter-modal" class="fixed inset-0 z-[250] bg-brandDark/70 hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-3xl p-6 md:p-8 w-full max-w-sm relative shadow-2xl slide-up border-t-4 border-brandGold">
            <button onclick="closeWaiterModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors w-8 h-8 flex items-center justify-center rounded-full bg-gray-50"><i class="fa-solid fa-xmark text-lg"></i></button>
            <div class="w-16 h-16 bg-brandGold/10 text-brandGold rounded-full flex items-center justify-center text-3xl mx-auto mb-4"><i class="fa-solid fa-bell-concierge"></i></div>
            <h3 class="text-xl font-bold text-brandDark mb-2 text-center uppercase tracking-wide">Masanızı Seçin</h3>
            <p class="text-sm text-gray-500 mb-6 text-center font-medium">Garsonu çağırmadan önce lütfen bulunduğunuz masa numarasını girin.</p>
            <input type="text" id="waiter-table-no" placeholder="Örn: 5" class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-3 mb-6 focus:outline-none focus:border-brandGreen font-black text-center text-xl text-brandDark transition-colors">
            <button onclick="confirmCallWaiter()" class="w-full bg-brandGold text-white py-3.5 rounded-xl font-bold uppercase tracking-widest text-sm hover:bg-brandGreen transition-colors shadow-lg flex items-center justify-center gap-2"><i class="fa-solid fa-check"></i> Garson Çağır</button>
        </div>
    </div>

    <div id="product-modal" class="fixed inset-0 z-[200] bg-brandDark/70 hidden items-end md:items-center justify-center p-0 md:p-4 backdrop-blur-sm">
        <div class="slide-up bg-white w-full md:max-w-xl overflow-hidden shadow-2xl relative flex flex-col rounded-t-[2rem] md:rounded-[2rem] max-h-[90vh]">
            <button onclick="closeModal()" class="absolute top-4 right-4 bg-brandBg/90 text-brandGreen w-10 h-10 rounded-full flex items-center justify-center shadow-md z-10 hover:bg-brandGold hover:text-white transition-all"><i class="fa-solid fa-xmark text-lg"></i></button>
            <div class="w-full h-56 md:h-72 bg-brandBg relative">
                <img id="modal-img" src="" class="w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
                <h2 id="modal-title" class="absolute bottom-4 left-6 text-2xl font-serif font-bold text-white uppercase drop-shadow-md">Ürün Adı</h2>
            </div>
            <div class="p-6 md:p-8 overflow-y-auto hide-scroll">
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <span id="modal-price" class="text-brandGreen font-black text-2xl">₺0.00</span>
                    <span id="modal-cal" class="text-xs font-bold text-white bg-brandGold px-3 py-1.5 rounded-full flex items-center gap-1.5"><i class="fa-solid fa-fire"></i> 0 kcal</span>
                    <span id="modal-time" class="text-xs font-bold text-brandBlue bg-brandBg px-3 py-1.5 rounded-full border border-brandBlue/20 flex items-center gap-1.5"><i class="fa-regular fa-clock"></i> 0 min</span>
                </div>
                <div id="modal-alerjen-wrapper" class="hidden mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-lg mt-0.5"></i>
                    <div><h5 class="text-xs font-bold text-red-700 uppercase tracking-wider">Alerjen Uyarısı</h5><p id="modal-alerjen-text" class="text-xs md:text-sm text-red-600 font-medium mt-0.5"></p></div>
                </div>
                <h4 class="text-xs font-bold text-brandBlue uppercase tracking-widest mb-2 border-b border-brandBlue/20 pb-2">Ürün İçeriği & Detaylar</h4>
                <p id="modal-desc" class="text-brandDark/80 text-sm md:text-base leading-relaxed font-medium">Açıklama...</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const masa = urlParams.get('masa');
            if (masa) {
                localStorage.setItem('aktif_masa', masa);
                const subtitle = document.getElementById('site-subtitle');
                if(subtitle) subtitle.textContent = `Center Cafe | Masa ${masa}`;
            }

            fetch('/api/ayarlar').then(res => res.json()).then(data => {
                if(data) {
                    if(data.sirket_adi) {
                        const titleEl = document.getElementById('site-title');
                        if(titleEl) titleEl.textContent = data.sirket_adi.split(' ')[0];
                        document.title = data.sirket_adi + " | Dijital Menü";
                    }
                    if(data.wifi_sifresi) {
                        const wifiEl = document.getElementById('info-wifi');
                        if(wifiEl) wifiEl.innerHTML = `<i class="fa-solid fa-wifi text-brandGold text-lg w-5"></i> Şifre: <span class="font-bold tracking-wider">${data.wifi_sifresi}</span>`;
                    }
                    if(data.telefon) {
                        const telEl = document.getElementById('info-telefon');
                        if(telEl) telEl.innerHTML = `<i class="fa-solid fa-phone text-brandGold text-lg w-5"></i> ${data.telefon}`;
                    }
                    if(data.adres) {
                        const adresEl = document.getElementById('info-adres');
                        if(adresEl) adresEl.innerHTML = `<i class="fa-solid fa-location-dot text-brandGold text-lg w-5"></i> ${data.adres}`;
                    }
                    if(data.yorum_linki) {
                        const yorumBtn = document.getElementById('btn-yorum-yap');
                        if(yorumBtn) yorumBtn.href = data.yorum_linki;
                    }
                }
            }).catch(err => console.log("Ayarlar yüklenemedi."));

            // Splash ekranını her ihtimale karşı JS ile de garanti alalım
            window.addEventListener('load', function() {
                setTimeout(function() {
                    var splash = document.querySelector('.splash-screen');
                    if (splash) {
                        splash.style.transition = 'opacity 0.4s ease';
                        splash.style.opacity = '0';
                        setTimeout(function() { splash.style.display = 'none'; }, 400);
                    }
                }, 1800);
            });
        });

        function switchTab(tabId) {
            document.getElementById('home-section').classList.toggle('hidden', tabId !== 'home');
            document.getElementById('menu-section').classList.toggle('hidden', tabId === 'home');
            document.getElementById('menu-section').classList.toggle('flex', tabId !== 'home');
            document.getElementById('nav-home').className = tabId === 'home' ? 'text-brandGreen border-b-2 border-brandGreen pb-1 transition-all' : 'text-brandBlue hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all';
            document.getElementById('nav-menu').className = tabId === 'menu' ? 'text-brandGreen border-b-2 border-brandGreen pb-1 transition-all' : 'text-brandBlue hover:text-brandGreen border-b-2 border-transparent hover:border-brandGreen pb-1 transition-all';
        }

        // --- GARSON ÇAĞIRMA (Modal) ---
        function openWaiterModal() {
            document.getElementById('waiter-modal').classList.remove('hidden');
            document.getElementById('waiter-modal').classList.add('flex');
            document.getElementById('waiter-table-no').value = '';
            document.getElementById('waiter-table-no').focus();
        }

        function closeWaiterModal() {
            document.getElementById('waiter-modal').classList.add('hidden');
            document.getElementById('waiter-modal').classList.remove('flex');
        }

        function confirmCallWaiter() {
            const tableNo = document.getElementById('waiter-table-no').value || localStorage.getItem('aktif_masa') || 'Bilinmiyor';
            closeWaiterModal();

            let cagriListesi = JSON.parse(localStorage.getItem('center_garson_cagrilari')) || [];
            cagriListesi.push({
                masa: tableNo,
                zaman: new Date().toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' })
            });
            localStorage.setItem('center_garson_cagrilari', JSON.stringify(cagriListesi));

            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = `Masa ${tableNo} için garson çağırıldı!`;
            toast.classList.remove('opacity-0', 'translate-y-[-20px]');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-[-20px]');
            }, 3000);
        }

        // --- AKILLI FİLTRELEME VE ARAMA MANTIĞI ---
        let currentAnaKat = '';
        let currentAltKat = '';
        let activeFilters = { maxFiyat: 0, glutensiz: false, alerjensiz: false };

        function openFilterModal() {
            document.getElementById('filter-modal').classList.remove('hidden');
            document.getElementById('filter-modal').classList.add('flex');
        }

        function closeFilterModal() {
            document.getElementById('filter-modal').classList.add('hidden');
            document.getElementById('filter-modal').classList.remove('flex');
        }

        function applyFilters() {
            const priceVal = document.getElementById('filter-price').value;
            activeFilters.maxFiyat = priceVal ? parseFloat(priceVal) : 0;
            activeFilters.glutensiz = document.getElementById('filter-gluten').checked;
            activeFilters.alerjensiz = document.getElementById('filter-allergen').checked;

            closeFilterModal();

            if(activeFilters.maxFiyat > 0 || activeFilters.glutensiz || activeFilters.alerjensiz) {
                document.getElementById('aktif-filtre-uyarisi').classList.remove('hidden');
            } else {
                document.getElementById('aktif-filtre-uyarisi').classList.add('hidden');
            }

            tetikleAramaVeFiltre();
        }

        function clearFilters() {
            document.getElementById('filter-price').value = '';
            document.getElementById('filter-gluten').checked = false;
            document.getElementById('filter-allergen').checked = false;

            activeFilters = { maxFiyat: 0, glutensiz: false, alerjensiz: false };
            document.getElementById('aktif-filtre-uyarisi').classList.add('hidden');

            closeFilterModal();
            tetikleAramaVeFiltre();
        }

        function tetikleAramaVeFiltre() {
            if(currentAnaKat && currentAltKat) {
                renderUrunler(currentAnaKat, currentAltKat);
            }
        }

        function getUrunGorseli(urun) { return (urun.resim_url && urun.resim_url.trim() !== "") ? urun.resim_url : "https://images.unsplash.com/photo-1544025162-d76694265947?w=500&h=300&fit=crop"; }

        function openModal(index) {
            const urun = globalUrunler[index];
            if(!urun) return;
            const kalori = urun.kalori || urun.Kalori || '0';
            const sure = urun.sure || urun.HazirlanmaSuresi || '0';
            const aciklama = urun.aciklama || urun.Aciklama || "İçerik detayı bulunmamaktadır.";
            const alerjen = urun.alerjen || urun.Alerjen;

            document.getElementById('modal-img').src = getUrunGorseli(urun);
            document.getElementById('modal-title').textContent = urun.UrunAd;
            document.getElementById('modal-price').textContent = "₺" + (urun.FixFiyat || "0.00");
            document.getElementById('modal-cal').innerHTML = `<i class="fa-solid fa-fire"></i> ${kalori} kcal`;
            document.getElementById('modal-time').innerHTML = `<i class="fa-regular fa-clock"></i> ${sure} min`;
            document.getElementById('modal-desc').innerHTML = aciklama;

            const alerjenWrapper = document.getElementById('modal-alerjen-wrapper');
            const alerjenText = document.getElementById('modal-alerjen-text');
            if (alerjen && alerjen.trim() !== "") {
                alerjenText.textContent = alerjen;
                alerjenWrapper.classList.remove('hidden');
                alerjenWrapper.classList.add('flex');
            } else {
                alerjenWrapper.classList.add('hidden');
                alerjenWrapper.classList.remove('flex');
            }

            document.getElementById('product-modal').classList.remove('hidden');
            document.getElementById('product-modal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('product-modal').classList.add('hidden');
            document.getElementById('product-modal').classList.remove('flex');
        }

        let globalUrunler = [];

        document.addEventListener('DOMContentLoaded', function() {
            const sabitKategoriler = [
                { ad: "KAHVALTILAR", resim: "/images/urunler/168762219164971235.jpg", fallback: "https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?w=500&h=300&fit=crop" },
                { ad: "TATLILAR", resim: "/images/urunler/1703053931650cbf0b23f90.jpeg", fallback: "https://images.unsplash.com/photo-1579306194872-64d3b7bac4c2?w=500&h=300&fit=crop" },
                { ad: "SICAK İÇECEKLER", resim: "/images/urunler/1785535612.jpg", fallback: "https://images.unsplash.com/photo-1541167760496-1628856ab772?w=500&h=300&fit=crop" },
                { ad: "SOĞUK İÇECEKLER", resim: "/images/urunler/1696077430651_167b26084.jpg", fallback: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=500&h=300&fit=crop" },
                { ad: "DONDURMALAR", resim: "/images/urunler/1751035816685-e1a518ef4.jpeg", fallback: "https://images.unsplash.com/photo-1551024601-bec78aea704b?w=500&h=300&fit=crop" },
                { ad: "GÖZLEME & TOST", resim: "/images/urunler/1687542100649_3540263b.jpeg", fallback: "https://images.unsplash.com/photo-1528736235302-52922df5c122?w=500&h=300&fit=crop" }
            ];

            const altHiyerarsi = {
                "KAHVALTILAR": ["KAHVALTILAR", "SAHANDA", "OMLET", "KENDİ KAHVALTINI YARAT"],
                "TATLILAR": ["TATLILAR", "SÜTLÜ TATLI", "PASTALAR", "ŞERBETLİ TATLI", "KİLOLUK ÜRÜNLER", "KEKLER", "İLAVELER"],
                "SICAK İÇECEKLER": ["SICAK İÇECEKLER", "DÜNYA KAHVELERİ", "BİTKİ ÇAYI", "İLAVELER"],
                "SOĞUK İÇECEKLER": ["SOĞUK İÇECEKLER", "SOĞUK KAHVELER", "MEŞRUBATLAR", "FROZEN", "SMOOTHIE", "MILKSHAKE", "FRAPPE", "KOKTEYL & DETOX"],
                "DONDURMALAR": ["DONDURMALAR"],
                "GÖZLEME & TOST": ["GÖZLEME & TOST", "GÖZLEMELER", "TOSTLAR", "KÖYLUM (BAZLAMA) TOSTLAR", "KÖY EKMEĞİ TOSTLAR", "APERATİFLER"]
            };

            const anaKatAlani = document.getElementById('ana-kategoriler');
            const altKatAlani = document.getElementById('alt-kategoriler');
            const urunGrid = document.getElementById('urun-grid');
            const tavsiyeAlani = document.getElementById('tavsiye-alani');
            const baslik = document.getElementById('kategori-baslik');

            sabitKategoriler.forEach(kat => {
                const div = document.createElement('div');
                div.className = "flex-shrink-0 w-36 md:w-48 h-20 md:h-24 rounded-2xl relative overflow-hidden cursor-pointer shadow-md border border-brandBlue/10 group ana-kat-btn";
                div.innerHTML = `
                    <img src="${kat.resim}" onerror="this.onerror=null; this.src='${kat.fallback}';" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-brandDark/50 group-hover:bg-brandGreen/60 transition-colors flex items-center justify-center p-2 text-center">
                        <span class="text-white font-serif font-bold text-xs md:text-sm uppercase tracking-widest drop-shadow-md z-10">${kat.ad}</span>
                    </div>
                    <div class="kat-overlay absolute inset-0 border-4 border-transparent rounded-2xl transition-all"></div>`;
                anaKatAlani.appendChild(div);
            });

            fetch('/api/menu').then(res => res.json()).then(data => {
                if(data && data.urunler) {
                    globalUrunler = data.urunler.sort((a, b) => (a.Sira || 99) - (b.Sira || 99));
                }

                const btnler = anaKatAlani.querySelectorAll('.ana-kat-btn');
                btnler.forEach((btn, idx) => {
                    btn.onclick = () => selectCategory(sabitKategoriler[idx].ad, btn);
                });

                if(btnler.length > 0) selectCategory(sabitKategoriler[0].ad, btnler[0]);
            });

            function selectCategory(isim, btn) {
                currentAnaKat = isim;
                document.querySelectorAll('.kat-overlay').forEach(e => e.classList.remove('border-brandGold'));
                if(btn) btn.querySelector('.kat-overlay').classList.add('border-brandGold');
                baslik.textContent = isim;
                altKatAlani.innerHTML = '';
                const altlar = altHiyerarsi[isim] || [isim];

                altlar.forEach((alt, i) => {
                    const count = globalUrunler.filter(u => {
                        if(!u.UrunGrubu) return false;
                        const g = u.UrunGrubu.toLocaleUpperCase('tr-TR');
                        const altUpper = alt.toLocaleUpperCase('tr-TR');
                        const anaUpper = isim.toLocaleUpperCase('tr-TR');

                        if (altUpper === anaUpper) {
                            return altlar.map(a => a.toLocaleUpperCase('tr-TR')).includes(g) || g === anaUpper;
                        } else {
                            return g === altUpper;
                        }
                    }).length;

                    const b = document.createElement('button');
                    b.className = `flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider transition-all shadow-sm ${i === 0 ? 'bg-brandGold text-white shadow-md transform scale-105' : 'bg-white border border-brandBlue/20 text-brandBlue hover:bg-brandBg hover:text-brandGreen'}`;
                    b.textContent = `${alt} (${count})`;
                    b.onclick = (e) => {
                        Array.from(altKatAlani.children).forEach(x => { x.className = "flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white border border-brandBlue/20 text-brandBlue hover:bg-brandBg hover:text-brandGreen transition-all shadow-sm"; });
                        e.target.className = "flex-shrink-0 px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider bg-brandGold text-white shadow-md transform scale-105 transition-all";
                        currentAltKat = alt;
                        renderUrunler(isim, alt);
                    };
                    altKatAlani.appendChild(b);
                });

                currentAltKat = altlar[0];
                renderUrunler(isim, altlar[0]);
            }

            window.renderUrunler = function(ana, alt) {
                const searchVal = document.getElementById('menu-arama').value.trim().toLocaleUpperCase('tr-TR');

                const filtrelenenler = globalUrunler.filter(u => {
                    if(!u.UrunGrubu) return false;
                    const g = u.UrunGrubu.toLocaleUpperCase('tr-TR');
                    const altUpper = alt.toLocaleUpperCase('tr-TR');
                    const anaUpper = ana.toLocaleUpperCase('tr-TR');

                    let katMatch = false;
                    if (altUpper === anaUpper) {
                        const altlar = altHiyerarsi[ana] || [ana];
                        katMatch = altlar.map(a => a.toLocaleUpperCase('tr-TR')).includes(g) || g === anaUpper;
                    } else {
                        katMatch = (g === altUpper);
                    }

                    if(!katMatch) return false;

                    if(searchVal !== "") {
                        const ad = (u.UrunAd || "").toLocaleUpperCase('tr-TR');
                        const aciklama = (u.aciklama || "").toLocaleUpperCase('tr-TR');
                        if(!ad.includes(searchVal) && !aciklama.includes(searchVal)) return false;
                    }

                    if (activeFilters.maxFiyat > 0 && parseFloat(u.FixFiyat || 0) > activeFilters.maxFiyat) return false;
                    if (activeFilters.glutensiz && u.is_gluten_free != 1) return false;
                    if (activeFilters.alerjensiz && u.alerjen && u.alerjen.trim() !== '') return false;

                    return true;
                });

                urunGrid.innerHTML = '';
                tavsiyeAlani.innerHTML = '';

                if(filtrelenenler.length === 0) {
                    urunGrid.innerHTML = `<div class="col-span-full py-12 text-center text-brandBlue text-base font-medium flex flex-col items-center gap-3"><i class="fa-solid fa-plate-wheat text-4xl text-brandBlue/40"></i> Aradığınız kriterlere uygun ürün bulunamadı.</div>`;
                    return;
                }

                filtrelenenler.forEach(u => {
                    const globalIndex = globalUrunler.indexOf(u);
                    const gorsel = getUrunGorseli(u);
                    const badge = (u.is_gluten_free == 1) ? `<span class="absolute top-3 left-3 bg-brandGreen text-white text-[0.6rem] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md z-10 border border-brandGreen/50">GF</span>` : '';
                    const kalori = u.kalori || u.Kalori || '0';
                    const sure = u.sure || u.HazirlanmaSuresi || '0';

                    urunGrid.innerHTML += `
                        <div class="bg-white rounded-3xl shadow-sm border border-brandBlue/10 flex flex-col relative cursor-pointer hover:shadow-xl transition-all group overflow-hidden">
                            <div onclick="openModal(${globalIndex})" class="w-full h-40 md:h-48 relative overflow-hidden bg-brandBg">
                                ${badge}
                                <img src="${gorsel}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="p-4 flex flex-col flex-1">
                                <h3 onclick="openModal(${globalIndex})" class="font-bold text-sm md:text-base uppercase mb-2 text-brandDark tracking-wide line-clamp-2">${u.UrunAd}</h3>
                                <div class="mt-auto flex items-center justify-between pt-3 border-t border-brandBlue/10">
                                    <span class="font-black text-brandGreen text-lg">₺${u.FixFiyat || "0.00"}</span>
                                    <button onclick="sepeteEkle(${globalIndex})" class="bg-brandBg text-brandGold w-8 h-8 rounded-full flex items-center justify-center group-hover:bg-brandGold group-hover:text-white transition-colors">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            window.sepet = [];
            window.sepeteEkle = function(index) {
                const urun = globalUrunler[index];
                sepet.push(urun);
                localStorage.setItem('center_sepet', JSON.stringify(sepet));

                const toast = document.getElementById('toast');
                document.getElementById('toast-message').textContent = `${urun.UrunAd} sepete eklendi!`;
                toast.classList.remove('opacity-0', 'translate-y-[-20px]');
                toast.classList.add('opacity-100', 'translate-y-0');
                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'translate-y-[-20px]');
                }, 2000);
            }
        });
    </script>
</body>
</html>