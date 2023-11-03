@extends('layouts.main')

@section('title', 'Create User')

@section('content')
    <div class="container-fluid">
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header text-uppercase">
                    <a href="{{ route('user') }}" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                    User Baru
                </div>
                <div class="card-body">
                    {!! session('msg') !!}
                    <form action="{{ route('store-user') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name"
                                        type="text" id="name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        id="email" type="email" />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password"
                                id="password" type="password" />
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
