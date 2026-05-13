@extends('layouts.app')

@section('title', 'Edit Reservasi - Studio LensArt')

@section('content')
<section class="reservasi-form-section">
    <div class="reservasi-form-header">
        <div>
            <h1 class="section-title">Edit Reservasi</h1>
            <p class="section-desc">
                Perbarui data reservasi untuk Kode Booking:
                <strong>#{{ $reservasi->kode_booking }}</strong>
            </p>
        </div>

        <a href="{{ route('reservasi.index') }}" class="btn-secondary">
            Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="form-message error reservasi-error-box">
            <strong>Data belum berhasil diperbarui.</strong>
            <p>Silakan periksa kembali input yang ditandai.</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST" class="reservasi-form-card">
        @csrf
        @method('PUT')

        <div class="form-section-title">
            <h2>Informasi Booking</h2>
            <p>Perbarui kode booking, paket foto, harga otomatis, dan status reservasi.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="kode_booking">Kode Booking</label>
                <input
                    type="text"
                    name="kode_booking"
                    id="kode_booking"
                    value="{{ old('kode_booking', $reservasi->kode_booking) }}"
                    class="{{ $errors->has('kode_booking') ? 'input-error' : '' }}"
                >
                @error('kode_booking')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="paket_foto">Pilih Paket Foto</label>
                <select name="paket_foto" id="paket_foto" class="{{ $errors->has('paket_foto') ? 'input-error' : '' }}">
                    @foreach ($filterPakets as $paket)
                        <option value="{{ $paket }}" {{ old('paket_foto', $reservasi->paket_foto) == $paket ? 'selected' : '' }}>
                            {{ $paket }}
                        </option>
                    @endforeach
                </select>
                @error('paket_foto')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga Paket (Rp)</label>
                <input
                    type="number"
                    name="harga"
                    id="harga"
                    value="{{ old('harga', $reservasi->harga) }}"
                    class="{{ $errors->has('harga') ? 'input-error' : '' }}"
                    readonly
                >
                <small class="form-help">Harga akan otomatis mengikuti paket foto yang dipilih.</small>
                @error('harga')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="aktif">Status Reservasi</label>
                <select name="aktif" id="aktif" class="{{ $errors->has('aktif') ? 'input-error' : '' }}">
                    <option value="1" {{ old('aktif', $reservasi->aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('aktif', $reservasi->aktif) == '0' ? 'selected' : '' }}>Selesai / Tidak Aktif</option>
                </select>
                @error('aktif')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-section-title">
            <h2>Data Pelanggan</h2>
            <p>Perbarui identitas pelanggan yang melakukan reservasi.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input
                    type="text"
                    name="nama_pelanggan"
                    id="nama_pelanggan"
                    value="{{ old('nama_pelanggan', $reservasi->nama_pelanggan) }}"
                    class="{{ $errors->has('nama_pelanggan') ? 'input-error' : '' }}"
                >
                @error('nama_pelanggan')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $reservasi->email) }}"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}"
                >
                @error('email')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="username_instagram">Username Instagram</label>
                <input
                    type="text"
                    name="username_instagram"
                    id="username_instagram"
                    value="{{ old('username_instagram', $reservasi->username_instagram) }}"
                    class="{{ $errors->has('username_instagram') ? 'input-error' : '' }}"
                >
                @error('username_instagram')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input
                    type="text"
                    name="no_hp"
                    id="no_hp"
                    value="{{ old('no_hp', $reservasi->no_hp) }}"
                    class="{{ $errors->has('no_hp') ? 'input-error' : '' }}"
                >
                @error('no_hp')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-section-title">
            <h2>Jadwal Pemotretan</h2>
            <p>Perbarui jumlah orang, tanggal, dan slot jam reservasi pelanggan.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="jumlah_orang">Jumlah Orang</label>
                <input
                    type="number"
                    name="jumlah_orang"
                    id="jumlah_orang"
                    value="{{ old('jumlah_orang', $reservasi->jumlah_orang) }}"
                    class="{{ $errors->has('jumlah_orang') ? 'input-error' : '' }}"
                >
                @error('jumlah_orang')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_reservasi">Tanggal Reservasi</label>
                <input
                    type="date"
                    name="tanggal_reservasi"
                    id="tanggal_reservasi"
                    value="{{ old('tanggal_reservasi', $reservasi->tanggal_reservasi->format('Y-m-d')) }}"
                    class="{{ $errors->has('tanggal_reservasi') ? 'input-error' : '' }}"
                >
                @error('tanggal_reservasi')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_reservasi">Jam Reservasi</label>

                @php
                    $jamDipilih = old('jam_reservasi', substr($reservasi->jam_reservasi, 0, 5));
                @endphp

                <select name="jam_reservasi" id="jam_reservasi" class="{{ $errors->has('jam_reservasi') ? 'input-error' : '' }}">
                    <option value="">-- Pilih Jam Reservasi --</option>
                    <option value="09:00" {{ $jamDipilih == '09:00' ? 'selected' : '' }}>09:00 - 10:00</option>
                    <option value="10:00" {{ $jamDipilih == '10:00' ? 'selected' : '' }}>10:00 - 11:00</option>
                    <option value="11:00" {{ $jamDipilih == '11:00' ? 'selected' : '' }}>11:00 - 12:00</option>
                    <option value="12:00" {{ $jamDipilih == '12:00' ? 'selected' : '' }}>12:00 - 13:00</option>
                    <option value="13:00" {{ $jamDipilih == '13:00' ? 'selected' : '' }}>13:00 - 14:00</option>
                    <option value="14:00" {{ $jamDipilih == '14:00' ? 'selected' : '' }}>14:00 - 15:00</option>
                    <option value="15:00" {{ $jamDipilih == '15:00' ? 'selected' : '' }}>15:00 - 16:00</option>
                    <option value="16:00" {{ $jamDipilih == '16:00' ? 'selected' : '' }}>16:00 - 17:00</option>
                    <option value="17:00" {{ $jamDipilih == '17:00' ? 'selected' : '' }}>17:00 - 18:00</option>
                    <option value="18:00" {{ $jamDipilih == '18:00' ? 'selected' : '' }}>18:00 - 19:00</option>
                    <option value="19:00" {{ $jamDipilih == '19:00' ? 'selected' : '' }}>19:00 - 20:00</option>
                    <option value="20:00" {{ $jamDipilih == '20:00' ? 'selected' : '' }}>20:00 - 21:00</option>
                </select>
                @error('jam_reservasi')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="reservasi-form-actions">
            <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-create">
                Update Reservasi
            </button>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paketFoto = document.getElementById('paket_foto');
        const harga = document.getElementById('harga');

        const daftarHarga = {
            'Paket Indie': 50000,
            'Paket LensArt': 80000,
            'Paket Kalcer': 120000,
            'Paket Custom': 150000
        };

        function isiHargaOtomatis() {
            const paketDipilih = paketFoto.value;

            if (daftarHarga[paketDipilih]) {
                harga.value = daftarHarga[paketDipilih];
            } else {
                harga.value = '';
            }
        }

        if (paketFoto && harga) {
            paketFoto.addEventListener('change', isiHargaOtomatis);
            isiHargaOtomatis();
        }
    });
</script>
@endpush
