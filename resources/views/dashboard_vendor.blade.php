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
        <x-slot:type>{{ "Vendor" }}</x-slot:type>
    </x-sidebar>
    
    <x-layout_homepage>
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
                <x-box>
                    <x-slot:text>Jumlah Extrakulikuler aktif</x-slot:text>
                    <x-slot:value>10</x-slot:value>
                </x-box>
            </div>
            <div class="mt-10">
                <div class="flex  p-3 items-center">
                    <h2 class="text-2xl font-bold">Jadwal Hari Ini</h2>
                    <div class="ms-20 text-white bg-green-600  flex ps-4 pt-2 pb-2 pe-4 rounded-lg">
                        <a href="/jadwal" class="text-sm">Buat jadwal</a>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full xl:w-[55%] border-[1px] border-slate-600">
                    <table class=" w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ekstrakurikuler
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Divisi
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Level
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Vendor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    jam mulai
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    jam berakhir
                                </th>
    
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 9; $i++)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Basket
                                    </th>
                                    <td class="px-6 py-4">
                                        Silver
                                    </td>
                                    <td class="px-6 py-4">
                                        Laptop
                                    </td>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                    <td class="px-6 py-4">
                                        $2999
                                    </td>
                                </tr>
                            @endfor
    
    
                        </tbody>
                    </table>
                </div>
    
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
