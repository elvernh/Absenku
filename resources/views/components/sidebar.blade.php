<div id="sidebar"
    class="w-64 h-screen px-6 bg-custom-blue text-white fixed top-0 left-0 -translate-x-full transition-transform transform z-[10000]">

    <div class="flex justify-center mt-6 pb-5 border-b-[1px]">
        <img src="{{ asset('images/Atten-cropped.svg') }}" alt="logo" class="w-40 h-20">
    </div>
    <h1 class="text-center mt-4">{{ ucfirst(strtolower($type)) }}</h1>

    <ul class="space-y-2 mt-10">
        @if ($type == 'school')
            <li
                class="{{ Request::is($type . '/dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/dashboard' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/daftarekskul') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarekskul' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/dribbble.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Daftar Ektrakulikuler</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/daftarekskulaktifaktif') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarekskulaktif' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Daftar Ektrakulikuler Aktif</span>
                </a>
            </li>

            <li
                class="{{ Request::is($type . '/daftarsiswa') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarsiswa' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/users.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Siswa</span>
                </a>
            </li>

            <li
                class="{{ Request::is($type . '/daftarvendor') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarvendor' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Vendor</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/pendaftaran') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/pendaftaran' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Pendaftaran</span>
                </a>
            </li>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
                <a href={{ '/logout/' . $type }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @elseif ($type == 'vendor')
            <li
                class="{{ Request::is($type . '/dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href="{{ '/' . $type . '/dashboard' }}" class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard Vendor</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/daftarpertemuan') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarpertemuan' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Daftar Pertemuan</span>
                </a>
            </li>


            <div class="h-[100px] xl:h-[100px]"></div>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
                <a href={{ '/logout/' . $type }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @elseif($type == 'student')
            <li
                class="{{ Request::is($type . '/dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/dashboard' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/meeting') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/meeting' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/calendar.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Meeting</span>
                </a>
            </li>
            <li
                class="{{ Request::is($type . '/payment') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/payment' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/dollar-sign.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Payments</span>
                </a>
            </li>

            <li
                class="{{ Request::is($type . 'sertifikat') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/sertifikat' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/award.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Sertifikat</span>
                </a>
            </li>
            <li
                class="{{ Request::is('student/daftar') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftar' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Pendaftaran</span>
                </a>
            </li>
            <li
                class="{{ Request::is('profile') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/profile' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Profile</span>
                </a>
            </li>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
                <a href={{ '/logout/' . $type }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @endif


    </ul>
    <button id="toggleBtn"
        class="absolute flex items-center justify-center w-[45px] h-[45px] left-64 top-[110px] z-10 border-black border-t border-e border-b text-custom-blue  text-4xl rounded bg-white"><svg
            xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
        </svg></button>
</div>

<!-- Overlay -->
<div id="overlay" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden z-[9999]"></div>
