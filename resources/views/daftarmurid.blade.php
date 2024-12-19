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
        <h1 class="text-3xl font-bold mb-4">Siswa SMP</h1>

        <div
            class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Id</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Nama </h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Kelas</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Asal Kelas</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Email</h1>

        </div>

        <!-- Data Row -->
        @if ($smps && count($smps) > 0)
            @foreach ($smps as $smp)
                <div
                    class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center"># {{ $smp['id'] }} </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $smp['full_name'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $smp['grade'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $smp['from_class'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $smp['email'] }}</h1>

                </div>
            @endforeach
        
        @endif
        <h1 class="text-3xl font-bold mb-4">Siswa SMA</h1>

        <div
            class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Id</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Nama </h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Kelas</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Asal Kelas</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Email</h1>

        </div>

        <!-- Data Row -->
        @if ($smas && count($smas) > 0)
            @foreach ($smas as $sma)
                <div
                    class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center"># {{ $sma['id'] }} </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $sma['full_name'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $sma['grade'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $sma['from_class'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $sma['email'] }}</h1>

                    
                </div>
            @endforeach
        @else
            <div class="flex flex-col justify-center items-center h-screen">
                <h1 class="text-gray-500 text-lg">Tidak ada ekskul</h1>
            </div>
        @endif

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
