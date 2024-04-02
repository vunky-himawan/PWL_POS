@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($stok)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/stok/' . $stok->stok_id) }}" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Barang</label>
                        <div class="col-11">
                            <select name="barang_id" id="barang" class="form-control">
                                <option value="">Pilih Barang</option>
                                @foreach ($listBarang as $barang)
                                    <option value="{{ $barang->barang_id }}" @if ($barang->barang_id == $stok->barang_id) selected @endif>
                                        {{ $barang->barang_kode }} -
                                        {{ $barang->barang_nama }}</option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pembuat: </label>
                        <div class="col-11">
                            <select name="user_id" id="user" class="form-control">
                                <option value="">Pilih User</option>
                                @foreach ($listUser as $user)
                                    <option value="{{ $user->user_id }}" @if ($user->user_id == $stok->user_id) selected @endif>
                                        {{ $user->nama }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Stok Tanggal</label>
                        <div class="col-11">
                            @php
                                $date = date('Y-m-d', strtotime($stok->stok_tanggal));
                            @endphp
                            <input type="date" class="form-control" id="stok_tanggal" name="stok_tanggal"
                                value="{{ old('stok_tanggal') ?? $date }}" required>
                            @error('stok_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jumlah</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="stok_jumlah" name="stok_jumlah"
                                value="{{ old('stok_jumlah') ?? $stok->stok_jumlah }}" required>
                            @error('stok_jumlah')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Sisa</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="stok_jumlah" name="sisa"
                                value="{{ old('sisa') ?? $stok->sisa }}" required>
                            @error('sisa')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                class="bi bi-floppy mr-2"></i>Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('stok') }}"><i
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
