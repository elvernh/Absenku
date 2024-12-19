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

        <div
            class="flex flex-wrap items-center justify-between bg-white w-full h-[60px] rounded-md px-4 xl:px-10 mb-4 border-s-[10px] shadow border-custom-blue sticky top-4">
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Id Ekskul</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Nama Ekskul</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Divisi</h1>
            <h1 class="text-black sm:text-sm text-[11px] w-1/6 text-center">Level</h1>

        </div>

        <!-- Data Row -->
        @if ($extracurriculars && count($extracurriculars) > 0)
            @foreach ($extracurriculars as $extracurricular)
                <div
                    class="flex flex-wrap items-center justify-between bg-white w-full h-[80px] rounded-md px-4 xl:px-10 mb-[10px] border-s-[11px] shadow border-custom-blue">
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center"># {{ $extracurricular['id'] }} </h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $extracurricular['name'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $extracurricular['division'] }}</h1>
                    <h1 class="text-[#726F6F] sm:text-sm text-[11px] w-1/6 text-center">{{ $extracurricular['level'] }}</h1>
                    
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
