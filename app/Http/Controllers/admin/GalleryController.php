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
        return view('content.gallery.index', [
            'galleries'     => Gallery::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('content.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['required', 'image', 'max:2048'],
            'gallery_category_id' => ['required'],
        ]);

        $filename_gambar = 'Gambar_' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();

        $request->file('gambar')->move('uploads/gallery', $filename_gambar);

        $gallery = new Gallery([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'],
            'gambar' => $filename_gambar,
            'gallery_category_id' => $data['gallery_category_id'],
        ]);

        $gallery->save();

        return redirect('gallery')->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }


    public function edit(Gallery $gallery)
    {
        return view('content.gallery.edit', [
            'gallery'          => $gallery,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'judul' => ['required'],
            'deskripsi' => ['required'],
            'gallery_category_id' => ['required'],
        ]);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => ['image', 'max:2048'],
            ]);

            $filename_gambar = 'Gambar_' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();

            $request->file('gambar')->move('uploads/gallery', $filename_gambar);

            if ($gallery->gambar) {
                if (file_exists('uploads/gallery/' . $gallery->gambar)) {
                    unlink('uploads/gallery/' . $gallery->gambar);
                }
            }

            $data['gambar'] = $filename_gambar;
        }

        $gallery->update($data);

        return redirect('gallery')->with('msg', '<div class="alert alert-success small" role="alert">Berhasil diperbarui!</div>');
    }



    public function destroy(Gallery $gallery)
    {
        Gallery::destroy($gallery->id);

        return back()->with('msg', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    }
}
