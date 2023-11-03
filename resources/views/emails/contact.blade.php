<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PT Datanode</title>
</head>

<body>
    <p>
        <b>{{ $data['name'] }}</b> telah mengisi formulir kontak melalui website PT Datanode, berikut informasi
        pesan yang dikirim:
    </p>
    <p>
        <b>Nama:</b> {{ $data['name'] }}<br />
        <b>Email:</b> {{ $data['email'] }}<br />
        <b>Subject:</b> {{ $data['subject'] }}<br />
        <b>Pesan:</b>
        <br />
        {{ $data['message'] }}
    </p>
</body>

</html>
