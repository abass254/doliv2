
<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from mediqu.dexignzone.com/laravel/demo/page-register by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Oct 2024 09:29:08 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<!-- PAGE TITLE HERE -->
	<title>Mediqu Laravel | Page Register</title>

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
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{ asset('vendor/toastr/css/toastr.min.css') }}" rel="stylesheet" type="text/css">
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
                        <a href="index.html"><img src="{{ asset('images/logo-full.png') }}" alt=""></a>
                    </div>
                    <h4 class="text-center mb-4">Please provide the following Information</h4>
                    <form action="">
                        <span class="row">
                            <div class="form-group col-md-12">
                                <label class="mb-1 form-label">Full name</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="John Doe">
                            </div>
                            <div class="form-group">
                                <label class="mb-1 form-label">Email Address</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="johndoe@mail.com">
                            </div>
                            <div class="mb-4 col-md-6 position-relative">
                                <label class="mb-1 form-label">Password</label>
                                <input id="password" name="password" type="password" class="form-control" value="">
                                <span class="show-pass eye">
                                
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
        
                                </span>
                            </div>
                            <div class="mb-4 col-md-6 position-relative">
                                <label class="mb-1 form-label">Confirm Password</label>
                                <input id="confirm_password" name="-confirm" type="password" class="form-control" value="">
                                <span class="show-pass eye">
                                
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
        
                                </span>
                            </div>
                        </span>
                        <input class="col-md-6" type="hidden" name="_token" value="eB0n2NdjGLN3bGnjbX2PnNw3rbcfOZJ2WUR5dX5m">  
                        
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary btn-register btn-block">Submit Registration</button>
                        </div>
                    </form>
                    <div class="new-account mt-3">
                        <p>Already have an account? <a class="text-primary" href="login">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
  </script>
    <script src="{{ asset('js/registration.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            //alert('11111');
            $('.btn-register').on('click', function(){
                var name = $('#name').val();
                const alertt = "User Registration"
                var email = $('#email').val();
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();
                if(name.trim().length == 0){
                    toastr.info(`Please provide you name`, alertt, { "closeButton": true, "progressBar": true });
                    return;
                }

                else if(email.trim().length == 0){
                    toastr.error(`Please provide you email address`, alertt, { "closeButton": true, "progressBar": true });
                    return;
                }

                else if(password.trim().length == 0){
                    toastr.error(`Please provide you password`, alertt, { "closeButton": true, "progressBar": true });
                    return;
                }
                
                else if(confirm_password.trim().length == 0){
                    toastr.error(`Please confirm your password`, alertt, { "closeButton": true, "progressBar": true });
                    return;
                }

                else if(password != confirm_password){
                    toastr.error(`Your passwords should much`, alertt, { "closeButton": true, "progressBar": true });
                    return;
                }

                else{


                    let button = $(this);
                   // $.blockUI();
                    button.prop("disabled", true);
                    toast = toastr.info('Please wait as your information is being processed.', 'Posting', { closeButton: true, progressBar: true, timeOut: "50000" });


                    const userData = {
                        name: name,
                        email: email,
                        password: password,
                    };

                    $.ajax({
                        url: '/api/register',  // Replace with your registration endpoint
                        type: 'POST',
                        data: JSON.stringify(userData),
                        contentType: 'application/json',
                        success: function(response) {
                            toastr.success(`Your passwords should much`, alertt, { "closeButton": true, "progressBar": true });
                            return;             
                        },
                        error: function(xhr, status, error) {
                            console.error("Registration failed:", xhr.responseText);
                            alert("Error during registration. Please try again.");
                        }
                    });




                    toastr.success("Good to go.", alertt);
                    return;
                }

                



                


            })
        })
        
    </script>

    <!-- Required vendors -->
    <!-- <script src="{{ asset('vendor/global/global.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/styleSwit1cher.js') }}" type="text/javascript"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->

    

</body>

<!-- Mirrored from mediqu.dexignzone.com/laravel/demo/page-register by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Oct 2024 09:29:08 GMT -->
</html>