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

<body class="flex overflow-x-hidden bg-[#f4f4f4bd] relative">

    <!-- Sidebar -->
    <x-sidebar class="relative">
        <x-slot:type>{{ 'student' }}</x-slot:type>
    </x-sidebar>

    <!-- Main Layout -->
    <x-layout_homepage class="relative">
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:filename>{{ $filename }}</x-slot:filename>

        <div>
            <!-- Cards Section -->
            <div class="flex w-full flex-wrap gap-5 mb-10">

                <x-box>
                    <x-slot:text>Mid Score </x-slot:text>
                    <x-slot:value>{{ $midScore }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Final Score </x-slot:text>
                    <x-slot:value>{{ $finalScore }}</x-slot:value>
                </x-box>
                <x-box>
                    <x-slot:text>Extrakulikuler </x-slot:text>
                    <x-slot:value>{{ count($results) }}</x-slot:value>
                </x-box>
            </div>
            <div class="flex w-full flex-wrap justify-between ">
                <div class="w-full xl:w-1/2 ">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold">Ekstrakurikuler yang diikuti</h2>

                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-[1px]  bg-[#f6f6f685]">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                            <thead class="text-xs text-gray-700 uppercase  dark:text-gray-400">
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
                                @if (count($results) != 0)
                                    @foreach ($results as $result)
                                        <tr
                                            class=" border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration }}
                                            </th>
                                            
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->extracurricular->name }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->start_time }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->end_time }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->extracurricular->level }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->extracurricular->division }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                                {{ $result->excurVendor->day }}
                                            </th>
                                        </tr>
                                @endforeach
                    </div>
                    </tbody>
                    </table>
                </div>
                @if (count($results) > 5)
                    <a href="#">see more</a>
                @endif
                @endif

                

            </div>

    </x-layout_homepage>
    <img src="{{ asset('images/aset1.png') }}" alt="dd"
        class="absolute left-[-90px] -z-[100] sm:left-[-70px] md:left-[-30px] lg:left-[-40px] w-[300px] sm:w-[350px] md:w-[400px] lg:w-[450px] bottom-[0]">
    <img src="{{ asset('images/aset5.png') }}" alt="dd"
        class="absolute  right-[3px] -z-[100] sm:right-[-10px] md:right-[-20px] lg:right-[0px] w-[260px] sm:w-[300px] md:w-[350px] lg:w-[400px] bottom-[0]">

    <!-- Scripts -->
    <script></script>
</body>

</html>
