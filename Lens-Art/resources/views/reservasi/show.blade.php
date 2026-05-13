@extends('layouts.app')

@section('title', 'Detail Reservasi - Studio LensArt')

@section('content')
<section class="reservasi-detail-section">
    <div class="reservasi-detail-header">
        <div>
            <h1 class="section-title">Detail Reservasi</h1>
            <p class="section-desc">
                Informasi lengkap data reservasi pelanggan Studio LensArt.
            </p>
        </div>

        <a href="{{ route('reservasi.index') }}" class="btn-secondary">
            Kembali ke Daftar
        </a>
    </div>

    <div class="reservasi-detail-card">
        <div class="detail-main-header">
            <div>
                <span class="detail-label">Kode Booking</span>
                <h2>#{{ $reservasi->kode_booking }}</h2>
                <p>{{ $reservasi->nama_pelanggan }}</p>
            </div>

            <span class="status-badge {{ $reservasi->aktif ? 'status-active' : 'status-inactive' }}">
                {{ $reservasi->aktif ? 'Aktif' : 'Selesai / Tidak Aktif' }}
            </span>
        </div>

        <div class="detail-section-block">
            <h3>Data Pelanggan</h3>

            <div class="detail-grid">
                <div class="detail-item">
                    <span>Nama Pelanggan</span>
                    <strong>{{ $reservasi->nama_pelanggan }}</strong>
                </div>

                <div class="detail-item">
                    <span>Email</span>
                    <strong>{{ $reservasi->email }}</strong>
                </div>

                <div class="detail-item">
                    <span>Username Instagram</span>
                    <strong>{{ $reservasi->username_instagram }}</strong>
                </div>

                <div class="detail-item">
                    <span>No. HP</span>
                    <strong>{{ $reservasi->no_hp }}</strong>
                </div>
            </div>
        </div>

        <div class="detail-section-block">
            <h3>Informasi Reservasi</h3>

            <div class="detail-grid">
                <div class="detail-item">
                    <span>Paket Foto</span>
                    <strong>{{ $reservasi->paket_foto }}</strong>
                </div>

                <div class="detail-item">
                    <span>Harga</span>
                    <strong>Rp{{ number_format($reservasi->harga, 0, ',', '.') }}</strong>
                </div>

                <div class="detail-item">
                    <span>Jumlah Orang</span>
                    <strong>{{ $reservasi->jumlah_orang }} Orang</strong>
                </div>

                <div class="detail-item">
                    <span>Status</span>
                    <strong>{{ $reservasi->aktif ? 'Aktif' : 'Selesai / Tidak Aktif' }}</strong>
                </div>
            </div>
        </div>

        <div class="detail-section-block">
            <h3>Jadwal Pemotretan</h3>

            <div class="detail-grid">
                <div class="detail-item">
                    <span>Tanggal Reservasi</span>
                    <strong>
                        {{ is_object($reservasi->tanggal_reservasi)
                            ? $reservasi->tanggal_reservasi->format('d M Y')
                            : date('d M Y', strtotime($reservasi->tanggal_reservasi)) }}
                    </strong>
                </div>

                <div class="detail-item">
                    <span>Jam Reservasi</span>
                    <strong>{{ substr($reservasi->jam_reservasi, 0, 5) }}</strong>
                </div>
            </div>
        </div>

        <div class="reservasi-detail-actions">
            <a href="{{ route('reservasi.index') }}" class="btn-secondary">
                Kembali
            </a>

            <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn-create">
                Edit Reservasi
            </a>
        </div>
    </div>
</section>
@endsection
