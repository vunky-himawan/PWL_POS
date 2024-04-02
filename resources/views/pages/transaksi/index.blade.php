@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('transaksi/create') }}"><i class="bi bi-plus-lg mr-3"></i>Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <!-- Button trigger modal -->
            <div class="form-group row justify-content-end">
                <button type="button" class="btn border px-3" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="bi bi-filter mr-3"></i>Filter
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col">
                                            <select name="user_id" id="user_id" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                @foreach ($listUser as $user)
                                                    <option value="{{ $user->user_id }}">{{ $user->nama }}</option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">User Nama</small>
                                        </div>
                                        <div class="col">
                                            <select name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                <option value="UPDATED">Diedit</option>
                                                <option value="ORIGINAL">Asli</option>
                                            </select>
                                            <small class="form-text text-muted">Status Data</small>
                                        </div>
                                        <div class="col">
                                            <select name="barang_id" id="barang_id" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                @foreach ($listBarang as $barang)
                                                    <option value="{{ $barang->barang_id }}">{{ $barang->barang_nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Barang</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                @foreach ($listKategori as $kategori)
                                                    <option value="{{ $kategori->kategori_id }}">
                                                        {{ $kategori->kategori_nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="form-text text-muted">Kategori Barang</small>
                                        </div>
                                        <div class="col">
                                            <select name="bulan" id="bulan" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                            <small class="form-text text-muted">Bulan Transaksi</small>
                                        </div>
                                        <div class="col">
                                            <select name="tahun" id="tahun" class="form-control" required>
                                                <option value="">- Semua -</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                            </select>
                                            <small class="form-text text-muted">Tahun Transaksi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="tabel_transaksi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Penjualan Kode</th>
                        <th>Pembuat</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            var dataUser = $('#tabel_transaksi').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('transaksi/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    'data': function(d) {
                        d.user_id = $('#user_id').val();
                        d.penjualan_kode = $('#penjualan_kode').val();
                        d.barang_id = $('#barang_id').val();
                        d.kategori_id = $('#kategori_id').val();
                        d.bulan = $('#bulan').val();
                        d.tahun = $('#tahun').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'penjualan_kode',
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "user.nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "pembeli",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'penjualan_tanggal',
                        className: "text-center",
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#user_id').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#penjualan_kode').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#barang_id').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#kategori_id').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#bulan').on('change', function() {
                dataUser.ajax.reload();
            });

            $('#tahun').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush
