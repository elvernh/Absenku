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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4] relative">
    <x-sidebar class="relative">
        <x-slot:type>{{ 'school' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage class="relative">
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <div>

            <div class="flex w-full flex-wrap  gap-5">
                <x-box>
                    <x-slot:text>Jumlah Extrakulikuler</x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Murid</x-slot:text>
                    <x-slot:value>10000</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Jumlah Vendor</x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>

            </div>
            <div class="mt-10 w-full  flex flex-wrap justify-between  mb-10">
                <!-- Table Section -->
                <div class="w-full xl:w-1/2">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold">Jadwal Hari Ini</h2>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                                    <th scope="col" class="px-6 py-3">Divisi</th>
                                    <th scope="col" class="px-6 py-3">Level</th>
                                    <th scope="col" class="px-6 py-3">Vendor</th>
                                    <th scope="col" class="px-6 py-3">Jam Mulai</th>
                                    <th scope="col" class="px-6 py-3">Jam Berakhir</th>
                                    <th scope="col" class="px-6 py-3">Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($excurVendors as $excurVendor)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $excurVendor->extracurricular->name }}
                                        </th>
                                        <td class="px-6 py-4">{{ $excurVendor->extracurricular->division }}</td>
                                        <td class="px-6 py-4">{{ $excurVendor->extracurricular->level }}</td>
                                        <td class="px-6 py-4">{{ $excurVendor->vendor->name }}</td>
                                        <td class="px-6 py-4">{{ $excurVendor->start_time }}</td>
                                        <td class="px-6 py-4">{{ $excurVendor->end_time }}</td>
                                        <td class="px-6 py-4">{{ $excurVendor->day }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full xl:w-[40%]">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold">Persentase</h2>
                    </div>
                    <div class="bg-white p-8 shadow rounded-lg border-slate-600 flex justify-center">
                        <!-- Canvas element with width and height defined in CSS -->
                        <canvas id="pieChart" class="w-[150px] h-[150px]"></canvas>
                    </div>
                </div>


            </div>

            <div class="w-full xl:w-[70%]">
                <div class="flex items-center mb-4">
                    <h2 class="text-2xl font-bold">Daftar Vendor</h2>
                    <div class="ms-20 text-white bg-green-600 flex ps-4 pt-2 pb-2 pe-4 rounded-lg">
                        <a href="/school/addvendor" class="text-sm">Tambah Vendor</a>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">id</th>
                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Alamat</th>
                                <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">Jumlah Ekskul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $vendor)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $vendor->id }}</td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $vendor->name }}
                                    </th>
                                    <td class="px-6 py-4">{{ $vendor->address }}</td>
                                    <td class="px-6 py-4">{{ $vendor->phone }}</td>
                                    <td class="px-6 py-4">{{ $vendor->email }}</td>
                                    <td class="px-6 py-4">{{ $vendor->description }}</td>
                                    <td class="px-6 py-4">{{ count($vendor->excurVendors) }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <img src="images/aset1.png" alt=""
                class="absolute left-[-90px] sm:left-[-70px] md:left-[-30px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] mb-4">
            <img src="images/aset5.png" alt=""
                class="absolute  right-[3px] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] mb-4">

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
                    labels: ['Completed', 'Remaining', 'ongoing'],
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error');
        @endif
    </script>

</body>

</html>
