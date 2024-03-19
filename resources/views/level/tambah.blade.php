@extends('layouts.app')

@section('subtitle', 'Tambah Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Tambah Level')

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
                            <label for="level_kode">Level Kode</label>
                            <input type="text" class="form-control" id="level_kode" name="level_kode"
                                placeholder="Masukkan Kode Level">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="level_nama">Level Name</label>
                            <input type="text" class="form-control" id="level_nama" name="level_nama"
                                placeholder="Masukkan Nama Level">
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
