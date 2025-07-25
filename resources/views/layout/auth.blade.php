<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Tempat untuk mencari makanan sehat." />
    <meta name="keywords" content="SEA Catering, Healthy Meal, Best Meal">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="cookies___" content="{{ env('API_TOKEN') }}">
    <meta name="url___" content="{{ route('api.logout') }}">

    <title>@yield('title')</title>
    
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
</head>
<body>
    {{-- Content --}}
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="{{ url('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ url('assets/js/js.cookie.min.js') }}"></script>
    @stack('vendor-script')

    <script>
        function getAuthorization() {
            return "Bearer " + Cookies.get("{{ env('API_TOKEN') }}");
        }
    </script>
    @stack('script')
</body>
</html>