{{-- layout_homepage.blade.php --}}
<main id="content" class=" w-full ">
    <div class="">
        {{-- top section --}}
        <div class="flex justify-between mb-10 {{ $roleColor }} px-10 md:px-16 py-5 items-center">
            <h1 class="font-medium text-lg sm:text-2xl text-white">{{ ucfirst($layoutTitle) }}</h1>
            {{-- Display the school name --}}
            <a href={{ '/editprofile?type=' . 'vendor' }} class="flex items-center">
                @if (!empty($filename))
                    <img src="{{ url('/profile-image/' . $filename) }}" class="w-[45px] h-[45px] rounded-full me-4"
                        alt="Profile Image">
                @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#f6f6f6"
                            class="bi bi-person-circle me-4" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    </div>
                @endif

                <div class="lg:flex flex-col hidden text-[#f6f6f6]">
                    <h1 class="text-sm sm:text-base font-medium">{{ ucfirst($name) }}</h1>
                    <h1 class="text-sm sm:text-base ">{{ $email }}</h1>
                </div>
            </a>
        </div>
        <div class="md:px-[65px] px-8">
            {{-- content --}}
            {{ $slot }}
        </div>


    </div>
    <x-footer>
        <x-slot:roleColor>{{ $roleColor }}</x-slot:roleColor>
    </x-footer>

</main>

<script>
   
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleBtn');
    const overlay = document.getElementById('overlay');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('opacity-50');
        overlay.classList.toggle('invisible');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('invisible');
        overlay.classList.remove('opacity-50');
    });
</script>
