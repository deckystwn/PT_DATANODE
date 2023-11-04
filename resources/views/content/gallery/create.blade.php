@extends('layouts.main')

@section('title', 'Create Galery')

@section('content')
    <div class="container-fluid">
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <a href="{{ route('gallery') }}" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                    Galeri Baru
                </div>
                <div class="card-body">
                    {!! session('msg') !!}
                    <form action="{{ route('store-gallery') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input class="form-control mt-1 @error('judul') is-invalid @enderror" name="judul"
                                        type="text" id="judul" value="{{ old('judul') }}" />
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ asset('/assets/admin/images/profile/user-1.jpg') }}"
                                        class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <div class="input-group">
                                        <input type="file" name="gambar" id="gambar"
                                            class="form-control  @error('gambar') is-invalid @enderror" accept="image/*"
                                            onchange="previewImage('gambar', 'imagePreview')">
                                        @error('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="5"
                                    class="form-control mt-1 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-3">
                                <label for="gallery_category_id">Kategori Galeri</label>
                                <select name="gallery_category_id" id="gallery_category_id"
                                    class="form-control mt-1 @error('gallery_category_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    <?php $gallerycategories = \App\Models\GalleryCategory::all(); ?>
                                    @foreach ($gallerycategories as $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('gallery_category_id') == $row->id ? 'selected' : '' }}>
                                            {{ $row->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gallery_category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-0">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }
    </script>
@endpush
