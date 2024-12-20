<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Ekskul</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
      <x-slot:type>Sekolah</x-slot:type>  
    </x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
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
                            PIC
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hari
                        </th>
                        <th scope="col" class="px-6 py-3">
                           Jam Mulai
                        </th> <th scope="col" class="px-6 py-3">
                           Jam Selesai
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($excurVendors as $excurVendor)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $excurVendor->extracurricular->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $excurVendor->extracurricular->division }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->extracurricular->level }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->vendor->name }}

                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->pic }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->day }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->start_time }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $excurVendor->end_time }}
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
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
