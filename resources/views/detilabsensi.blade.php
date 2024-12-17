<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/Atten-cropped.svg')}}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detil Absensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    {{-- sidebar --}}
    <x-sidebar></x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <div class="flex flex-wrap items-center justify-between bg-white w-full h-[500px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4"">
            <div>
                {{ $ekskul->name }}
            </div>
        </div>
    </x-layout_homepage>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        const content = document.getElementById('content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-64');
            content.classList.toggle('ml-64');
        });
    </script>
</body>

</html>
