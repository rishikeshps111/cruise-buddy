<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('2_AdminPanel/assets/images/favicon.png') }}">

    <!-- STYLES -->
    <link href="{{ asset('2_AdminPanel/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('2_AdminPanel/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                {{ $slot }}
                <div class="col-xl-6 col-lg-6">
                    <div class="pages-left h-100">
                        <div class="login-content">
                            <a href="index.html"><img src="{{ asset('2_AdminPanel/assets/images/logo-full.png') }}"
                                    class="mb-3 logo-dark" alt=""></a>
                            <a href="index.html"><img src="{{ asset('2_AdminPanel/assets/images/logi-white.png') }}"
                                    class="mb-3 logo-light" alt=""></a>

                            <p>CRM dashboard uses line charts to visualize customer-related metrics and trends over
                                time.</p>
                        </div>
                        <div class="login-media text-center">
                            <img src="{{ asset('2_AdminPanel/assets/images/login.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{ asset('2_AdminPanel/assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('2_AdminPanel/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('2_AdminPanel/assets/js/deznav-init.js') }}"></script>
    <script src="{{ asset('2_AdminPanel/assets/js/demo.js') }}"></script>
    <script src="{{ asset('2_AdminPanel/assets/js/custom.js') }}"></script>
    <script src="{{ asset('2_AdminPanel/assets/js/styleSwitcher.js') }}"></script>

</body>

</html>
