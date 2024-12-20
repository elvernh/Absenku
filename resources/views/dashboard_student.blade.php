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
    <!-- Sidebar -->
    <x-sidebar>
        <x-slot:type>{{ 'Murid' }}</x-slot:type>
    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div>
            <!-- Cards Section -->
            <div class="flex w-full flex-wrap gap-5 mb-10">
                <x-box>
                    <x-slot:text>Total Tagihan </x-slot:text>
                    <x-slot:value>{{ $studentExcur->bill }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Mid Score </x-slot:text>
                    <x-slot:value>{{ $studentExcur->score_mid }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Final Score </x-slot:text>
                    <x-slot:value>{{ $studentExcur->score_final }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Extrakulikuler </x-slot:text>
                    <x-slot:value>{{ $sum }}</x-slot:value>
                </x-box>
            </div>

            <!-- Chart Section -->
            <div class="flex w-full gap-4">
                <!-- Pie Chart -->
                <div
                    class="w-1/2 bg-white py-10 px-8 shadow flex flex-col items-center justify-center border-s-[10px] border-custom-blue">
                    <h1 class="text-center font-medium">Data</h1>
                    <div class="mt-10">
                        <canvas id="pieChart" width="300" height="300"></canvas>
                    </div>

                </div>
                <!-- Empty Section -->
                <div class="w-1/2 bg-white py-10 shadow border-s-[10px] border-custom-blue"></div>
            </div>
        </div>
    </x-layout_homepage>

    <!-- Scripts -->
    <script></script>
</body>

</html>
