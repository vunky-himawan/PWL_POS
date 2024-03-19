@extends('layouts.app')

@section('subtitle', 'Tambah User')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Tambah User')

@section('content')
    <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Formulir</h3>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="nama">Nama</label>
                            <input type="email" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama" value="{{ old('nama') }}">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="username">Username</label>
                            <input type="email" class="form-control" id="username" name="username"
                                placeholder="Masukkan Username" value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" name="level" id="level">
                                    <option value="" disabled selected>Pilih Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->level_id }}">{{ $level->level_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
