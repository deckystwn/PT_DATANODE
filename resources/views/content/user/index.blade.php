@extends('layouts.main')

@section('title', 'User')

@section('content')
    <div class="container-fluid">
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header text-uppercase d-flex justify-content-between align-items-center">
                    <h1 style="font-size: 16px; font-weight: bold;" class="m-0">Users</h1>
                    <a href="{{ route('create-user') }}" class="me-2">
                        <i class='fas fa-plus-circle fa-lg'></i> Tambah User
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
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            <form action="{{ route('destroy-user', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('edit-user', $row->id) }}"
                                                    class="btn btn-datatable btn-icon btn-primary"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                <button {{ $row->id === 1 ? 'disabled' : '' }} type="submit"
                                                    class="btn btn-datatable btn-icon btn-danger"
                                                    onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($users->count() == 0)
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
@endsection
