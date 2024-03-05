<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>

<body>
    <h1>Data User</h1>
    <a style="padding: 1rem; border: 1px solid black; border-radius: 0.5rem; margin: 1rem 0; display: inline-block"
        href="{{ route('/user/tambah') }}">Tambah
        User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>ID Level Pengguna</th>
                <th>Aksi</th>
            </tr>

            {{-- Praktikum 2.3 - Retreiving Aggregates --}}
            {{-- <tr>
                <th>Jumlah Pengguna</th>
            </tr> --}}
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr style="text-align: center;">
                    <td style="padding: 1rem">{{ $data->user_id }}</td>
                    <td style="padding: 1rem">{{ $data->username }}</td>
                    <td style="padding: 1rem">{{ $data->nama }}</td>
                    <td style="padding: 1rem">{{ $data->level_id }}</td>
                    <td style="padding: 1rem">
                        <a href="{{ route('/user/ubah', $data->user_id) }}">Ubah</a> |
                        <a href="{{ route('/user/hapus', $data->user_id) }}">Hapus</a>
                    </td>
                </tr>
            @endforeach

            {{-- <tr>
                <td>{{ $data->user_id }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->level_id }}</td>
            </tr> --}}

            {{-- Praktikum 2.3 - Retreiving Aggregates --}}
            {{-- <tr>
                <td>{{ $data }}</td>
            </tr> --}}
        </tbody>
    </table>
</body>

</html>
