<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PAGE TITLE HERE -->
    <title>Doli Law Firm | @yield('page-title', 'Dashboard')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add required CSS files here -->
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link rel="icon" href="https://dolicloudinc.ca:2828/webman/favicon.ico?v=40438" />
    <link href="{{ asset('vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">


    <link href="{{ asset('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:400,500,700') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700') }}" rel="stylesheet">
    <link href="{{ asset('icons/helveticaNeue/css/helveticaNeue.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/material-design-iconic-font/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icons/flaticon/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/metismnu/css/metisMenu.min.css') }}" rel="stylesheet">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        /* Preloader wrapper styling */
        /* This styles the preloader itself */
        /* The preloader should be fixed and cover the entire page */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: transparent; /* Transparent background */
            z-index: 9999; /* Ensure preloader is above other content */
            display: flex;
            justify-content: center;
            align-items: center;
        }



        /* Bounce keyframes animation */
        @keyframes bounce {
            0%, 100% {
                transform: scale(0);
            }
            50% {
                transform: scale(1);
            }
        }

        /* Initially hide page content */
        body.loading #content {
            visibility: hidden; /* Hide page content */
            opacity: 0; /* Optionally fade out content */
        }

        /* When the page has loaded, remove 'loading' class and show content */
        body.loaded #content {
            visibility: visible;
            opacity: 1;
        }

       



    </style>
</head>
<body data-header-position="fixed" class="loading">
    <!-- Preloader -->
    <div id="preloader" style="background-color: transparent;">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div id="main-wrapper">
        @include('partials.navbar')
        <!-- Header -->
        @include('partials.header')

         <!-- Sidebar -->
         @include('partials.sidebar')

        <!-- Main Content -->
        <div class="content-body default-height">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('partials.footer')
    </div>
    

    



    <script src="{{ asset('vendor/global/global.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}" type="text/javascript"></script>
    @yield('js')
    <script src="{{ asset('js/custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/demo.js') }}" type="text/javascript"></script>

    
    <!-- <script src="{{ asset('js/styleSwitcher.js') }}" type="text/javascript"></script> -->

    <script>
        window.addEventListener("load", function() {
            // Remove 'loading' class to reveal the content and hide preloader
            document.body.classList.remove("loading");
            document.body.classList.add("loaded"); // Add 'loaded' class when the page is ready
            document.getElementById("preloader").style.display = "none"; // Hide the preloader
        });

        // If you need to add the 'loading' class before the page unloads (optional for reloads)
        window.addEventListener("beforeunload", function() {
            document.body.classList.add("loading");
            document.body.classList.remove("loaded");
        });
    </script>

</body>
</html>
