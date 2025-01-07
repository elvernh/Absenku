<div id="sidebar" class="w-64 h-screen px-6 bg-custom-blue text-white fixed transition-transform transform z-[10000]">
    <div class="flex justify-center mt-6 pb-5 border-b-[1px]">
        <img src="{{ asset('images/Atten-cropped.svg') }}" alt="logo" class="w-40 h-20">
    </div>
    <ul class="space-y-2 mt-10">
        @if ($type == 'school')
            <li class="{{ Request::is('dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/dashboard' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li
                class="{{ Request::is('daftarekskul') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarekskul' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Daftar Ekskul</span>
                </a>
            </li>
            <li
                class="{{ Request::is('absensisiswa') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/absensisiswa' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Meeting</span>
                </a>
            </li>
            <li
                class="{{ Request::is('daftarsiswa') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/daftarsiswa' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Siswa</span>
                </a>
            </li>
            <div class="h-[320px] xl:h-[350px]"></div>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
                <a href={{ '/logout/' . $type }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @elseif ($type == 'vendor')
            <li
                class="{{ Request::is('dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href="/dashboard" class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard Vendor</span>
                </a>
            </li>
            <li
                class="{{ Request::is('daftarekskul') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href="/daftarekskul" class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Daftar Pertemuan</span>
                </a>
            </li>

            <li class="{{ Request::is('siswa') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href="/daftarsiswa" class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                    <span class="font-medium">Siswa</span>
                </a>
            </li>
            <div class="h-[320px] xl:h-[350px]"></div>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">

                <a href={{ $type . '/logout' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @elseif($type == 'student')
            <li
                class="{{ Request::is('dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/dashboard' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>
            <li
                class="{{ Request::is('meetingStudent') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/meeting' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Meeting</span>
                </a>
            </li>
            <li
                class="{{ Request::is('meetingStudent') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
                <a href={{ '/' . $type . '/payment' }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                    <span class="font-medium">Payments</span>
                </a>
            </li>
           
            <div class="h-[320px] xl:h-[350px]"></div>
            <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
                <a href={{ '/logout/' . $type }} class="flex px-6 py-3 items-center">
                    <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                    <span class="font-medium">Log out</span>
                </a>
            </li>
        @endif


    </ul>
    <button id="toggleBtn"
        class="absolute w-[40px] h-[80px] left-64 top-12 z-10 border-black border-t border-e border-b text-custom-blue p-2 text-3xl rounded bg-white">☰</button>
</div>
