

<nav class="bg-[#FAFAF5] dark:bg-gray-900 fixed w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-5 px-4 sm:px-10">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ url('assets/images/logo.png') }}" class="w-36" alt="Sea Catering Logo">
        </a>
        
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="hidden md:block cursor-pointer text-white bg-green-800 hover:bg-green-700 transition-colors duration-300 font-medium rounded-3xl px-9 py-2 text-center text-base">
                Login
            </button>
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-green-600 hover:text-white transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-green-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-[#FAFAF5] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <!-- Home Link - Active by default -->
                <li>
                    <a href="#" class="nav-link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-white bg-green-600 rounded-sm md:bg-transparent md:text-green-600 md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-green-600 after:transition-all after:duration-300 
                        hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Home
                    </a>
                </li>
                <!-- Other Links - Default state -->
                <li>
                    <a href="#" class="nav-link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Meal Plans
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Subscription
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Contact Us
                    </a>
                </li>

                <li>
                    <a href="#" class="md:hidden nav-link group relative block py-2 px-3 mt-2 mb-2 text-gray-500 rounded-sm transition-colors duration-300 hover:after:w-full hover:text-white hover:bg-green-600">
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('script')
<script>
    // Toggle mobile menu
    const toggleButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
    const navbarMenu = document.getElementById('navbar-sticky');
    
    if (toggleButton && navbarMenu) {
        toggleButton.addEventListener('click', () => {
            navbarMenu.classList.toggle('hidden');
        });
    }

    // Handle active state change
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Remove active class from all links and reset to default state
            document.querySelectorAll('.nav-link').forEach(l => {
                l.classList.remove('active');
                
                // Reset to default non-active state
                l.classList.remove('text-green-600', 'bg-green-600', 'text-white', 'md:text-green-600');
                l.classList.add('text-gray-500');
                
                // Reset garis (after pseudo-element) ke width 0
                l.classList.remove('after:w-full');
                l.classList.add('after:w-0');
                
                // Remove inline styles if any
                l.removeAttribute('style');
            });
            
            // Add active class to clicked link
            link.classList.add('active');
            link.classList.remove('text-gray-500', 'after:w-0');
            
            // Set active state styling
            if (window.innerWidth >= 768) {
                // Desktop: hijau text + garis penuh + transparent background
                link.classList.add('text-green-600', 'after:w-full');
                link.classList.remove('bg-green-600', 'text-white');
            } else {
                // Mobile: hijau background + white text
                link.classList.add('bg-green-600', 'text-white');
                link.classList.remove('text-green-600');
            }
        });
    });

    // Handle window resize untuk memastikan styling konsisten
    window.addEventListener('resize', () => {
        const activeLink = document.querySelector('.nav-link.active');
        if (activeLink) {
            if (window.innerWidth >= 768) {
                // Desktop styling for active link
                activeLink.classList.remove('bg-green-600', 'text-white');
                activeLink.classList.add('text-green-600');
            } else {
                // Mobile styling for active link
                activeLink.classList.remove('text-green-600');
                activeLink.classList.add('bg-green-600', 'text-white');
            }
        }
    });
</script>
@endpush