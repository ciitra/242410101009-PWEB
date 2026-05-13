@extends('layouts.app')

@section('title', 'Tambah Reservasi - Studio LensArt')

@section('content')
<section class="reservasi-form-section">
    <div class="reservasi-form-header">
        <div>
            <h1 class="section-title">Tambah Reservasi Baru</h1>
            <p class="section-desc">
                Masukkan data pelanggan untuk membuat jadwal pemotretan baru di Studio LensArt.
            </p>
        </div>

        <a href="{{ route('reservasi.index') }}" class="btn-secondary">
            Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="form-message error reservasi-error-box">
            <strong>Data belum berhasil disimpan.</strong>
            <p>Silakan periksa kembali input yang ditandai.</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" class="reservasi-form-card">
        @csrf

        <div class="form-section-title">
            <h2>Informasi Booking</h2>
            <p>Isi kode booking, paket foto, harga otomatis, dan status reservasi.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="kode_booking">Kode Booking</label>
                <input
                    type="text"
                    name="kode_booking"
                    id="kode_booking"
                    placeholder="Contoh: BK026"
                    value="{{ old('kode_booking') }}"
                    class="{{ $errors->has('kode_booking') ? 'input-error' : '' }}"
                >
                @error('kode_booking')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="paket_foto">Pilih Paket Foto</label>
                <select name="paket_foto" id="paket_foto" class="{{ $errors->has('paket_foto') ? 'input-error' : '' }}">
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($filterPakets as $paket)
                        <option value="{{ $paket }}" {{ old('paket_foto') == $paket ? 'selected' : '' }}>
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
                    placeholder="Harga otomatis terisi"
                    value="{{ old('harga') }}"
                    class="{{ $errors->has('harga') ? 'input-error' : '' }}"
                    readonly
                >
                <small class="form-help">Harga akan otomatis terisi sesuai paket foto yang dipilih.</small>
                @error('harga')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="aktif">Status Reservasi</label>
                <select name="aktif" id="aktif" class="{{ $errors->has('aktif') ? 'input-error' : '' }}">
                    <option value="1" {{ old('aktif', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('aktif') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('aktif')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-section-title">
            <h2>Data Pelanggan</h2>
            <p>Masukkan identitas pelanggan yang melakukan reservasi.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input
                    type="text"
                    name="nama_pelanggan"
                    id="nama_pelanggan"
                    placeholder="Nama lengkap pelanggan"
                    value="{{ old('nama_pelanggan') }}"
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
                    placeholder="email@gmail.com"
                    value="{{ old('email') }}"
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
                    placeholder="@username"
                    value="{{ old('username_instagram') }}"
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
                    placeholder="081234567890"
                    value="{{ old('no_hp') }}"
                    class="{{ $errors->has('no_hp') ? 'input-error' : '' }}"
                >
                @error('no_hp')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-section-title">
            <h2>Jadwal Pemotretan</h2>
            <p>Tentukan jumlah orang, tanggal, dan slot jam reservasi pelanggan.</p>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="jumlah_orang">Jumlah Orang</label>
                <input
                    type="number"
                    name="jumlah_orang"
                    id="jumlah_orang"
                    placeholder="Contoh: 2"
                    value="{{ old('jumlah_orang') }}"
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
                    value="{{ old('tanggal_reservasi') }}"
                    class="{{ $errors->has('tanggal_reservasi') ? 'input-error' : '' }}"
                >
                @error('tanggal_reservasi')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="jam_reservasi">Jam Reservasi</label>
                <select name="jam_reservasi" id="jam_reservasi" class="{{ $errors->has('jam_reservasi') ? 'input-error' : '' }}">
                    <option value="">-- Pilih Jam Reservasi --</option>
                    <option value="09:00" {{ old('jam_reservasi') == '09:00' ? 'selected' : '' }}>09:00 - 10:00</option>
                    <option value="10:00" {{ old('jam_reservasi') == '10:00' ? 'selected' : '' }}>10:00 - 11:00</option>
                    <option value="11:00" {{ old('jam_reservasi') == '11:00' ? 'selected' : '' }}>11:00 - 12:00</option>
                    <option value="12:00" {{ old('jam_reservasi') == '12:00' ? 'selected' : '' }}>12:00 - 13:00</option>
                    <option value="13:00" {{ old('jam_reservasi') == '13:00' ? 'selected' : '' }}>13:00 - 14:00</option>
                    <option value="14:00" {{ old('jam_reservasi') == '14:00' ? 'selected' : '' }}>14:00 - 15:00</option>
                    <option value="15:00" {{ old('jam_reservasi') == '15:00' ? 'selected' : '' }}>15:00 - 16:00</option>
                    <option value="16:00" {{ old('jam_reservasi') == '16:00' ? 'selected' : '' }}>16:00 - 17:00</option>
                    <option value="17:00" {{ old('jam_reservasi') == '17:00' ? 'selected' : '' }}>17:00 - 18:00</option>
                    <option value="18:00" {{ old('jam_reservasi') == '18:00' ? 'selected' : '' }}>18:00 - 19:00</option>
                    <option value="19:00" {{ old('jam_reservasi') == '19:00' ? 'selected' : '' }}>19:00 - 20:00</option>
                    <option value="20:00" {{ old('jam_reservasi') == '20:00' ? 'selected' : '' }}>20:00 - 21:00</option>
                </select>
                @error('jam_reservasi')
                    <small class="error-text">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="reservasi-form-actions">
            <a href="{{ route('reservasi.index') }}" class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-create">
                Simpan Reservasi
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
