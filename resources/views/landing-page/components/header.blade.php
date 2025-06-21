<nav class="bg-[#FAFAF5] fixed w-full z-40 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-5 px-4 sm:px-10">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ url('assets/images/logo.png') }}" class="w-36" alt="Sea Catering Logo">
        </a>

        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center">
            @if ($user)
                <button type="button"
                    class="md:w-10 md:h-10 cursor-pointer w-8 h-8 flex text-sm rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 md:w-10 md:h-10 rounded-full" src="{{ url($user->image) }}" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">{{ $user->name }}</span>
                        <span class="block text-sm  text-gray-500 truncate">{{ $user->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            @if ($user->role === 'admin')
                                <a href="{{ route('dashboard.admin.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @else
                                <a href="{{ route('dashboard.user.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                            @endif
                        </li>
                        <li>
                            <button 
                                data-modal-target="logout-modal" data-modal-toggle="logout-modal" class="btn-logout cursor-pointer w-full text-start block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('auth.login') }}"
                    class="hidden md:block cursor-pointer text-white bg-green-800 hover:bg-green-700 transition-colors duration-300 font-medium rounded-3xl px-9 py-2 text-center text-base">
                    Login
                </a>
            @endif
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-green-600 hover:text-white transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-green-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-[#FAFAF5] md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                <!-- Home Link - Active by default -->
                <li>
                    <a href="#home" data-target="home" class="nav-link link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-white bg-green-600 rounded-sm md:bg-transparent md:text-green-600 md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-green-600 after:transition-all after:duration-300 
                        hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Home
                    </a>
                </li>
                <!-- Other Links - Default state -->
                <li>
                    <a href="#meal-plans" data-target="meal-plans"
                        class="nav-link link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Meal Plans
                    </a>
                </li>
                <li>
                    <a href="/subscription"
                        class="nav-link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Subscription
                    </a>
                </li>
                <li>
                    <a href="#contact-us" data-target="contact-us"
                        class="nav-link link group relative block py-2 px-3 mt-2 mb-2 md:mb-0 md:mt-0 text-gray-500 rounded-sm md:p-0 transition-colors duration-300
                        after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-0 after:bg-green-600 after:transition-all after:duration-300 
                        hover:after:w-full hover:text-white hover:bg-green-600 md:hover:bg-transparent md:hover:text-green-600">
                        Contact Us
                    </a>
                </li>

                <li>
                    @if ($user)

                    @else
                        <a href="/login"
                            class="md:hidden nav-link group relative block py-2 px-3 mt-2 mb-2 text-gray-500 rounded-sm transition-colors duration-300 hover:after:w-full hover:text-white hover:bg-green-600">
                            Login
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

@if ($user)
<div id="logout-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm">
            <button type="button" class="cursor-pointer absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="logout-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to logout?</h3>
                <button data-modal-hide="logout-modal" type="button" class="cursor-pointer btn-logout-confirm text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="logout-modal" type="button" class="cursor-pointer py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No, cancel</button>
            </div>
        </div>
    </div>
</div>
@endif

@push('script')
    <script>
        const toggleButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
        const navbarMenu = document.getElementById('navbar-sticky');
        const navLinks = document.querySelectorAll('.link');
        const sections = document.querySelectorAll('section');

        if (toggleButton && navbarMenu) {
            toggleButton.addEventListener('click', () => {
                navbarMenu.classList.toggle('hidden');
            });
        }

        function setActiveLink(link) {
            document.querySelectorAll('.nav-link').forEach(l => {
                l.classList.remove('active', 'text-green-600', 'bg-green-600', 'text-white', 'after:w-full', 'md:text-green-600');
                l.classList.add('text-gray-500', 'after:w-0');
            });

            link.classList.add('active');
            link.classList.remove('text-gray-500', 'after:w-0');

            if (window.innerWidth >= 768) {
                link.classList.add('text-green-600', 'after:w-full');
            } else {
                link.classList.add('bg-green-600', 'text-white');
            }
        }

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    setActiveLink(link);

                    if (window.innerWidth < 768) {
                        navbarMenu.classList.add('hidden');
                    }
                }
            });
        });

        function onScroll() {
            let scrollPosition = window.scrollY;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (scrollPosition >= sectionTop - 120 && scrollPosition < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        if (link.getAttribute('data-target') === sectionId) {
                            setActiveLink(link);
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', onScroll);

        // Optional: jaga styling tetap konsisten saat resize
        window.addEventListener('resize', () => {
            const activeLink = document.querySelector('.nav-link.active');
            if (activeLink) {
                setActiveLink(activeLink);
            }
        });
    </script>
@endpush