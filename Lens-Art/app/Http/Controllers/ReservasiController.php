<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasis = Reservasi::latest()->paginate(10);

        return view('reservasi.index', compact('reservasis'));
    }

    public function create()
    {
        $filterPakets = [
            'Paket Indie',
            'Paket LensArt',
            'Paket Kalcer',
            'Paket Custom',
        ];

        return view('reservasi.create', compact('filterPakets'));
    }

    public function store(Request $request)
    {
        $daftarHarga = [
            'Paket Indie' => 50000,
            'Paket LensArt' => 80000,
            'Paket Kalcer' => 120000,
            'Paket Custom' => 150000,
        ];

        $validatedData = $request->validate([
            'kode_booking' => 'required|unique:reservasis,kode_booking',
            'nama_pelanggan' => 'required|min:3',
            'email' => 'required|email|unique:reservasis,email',
            'username_instagram' => 'required|min:3',
            'no_hp' => 'required|numeric',
            'jumlah_orang' => 'required|integer|min:1',
            'paket_foto' => 'required|in:Paket Indie,Paket LensArt,Paket Kalcer,Paket Custom',
            'tanggal_reservasi' => 'required|date',
            'jam_reservasi' => 'required|in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00,18:00,19:00,20:00',
            'aktif' => 'required|boolean',
        ], [
            'kode_booking.required' => 'Kode booking wajib diisi.',
            'kode_booking.unique' => 'Kode booking sudah digunakan.',

            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'nama_pelanggan.min' => 'Nama pelanggan minimal 3 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'username_instagram.required' => 'Username Instagram wajib diisi.',
            'username_instagram.min' => 'Username Instagram minimal 3 karakter.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP hanya boleh berisi angka.',

            'jumlah_orang.required' => 'Jumlah orang wajib diisi.',
            'jumlah_orang.integer' => 'Jumlah orang harus berupa angka.',
            'jumlah_orang.min' => 'Jumlah orang minimal 1.',

            'paket_foto.required' => 'Paket foto wajib dipilih.',
            'paket_foto.in' => 'Paket foto tidak valid.',

            'tanggal_reservasi.required' => 'Tanggal reservasi wajib diisi.',
            'tanggal_reservasi.date' => 'Tanggal reservasi tidak valid.',

            'jam_reservasi.required' => 'Jam reservasi wajib dipilih.',
            'jam_reservasi.in' => 'Jam reservasi tidak valid.',

            'aktif.required' => 'Status reservasi wajib dipilih.',
            'aktif.boolean' => 'Status reservasi tidak valid.',
        ]);

        $validatedData['harga'] = $daftarHarga[$validatedData['paket_foto']];

        Reservasi::create($validatedData);

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Data reservasi berhasil ditambahkan.');
    }

    public function show(Reservasi $reservasi)
    {
        return view('reservasi.show', compact('reservasi'));
    }

    public function edit(Reservasi $reservasi)
    {
        $filterPakets = [
            'Paket Indie',
            'Paket LensArt',
            'Paket Kalcer',
            'Paket Custom',
        ];

        return view('reservasi.edit', compact('reservasi', 'filterPakets'));
    }

    public function update(Request $request, Reservasi $reservasi)
    {
        $daftarHarga = [
            'Paket Indie' => 50000,
            'Paket LensArt' => 80000,
            'Paket Kalcer' => 120000,
            'Paket Custom' => 150000,
        ];

        $validatedData = $request->validate([
            'kode_booking' => 'required|unique:reservasis,kode_booking,' . $reservasi->id,
            'nama_pelanggan' => 'required|min:3',
            'email' => 'required|email|unique:reservasis,email,' . $reservasi->id,
            'username_instagram' => 'required|min:3',
            'no_hp' => 'required|numeric',
            'jumlah_orang' => 'required|integer|min:1',
            'paket_foto' => 'required|in:Paket Indie,Paket LensArt,Paket Kalcer,Paket Custom',
            'tanggal_reservasi' => 'required|date',
            'jam_reservasi' => 'required|in:09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00,18:00,19:00,20:00',
            'aktif' => 'required|boolean',
        ], [
            'kode_booking.required' => 'Kode booking wajib diisi.',
            'kode_booking.unique' => 'Kode booking sudah digunakan.',

            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'nama_pelanggan.min' => 'Nama pelanggan minimal 3 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'username_instagram.required' => 'Username Instagram wajib diisi.',
            'username_instagram.min' => 'Username Instagram minimal 3 karakter.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP hanya boleh berisi angka.',

            'jumlah_orang.required' => 'Jumlah orang wajib diisi.',
            'jumlah_orang.integer' => 'Jumlah orang harus berupa angka.',
            'jumlah_orang.min' => 'Jumlah orang minimal 1.',

            'paket_foto.required' => 'Paket foto wajib dipilih.',
            'paket_foto.in' => 'Paket foto tidak valid.',

            'tanggal_reservasi.required' => 'Tanggal reservasi wajib diisi.',
            'tanggal_reservasi.date' => 'Tanggal reservasi tidak valid.',

            'jam_reservasi.required' => 'Jam reservasi wajib dipilih.',
            'jam_reservasi.in' => 'Jam reservasi tidak valid.',

            'aktif.required' => 'Status reservasi wajib dipilih.',
            'aktif.boolean' => 'Status reservasi tidak valid.',
        ]);

        $validatedData['harga'] = $daftarHarga[$validatedData['paket_foto']];

        $reservasi->update($validatedData);

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Data reservasi berhasil diperbarui.');
    }

    public function destroy(Reservasi $reservasi)
    {
        $reservasi->delete();

        return redirect()
            ->route('reservasi.index')
            ->with('success', 'Data reservasi berhasil dihapus!');
    }
}
