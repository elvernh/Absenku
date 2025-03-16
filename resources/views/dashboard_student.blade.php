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
        <x-slot:sidebarColor>{{ 'bg-[#42A5F5]' }}</x-slot:sidebarColor>
    </x-sidebar>

    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-[#42A5F5]' }}</x-slot:roleColor>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $name }}</x-slot:name>
        <x-slot:email>{{ $email }}</x-slot:email>
        <x-slot:filename>{{ $filename }}</x-slot:filename>
        <x-box>
            <x-slot:text>Jumlah Ekstrakurikuler</x-slot:text>
            <x-slot:value>{{ $total }}</x-slot:value>
        </x-box>
        <div class="w-full flex justify-between mb-4 overflow-scroll py-5">
            <div class="relative overflow-x-auto w-[50%]">
                <h1 class="text-3xl font-bold pb-4 text-black">Ekstrakurikuler yang Diikuti</h1>
                <table class="w-full text-sm text-left rtl:text-right text-black border-[2px] border-gray-200 ">
                    <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Ekskul</th>
                            <th scope="col" class="px-6 py-3">Jam</th>
                            <th scope="col" class="px-6 py-3">Hari</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr
                                class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black">
                                    {{ $loop->iteration }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black">
                                    {{ $result->excurVendor->extracurricular->name }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black">
                                    {{ $result->excurVendor->start_time }} - {{ $result->excurVendor->end_time }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-black">
                                    {{ $result->excurVendor->day }}
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>



                <nav aria-label="Page navigation example " class="mt-5">
                    <ul class="flex items-center -space-x-px h-8 text-sm">
                      <!-- Tombol Previous -->
                      @if ($results->onFirstPage())
                        <li>
                          <span class="flex items-center justify-center px-3 h-8 text-gray-400 bg-gray-200 border border-gray-300 rounded-s-lg">Previous</span>
                        </li>
                      @else
                        <li>
                          <a href="{{ $results->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                          </a>
                        </li>
                      @endif
                  
                      <!-- Nomor Halaman -->
                      @foreach ($results->getUrlRange(1, $results->lastPage()) as $page => $url)
                        <li>
                          <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 {{ $results->currentPage() == $page ? 'text-blue-600 border border-blue-300 bg-blue-50' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700' }}">
                            {{ $page }}
                          </a>
                        </li>
                      @endforeach
                  
                      <!-- Tombol Next -->
                      @if ($results->hasMorePages())
                        <li>
                          <a href="{{ $results->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                          </a>
                        </li>
                      @else
                        <li>
                          <span class="flex items-center justify-center px-3 h-8 text-gray-400 bg-gray-200 border border-gray-300 rounded-e-lg">Next</span>
                        </li>
                      @endif
                    </ul>
                  </nav>
                  


            </div>
    </x-layout_homepage>
</body>

</html>
