<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Isi Pesan</title>
</head>
<body>
   <h3> Tunjukkan QR Code kepada panitian ketika akan mengikuti kegiatan </h3>
   <img src="{!!$message->embedData(QrCode::format('png')->size(400)->generate($userid), 'QrCode.png', 'image/png')!!}">
   </body>
</html>