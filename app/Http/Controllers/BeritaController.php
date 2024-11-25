<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $beritum = new Berita();
        $beritum->judul = $request->judul;
        $beritum->isi_berita = $request->isi_berita;

        if ($request->hasFile('gambar')){
            $beritum->gambar = $request->file('gambar')->store('images','public');
        }
        $beritum->save();
        return redirect()->route('berita.index')->with('success','Berita berhasil ditambahkan!');

    }


    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $beritum)
    {
        return view('berita.edit', compact('beritum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $beritum->judul = $request->judul;
        $beritum->isi_berita = $request->isi_berita;

        if($request->hasFile('gambar')){
            if($beritum->gambar){
                Storage::delete('public/'.$beritum->gambar);
            }
            $beritum->gambar = $request->file('gambar')->store('images','public');
        }

        $beritum->save();
        return redirect()->route('berita.index')->with('success','Berita berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum)
    {
        if($beritum->gambar){
            Storage::delete('public/' .$beritum->gambar);
        }

        $beritum->delete();
        return redirect()->route('berita.index')->with('success',('Data berhasil dihapus!'));
    }
}
