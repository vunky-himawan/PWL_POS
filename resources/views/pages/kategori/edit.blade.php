@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($category)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kategori') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/kategori/' . $category->kategori_id) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kategori Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kategori_kode" name="kategori_kode"
                                value="{{ old('kategori_kode', $category->kategori_kode) }}" required>
                            @error('kategori_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kategori Nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                                value="{{ old('kategori_nama', $category->kategori_nama) }}" required>
                            @error('kategori_nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                class="bi bi-floppy mr-2"></i>Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('kategori') }}"><i
                                class="bi bi-arrow-90deg-left mr-2"></i>Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
