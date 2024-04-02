@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('stok') }}" class="form-horizontal">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Barang</label>
                    <div class="col-11">
                        <select name="barang_id" id="barang" class="form-control">
                            <option value="">Pilih Barang</option>
                            @foreach ($listBarang as $barang)
                                <option value="{{ $barang->barang_id }}">{{ $barang->barang_kode }} -
                                    {{ $barang->barang_nama }}</option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Penanggung Jawab</label>
                    <div class="col-11">
                        <select name="user_id" id="user" class="form-control">
                            <option value="">Pilih Penanggung Jawab</option>
                            @foreach ($listUser as $user)
                                <option value="{{ $user->user_id }}">{{ $user->nama }}</option>
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
                        <input type="date" class="form-control" id="stok_tanggal" name="stok_tanggal"
                            value="{{ old('stok_tanggal') ?? $today }}" required>
                        @error('stok_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Jumlah</label>
                    <div class="col-11">
                        <input type="number" min="1" max="100" class="form-control" id="stok_jumlah"
                            name="stok_jumlah" value="{{ old('stok_jumlah') }}" required>
                        @error('stok_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-floppy mr-2"></i>Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('stok') }}"><i class="bi bi-arrow-90deg-left mr-2"></i>Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
