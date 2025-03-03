{{-- layout_homepage.blade.php --}}
<main id="content" class=" w-full ">
    <div class="">
        {{-- top section --}}
        <div class="flex justify-between mb-10 bg-slate-400 px-16 py-5 items-center">
            <h1 class="font-medium text-lg sm:text-2xl">{{ $layoutTitle }}</h1>
            {{-- Display the school name --}}
            <a href={{ '/editprofile?type=' . 'vendor' }} class="flex items-center">
                @if (!empty($filename))
                    <img src="{{ url('/profile-image/' . $filename) }}" class="w-[60px] h-[60px] rounded-full me-4"
                        alt="Profile Image">
                @else
                    <img src="{{ asset('icons/profile.svg') }}" class="w-[50px] h-[50px] rounded-full me-4"
                        alt="Default Profile Image">
                @endif

                <div class="lg:flex flex-col hidden">
                    <h1 class="text-sm sm:text-base font-medium">{{ $name }}</h1>
                    <h1 class="text-sm sm:text-base text-[#726F6F]">{{ $email }}</h1>
                </div>
            </a>
        </div>
        <div class="px-[65px]">
            {{-- content --}}
            {{ $slot }}
        </div>

    </div>
</main>

<script>
    // const sidebar = document.getElementById('sidebar');
    // const toggleBtn = document.getElementById('toggleBtn');
    // const content = document.getElementById('content');

    // toggleBtn.addEventListener('click', () => {
    //     sidebar.classList.toggle('-translate-x-64');
    //     content.classList.toggle('ml-64');
    // });
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
