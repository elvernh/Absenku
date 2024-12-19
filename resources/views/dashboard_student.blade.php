<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
        <x-slot:type>{{ 'Murid' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div>
            <div class="flex w-full flex-wrap  gap-5">
                <x-box>
                    <x-slot:text>Total Tagihan: </x-slot:text>
                    <x-slot:value>100000</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Mid Score: </x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Final Score: </x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Extrakulikuler aktif</x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>
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
