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
                    <x-slot:value>{{ $studentExcurs->bill }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Mid Score </x-slot:text>
                    <x-slot:value>{{ $studentExcurs->score_mid }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Final Score </x-slot:text>
                    <x-slot:value>{{ $studentExcurs->score_final }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Extrakulikuler </x-slot:text>
                    <x-slot:value>{{ $sum }}</x-slot:value>
                </x-box>
            </div>

            <div class="flex w-full flex-wrap justify-between">
                <div class="w-full xl:w-1/2">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold">Ekstrakurikuler yang diikuti</h2>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nomor</th>
                                    <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                                    <th scope="col" class="px-6 py-3">Jam Mulai</th>
                                    <th scope="col" class="px-6 py-3">Jam Berakhir</th>
                                    <th scope="col" class="px-6 py-3">Level</th>
                                    <th scope="col" class="px-6 py-3">Divisi</th>

                                </tr>
                            </thead>
                            <tbody>

                                @for ($i = 0; $i < count($results); $i++)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->extracurricular->name }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->start_time }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->end_time }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->extracurricular->level }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->extracurricular->division }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $results[$i]->excurVendor->day }}
                                        </th>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full xl:w-[40%]">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold">Jadwal Hari Ini</h2>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px] border-slate-600">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nomor</th>
                                    <th scope="col" class="px-6 py-3">Ekstrakurikuler</th>
                                    <th scope="col" class="px-6 py-3">Jam Mulai</th>
                                    <th scope="col" class="px-6 py-3">Jam Akhir</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nows as $key => $now)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $key + 1 }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $now->excurVendor->extracurricular->name ?? 'Tidak diketahui' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $now->excurVendor->start_time }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $now->excurVendor->end_time }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

    </x-layout_homepage>

    <!-- Scripts -->
    <script></script>
</body>

</html>
