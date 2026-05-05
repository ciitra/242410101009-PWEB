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

        <section id="daftar-booking" class="booking-section">
            <h2 class="section-title">Data Reservasi</h2>
            <p class="section-desc">
                Berikut adalah data pelanggan yang telah melakukan reservasi di Studio LensArt.
            </p>

            <form class="search-form" id="searchForm">
                <input type="text" id="searchInput" placeholder="Cari berdasarkan nama pelanggan atau kode booking...">
                <button type="button">Cari</button>
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Booking</th>
                            <th>Nama Pelanggan</th>
                            <th>Email</th>
                            <th>Username Instagram</th>
                            <th>No. HP</th>
                            <th>Jumlah Orang</th>
                            <th>Paket Foto</th>
                            <th>Harga</th>
                            <th>Tanggal Reservasi</th>
                            <th>Jam Reservasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="reservationBody">
                        @forelse ($reservasiDummies as $reservasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservasi['kode'] }}</td>
                                <td>{{ $reservasi['nama'] }}</td>
                                <td>{{ $reservasi['email'] }}</td>
                                <td>{{ $reservasi['instagram'] }}</td>
                                <td>{{ $reservasi['no_hp'] }}</td>
                                <td>{{ $reservasi['jumlah_orang'] }}</td>
                                <td>{{ $reservasi['paket'] }}</td>
                                <td>{{ $reservasi['harga'] }}</td>
                                <td>{{ $reservasi['tanggal'] }}</td>
                                <td>{{ $reservasi['jam'] }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-edit" data-action="edit" data-index="{{ $loop->index }}">Edit</button>
                                        <button type="button" class="btn-delete" data-action="delete" data-index="{{ $loop->index }}">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="empty-state">Data reservasi belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="11"><strong>Total Reservasi</strong></td>
                            <td><strong id="tableTotalReservasi">{{ count($reservasiDummies) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <section class="tambah-reservasi-section">
                <h3 class="sub-title" id="formTitle">Daftar Reservasi</h3>

                <div id="formMessage" class="form-message"></div>

                <form class="tambah-reservasi-form" id="reservationForm">
                    <input type="hidden" id="editIndex" value="-1">

                    <div class="form-group">
                        <input type="text" id="kodeBooking" placeholder="Kode Booking" required>
                        <small class="error-text" id="errorKodeBooking"></small>
                    </div>

                    <div class="form-group">
                        <input type="text" id="namaPelanggan" placeholder="Nama Pelanggan" required>
                        <small class="error-text" id="errorNamaPelanggan"></small>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" placeholder="Email" required>
                        <small class="error-text" id="errorEmail"></small>
                    </div>

                    <div class="form-group">
                        <input type="text" id="usernameInstagram" placeholder="Username Instagram" required>
                        <small class="error-text" id="errorUsernameInstagram"></small>
                    </div>

                    <div class="form-group">
                        <input type="text" id="noHp" placeholder="No. HP" required>
                        <small class="error-text" id="errorNoHp"></small>
                    </div>

                    <div class="form-group">
                        <input type="number" id="jumlahOrang" placeholder="Jumlah Orang" required>
                        <small class="error-text" id="errorJumlahOrang"></small>
                    </div>

                    <div class="form-group">
                        <select id="paketFoto" required>
                            <option value="">Pilih Paket Foto</option>

                            @forelse ($filterPakets as $paket)
                                <option value="{{ $paket }}">{{ $paket }}</option>
                            @empty
                                <option value="">Paket belum tersedia</option>
                            @endforelse
                        </select>
                        <small class="error-text" id="errorPaketFoto"></small>
                    </div>

                    <div class="form-group">
                        <input type="text" id="hargaDisplay" placeholder="Harga Paket Otomatis" readonly>
                        <small class="error-text" id="errorHargaDisplay"></small>
                    </div>

                    <div class="form-group">
                        <input type="date" id="tanggalReservasi" required>
                        <small class="error-text" id="errorTanggalReservasi"></small>
                    </div>

                    <div class="form-group">
                        <select id="jamReservasi" required>
                            <option value="">Pilih Jam Reservasi</option>

                            @forelse ($jamReservasis as $jam)
                                <option value="{{ $jam }}">{{ $jam }}</option>
                            @empty
                                <option value="">Jam reservasi belum tersedia</option>
                            @endforelse
                        </select>
                        <small class="error-text" id="errorJamReservasi"></small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="submitBtn">Simpan Reservasi</button>
                        <button type="button" id="cancelEditBtn" class="btn-secondary hidden">Batal Edit</button>
                    </div>
                </form>
            </section>
        </section>
    </section>
</main>

@endsection
