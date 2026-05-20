@extends('layouts.app')

@section('title', 'Dashboard Customer - Studio LensArt')

@section('content')
<section class="customer-dashboard-page">

    {{-- HERO CUSTOMER --}}
    <section class="customer-hero">
        <div class="customer-hero-content">
            <span class="customer-eyebrow">Studio Foto Booking</span>

            <h1>
                Halo, {{ auth()->user()->name }} 👋
                <br>
                Abadikan Momen Terbaikmu Bersama Studio LensArt
            </h1>

            <p>
                Pilih paket foto favoritmu, tentukan jadwal pemotretan, dan buat reservasi
                dengan mudah melalui akun customer Studio LensArt.
            </p>

            <div class="customer-hero-actions">
                <a href="{{ route('customer.reservasi.create') }}" class="btn-create">
                    Reservasi Sekarang
                </a>

                <a href="#paket-customer" class="btn-secondary">
                    Lihat Paket Foto
                </a>
            </div>
        </div>

        <div class="customer-hero-card">
            <div class="customer-avatar-large">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>

            <span class="customer-role-badge">
                Customer LensArt
            </span>
        </div>
    </section>

        {{-- SESSION VISIT COUNTER --}}
    <section class="customer-visit-section">
        <div class="customer-visit-content">
            <span class="customer-visit-label">Session Counter</span>

            <h2>Aktivitas Kunjungan Dashboard</h2>

            <p>
                Sistem menghitung berapa kali halaman dashboard customer ini dikunjungi
                menggunakan session Laravel.
            </p>
        </div>

        <div class="customer-visit-grid">
            <div class="customer-visit-card">
                <span>Jumlah Kunjungan</span>
                <strong>{{ $visitCount ?? 0 }} Kali</strong>
            </div>

            <div class="customer-visit-card">
                <span>Kunjungan Pertama</span>
                <strong>{{ $firstVisit ?? '-' }}</strong>
            </div>

            <div class="customer-visit-card">
                <span>Kunjungan Terakhir</span>
                <strong>{{ $lastVisit ?? '-' }}</strong>
            </div>
        </div>

        <form action="{{ route('customer.dashboard.reset-visit') }}" method="POST" class="customer-visit-reset-form">
            @csrf

            <button type="submit" class="btn-secondary">
                Reset Hitungan
            </button>
        </form>
    </section>

    {{-- PAKET FOTO CUSTOMER --}}
    <section class="customer-package-section" id="paket-customer">
        <div class="customer-section-header">
            <div>
                <h2 class="section-title">Paket Foto Pilihan</h2>
                <p class="section-desc">
                    Pilih paket foto sesuai kebutuhanmu dan lakukan reservasi secara online.
                </p>
            </div>
        </div>

        <div class="customer-package-grid">
            <article class="customer-package-card">
                <div class="customer-package-icon">📷</div>
                <h3>Paket Indie</h3>
                <p>Durasi 10 menit sesi foto, 1 lembar print, dan softcopy file.</p>
                <strong>Rp50.000</strong>
                <a href="{{ route('customer.reservasi.create') }}" class="customer-package-button">
                    Reservasi Paket
                </a>
            </article>

            <article class="customer-package-card package-popular">
                <span class="popular-badge">Favorit</span>
                <div class="customer-package-icon">✨</div>
                <h3>Paket LensArt</h3>
                <p>Durasi 15 menit sesi foto, 2 lembar print, dan softcopy file.</p>
                <strong>Rp80.000</strong>
                <a href="{{ route('customer.reservasi.create') }}" class="customer-package-button">
                    Reservasi Paket
                </a>
            </article>

            <article class="customer-package-card">
                <div class="customer-package-icon">🎞️</div>
                <h3>Paket Kalcer</h3>
                <p>Durasi 20 menit sesi foto, 4 lembar print, dan softcopy file.</p>
                <strong>Rp120.000</strong>
                <a href="{{ route('customer.reservasi.create') }}" class="customer-package-button">
                    Reservasi Paket
                </a>
            </article>

            <article class="customer-package-card">
                <div class="customer-package-icon">🌟</div>
                <h3>Paket Custom</h3>
                <p>Paket foto fleksibel yang dapat disesuaikan dengan kebutuhan pelanggan.</p>
                <strong>Rp150.000</strong>
                <a href="{{ route('customer.reservasi.create') }}" class="customer-package-button">
                    Reservasi Paket
                </a>
            </article>
        </div>
    </section>

    {{-- KEUNGGULAN CUSTOMER --}}
    <section class="customer-feature-section">
        <div class="customer-feature-card">
            <div class="customer-feature-icon">🗓️</div>
            <h3>Reservasi Mudah</h3>
            <p>Customer dapat memilih tanggal dan jam reservasi sesuai slot yang tersedia.</p>
        </div>

        <div class="customer-feature-card">
            <div class="customer-feature-icon">💰</div>
            <h3>Harga Transparan</h3>
            <p>Harga paket otomatis mengikuti pilihan paket foto tanpa input manual.</p>
        </div>

        <div class="customer-feature-card">
            <div class="customer-feature-icon">📸</div>
            <h3>Studio Profesional</h3>
            <p>Studio LensArt menyediakan sesi foto indoor dengan hasil print dan softcopy.</p>
        </div>
    </section>

    <section class="customer-cta">
        <div>
            <h2>Sudah siap membuat reservasi?</h2>
            <p>
                Buat jadwal pemotretanmu sekarang dan lihat data reservasi melalui menu Reservasi.
            </p>
        </div>

        <a href="{{ route('customer.reservasi.create') }}" class="btn-create">
            Buat Reservasi
        </a>
    </section>

    <button type="button" class="lensart-weather-button" id="openWeatherCard">
        <span class="lensart-weather-button-icon">☁️</span>
        <span>Yuk cek cuaca hari ini!</span>
    </button>

    <div class="lensart-weather-overlay lensart-weather-hidden" id="weatherOverlay">
        <div class="lensart-weather-card">
            <button type="button" class="lensart-weather-close" id="closeWeatherCard">
                ×
            </button>

            <div class="lensart-weather-card-header">
                <span class="lensart-weather-label">LensArt Weather Check</span>
                <h2>Cuaca Sstudio Hari Ini</h2>
                <p>
                    Cek kondisi cuaca Jember sebelum menentukan jadwal reservasi foto.
                </p>
            </div>

            <div id="weatherLoading" class="lensart-weather-loading">
                Mengambil data cuaca...
            </div>

            <div id="weatherContent" class="lensart-weather-content lensart-weather-hidden">
                <div class="lensart-weather-main">
                    <div>
                        <span class="lensart-weather-city-label">Lokasi</span>
                        <h3 id="weatherCity">Jember</h3>
                    </div>

                    <div class="lensart-weather-temp">
                        <span id="weatherTemp">-</span>°C
                    </div>
                </div>

                <div class="lensart-weather-desc-box">
                    <span>Deskripsi Cuaca</span>
                    <p id="weatherDesc">-</p>
                </div>

                <div class="lensart-weather-note">
                    Informasi cuaca ini membantu customer mempertimbangkan waktu terbaik sebelum melakukan reservasi.
                </div>
            </div>

            <div id="weatherError" class="lensart-weather-error lensart-weather-hidden">
                Data cuaca belum berhasil dimuat. Silakan coba lagi nanti.
            </div>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openWeatherCard = document.getElementById('openWeatherCard');
        const closeWeatherCard = document.getElementById('closeWeatherCard');
        const weatherOverlay = document.getElementById('weatherOverlay');

        const weatherLoading = document.getElementById('weatherLoading');
        const weatherContent = document.getElementById('weatherContent');
        const weatherError = document.getElementById('weatherError');

        const weatherCity = document.getElementById('weatherCity');
        const weatherTemp = document.getElementById('weatherTemp');
        const weatherDesc = document.getElementById('weatherDesc');

        let weatherLoaded = false;

        async function loadWeatherData() {
            weatherLoading.classList.remove('lensart-weather-hidden');
            weatherContent.classList.add('lensart-weather-hidden');
            weatherError.classList.add('lensart-weather-hidden');

            try {
                const response = await fetch('https://wttr.in/Jember?format=j1');

                if (!response.ok) {
                    throw new Error('Gagal mengambil data cuaca.');
                }

                const data = await response.json();

                const city = data.nearest_area?.[0]?.areaName?.[0]?.value || 'Jember';
                const temperature = data.current_condition?.[0]?.temp_C || '-';
                const description = data.current_condition?.[0]?.weatherDesc?.[0]?.value || 'Deskripsi cuaca tidak tersedia';

                weatherCity.textContent = city;
                weatherTemp.textContent = temperature;
                weatherDesc.textContent = description;

                weatherLoading.classList.add('lensart-weather-hidden');
                weatherContent.classList.remove('lensart-weather-hidden');

                weatherLoaded = true;
            } catch (error) {
                weatherLoading.classList.add('lensart-weather-hidden');
                weatherError.classList.remove('lensart-weather-hidden');
            }
        }

        function openWeatherModal() {
            weatherOverlay.classList.remove('lensart-weather-hidden');

            if (!weatherLoaded) {
                loadWeatherData();
            }
        }

        function closeWeatherModal() {
            weatherOverlay.classList.add('lensart-weather-hidden');
        }

        openWeatherCard.addEventListener('click', openWeatherModal);
        closeWeatherCard.addEventListener('click', closeWeatherModal);

        weatherOverlay.addEventListener('click', function (event) {
            if (event.target === weatherOverlay) {
                closeWeatherModal();
            }
        });
    });
</script>
@endpush
