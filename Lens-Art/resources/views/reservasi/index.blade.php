@extends('layouts.app')

@section('title', 'Daftar Reservasi - Studio LensArt')

@section('content')
<section class="booking-section reservasi-index-section">
    <div class="reservasi-page-header">
        <div>
            <h1 class="section-title">Daftar Reservasi</h1>
            <p class="section-desc">
                Kelola semua data pesanan Studio LensArt secara rapi dan terstruktur.
            </p>
        </div>

        <a href="{{ route('reservasi.create') }}" class="btn-create">
            + Tambah Reservasi
        </a>
    </div>

    <div class="reservasi-summary-card">
        <div class="summary-icon">📅</div>
        <div>
            <h3>Total Data Reservasi</h3>
            <p>{{ $reservasis->total() }} Data</p>
        </div>
    </div>

    <div class="table-container reservasi-table-container">
        <table class="reservasi-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Booking</th>
                    <th>Pelanggan</th>
                    <th>Paket</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($reservasis as $reservasi)
                    <tr>
                        <td class="table-number">
                            {{ $reservasis->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong class="booking-code">
                                #{{ $reservasi->kode_booking }}
                            </strong>
                        </td>

                        <td>
                            <div class="customer-cell">
                                <strong>{{ $reservasi->nama_pelanggan }}</strong>
                                <span>{{ $reservasi->email }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="package-badge">
                                {{ $reservasi->paket_foto }}
                            </span>
                        </td>

                        <td>
                            <div class="schedule-cell">
                                <strong>
                                    {{ is_object($reservasi->tanggal_reservasi)
                                        ? $reservasi->tanggal_reservasi->format('d M Y')
                                        : date('d M Y', strtotime($reservasi->tanggal_reservasi)) }}
                                </strong>
                                <span>{{ substr($reservasi->jam_reservasi, 0, 5) }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="status-badge {{ $reservasi->aktif ? 'status-active' : 'status-inactive' }}">
                                {{ $reservasi->aktif ? 'Aktif' : 'Selesai' }}
                            </span>
                        </td>

                        <td>
                            <div class="reservasi-action-buttons">
                                <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn-action btn-detail">
                                    Detail
                                </a>

                                <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn-action btn-edit-data">
                                    Edit
                                </a>

                                <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data reservasi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-action btn-delete-data">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-state">
                            Belum ada data reservasi ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-info">
        <p>
            Menampilkan {{ $reservasis->firstItem() ?? 0 }} sampai {{ $reservasis->lastItem() ?? 0 }}
            dari {{ $reservasis->total() }} data reservasi.
        </p>
    </div>

    <div class="pagination-wrapper">
        {{ $reservasis->links() }}
    </div>
</section>
@endsection
