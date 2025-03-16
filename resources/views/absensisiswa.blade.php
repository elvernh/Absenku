<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Absensi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
        <x-slot:type>{{ 'school' }}</x-slot:type>
        <x-slot:sidebarColor>{{ 'bg-custom-blue' }}</x-slot:sidebarColor>

    </x-sidebar>
    <x-layout_homepage>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:roleColor>{{ 'bg-custom-blue' }}</x-slot:roleColor>

        <div>
            <div
                class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Id</h1>
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Tanggal</h1>
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Ekstrakurikuler</h1>
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Topik</h1>
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Guru</h1>
                <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center font-bold">Absensi</h1>

            </div>

            <!-- Data Row -->
            @foreach ($meetings as $meeting)
                <div
                    class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $meeting->id }}
                    </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $meeting->meeting_date }}
                    </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">
                        {{ $meeting->excurVendor->extracurricular->name }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $meeting->topic }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $meeting->teacher }}
                    </h1>
                    <a class="text-blue-700 sm:text-sm text-[11px] w-1/6 text-center"
                        href={{ '/school/detail/absensi/' . $meeting->id }}>detail</a>
                </div>
            @endforeach

        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="{{ $meetings->previousPageUrl() }}"
                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>

                @foreach ($meetings->getUrlRange(1, $meetings->lastPage()) as $page => $url)
                    <li>
                        <a href="{{ $url }}"
                            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white
                           {{ $page == $meetings->currentPage() ? 'bg-blue-50 text-blue-600' : '' }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li>
                    <a href="{{ $meetings->nextPageUrl() }}"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
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
