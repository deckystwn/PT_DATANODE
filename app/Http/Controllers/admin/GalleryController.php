<?php

namespace App\Http\Controllers\admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.galleries', [
            'galleries'     => Gallery::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.gallery_create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'         => ['required'],
            'deskripsi'     => ['required'],
            'gambar'        => ['required'],
            'gallery_category_id'   => ['required']
        ]);
        
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->gambar->store('uploads');
        }
        
        Gallery::create($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery_edit', [
            'gallery'          => $gallery,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'judul'         => ['required'],
            'deskripsi'     => ['required'],
            'gambar'        => [''],
            'gallery_category_id'   => ['required']
        ]);

        if ($request->hasFile('gambar')) {
            if ($gallery->gambar) {
                Storage::delete($gallery->gambar);
            }
            $data['gambar'] = $request->gambar->store('uploads');
        }
        
        Gallery::where('id', $gallery->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Gallery $gallery)
    {
        Gallery::destroy($gallery->id);

        return back()->with('msg', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    }
}