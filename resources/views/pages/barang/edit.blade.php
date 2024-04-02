@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($barang)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/barang/' . $barang->barang_id) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Barang Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="barang_kode" name="barang_kode"
                                value="{{ old('barang_kode', $barang->barang_kode) }}" required>
                            @error('barang_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Barang Nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="barang_nama" name="barang_nama"
                                value="{{ old('barang_nama', $barang->barang_nama) }}" required>
                            @error('barang_nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kategori Barang</label>
                        <div class="col-11">
                            <select class="form-control" name="kategori_id">
                                <option value="">Pilih Kategori</option>
                                @foreach ($listKategori as $kategori)
                                    <option value="{{ $kategori->kategori_id }}"
                                        {{ old('kategori_id', $barang->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
                                        {{ $kategori->kategori_nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Harga Beli</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                                value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                            @error('harga_beli')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Harga Jual</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                            @error('harga_jual')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                class="bi bi-floppy mr-2"></i>Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}"><i
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
