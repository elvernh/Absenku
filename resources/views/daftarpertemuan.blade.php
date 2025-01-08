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
        <x-slot:type>{{ 'Vendor' }}</x-slot:type>
    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="flex justify-between">
                        <th scope="col" class="px-6 py-3">
                            Nama Ekskul
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah Murid
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hari
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Mulai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Berakhir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Detail Pertemuan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="flex justify-between bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">Kocak</td>
                    </tr>
                </tbody>
            </table>
        </div>
            
    </x-layout_homepage>

    <script></script>
</body>

</html>
