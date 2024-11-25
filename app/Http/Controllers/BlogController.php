<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            '13_judul' => 'required|string|max:255',
            '13_kategori' => 'required|string|max:255',
            '13_status' => 'required|string|max:255',
            '13_artikel' => 'required|string|max:255',
            '13_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $blog = new Blog();
        $blog->{'13_judul'} = $request->{'13_judul'};
        $blog->{'13_kategori'} = $request->{'13_kategori'};
        $blog->{'13_status'} = $request->{'13_status'};
        $blog->{'13_artikel'} = $request->{'13_artikel'};

        if ($request->hasFile('gambar')){
            $blog->gambar = $request->file('13_gambar')->store('image','public');
        }
        $blog->save();
        return redirect()->route('blog.index')->with('success','Blog berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blog $blog)
    {
        $request->validate([
            '13_judul' => 'required|string|max:255',
            '13_kategori' => 'required|string|max:255',
            '13_status' => 'required|string|max:255',
            '13_artikel' => 'required|string|max:255',
            '13_gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $blog->{'13_judul'} = $request->{'13_judul'};
        $blog->{'13_kategori'} = $request->{'13_kategori'};
        $blog->{'13_status'} = $request->{'13_status'};
        $blog->{'13_artikel'} = $request->{'13_artikel'};

        if($request->hasFile('gambar')){
            if($blog->gambar){
                Storage::delete('public/'.$blog->gambar);
            }
            $blog->gambar = $request->file('13_gambar')->store('image','public');
        }

        $blog->save();
        return redirect()->route('blog.index')->with('success','Blog berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        if($blog->gambar){
            Storage::delete('public/' .$blog->gambar);
        }

        $blog->delete();
        return redirect()->route('blog.index')->with('success',('Data berhasil dihapus!'));
    }
}
