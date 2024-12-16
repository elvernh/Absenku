<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/Atten-cropped.svg')}}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

</head>
<body class="w-screen h-screen flex justify-center items-center" style="background-image: url('{{ asset('images/doodles.svg') }}'); background-size: cover;">
    <x-loginform :type="$type">{{ $type }}</x-loginform>
</body>
</html>
