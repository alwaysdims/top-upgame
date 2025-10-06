<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Daftar User</h2>

<table border="1">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $user)
            <tr>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['username'] }}</td>
                <td>{{ $user['email'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Tidak ada data pengguna.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>