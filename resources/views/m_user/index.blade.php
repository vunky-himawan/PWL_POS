@extends('layouts.app')

@section('subtitle', 'Users')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Users')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="/m_user/create" class="btn btn-primary"><i class="fas fa-plus mr-1"></i>Tambah Data User</a>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Level</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($useri as $user)
                                <tr>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->level->level_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->password }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="/m_user/{{ $user->user_id }}">Show</a>
                                        <a class="btn btn-success" href="/m_user/{{ $user->user_id }}/edit">Edit</a>
                                        <a class="btn btn-danger" href="/m_user/hapus/{{ $user->user_id }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Level</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
