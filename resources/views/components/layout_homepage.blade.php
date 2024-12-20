{{-- layout_homepage.blade.php --}}
<main id="content" class="ml-64 my-14 w-full ">
    <div class="mx-14">
        {{-- top section --}}
        <div class="flex justify-between mb-10">
            <h1 class="font-medium text-lg sm:text-2xl">{{ $layoutTitle }}</h1>
            {{-- Display the school name --}}
            <a href="/editprofile?type=Vendor" class="flex items-center">
                <img src="{{ asset("icons/profile.svg") }}" alt=null class="mr-4">
                <div class="lg:flex flex-col hidden">
                    <h1 class="text-sm sm:text-base font-medium">{{ $name }}</h1>
                    <h1 class="text-sm sm:text-base text-[#726F6F]">{{ $email }}</h1>
                </div>
            </a>
        </div>
        
        {{-- content --}}
        {{ $slot }}
    </div>
</main>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleBtn');
    const content = document.getElementById('content');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-64');
        content.classList.toggle('ml-64');
    });
</script>