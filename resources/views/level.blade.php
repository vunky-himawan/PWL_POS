<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Level Pengguna</title>
</head>

<body>
    <h1>Data Level Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <thead>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->level_id }}</td>
                    <td>{{ $data->level_kode }}</td>
                    <td>{{ $data->level_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
