<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        session()->flash('success', 'Halo! Selamat datang di Studio LensArt, Owner!');

        $filterPakets = [
            'Paket Indie',
            'Paket LensArt',
            'Paket Kalcer',
            'Paket Custom',
        ];

        $statCards = [
            [
                'judul' => 'Total Reservasi',
                'nilai' => '5',
                'ikon' => '📅',
                'warna' => 'stat-brown',
            ],
            [
                'judul' => 'Total Pendapatan',
                'nilai' => 'Rp380.000',
                'ikon' => '💰',
                'warna' => 'stat-orange',
            ],
            [
                'judul' => 'Paket Favorit',
                'nilai' => 'Paket LensArt',
                'ikon' => '📸',
                'warna' => 'stat-green',
            ],
        ];

        $sidebarStatistik = [
            [
                'label' => 'Total Reservasi',
                'id' => 'totalReservasi',
                'nilai' => '5',
                'class' => '',
            ],
            [
                'label' => 'Total Pendapatan',
                'id' => 'totalPendapatan',
                'nilai' => 'Rp380.000',
                'class' => '',
            ],
            [
                'label' => 'Paket Terpopuler',
                'id' => 'paketTerpopuler',
                'nilai' => 'Paket LensArt',
                'class' => '',
            ],
            [
                'label' => 'Jadwal Tersedia Hari Ini',
                'id' => 'jadwalTersedia',
                'nilai' => '14',
                'class' => '',
            ],
            [
                'label' => 'Status Slot Hari Ini',
                'id' => 'statusSlot',
                'nilai' => 'Slot aman',
                'class' => 'status-safe',
            ],
        ];

        $paketFotos = [
            [
                'nama' => 'Paket Indie',
                'deskripsi' => 'Durasi 10 menit sesi foto, 1 lembar print, dan softcopy file.',
                'harga' => 'Rp50.000',
            ],
            [
                'nama' => 'Paket LensArt',
                'deskripsi' => 'Durasi 15 menit sesi foto, 2 lembar print, dan softcopy file.',
                'harga' => 'Rp80.000',
            ],
            [
                'nama' => 'Paket Kalcer',
                'deskripsi' => 'Durasi 20 menit sesi foto, 4 lembar print, dan softcopy file.',
                'harga' => 'Rp120.000',
            ],
            [
                'nama' => 'Paket Custom',
                'deskripsi' => 'Paket foto fleksibel yang dapat disesuaikan dengan kebutuhan pelanggan.',
                'harga' => 'Rp150.000',
            ],
        ];

        $reservasiDummies = [
            [
                'kode' => 'BK001',
                'nama' => 'Alya Putri',
                'email' => 'alya@gmail.com',
                'instagram' => '@alyaputri',
                'no_hp' => '081234567890',
                'jumlah_orang' => 2,
                'paket' => 'Paket Indie',
                'harga' => 'Rp50.000',
                'tanggal' => '2026-05-12',
                'jam' => '10:00',
            ],
            [
                'kode' => 'BK002',
                'nama' => 'Bima Saputra',
                'email' => 'bima@gmail.com',
                'instagram' => '@bimasaputra',
                'no_hp' => '081234567891',
                'jumlah_orang' => 3,
                'paket' => 'Paket LensArt',
                'harga' => 'Rp80.000',
                'tanggal' => '2026-05-13',
                'jam' => '13:00',
            ],
            [
                'kode' => 'BK003',
                'nama' => 'Citra Lestari',
                'email' => 'citra@gmail.com',
                'instagram' => '@citralestari',
                'no_hp' => '081234567892',
                'jumlah_orang' => 4,
                'paket' => 'Paket Kalcer',
                'harga' => 'Rp120.000',
                'tanggal' => '2026-05-14',
                'jam' => '15:00',
            ],
            [
                'kode' => 'BK004',
                'nama' => 'Doni Pratama',
                'email' => 'doni@gmail.com',
                'instagram' => '@donipratama',
                'no_hp' => '081234567893',
                'jumlah_orang' => 2,
                'paket' => 'Paket Indie',
                'harga' => 'Rp50.000',
                'tanggal' => '2026-05-15',
                'jam' => '09:00',
            ],
            [
                'kode' => 'BK005',
                'nama' => 'Eva Maharani',
                'email' => 'eva@gmail.com',
                'instagram' => '@evamaharani',
                'no_hp' => '081234567894',
                'jumlah_orang' => 4,
                'paket' => 'Paket LensArt',
                'harga' => 'Rp80.000',
                'tanggal' => '2026-05-16',
                'jam' => '11:00',
            ],
        ];

        $jamReservasis = [
            '08:00',
            '09:00',
            '10:00',
            '11:00',
            '12:00',
            '13:00',
            '14:00',
            '15:00',
            '16:00',
            '17:00',
            '18:00',
            '19:00',
            '20:00',
            '21:00',
        ];

        return view('dashboard', compact(
            'filterPakets',
            'statCards',
            'sidebarStatistik',
            'paketFotos',
            'reservasiDummies',
            'jamReservasis'
        ));
    }
}
