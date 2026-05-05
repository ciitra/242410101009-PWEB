<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservasi;

class ReservasiSeeder extends Seeder
{
    public function run(): void
    {
        $reservasis = [
            [
                'kode_booking' => 'BK001',
                'nama_pelanggan' => 'Alya Putri',
                'email' => 'alya@gmail.com',
                'username_instagram' => '@alyaputri',
                'no_hp' => '081234567890',
                'jumlah_orang' => 2,
                'paket_foto' => 'Paket Indie',
                'harga' => 50000,
                'tanggal_reservasi' => '2026-05-12',
                'jam_reservasi' => '10:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK002',
                'nama_pelanggan' => 'Bima Saputra',
                'email' => 'bima@gmail.com',
                'username_instagram' => '@bimasaputra',
                'no_hp' => '081234567891',
                'jumlah_orang' => 3,
                'paket_foto' => 'Paket LensArt',
                'harga' => 80000,
                'tanggal_reservasi' => '2026-05-13',
                'jam_reservasi' => '13:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK003',
                'nama_pelanggan' => 'Citra Lestari',
                'email' => 'citra@gmail.com',
                'username_instagram' => '@citralestari',
                'no_hp' => '081234567892',
                'jumlah_orang' => 4,
                'paket_foto' => 'Paket Kalcer',
                'harga' => 120000,
                'tanggal_reservasi' => '2026-05-14',
                'jam_reservasi' => '15:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK004',
                'nama_pelanggan' => 'Doni Pratama',
                'email' => 'doni@gmail.com',
                'username_instagram' => '@donipratama',
                'no_hp' => '081234567893',
                'jumlah_orang' => 2,
                'paket_foto' => 'Paket Indie',
                'harga' => 50000,
                'tanggal_reservasi' => '2026-05-15',
                'jam_reservasi' => '09:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK005',
                'nama_pelanggan' => 'Eva Maharani',
                'email' => 'eva@gmail.com',
                'username_instagram' => '@evamaharani',
                'no_hp' => '081234567894',
                'jumlah_orang' => 4,
                'paket_foto' => 'Paket LensArt',
                'harga' => 80000,
                'tanggal_reservasi' => '2026-05-16',
                'jam_reservasi' => '11:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK006',
                'nama_pelanggan' => 'Farhan Ramadhan',
                'email' => 'farhan@gmail.com',
                'username_instagram' => '@farhanramadhan',
                'no_hp' => '081234567895',
                'jumlah_orang' => 5,
                'paket_foto' => 'Paket Kalcer',
                'harga' => 120000,
                'tanggal_reservasi' => '2026-05-17',
                'jam_reservasi' => '14:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK007',
                'nama_pelanggan' => 'Gita Anindya',
                'email' => 'gita@gmail.com',
                'username_instagram' => '@gitaanindya',
                'no_hp' => '081234567896',
                'jumlah_orang' => 1,
                'paket_foto' => 'Paket Custom',
                'harga' => 150000,
                'tanggal_reservasi' => '2026-05-18',
                'jam_reservasi' => '16:00',
                'aktif' => true,
                'foto' => null,
            ],
            [
                'kode_booking' => 'BK008',
                'nama_pelanggan' => 'Hana Safira',
                'email' => 'hana@gmail.com',
                'username_instagram' => '@hanasafira',
                'no_hp' => '081234567897',
                'jumlah_orang' => 2,
                'paket_foto' => 'Paket Indie',
                'harga' => 50000,
                'tanggal_reservasi' => '2026-05-19',
                'jam_reservasi' => '08:00',
                'aktif' => false,
                'foto' => null,
            ],
        ];

        foreach ($reservasis as $reservasi) {
            Reservasi::create($reservasi);
        }
    }
}
