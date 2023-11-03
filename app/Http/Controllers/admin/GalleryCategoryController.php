<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        return view('admin.gallerycategories', [
            'gallerycategories'      => GalleryCategory::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:gallery_categories']
        ]);
        GalleryCategory::create($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $data = $request->validate([
            'name' => $request->name !== $galleryCategory->name ? ['required', 'min:3', 'max:255', 'unique:gallery_categories'] : ['required', 'min:3', 'max:255']
        ]);

        GalleryCategory::where('id', $galleryCategory->id)->update($data);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        GalleryCategory::destroy($galleryCategory->id);

        return back()->with('msg', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
    }

    public function api_gallerycategory(GalleryCategory $galleryCategory)
    {
        return response()->json($galleryCategory);
    }
}