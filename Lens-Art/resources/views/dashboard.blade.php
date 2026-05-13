@extends('layouts.app')

@section('title', 'Studio LensArt - Sistem Booking Studio Foto')

@section('content')

<header class="hero" id="beranda">
    <div class="hero-overlay">
        <img src="{{ asset('images/logo-lensart.png') }}" alt="Logo Studio LensArt" class="hero-logo hero-animate logo-animate">
        <h1 class="hero-animate title-animate">Selamat datang di Studio LensArt</h1>
        <p class="hero-animate text-animate">
            Website ini menyediakan informasi paket foto serta data reservasi pelanggan
            di Studio LensArt.
        </p>
    </div>
</header>

<main class="main-layout">
    <aside class="sidebar">
        <section class="filter-box">
            <h2>Filter Reservasi</h2>

            @forelse ($filterPakets as $filter)
                <label>
                    <input type="checkbox" class="filter-paket" value="{{ $filter }}"> {{ $filter }}
                </label>
            @empty
                <p class="empty-state">Filter paket belum tersedia.</p>
            @endforelse
        </section>

        <section class="stat-box" id="statistik">
            <h2>Statistik LensArt</h2>

            <ul>
                @forelse ($sidebarStatistik as $statistik)
                    <li>
                        {{ $statistik['label'] }}:
                        <span id="{{ $statistik['id'] }}" class="{{ $statistik['class'] }}">
                            {{ $statistik['nilai'] }}
                        </span>
                    </li>
                @empty
                    <li class="empty-state">Statistik belum tersedia.</li>
                @endforelse
            </ul>
        </section>
    </aside>

    <section class="content">
        <div class="dashboard-stat-grid">
            @forelse ($statCards as $stat)
                <x-stat-card
                    :judul="$stat['judul']"
                    :nilai="$stat['nilai']"
                    :ikon="$stat['ikon']"
                    :warna="$stat['warna']"
                />
            @empty
                <p class="empty-state">Data statistik belum tersedia.</p>
            @endforelse
        </div>

        <section id="paket" class="paket-section">
            <h2 class="section-title">Paket Foto</h2>

            <div class="card-grid">
                @forelse ($paketFotos as $paket)
                    <article class="card">
                        <h3>{{ $paket['nama'] }}</h3>
                        <p>{{ $paket['deskripsi'] }}</p>
                        <p class="card-price">Harga: {{ $paket['harga'] }}</p>
                    </article>
                @empty
                    <p class="empty-state">Data paket foto belum tersedia.</p>
                @endforelse
            </div>
        </section>

        <section id="daftar-booking" class="dashboard-reservasi-section">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Preview Data Reservasi</h2>
                    <p class="section-desc">
                        Ringkasan data reservasi pelanggan Studio LensArt berdasarkan filter paket foto.
                    </p>
                </div>

                <a href="{{ route('reservasi.index') }}" class="btn-secondary">
                    Kelola Data Lengkap
                </a>
            </div>

            <div class="table-container dashboard-reservasi-table">
                <table class="reservasi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Jadwal</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>

                    <tbody id="dashboardReservationBody">
                        @forelse ($reservasiDummies as $index => $reservasi)
                            <tr data-paket="{{ $reservasi['paket'] }}">
                                <td class="table-number">{{ $index + 1 }}</td>

                                <td>
                                    <strong class="booking-code">
                                        #{{ $reservasi['kode'] }}
                                    </strong>
                                </td>

                                <td>
                                    <div class="customer-cell">
                                        <strong>{{ $reservasi['nama'] }}</strong>
                                        <span>{{ $reservasi['email'] }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="package-badge">
                                        {{ $reservasi['paket'] }}
                                    </span>
                                </td>

                                <td>
                                    <div class="schedule-cell">
                                        <strong>{{ date('d M Y', strtotime($reservasi['tanggal'])) }}</strong>
                                        <span>{{ $reservasi['jam'] }}</span>
                                    </div>
                                </td>

                                <td>
                                    {{ $reservasi['jumlah_orang'] }} Orang
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    Data reservasi belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p id="dashboardFilterInfo" class="dashboard-filter-info">
                Menampilkan semua data reservasi.
            </p>
        </section>
    </section>
</main>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterCheckboxes = document.querySelectorAll('.filter-paket');
        const rows = document.querySelectorAll('#dashboardReservationBody tr[data-paket]');
        const filterInfo = document.getElementById('dashboardFilterInfo');

        function getActiveFilters() {
            return Array.from(filterCheckboxes)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value);
        }

        function filterDashboardReservasi() {
            const activeFilters = getActiveFilters();
            let visibleCount = 0;

            rows.forEach((row) => {
                const paket = row.dataset.paket;
                const isVisible = activeFilters.length === 0 || activeFilters.includes(paket);

                row.style.display = isVisible ? '' : 'none';

                if (isVisible) {
                    visibleCount++;
                }
            });

            if (filterInfo) {
                if (activeFilters.length === 0) {
                    filterInfo.textContent = 'Menampilkan semua data reservasi.';
                } else {
                    filterInfo.textContent = 'Menampilkan ' + visibleCount + ' data berdasarkan filter: ' + activeFilters.join(', ') + '.';
                }
            }
        }

        filterCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', filterDashboardReservasi);
        });

        filterDashboardReservasi();
    });
</script>
@endpush
