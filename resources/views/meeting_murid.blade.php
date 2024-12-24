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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">

    <x-sidebar class="relative">
        <x-slot:type>{{ 'student' }}</x-slot:type>
    </x-sidebar>

    <x-layout_homepage class="relative">
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>



        <div
            class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Tanggal</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Nama </h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Topic</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Pengajar</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Kehadiran</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Keterangan</h1>
        </div>

        <!-- Data Row -->
        @foreach ($presences as $presence)
            <div
                class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->meeting->meeting_date}}</h1>
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->meeting->excurVendor->extracurricular->name }}</h1>
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->meeting->topic }}</h1>
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->meeting->teacher }}</h1>
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->status->status_name }}</h1>
                <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $presence->keterangan }}</h1>

            </div>
        @endforeach

    </x-layout_homepage>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('pieChart');
            if (!canvas) {
                console.error('Canvas element with id "pieChart" not found.');
                return;
            }

            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'Remaining', 'Kenneth'],
                    datasets: [{
                        data: [25, 25, 50],
                        backgroundColor: ['#4CAF50', '#E0E0E0', '#1E1E1E'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Ensure it resizes proportionally
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                },
            });
        });
    </script>





</body>

</html>
