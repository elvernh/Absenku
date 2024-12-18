{{-- layout_homepage.blade.php --}}
<main id="content" class="ml-64 my-14 w-full ">
    <div class="mx-14">
        {{-- top section --}}
        <div class="flex justify-between mb-10">
            <h1 class="font-medium text-lg sm:text-2xl">{{ $layoutTitle }}</h1>
            {{-- Display the school name --}}
            <a href="/editprofile?type=Vendor" class="flex items-center">
                <div class="lg:flex flex-col hidden">
                    <h1 class="text-sm sm:text-base font-medium">Jono Vendor</h1>
                    <h1 class="text-sm sm:text-base text-[#726F6F]">jonovendor@gmail.com</h1>
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
