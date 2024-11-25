<?php

namespace App\Http\Controllers;

use App\Models\PesanSaran;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PesanSaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pesansaran = PesanSaran::with('user')->get(); // Pastikan mengambil data dengan relasi user
        return view('pesansaran.index', compact('pesansaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang diinput oleh pengguna
        $validated = $request->validate([
            'nama' => 'required|string|max:255', // Nama harus diisi dan tidak lebih dari 255 karakter
            'email' => 'required|email|max:255', // Email harus diisi dan valid serta tidak lebih dari 255 karakter
            'pesan' => 'required|string', // Pesan harus diisi
        ]);

        $request->user()->pesanSaran()->create($validated);

        // Redirect kembali ke halaman form dan menampilkan pesan sukses
        return redirect()->route('pesan_saran.index')->with('success', 'Pesan saran berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(PesanSaran $pesanSaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesanSaran $pesanSaran)
    {
        return view('pesansaran.edit', compact('pesanSaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PesanSaran $pesanSaran)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255', // Nama harus diisi dan tidak lebih dari 255 karakter
            'email' => 'required|email|max:255', // Email harus diisi dan valid serta tidak lebih dari 255 karakter
            'pesan' => 'required|string', // Pesan harus diisi
        ]);

        $pesanSaran->update($validated); // Update data pesan saran

        // Redirect kembali ke halaman form dan menampilkan pesan sukses
        return redirect()->route('pesan_saran.index')->with('success', 'Pesan saran sudah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PesanSaran $pesanSaran)
    {
        // Hapus pesan saran
        $pesanSaran->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pesan_saran.index')->with('success', 'Pesan saran berhasil dihapus');
    }
}
