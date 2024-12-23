
<!DOCTYPE html>
<html lang="en" class="h-100">



<head>
	<!-- PAGE TITLE HERE -->
	<title>Doli Law Firm | Login Page</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="">
	<meta name="csrf-token" content="eB0n2NdjGLN3bGnjbX2PnNw3rbcfOZJ2WUR5dX5m">
	<meta name="description" content="Some description for the page"/>
	<meta name="keywords" content="admin dashboard, admin template, administration, analytics, bootstrap, disease, doctor, elegant, health, hospital admin, medical dashboard, modern, responsive admin dashboard">
	<meta name="description" content="Mediqu. is a Fully Mobile Responsive Admin Dashboard Laravel Templates for Hospitals dentists, doctors, surgeons, hospitals, health clinics, pediatrics, psychiatrist, psychiatry, stomatology, chiropractor, veterinary clinics. This minimal template is being packed with tons of features like Dashboard Pages, Elements pages, Shop/Store Pages, Product Pages, All Inner Pages with Total 70+ HTML Files. Mediqu. is designed for especially Mobile devices and all types of modern browsers.">
	<meta property="og:title" content="Mediqu  - Hospital Admin Dashboard Bootstrap Laravel Template">
	<meta property="og:description" content="Mediqu Laravel | Page Register" />
	<meta property="og:image" content="../../../mediqu.laravel.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicon icon -->

    <link rel="icon" href="https://dolicloudinc.ca:2828/webman/favicon.ico?v=40438" />




                <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
                <link class="main-css" href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

    <body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="http://dolilaw.com/wp-content/uploads/2024/03/Untitled-design-35.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">Fill in the form below</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            {{ $errors->first() }}
                                        </div>

                                    @elseif(session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif

                                    @csrf
                                    <form method="POST" action="/system_users">
                                        <!-- @csrf --> {{ csrf_field() }}
                                        <span class="row">
                                            <div class="form-group">
                                                <label class="form-label">Full Name</label>
                                                <input name="name" id="name" type="text" class="form-control text-primary" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Phone Number</label>
                                                <input name="name" id="name" type="text" class="form-control text-primary" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1 form-label">Email Address</label>
                                                <input name="email" type="email" class="form-control" placeholder="johndoe@mail.com">
                                            </div>
                                            <div class="mb-4 position-relative">
                                                <label class="mb-1 form-label">Password</label>
                                                <input name="password" type="password" id="dz-password" class="form-control" placeholder="*******">
                                            </div>
                                            <div class="mb-4 position-relative">
                                                <label class="mb-1 form-label">Confirm Password</label>
                                                <input name="password" type="password" id="dz-password" class="form-control" placeholder="*******">
                                            </div>
                                            <input value="Clerk" name="role" hidden>
                                        </span>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </form>
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <!-- <script src="{{ asset('vendor/global/global.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/styleSwit1cher.js') }}" type="text/javascript"></script> -->

</body>

<!-- Mirrored from mediqu.dexignzone.com/laravel/demo/page-register by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Oct 2024 09:29:08 GMT -->
</html>
