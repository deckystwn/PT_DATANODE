@extends('layouts.main')

@section('title', 'Galery Category')

@section('content')
    <div class="container-fluid">
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header text-uppercase d-flex justify-content-between align-items-center">
                    <h1 style="font-size: 16px; font-weight: bold;" class="m-0">Galeri Kategori</h1>
                    <a href="javascript:void(0)" class="addGalleryCategory" data-bs-toggle="modal"
                        data-bs-target="#galleryCategoryModal">
                        <i class='fas fa-plus-circle fa-lg'></i> Tambah Kategori
                    </a>
                </div>

                <div class="card-body">
                    {!! session('msg') !!}
                    <div class="table-responsive">
                        <table id="tableStandar" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gallerycategories as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $row->name }} <label
                                                style="color: red">({{ $row->galleries->count() }})</label>
                                        </td>
                                        <td>
                                            <form action="/admin/gallerycategory/{{ $row->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)"
                                                    class="editGalleryCategory btn btn-datatable btn-icon btn-primary"
                                                    data-id="{{ $row->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#galleryCategoryModal"><i
                                                        class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <button {{ $row->galleries->count() != 0 ? 'disabled' : '' }} type="submit"
                                                    class="btn btn-datatable btn-icon btn-danger"
                                                    onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($gallerycategories->count() == 0)
                                    <tr>
                                        <td colspan="6" style="text-align: center;font-style:italic">Belum Ada Data Yang
                                            Tersedia
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="galleryCategoryModal" tabindex="-1" aria-labelledby="galleryCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryCategoryModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Kategori Galeri</label>
                            <input required type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.addGalleryCategory').on('click', function() {
            $('#galleryCategoryModalLabel').html('Kategori Galeri Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/admin/gallerycategory');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
        });

        $(document).on('click', '.editGalleryCategory', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#galleryCategoryModalLabel').html('Perbarui Kategori Galeri');
            $('.modal form').prop('action', '/admin/gallerycategory/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/api/gallerycategory/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                }
            });
        });
    </script>
@endpush
