<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Tempat untuk mencari makanan sehat." />
    <meta name="keywords" content="SEA Catering, Healthy Meal, Best Meal">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="cookies___" content="_sea_catering_token">
    <meta name="url___" content="{{ route('api.logout') }}">

    <title>SEA Catering</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- Vendors css --}}
    <link rel="stylesheet" href="{{ url('assets/css/swiper-bundle.min.css') }}">
    @stack('vendor-style')

    <style>
        html {
            scroll-behavior: smooth;
        }

        .swiper-pagination-bullet {
            background-color: #F5F5F5 !important;
            opacity: 1 !important;
        }
        .swiper-pagination-bullet-active {
            background-color: #1B5E20 !important; /* misal pakai warna Tailwind dark */
        }
        .testimonial-swiper .swiper-slide {
            width: 280px !important;
            height: 240px !important;
        }
        
        @media (min-width: 640px) {
            .testimonial-swiper .swiper-slide {
                width: 320px !important;
                height: 260px !important;
            }
        }
        
        @media (min-width: 1024px) {
            .testimonial-swiper .swiper-slide {
                width: 394px !important;
                height: 260px !important;
            }
        }

        /* Custom CSS untuk memastikan animasi bekerja dengan baik */
        .nav-link.active::after {
            width: 100% !important;
        }
        
        .nav-link::after {
            transform-origin: left center;
        }
        
        /* Reset hover effect untuk link aktif */
        .nav-link.active:hover::after {
            width: 100% !important;
        }
        
        /* Untuk mobile view - hilangkan animasi dan garis */
        @media (max-width: 767px) {
            .nav-link::after {
                display: none !important;
            }
            
            .nav-link.active::after {
                display: none !important;
            }
        }
    </style>
    @stack('style')
</head>
<body>
    <div class="">
        
        @include('landing-page.components.header')

        @include('landing-page.components.hero')

        @include('landing-page.components.feature')

        @include('landing-page.components.meal-plans')

        @include('landing-page.components.testimonials')

        @include('landing-page.components.submit-testimonial')

        @include('landing-page.components.contact-us')

        @include('landing-page.components.subscribe-now')

        @include('landing-page.components.footer')
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="{{ url('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ url('assets/js/js.cookie.min.js') }}"></script>
    <script src="{{ url('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/helper-api.js') }}"></script>
    @stack('vendor-script')

    <script>
        function getAuthorization() {
            return "Bearer " + Cookies.get("{{ env('API_TOKEN') }}");
        }

        (function () {
            setInterval(() => {

                let tokenName = $('meta[name="cookies___"]').attr('content')
                let cookies = Cookies.get(tokenName);
                let currentUrl = window.location.href;

                if (cookies) {
                    Cookies.set(`${tokenName}_extend`, cookies, {
                        expires: 5 / 1440, // 1 jam
                        path: '/',
                        secure: false,
                        sameSite: 'Lax'
                    })
                } else {
                    let extendedCookies = Cookies.get(`${tokenName}_extend`);

                    if (extendedCookies) {
                        let urlLogout = $('meta[name="url___"]').attr('content')
                        apiRequest("POST", urlLogout, [], (res) => {
                            Cookies.set(
                                'sc-automatic-redirect',
                                window.location.href,
                                {
                                    expires: 1/24, // 1 jam
                                    path: '/',
                                    secure: false,
                                    sameSite: 'Lax',
                                }
                            );

                            Cookies.remove(`${tokenName}`)
                            Cookies.remove(`${tokenName}_extend`)
                            window.location.href = "{{ route('auth.login') }}"
                        }, (xhr, status, err) => {
                            window.location.href = "{{ route('auth.login') }}"
                        }, {
                            Authorization: "Bearer "+extendedCookies
                        })
                    }
                }

            }, 10000);
        })()
    </script>
    <script src="{{ url('assets/js/auth/logout.js') }}"></script>
    @stack('script')
</body>
</html>