<?php

namespace App\Http\Controllers\Api;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Schema(
 *     schema="Berita",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="The ID of the berita"),
 *     @OA\Property(property="judul", type="string", description="The title of the berita"),
 *     @OA\Property(property="isi_berita", type="string", description="The content of the berita"),
 *     @OA\Property(property="gambar", type="string", description="The image URL for the berita")
 * )
 */

class BeritaController extends Controller
{
    /**
 * Menampilkan daftar berita.
 *
 * @OA\Get(
 *     path="/api/beritas",
 *     summary="Menampilkan semua berita",
 *     tags={"Berita"},
 *     @OA\Response(
 *         response=200,
 *         description="Daftar berita",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Berita"))
 *     ),
 *     security={{"passport": {}}}
 * )
 */
    public function index()
    {
        $berita = DB::table('berita')->get();
        return response()->json($berita);
    }

       /**
 * Membuat berita baru.
 *
 * @OA\Post(
 *     path="/api/beritas",
 *     summary="Membuat berita baru",
 *     tags={"Berita"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"judul", "isi_berita"},
 *             @OA\Property(property="judul", type="string", example="Berita Baru"),
 *             @OA\Property(property="isi_berita", type="string", example="Isi berita"),
 *             @OA\Property(property="gambar", type="string", example="image.jpg")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Berita berhasil dibuat",
 *         @OA\JsonContent(ref="#/components/schemas/Berita")
 *     ),
 *     security={{"passport": {}}}
 * )
 */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')){
            $path = $request->file('gambar')->store('berita', 'public');
        }
        $id = DB::table('berita')->insertGetId([
            'judul' => $request->judul,
            'isi_berita' => $request->isi_berita,
            'gambar' => $path,
        ]);

        $berita = DB::table('berita')->where('id', $id)->first();
        $berita->gambar = $berita->gambar ? Storage::url($berita->gambar) : null;

        return response()->json($berita, 201);
    }

    /**
 * Menampilkan satu berita berdasarkan ID.
 *
 * @OA\Get(
 *     path="/api/beritas/{id}",
 *     summary="Menampilkan berita berdasarkan ID",
 *     tags={"Berita"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID berita",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Berita ditemukan",
 *         @OA\JsonContent(ref="#/components/schemas/Berita")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Berita tidak ditemukan"
 *     ),
 *     security={{"passport": {}}}
 * )
 */
    public function show($id)
    {
        $berita = DB::table('berita')->where('id', $id)->first();
        if (!$berita){
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }
        $berita->gambar = $berita->gambar ? Storage::url($berita->gambar) : null;
        return response()->json($berita);
    }

    /**
 * Mengupdate berita yang ada.
 *
 * @OA\Put(
 *     path="/api/beritas/{id}",
 *     summary="Mengupdate berita berdasarkan ID",
 *     tags={"Berita"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID berita",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="judul", type="string", example="Judul Diperbarui"),
 *             @OA\Property(property="isi_berita", type="string", example="Isi berita diperbarui"),
 *             @OA\Property(property="gambar", type="string", example="gambar-diperbarui")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Berita berhasil diperbarui",
 *         @OA\JsonContent(ref="#/components/schemas/Berita")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Berita tidak ditemukan"
 *     ),
 *     security={{"passport": {}}}
 * )
 */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $berita = DB::table('berita')->where('id', $id)->first();
        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
    }

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
        }
        $path = $request->file('gambar')->store('berita', 'public');
        } else {
            $path = $berita->gambar; // Use existing image if no new image is uploaded
        }

        DB::table('berita')->where('id', $id)->update([
            'judul' => $request->judul,
            'isi_berita' => $request->isi_berita,
            'gambar' => $path,
        ]);

        $beritaUpdated = DB::table('berita')->where('id', $id)->first();
        $beritaUpdated->gambar = $beritaUpdated->gambar ? Storage::url($beritaUpdated->gambar) : null;

        return response()->json($beritaUpdated);
    }

    /**
 * Menghapus berita berdasarkan ID.
 *
 * @OA\Delete(
 *     path="/api/beritas/{id}",
 *     summary="Menghapus berita berdasarkan ID",
 *     tags={"Berita"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID berita",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Berita berhasil dihapus"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Berita tidak ditemukan"
 *     ),
 *     security={{"passport": {}}}
 * )
 */
    public function destroy(string $id)
    {
        $berita = DB::table('berita')->where('id', $id)->first();
        if (!$berita){
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }
        if ($berita->gambar){
            Storage::disk('public')->delete($berita->gambar);
        }
        DB::table('berita')->where('id', $id)->delete();
        return response()->json(['message' => 'Berita berhasil dihapus']);
    }
}
