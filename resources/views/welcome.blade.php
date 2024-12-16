<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/Atten-cropped.svg')}}" />
    <title>Welcome to Absenku!</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-white overflow-hidden">
    <div class="w-screen h-screen flex justify-center items-center ">
        <div class="flex mx-4 flex-col justify-between lg:flex-row lg:mx-20">
            <div class=" absolute top-10 rounded-full right-0 translate-x-[480px] bg-custom-blue size-144 tsm:translate-x-[3000px] lg:translate-x-[260px] xl:translate-x-[150px]" aria-hidden="true">
                &nbsp;
            </div>
            <div class="z-10 w-full">
                <h1 class="text-5xl font-bold text-black w-[65%] lg:text-7xl">Absenku: Presensi Pintar untuk Ekskul</h1>
                <p class="text-lg text-gray-600 mt-4 w-[80%] md:w-[60%] lg:w-[60%] lg:text-xl">Solusi Mudah, Efisien, dan Terpercaya untuk Mencatat Kehadiran
                    Siswa dalam Kegiatan Ekstrakurikuler Anda</p>
                    <div class="flex flex-col gap-4 mt-8 lg:flex-row">
                        <a href="{{ url('/login?type=Vendor') }}"
                            class="py-4 px-8 text-center text-sm text-custom-blue bg-white font-medium border border-custom-blue rounded-xl hover:text-white hover:bg-custom-blue transition-all duration-300 lg:text-base whitespace-nowrap w-[300px] lg:w-full">Login
                            Sebagai Vendor</a>
                        <a href="{{  url('/login?type=Murid')  }}"
                            class="py-4 px-8 text-center text-sm text-custom-blue bg-white font-medium border border-custom-blue rounded-xl hover:text-white hover:bg-custom-blue transition-all duration-300 lg:text-base whitespace-nowrap w-[300px] lg:w-full">Login
                            Sebagai Murid</a>
                        <a href="{{ url('/login?type=Sekolah') }}"
                        class="py-4 px-8 text-center text-sm text-custom-blue bg-white font-medium border border-custom-blue rounded-xl hover:text-white hover:bg-custom-blue transition-all duration-300 lg:text-base whitespace-nowrap w-[300px] lg:w-full">Login
                            Sebagai Sekolah</a>
                    </div>
            </div>

            <div class="h-32 lg:w-64"></div>

            <div class="hidden lg:flex justify-center items-center w-48 h-48 lg:w-96 lg:h-96">
                <img src="{{ asset('images/2-cropped.svg') }}" alt="logo_absenku" class="w-48 h-48 lg:w-96 lg:h-96 object-contain z-10">
            </div>

        </div>
    </div>

</body>

</html>
