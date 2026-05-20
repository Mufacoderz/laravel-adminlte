<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_berita;
use App\Models\M_kategori;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = M_berita::with('kategori')->get();
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        $kategori = M_kategori::all();
        return view('admin.berita.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'kategori_id'=>'required',
            'judul_berita'=>'required',
            'isi_berita'=>'required',
            'gambar'=>'required|image|mimes:png,jpg,jpeg,webp|max-:2048',
        ]);

        $namaGambar = null;
        if($request->hasFIle('gambar')){
        $namaGambar = time().'.'.$request->gambar->extension();

        $request->gambar->move(public_path('uploads'),$namaGambar);
        }

        M_berita::create([
            'kategori_id' => $request->kategori_id,
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,
            'gambar' => $namaGambar,
        ]);

        return redirect()->route('berita.index')->with('success', 'berita berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $berita = M_berita::findOrFail($id);
        $kategori = M_kategori::all();

        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'kategori_id'=>'required',
            'judul_berita'=>'required',
            'isi_berita'=>'required',
            'gambar'=>'nullable|image|mimes:png,jpg,jpeg,webp|max-:2048',
        ]);

        //tmbahan spesifik detail berita by id
        $berita = M_berita::findOrFail($id);
        $namaGambar = $berita->gambar;

        if($request->hasFIle('gambar')){

            if($fileLama = public_path(('uploads/'.$berita->gambar)))
            {
                if(file_exists($fileLama))
                {
                    unlink($fileLama);
                }
            }

            $namaGambar = time().'.'.$request->gambar->extension();

            $request->gambar->move(public_path('uploads'),$namaGambar);
        }

        $berita->update([
            'kategori_id' => $request->kategori_id,
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,
            'gambar' => $namaGambar,
        ]);
        return redirect()->route('berita.index')->with('success', 'berita berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
