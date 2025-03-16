<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Atten-cropped.svg') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Vendor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="flex overflow-x-hidden bg-[#F4F4F4]">
    <x-sidebar>
      <x-slot:type>school</x-slot:type>  
      <x-slot:sidebarColor>{{ 'bg-custom-blue' }}</x-slot:sidebarColor>

    </x-sidebar>
    <x-layout_homepage>
        <x-slot:roleColor>{{ 'bg-custom-blue' }}</x-slot:roleColor>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:layoutTitle>{{ $pageTitle }}</x-slot:layoutTitle>
        <x-slot:name>{{ $school->name }}</x-slot:name>
        <x-slot:email>{{ $school->email }}</x-slot:email>
        <h1 class="text-3xl font-bold mb-4">Daftar Vendor</h1>

        <div
            class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">no</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Nama </h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Email</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Telepon</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Alamat</h1>

        </div>

        <!-- Data Row -->
        @if ($vendors && count($vendors) > 0)
            @foreach ($vendors as $vendor)
                <div
                    class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center"># {{ $loop->iteration }} </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $vendor->name }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $vendor->email }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $vendor->phone }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $vendor->address }}</h1>

                </div>
            @endforeach
        
        @endif

        <
       
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
