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

    <div class="live-search-card">
        <form id="liveSearchForm" class="live-search-form">
            @csrf

            <input
                type="text"
                id="liveSearchInput"
                name="keyword"
                placeholder="Ketik keyword pencarian..."
                autocomplete="off"
            >

            <button type="submit" class="btn-create">
                Cari
            </button>
        </form>
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

            <tbody id="reservasiTableBody">
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

    <div class="pagination-info" id="paginationInfo">
        <p>
            Menampilkan {{ $reservasis->firstItem() ?? 0 }} sampai {{ $reservasis->lastItem() ?? 0 }}
            dari {{ $reservasis->total() }} data reservasi.
        </p>
    </div>

    <div class="pagination-wrapper" id="paginationWrapper">
        {{ $reservasis->links() }}
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const liveSearchForm = document.getElementById('liveSearchForm');
        const liveSearchInput = document.getElementById('liveSearchInput');
        const reservasiTableBody = document.getElementById('reservasiTableBody');
        const liveSearchInfo = document.getElementById('liveSearchInfo');
        const paginationInfo = document.getElementById('paginationInfo');
        const paginationWrapper = document.getElementById('paginationWrapper');

        const csrfToken = '{{ csrf_token() }}';
        const liveSearchUrl = '{{ route('reservasi.live-search') }}';

        let searchTimer = null;

        function escapeHtml(value) {
            if (value === null || value === undefined) {
                return '';
            }

            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function setLoadingRow() {
            reservasiTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="empty-state">
                        Mencari data reservasi...
                    </td>
                </tr>
            `;
        }

        function setEmptyRow() {
            reservasiTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="empty-state">
                        Data reservasi tidak ditemukan.
                    </td>
                </tr>
            `;
        }

        function renderRows(reservasis) {
            if (!reservasis.length) {
                setEmptyRow();
                return;
            }

            let rows = '';

            reservasis.forEach((reservasi, index) => {
                const statusClass = reservasi.aktif ? 'status-active' : 'status-inactive';
                const statusText = reservasi.aktif ? 'Aktif' : 'Selesai';

                rows += `
                    <tr>
                        <td class="table-number">
                            ${index + 1}
                        </td>

                        <td>
                            <strong class="booking-code">
                                #${escapeHtml(reservasi.kode_booking)}
                            </strong>
                        </td>

                        <td>
                            <div class="customer-cell">
                                <strong>${escapeHtml(reservasi.nama_pelanggan)}</strong>
                                <span>${escapeHtml(reservasi.email)}</span>
                            </div>
                        </td>

                        <td>
                            <span class="package-badge">
                                ${escapeHtml(reservasi.paket_foto)}
                            </span>
                        </td>

                        <td>
                            <div class="schedule-cell">
                                <strong>${escapeHtml(reservasi.tanggal_reservasi)}</strong>
                                <span>${escapeHtml(reservasi.jam_reservasi)}</span>
                            </div>
                        </td>

                        <td>
                            <span class="status-badge ${statusClass}">
                                ${statusText}
                            </span>
                        </td>

                        <td>
                            <div class="reservasi-action-buttons">
                                <a href="${reservasi.show_url}" class="btn-action btn-detail">
                                    Detail
                                </a>

                                <a href="${reservasi.edit_url}" class="btn-action btn-edit-data">
                                    Edit
                                </a>

                                <form action="${reservasi.delete_url}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data reservasi ini?')">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" class="btn-action btn-delete-data">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                `;
            });

            reservasiTableBody.innerHTML = rows;
        }

        async function searchReservasi(keyword) {
            setLoadingRow();

            if (paginationInfo) {
                paginationInfo.style.display = keyword ? 'none' : '';
            }

            if (paginationWrapper) {
                paginationWrapper.style.display = keyword ? 'none' : '';
            }

            try {
                const response = await fetch(liveSearchUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        keyword: keyword
                    })
                });

                if (!response.ok) {
                    throw new Error('Gagal melakukan pencarian.');
                }

                const result = await response.json();

                renderRows(result.data);

                if (liveSearchInfo) {
                    if (keyword) {
                        liveSearchInfo.textContent = 'Ditemukan ' + result.count + ' data untuk keyword: "' + keyword + '".';
                    } else {
                        liveSearchInfo.textContent = 'Menampilkan data reservasi terbaru.';
                    }
                }
            } catch (error) {
                reservasiTableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="empty-state">
                            Terjadi kesalahan saat mencari data reservasi.
                        </td>
                    </tr>
                `;

                if (liveSearchInfo) {
                    liveSearchInfo.textContent = 'Pencarian gagal. Silakan coba lagi.';
                }
            }
        }

        liveSearchForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const keyword = liveSearchInput.value.trim();
            searchReservasi(keyword);
        });

        liveSearchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(function () {
                const keyword = liveSearchInput.value.trim();
                searchReservasi(keyword);
            }, 400);
        });
    });
</script>
@endpush
