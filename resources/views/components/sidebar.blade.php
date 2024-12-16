<div id="sidebar" class="w-64 h-screen px-6 bg-custom-blue text-white fixed transition-transform transform">
    <div class="flex justify-center mt-6 pb-5 border-b-[1px]">
        <img src="{{ asset('images/Atten-cropped.svg') }}" alt="logo" class="w-40 h-20">
    </div>
    <ul class="space-y-2 mt-10">
        <li
            class="{{ Request::is('dashboard') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
            <a href="/dashboard" class="flex px-6 py-3 items-center">
                <img src="{{ asset('icons/home.svg') }}" alt="home" class="mr-4">
                <span class="font-medium">Dashboard</span>
            </a>
        </li>
        <li
            class="{{ Request::is('daftarekskul') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
            <a href="/daftarekskul" class="flex px-6 py-3 items-center">
                <img src="{{ asset('icons/book.svg') }}" alt="book" class="mr-4">
                <span class="font-medium">Daftar Ekskul</span>
            </a>
        </li>
        <li
            class="{{ Request::is('absensisiswa') ? 'bg-[#343372]' : 'hover:bg-[#343372]' }} rounded-lg cursor-pointer">
            <a href="/absensisiswa" class="flex px-6 py-3 items-center">
                <img src="{{ asset('icons/user.svg') }}" alt="user" class="mr-4">
                <span class="font-medium">Absensi Siswa</span>
            </a>
        </li>
        <div class="h-[320px] xl:h-[350px]"></div>
        <li class="hover:bg-[#343372] rounded-lg cursor-pointer">
            <a href="#" class="flex px-6 py-3 items-center">
                <img src="{{ asset('icons/log-out.svg') }}" alt="logout" class="mr-4">
                <span class="font-medium">Log out</span>
            </a>
        </li>
        
    </ul>
    <button id="toggleBtn"
        class="absolute w-[40px] h-[80px] left-64 top-12 z-10 border-black border-t border-e border-b text-custom-blue p-2 text-3xl rounded bg-white">☰</button>
</div>
