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
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $stok->stok_id }}</td>
                    </tr>
                    <tr>
                        <th>Barang Kode</th>
                        <td>{{ $stok->barang->barang_kode }}</td>
                    </tr>
                    <tr>
                        <th>Barang Nama</th>
                        <td>{{ $stok->barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $stok->barang->kategori->kategori_kode }}</td>
                    </tr>
                    <tr>
                        <th>ID Penanggung Jawab</th>
                        <td>{{ $stok->user->user_id }}</td>
                    </tr>
                    <tr>
                        <th>Penanggung Jawab</th>
                        <td>{{ $stok->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Stok Tanggal</th>
                        <td>{{ $stok->stok_tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Sisa</th>
                        <td>{{ $stok->sisa }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $stok->stok_jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td>{{ $stok->barang->harga_beli }}</td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td>{{ $stok->barang->harga_jual }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $stok->barang->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $stok->updated_at }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2"><i
                class="bi bi-arrow-90deg-left mr-2"></i>Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
