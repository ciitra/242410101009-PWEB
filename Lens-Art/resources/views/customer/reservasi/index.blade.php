@extends('layouts.app')

@section('title', 'Reservasi Saya - Studio LensArt')

@section('content')
<section class="reservasi-index-section">
    <div class="reservasi-page-header">
        <div>
            <h1 class="section-title">Reservasi Saya</h1>
            <p class="section-desc">
                Berikut adalah daftar reservasi yang dibuat menggunakan akun customer ini.
            </p>
        </div>

        <a href="{{ route('customer.reservasi.create') }}" class="btn-create">
            Tambah Reservasi
        </a>
    </div>

    <div class="reservasi-summary-card">
        <div class="summary-icon">📸</div>
        <div>
            <h3>Total Reservasi Saya</h3>
            <p>{{ $reservasis->total() }} Data</p>
        </div>
    </div>

    <div class="table-container">
        <table class="reservasi-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Paket</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($reservasis as $index => $reservasi)
                    <tr>
                        <td>{{ $reservasis->firstItem() + $index }}</td>

                        <td>
                            <strong>#{{ $reservasi->kode_booking }}</strong>
                            <br>
                            <small>{{ $reservasi->nama_pelanggan }}</small>
                        </td>

                        <td>
                            <span class="package-badge">
                                {{ $reservasi->paket_foto }}
                            </span>
                        </td>

                        <td>
                            <strong>{{ $reservasi->tanggal_reservasi->format('d M Y') }}</strong>
                            <br>
                            <small>{{ substr($reservasi->jam_reservasi, 0, 5) }}</small>
                        </td>

                        <td>
                            @if ($reservasi->aktif)
                                <span class="status-badge status-active">Aktif</span>
                            @else
                                <span class="status-badge status-inactive">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            Belum ada reservasi yang dibuat oleh akun ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $reservasis->links() }}
    </div>
</section>
@endsection
