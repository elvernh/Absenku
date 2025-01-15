<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftara Ekskul</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
        <x-slot:type>{{ 'student' }}</x-slot:type>
    </x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <h1 class="text-2xl font-bold">Daftar Ekskul Tersedia</h1>
        <div class="overflow-x-auto mb-4">
            <div class="overflow-x-auto">
                <form action="{{ route('submitDaftar') }}" method="post">
                    @csrf
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-lg shadow-md">
                        <thead class="bg-custom-blue text-white uppercase">
                            <tr>
                                <th class="px-4 py-3 text-center"></th>
                                <th class="px-4 py-3 text-center">No</th>
                                <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                                <th class="px-4 py-3 text-center">Divisi</th>
                                <th class="px-4 py-3 text-center">Level</th>
                                <th class="px-4 py-3 text-center">Jam</th>
                                <th class="px-4 py-3 text-center">Biaya</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excurVendors as $excurVendor)
                                <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                                    <td class="px-4 py-3 text-center"><input type="checkbox" name="excurVendor[]" 
                                        value={{ $excurVendor->id }} 
                                        id="vendor-{{ $excurVendor->id }}">
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $excurVendor->id }}</td>
                                    <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->name }}</td>
                                    <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->division }}
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $excurVendor->extracurricular->level }}
                                    </td>
                                    <td class="px-4 py-3 text-center">{{ $excurVendor->start_time }} -
                                        {{ $excurVendor->end_time }}
                                    </td>
                                    <td class="px-4 py-3 text-center capitalize">{{ $excurVendor->fee }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="bg-green-600 mt-4 p-2 rounded-lg text-white" type="submit">Submit</button>
                </form>
            </div>

        </div>



        <h1 class="mt-4 mb-4">Riwayat pendaftaran</h1>
        <table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-custom-blue text-white uppercase">
                <tr>
                    <th class="px-4 py-3 text-center">No</th>
                    <th class="px-4 py-3 text-center">Ekstrakurikuler</th>
                    <th class="px-4 py-3 text-center">Divisi</th>
                    <th class="px-4 py-3 text-center">Level</th>
                    <th class="px-4 py-3 text-center">Status</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($historys as $hystory)
                    <tr class="border-b odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                        <td class="px-4 py-3 text-center">{{ $hystory->id }}</td>
                        <td class="px-4 py-3 text-center">{{ $hystory->excurVendor->extracurricular->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $hystory->excurVendor->extracurricular->division }}</td>
                        <td class="px-4 py-3 text-center">{{ $hystory->excurVendor->extracurricular->level }}</td>
                        <td class="px-4 py-3 text-center">{{ $hystory->status }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
<!-- Pagination -->
<nav aria-label="Page navigation example" class="mt-4">
    <ul class="inline-flex -space-x-px text-base h-10">
        <li>
            <a href="{{ $historys->previousPageUrl() }}"
                class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
        </li>

        @foreach ($historys->getUrlRange(1, $historys->lastPage()) as $page => $url)
            <li>
                <a href="{{ $url }}"
                    class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                   {{ $page == $historys->currentPage() ? 'bg-blue-50 text-blue-600' : '' }}">{{ $page }}</a>
            </li>
        @endforeach

        <li>
            <a href="{{ $historys->nextPageUrl() }}" id="testButton"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
        </li>
    </ul>
</nav>
<!-- Pagination -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        @if (session('success'))
            Swal.fire('Success', "{{ session('success') }}", 'success').then(() => {
                
            });
        @endif

        @if (session('error'))
            Swal.fire('Error', "{{ session('error') }}", 'error').then(() => {
                
            });
        @endif
    </script>
</body>

</html>
