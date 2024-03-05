<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Data</title>
</head>

<body>
    <h1>Form Ubah Data User</h1>
    <a href="{{ route('/user') }}">Kembali</a>
    <form action="{{ route('/user/ubah_simpan', $data->user_id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ $data->username }}">
        <br>

        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ $data->nama }}">
        <br>

        <label for="level_id">Level ID</label>
        <input type="number" name="level_id" id="level_id" value="{{ $data->level_id }}">
        <br>

        <input type="submit" name="btn btn-success" value="Ubah">
    </form>
</body>

</html>
