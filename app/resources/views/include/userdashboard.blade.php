@if(Auth::user()->phone_verify < 1 )

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="windows-1252">

    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--  Essential META Tags -->
    <meta property="og:title" content="Cryonik User Panel">
    <meta property="og:description" content="Your best crypto wallet platform">
    <meta property="og:image" content="{{asset('assets/images/logo/logo.png')}}">
    <script src="{{asset('process/countries.js')}}"></script>

    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="##1b1b1b">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="##1b1b1b">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="##1b1b1b">
    <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="{{asset('assets/images/logo/favicon.png')}}">
    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fix Internet Explorer ______________________________________-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="vendor/html5shiv.js"></script>
    <script src="vendor/respond.js"></script>
    <![endif]-->

    <style>
        body {
            background-color: #f8f8f8;
            font-family: arial;
            font-weight: 400;
        }

        #toast {
            position: fixed;
            z-index: 999;
            top: 12px;
            right: 12px;
        }

        .notification {
            display: block;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
            margin-right: 10px;
            padding: 20px;
            width: 300px;
            border-radius: 3px;
            color: white;
            right: -400px;
        }

        .normal {
            background: #273140;
        }

        .success {
            background: #44be75;
        }

        .error {
            background: #c33c3c;
        }

    </style>
</head>
<div id="toast"></div>
<body>
<div class="main-page-wrapper user-access-page">


    <div class="main-container">
        <div class="inner-box">
            <h3 class="main-title">Phone Verification</h3>
            <img src="{{asset('assets/images/mobile-banking.png')}}" width="300" alt="" class="icon">
            <div class="confirmation-text font-fix">A text message with a verification code was just sent to <span
                    class="mark-text">{{Auth::user()->phone}}</span>. Please enter the code in the field below to verify
                your identity
            </div>
            <form class="verification-code-form" action="{{ route('user.sms-verify')}}" method="post">
                @csrf
                <input type="text" name="sms_code" placeholder="Enter the 5-digit code">
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <button type="submit" class="theme-button"><span></span>Verify</button>
            </form>
            <form id="requestphone" action="{{route('user.send-vcode') }}" method="post">
                @csrf
                <div class="condition-text text-center font-fix">Haven't received the code yet? <a
                        href="{{route('user.send-vcode') }}"
                        onclick="event.preventDefault(); document.getElementById('requestphone').submit();">Resend
                        code</a></div>
            </form>
        </div> <!-- /.inner-box -->
    </div> <!-- /.main-container -->


    <!-- Optional JavaScript _____________________________  -->

    <script src="{{asset('assets/vendor/jquery.2.2.3.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('assets/vendor/popper.js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Country Select -->
    <script src="{{asset('assets/vendor/country-select-js-master/build/js/countrySelect.min.js')}}"></script>
    <!-- Telephone Select -->
    <script src="{{asset('assets/vendor/intl-tel/build/js/intlTelInput.min.js')}}"></script>
    <!-- Select js -->
    <script src="{{asset('assets/vendor/select/jquery.selectric.min.js')}}"></script>
    <!-- Range Slider -->
    <script src="{{asset('assets/vendor/ion.rangeSlider/ion.rangeSlider.js')}}"></script>
    <!-- Dashboard js -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
</div> <!-- /.main-page-wrapper -->

@yield('js')
<script>
    (function ($) {

        $.fn.toast = function (options) {

            var settings = $.extend({
                type: 'normal',
                message: null
            }, options);

            var item = $('<div class="notification ' + settings.type + '"><span>' + settings.message + '</span></div>');
            this.append($(item));
            $(item).animate({"right": "12px"}, "fast");
            setInterval(function () {
                $(item).animate({"right": "-400px"}, function () {
                    $(item).remove();
                });
            }, 4000);
        }

        $(document).on('click', '.notification', function () {
            $(this).fadeOut(400, function () {
                $(this).remove();
            });
        });

    }(jQuery));
</script>


@if (session('alert'))
    <script>
        $("#toast").toast({
            message: '{{ session('alert') }}'
        });
    </script>
@endif
@if(Session::has('success'))
    <script>
        $("#toast").toast({
            type: 'success',
            message: '{{ Session::get('success') }}'
        });
    </script>

@endif

@if (session('message'))
    <script>
        $("#toast").toast({
            message: '{{ session('message') }}'
        });
    </script>
@endif

@if(Session::has('danger'))
    <script>
        $("#toast").toast({
            type: 'error',
            message: '{{ session('danger') }}'
        });
    </script>
@endif

@if ($errors->has('fname'))

    <script>
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('fname') }}'
        });
    </script>
@endif

@if ($errors->has('lname'))
    <script>
        <
        script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('lname') }}'
        });
    </script>
    </script>
    @endif
    @if ($errors->has('username'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('username') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('phone'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('phone') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('email'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('email') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('password'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('password') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('currency'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('country') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('address'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('address') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('zip_code'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('zip_code') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('current_password'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('currenct_password') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('password_confirmation'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('password_confirmation') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->has('city'))
    <
    script >
    < script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $errors->first('city') }}'
    });
    </script>
    </script>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <
    script >
    $("#toast").toast({
        type: 'error',
        message: '{{ $error }}'
    });
    </script>

    @endforeach

@endif

</body>
</html>
@elseif(Auth::user()->locked == 1 )

    <!DOCTYPE html>
    <html lang="en">
    <head>

        <!-- For IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- For Resposive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--  Essential META Tags -->
        <meta property="og:title" content="Cryonik User Panel">
        <meta property="og:description" content="Your best crypto wallet platform">
        <meta property="og:image" content="{{asset('assets/images/logo/logo.png')}}">
        <script src="{{asset('process/countries.js')}}"></script>

        <!-- For Window Tab Color -->
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="##1b1b1b">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="##1b1b1b">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="##1b1b1b">
        <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="56x56" href="{{asset('assets/images/logo/favicon.png')}}">
        <!-- Main style sheet -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
        <!-- responsive style sheet -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Fix Internet Explorer ______________________________________-->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="vendor/html5shiv.js"></script>
        <script src="vendor/respond.js"></script>
        <![endif]-->

        <style>
            body {
                background-color: #f8f8f8;
                font-family: arial;
                font-weight: 400;
            }

            #toast {
                position: fixed;
                z-index: 999;
                top: 12px;
                right: 12px;
            }

            .notification {
                display: block;
                position: relative;
                overflow: hidden;
                margin-top: 10px;
                margin-right: 10px;
                padding: 20px;
                width: 300px;
                border-radius: 3px;
                color: white;
                right: -400px;
            }

            .normal {
                background: #273140;
            }

            .success {
                background: #44be75;
            }

            .error {
                background: #c33c3c;
            }

        </style>
    </head>
    <div id="toast"></div>
    <body>
    <div class="main-page-wrapper user-access-page">


        <div class="main-container">
            <div class="inner-box">
                <h3 class="main-title">Account Locked</h3>
                <img src="{{asset('assets/images/cc2.png')}}" width="200" alt="" class="icon">
                <div class="confirmation-text font-fix">Your account has been locked for using a wrong transaction
                    password 3 time. Please close session and contact one of our support through our contact us page for
                    assistance
                </div>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button type="submit" class="theme-button"><span></span>Close Session</button>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">{{ csrf_field() }}</form>


            </div> <!-- /.inner-box -->
        </div> <!-- /.main-container -->


        <!-- Optional JavaScript _____________________________  -->

        <script src="{{asset('assets/vendor/jquery.2.2.3.min.js')}}"></script>
        <!-- Popper js -->
        <script src="{{asset('assets/vendor/popper.js/popper.min.js')}}"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Country Select -->
        <script src="{{asset('assets/vendor/country-select-js-master/build/js/countrySelect.min.js')}}"></script>
        <!-- Telephone Select -->
        <script src="{{asset('assets/vendor/intl-tel/build/js/intlTelInput.min.js')}}"></script>
        <!-- Select js -->
        <script src="{{asset('assets/vendor/select/jquery.selectric.min.js')}}"></script>
        <!-- Range Slider -->
        <script src="{{asset('assets/vendor/ion.rangeSlider/ion.rangeSlider.js')}}"></script>
        <!-- Dashboard js -->
        <script src="{{asset('assets/js/dashboard.js')}}"></script>
    </div> <!-- /.main-page-wrapper -->

    @yield('js')
    <script>
        (function ($) {

            $.fn.toast = function (options) {

                var settings = $.extend({
                    type: 'normal',
                    message: null
                }, options);

                var item = $('<div class="notification ' + settings.type + '"><span>' + settings.message + '</span></div>');
                this.append($(item));
                $(item).animate({"right": "12px"}, "fast");
                setInterval(function () {
                    $(item).animate({"right": "-400px"}, function () {
                        $(item).remove();
                    });
                }, 4000);
            }

            $(document).on('click', '.notification', function () {
                $(this).fadeOut(400, function () {
                    $(this).remove();
                });
            });

        }(jQuery));
    </script>


    @if (session('alert'))
        <script>
            $("#toast").toast({
                message: '{{ session('alert') }}'
            });
        </script>
    @endif
    @if(Session::has('success'))
        <script>
            $("#toast").toast({
                type: 'success',
                message: '{{ Session::get('success') }}'
            });
        </script>

    @endif

    @if (session('message'))
        <script>
            $("#toast").toast({
                message: '{{ session('message') }}'
            });
        </script>
    @endif

    @if(Session::has('danger'))
        <script>
            $("#toast").toast({
                type: 'error',
                message: '{{ session('danger') }}'
            });
        </script>
    @endif

    @if ($errors->has('fname'))

        <script>
            $("#toast").toast({
                type: 'error',
                message: '{{ $errors->first('fname') }}'
            });
        </script>
    @endif

    @if ($errors->has('lname'))
        <script>
            <
            script >
            $("#toast").toast({
                type: 'error',
                message: '{{ $errors->first('lname') }}'
            });
        </script>
        </script>
        @endif
        @if ($errors->has('username'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('username') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('phone'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('phone') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('email'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('email') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('password'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('password') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('currency'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('country') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('address'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('address') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('zip_code'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('zip_code') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('current_password'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('currenct_password') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('password_confirmation'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('password_confirmation') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->has('city'))
        <
        script >
        < script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $errors->first('city') }}'
        });
        </script>
        </script>
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <
        script >
        $("#toast").toast({
            type: 'error',
            message: '{{ $error }}'
        });
        </script>

        @endforeach

    @endif

    </body>
    </html>





@else
@php
        $ncount = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();

    @endphp
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

		<!-- Favicon -->
		<link rel="icon" href="{{url('/')}}/assets/assets/img/brand/favicon.png" type="image/x-icon"/>

		<!-- Title -->
		<title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title>

		<!-- Bootstrap css-->
		<link href="{{url('/')}}/assets/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

		<!-- Icons css-->
		<link href="{{url('/')}}/assets/assets/plugins/web-fonts/icons.css" rel="stylesheet"/>
		<link href="{{url('/')}}/assets/assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="{{url('/')}}/assets/assets/plugins/web-fonts/plugin.css" rel="stylesheet"/>

		<!-- Style css-->
		<link href="{{url('/')}}/assets/assets/css/style.css" rel="stylesheet">
		<link href="{{url('/')}}/assets/assets/css/skins.css" rel="stylesheet">
		<link href="{{url('/')}}/assets/assets/css/dark-style.css" rel="stylesheet">
		<link href="{{url('/')}}/assets/assets/css/colors/default.css" rel="stylesheet">
		<link href="{{url('/')}}/assets/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />

		<!-- Color css-->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/assets/css/colors/color.css">

		<!-- Select2 css-->
		<link href="{{url('/')}}/assets/assets/plugins/select2/css/select2.min.css" rel="stylesheet">

		<!-- Mutipleselect css-->
		<link rel="stylesheet" href="{{url('/')}}/assets/assets/plugins/multipleselect/multiple-select.css">

        <!-- Internal Sweet-Alert css-->
        <link href="{{url('/')}}/assets/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet">
        <script src="{{url('/')}}/assets/assets/plugins/sweet-alert/sweetalert.min.js"></script>

		<!-- Sidemenu css-->
		<link href="{{url('/')}}/assets/assets/css/sidemenu/sidemenu.css" rel="stylesheet">

		 <style>
            body {
                background-color: #f8f8f8;
                font-family: arial;
                font-weight: 400;
            }

            #toast {
                position: fixed;
                z-index: 999;
                top: 12px;
                right: 12px;
            }

            .notification {
                display: block;
                position: relative;
                overflow: hidden;
                margin-top: 10px;
                margin-right: 10px;
                padding: 20px;
                width: 300px;
                border-radius: 3px;
                color: white;
                right: -400px;
            }

            .normal {
                background: #273140;
            }

            .success {
                background: #44be75;
            }

            .error {
                background: #c33c3c;
            }


            .hidden-xs-up {
                display: none !important;
            }

            @media (max-width: 575px) {
                .hidden-xs-down {
                    display: none !important;
                }
            }

            @media (min-width: 576px) {
                .hidden-sm-up {
                    display: none !important;
                }
            }

            @media (max-width: 767px) {
                .hidden-sm-down {
                    display: none !important;
                }
            }

            @media (min-width: 768px) {
                .hidden-md-up {
                    display: none !important;
                }
            }

            @media (max-width: 991px) {
                .hidden-md-down {
                    display: none !important;
                }
            }

            @media (min-width: 992px) {
                .hidden-lg-up {
                    display: none !important;
                }
            }

            @media (max-width: 991px) {
                .hidden-lg-down {
                    display: none !important;
                }
            }

            @media (min-width: 1200px) {
                .hidden-xl-up {
                    display: none !important;
                }
            }

            .hidden-xl-down {
                display: none !important;
            }

            @media (max-width: 991px) {
                .chart-legend > li {
                    float: left;
                    margin-right: 10px;
                }
            }

            .logo-wrapperme {
                float: left;
                display: block;
                padding: 26px 28px 26px 0;
            }

        </style>

	</head>
	 @php
        $ncount = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();
        $unread = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->latest()->take(5)->get();

    @endphp
	<body id="mainbody" class="main-body leftmenu @if(Auth::user()->darkmode == 1 ) dark-theme @endif">
	 <div id="toast"></div>
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{url('/')}}/assets/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->


		<!-- Page -->
		<div class="page">

			<!-- Sidemenu -->
			<div class="main-sidebar main-sidebar-sticky side-menu">
				<div class="sidemenu-logo">
					<a class="main-logo" href="{{route('home')}}">
						<img src="{{url('/')}}/assets/assets/img/brand/logo-light.png" class="header-brand-img desktop-logo" alt="logo">
						<img src="{{url('/')}}/assets/assets/img/brand/icon-light.png" class="header-brand-img icon-logo" alt="logo">
						<img src="{{url('/')}}/assets/assets/img/brand/logo.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
						<img src="{{url('/')}}/assets/assets/img/brand/icon.png" class="header-brand-img icon-logo theme-logo" alt="logo">
					</a>
				</div>
				<div class="main-sidebar-body">
					<ul class="nav">  <br><br>

						<li class="nav-item">
							<a class="nav-link" href="{{route('home')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-grid sidemenu-icon"></i><span class="sidemenu-label">Dashboard</span></a>
						</li>
						<br>

						<li class="nav-item">
							<a class="nav-link" href="{{route('my-wallet')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-wallet sidemenu-icon"></i><span class="sidemenu-label">Wallet</span></a>
						</li>
						<br>
						<li class="nav-item">
							<a class="nav-link" href="{{route('coinvest')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-chart sidemenu-icon"></i><span class="sidemenu-label">VX Vault</span></a>
						</li>
						<br>
						<li class="nav-item">
							<a class="nav-link" href="{{route('products')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-present sidemenu-icon"></i><span class="sidemenu-label">Product</span></a>
						</li>
						<br>
						<li class="nav-item">
							<a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-shopping-cart-full sidemenu-icon"></i><span class="sidemenu-label">Payment Log</span><i class="angle fe fe-chevron-right"></i></a>
							<ul class="nav-sub">

								<li class="nav-sub-item">
									<a class="nav-sub-link" href="{{route('airtime')}}">Airtime</a>
								</li>

								<li class="nav-sub-item">
									<a class="nav-sub-link" href="{{route('internet')}}">Internet Data</a>
								</li>
								<li class="nav-sub-item">
									<a class="nav-sub-link" href="{{route('utilitybill')}}">Utility Bills</a>
								</li>
								<li class="nav-sub-item">
									<a class="nav-sub-link" href="{{route('tvbill')}}">Cable TV</a>
								</li>
								<li class="nav-sub-item">
									<a class="nav-sub-link" href="{{route('instantsms')}}">SMS</a>
								</li>

							</ul>
						</li>
						<br>

						<li class="nav-item">
							<a class="nav-link" href="{{route('vxcard')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-credit-card sidemenu-icon"></i><span class="sidemenu-label">VX Card</span></a>
						</li>
						<br>

						<li class="nav-item">
							<a class="nav-link" href="{{route('profile')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-settings sidemenu-icon"></i><span class="sidemenu-label">Settings</span></a>
						</li>
						<br>

						<li class="nav-item">
							<a class="nav-link" href="{{route('verification')}}"><span class="shape1"></span><span class="shape2"></span><i class="si si-shield sidemenu-icon"></i><span class="sidemenu-label">Verification</span></a>
						</li>
						<br>





				</div>
			</div>
			<!-- End Sidemenu -->

			<!-- Main Header-->
			<div class="main-header side-header sticky">
				<div class="container-fluid">
					<div class="main-header-left">
						<a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
					</div>
					<div class="main-header-center">
						<div class="responsive-logo">
							<a href=""><img src="{{url('/')}}/assets/assets/img/brand/logo.png" class="mobile-logo" alt="logo"></a>
							<a href=" "><img src="{{url('/')}}/assets/assets/img/brand/logo-light.png" class="mobile-logo-dark" alt="logo"></a>
						</div>
						<div class="input-group">

							 @php
							  if(Auth::user()->bankyes == 1 ){

							  $a = 1; }
							 if(Auth::user()->bankyes != 1 ){

							 $a = 0;
							}

							 if(Auth::user()->bvn_verify == 1 ){
							 $b = 1; }
							  if(Auth::user()->bvn_verify != 1 ){

							 $b = 0;
							 }
							 if(Auth::user()->verified == 2 ){

							 $c = 1; }
							 if(Auth::user()->verified != 2 ){
							 $c = 0;
							}

							@endphp

							 @php
							 $stars = $a + $b + $c;
							 @endphp

							 @if($stars == 1)
							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 @elseif($stars == 2)

							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 @elseif($stars == 3)

							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:green"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 @else

							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 <i class="fa fa-star"style="color:red"></i>
							 @endif



						</div>
					</div>
					<div class="main-header-right">

						<div class="  ">
							<a href="#" class="">
									<span class="avatar  mr-3 align-self-center bg-transparent"><img src="{{url('/')}}/assets/assets/img/flags/nigeria.svg" alt="img"></span>

								</a>

						</div>
						<div class="dropdown d-md-flex">
							<a class="nav-link icon" data-effect="effect-fall" data-toggle="modal" href="#myqr">
								<i class="fe fe-maximize header-icons"></i>
{{--								<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>--}}
							</a>
						</div>
						<div class="dropdown main-header-notification">
							<a class="nav-link icon" href="">
								<i class="fe fe-bell header-icons"></i>
								<span class="badge badge-danger nav-link-badge">{{$ncount}}</span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<p class="main-notification-text text-info">You have {{$ncount}} unread notification</p>
								</div>
								<div class="main-notification-list">
								    @foreach($unread as $data)
									<a href="{{route('inbox-view',$data->id)}}"><div class="media new">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('assets/images/logo/logo.png')}}"></div>
										<div class="media-body">
											<p><strong>New</strong> {{$data->title}}</p><span>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
										</div>
									</div>
									</a>
									@endforeach

								</div>
								<div class="dropdown-footer">
									<a href="{{route('inbox')}}">View All Notifications</a>
								</div>
							</div>
						</div>

						<div class="dropdown main-profile-menu">
							<a class="d-flex" href="">
								<span class="main-img-user" >
								@if( file_exists(Auth::User()->image))
                                                <img src="{{asset(Auth::user()->image)}}" alt="" >
                                            @else
                                                <img src="{{url('assets/user/images/user-default.png')}}" alt=""
                                                    >
                                            @endif </span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title">{{Auth::user()->username}}</h6>
									<p class="main-notification-text">Member</p>
								</div>

								<a class="dropdown-item" href="{{route('profile')}}">
									<i class="fe fe-settings"></i> Account Settings
								</a>
								<a class="dropdown-item" href="{{route('inbox')}}">
									<i class="fe fe-mail"></i> Messages
								</a>
								<a class="dropdown-item" href="{{route('activities')}}">
									<i class="fe fe-compass"></i> Activity
								</a>
								<a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                       >
								 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">{{ csrf_field() }}</form>
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</div>
						<div class="dropdown d-md-flex header-settings">
						<label class="custom-switch">
														<input id="dlm" type="checkbox" onchange="darklightmode({{Auth::user()->darkmode}})" name="custom-switch-checkbox" class="custom-switch-input" @if(Auth::user()->darkmode == 1 ) checked @endif>
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">
{{--                                                            @if(Auth::user()->darkmode == 1 ) Dark Mode @else Toggle Dark Mode @endif--}}
                                                        </span>
													</label>
						</div>
						<button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
							aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
						</button><!-- Navresponsive closed -->
					</div>
				</div>
			</div>
			<!-- End Main Header-->

			<!-- Mobile-header -->
			<div class="mobile-main-header">
				<div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2 ml-auto">
						<div class="dropdown ">
							<a class="nav-link icon full-screen-link">
								<i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
								<i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
							</a>
						</div>
						<div class="dropdown main-header-notification">
							<a class="nav-link icon" href="">
								<i class="fe fe-bell header-icons"></i>
								<span class="badge badge-danger nav-link-badge">{{$ncount}}</span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<p class="main-notification-text text-info">You have {{$ncount}} unread notifications</span></p>
								</div>
								<div class="main-notification-list">
									 @foreach($unread as $data)
									<a href="{{route('inbox-view',$data->id)}}"><div class="media new">
										<div class="main-img-user online"><img alt="avatar" src="{{asset('assets/images/logo/logo.png')}}"></div>
										<div class="media-body">
											<p><strong>New</strong> {{$data->title}}</p><span>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
										</div>
									</div>
									</a>
									@endforeach								</div>
								<div class="dropdown-footer">
									<a href="{{route('inbox')}}">View All Notifications</a>
								</div>
							</div>
						</div>
						<div class="dropdown main-profile-menu">
							<a class="d-flex" href="#">
								<span class="main-img-user" >@if( file_exists(Auth::User()->image))
                                                <img src="{{asset(Auth::user()->image)}}" alt="" >
                                            @else
                                                <img src="{{url('assets/user/images/user-default.png')}}" alt=""
                                                    >
                                            @endif</span>
							</a>
							<div class="dropdown-menu">
								<div class="header-navheading">
									<h6 class="main-notification-title">{{Auth::user()->username}}</h6>
									<p class="main-notification-text">Member</p>
								</div>
								<a class="dropdown-item" href="{{route('profile')}}">
									<i class="fe fe-settings"></i> Account Settings
								</a>
								<a class="dropdown-item" href="{{route('inbox')}}">
									<i class="fe fe-mail"></i> Messages
								</a>
								<a class="dropdown-item" href="{{route('activities')}}">
									<i class="fe fe-compass"></i> Activity
								</a>
								<a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                       >
								 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">{{ csrf_field() }}</form>
									<i class="fe fe-power"></i> Sign Out
								</a>
							</div>
						</div>
						<div class="dropdown  header-settings">
							<div class="dropdown d-md-flex header-settings">
{{--							<div id="dlm" class="dropdown d-md-flex header-settings"  onclick="event.preventDefault(); document.getElementById('darkmode-form').submit();">--}}
						<label class="custom-switch">
														<input id="dlm2" onchange="darklightmode2({{Auth::user()->darkmode}})" type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" @if(Auth::user()->darkmode == 1 ) checked @endif>
														<span class="custom-switch-indicator"></span>
														<span class="custom-switch-description">
{{--                                                            @if(Auth::user()->darkmode == 1 ) Dark Mode @else Toggle Dark Mode @endif--}}
                                                        </span>
													</label>

						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile-header closed -->
			@yield('content')

				<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2020 <a href="#">Vision-X Limited</a>.</span>
						</div>
					</div>
				</div>
			</div>
			<!--End Footer-->

			<!-- Sidebar -->
			<div class="sidebar sidebar-right sidebar-animate">
				<div class="sidebar-icon">
					<a href="#" class="text-right float-right text-dark fs-20" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
				</div>
				<div class="sidebar-body">
					<h5>Todo</h5>
					<div class="d-flex p-3">
						<label class="ckbox"><input checked  type="checkbox"><span>Hangout With friends</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input checked type="checkbox"><span>System Updated</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input type="checkbox"><span>Do something more</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input  type="checkbox"><span>System Updated</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top">
						<label class="ckbox"><input  type="checkbox"><span>Find an Idea</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<div class="d-flex p-3 border-top mb-0">
						<label class="ckbox"><input  type="checkbox"><span>Project review</span></label>
						<span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
					</div>
					<h5>Overview</h5>
					<div class="p-4">
						<div class="main-traffic-detail-item">
							<div>
								<span>Founder &amp; CEO</span> <span>24</span>
							</div>
							<div class="progress">
								<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" class="progress-bar progress-bar-xs wd-20p" role="progressbar"></div>
							</div><!-- progress -->
						</div>
						<div class="main-traffic-detail-item">
							<div>
								<span>UX Designer</span> <span>1</span>
							</div>
							<div class="progress">
								<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="15" class="progress-bar progress-bar-xs bg-secondary wd-15p" role="progressbar"></div>
							</div><!-- progress -->
						</div>
						<div class="main-traffic-detail-item">
							<div>
								<span>Recruitment</span> <span>87</span>
							</div>
							<div class="progress">
								<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" class="progress-bar progress-bar-xs bg-success wd-45p" role="progressbar"></div>
							</div><!-- progress -->
						</div>
						<div class="main-traffic-detail-item">
							<div>
								<span>Software Engineer</span> <span>32</span>
							</div>
							<div class="progress">
								<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-info wd-25p" role="progressbar"></div>
							</div><!-- progress -->
						</div>
						<div class="main-traffic-detail-item">
							<div>
								<span>Project Manager</span> <span>32</span>
							</div>
							<div class="progress">
								<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25" class="progress-bar progress-bar-xs bg-danger wd-25p" role="progressbar"></div>
							</div><!-- progress -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Sidebar -->

		</div>
		<!-- End Page -->

     <!-- Modal effects -->
     <div class="modal" id="myqr">
         <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
             <div class="modal-content modal-content-demo">
                 <div class="modal-header">
                     <h6 class="modal-title">Send money to me via my QR</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <img src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl={{'visionx:'.\Illuminate\Support\Facades\Auth::user()->account_number}}&choe=UTF-8\" style='width:190px;' />
                 </div>
             </div>
         </div>
     </div>
     <!-- End Modal effects-->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

		<!-- Jquery js-->
		<script src="{{url('/')}}/assets/assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap js-->
		<script src="{{url('/')}}/assets/assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!-- Internal Chart.Bundle js-->
		<script src="{{url('/')}}/assets/assets/plugins/chart.js/Chart.bundle.min.js"></script>

		<!-- Peity js-->
		<script src="{{url('/')}}/assets/assets/plugins/peity/jquery.peity.min.js"></script>

		<!-- Select2 js-->
		<script src="{{url('/')}}/assets/assets/plugins/select2/js/select2.min.js"></script>

		<!-- Perfect-scrollbar js -->
		<script src="{{url('/')}}/assets/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

		<!-- Sidemenu js -->
		<script src="{{url('/')}}/assets/assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- Sidebar js -->
		<script src="{{url('/')}}/assets/assets/plugins/sidebar/sidebar.js"></script>

		<!-- Internal Morris js -->
		<script src="{{url('/')}}/assets/assets/plugins/raphael/raphael.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/morris.js/morris.min.js"></script>

		<!-- Circle Progress js-->
		<script src="{{url('/')}}/assets/assets/js/circle-progress.min.js"></script>
		<script src="{{url('/')}}/assets/assets/js/chart-circle.js"></script>

		<!-- Internal Dashboard js-->
		<script src="{{url('/')}}/assets/assets/js/index.js"></script>

		<!-- Sticky js -->
		<script src="{{url('/')}}/assets/assets/js/sticky.js"></script>

		<!-- Custom js -->
		<script src="{{url('/')}}/assets/assets/js/custom.js"></script>


     <!-- Internal Sweet-Alert js-->
     <script src="{{url('/')}}/assets/assets/plugins/sweet-alert/sweetalert.min.js"></script>
     <script src="{{url('/')}}/assets/assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>

		<!-- Internal Data Table js -->
		<script src="{{url('/')}}/assets/assets/plugins/owl-carousel/owl.carousel.js"></script>


		<script src="{{url('/')}}/assets/assets/plugins/datatable/jquery.dataTables.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/dataTables.buttons.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/jszip.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/pdfmake.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/vfs_fonts.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/buttons.html5.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/buttons.print.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/datatable/fileexport/buttons.colVis.min.js"></script>
		<script src="{{url('/')}}/assets/assets/js/table-data.js"></script>

		<script src="{{url('/')}}/assets/assets/plugins/checkout-jquery-steps/jquery.steps.min.js"></script>
		<script src="{{url('/')}}/assets/assets/js/checkout-jquery-steps.js"></script>
		<!-- Select2 js-->
		<script src="{{url('/')}}/assets/assets/plugins/select2/js/select2.min.js"></script>
		<script src="{{url('/')}}/assets/assets/js/select2.js"></script>

		<script src="{{url('/')}}/assets/assets/plugins/raphael/raphael.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/morris.js/morris.min.js"></script>
		<script src="{{url('/')}}/assets/assets/js/crypto-buysell.js"></script>
		<script src="{{url('/')}}/assets/assets/js/form-elements.js"></script>


		<script src="{{url('/')}}/assets/assets/plugins/raphael/raphael.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/morris.js/morris.min.js"></script>

		<!-- Internal Apexchart js-->
		<script src="{{url('/')}}/assets/assets/js/apexcharts.js"></script>

		<script src="{{url('/')}}/assets/js/vcard.js"></script>

		<!-- Internal Polyfills js-->
		<script src="{{url('/')}}/assets/assets/plugins/polyfill/polyfill.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/polyfill/classList.min.js"></script>
		<script src="{{url('/')}}/assets/assets/plugins/polyfill/polyfill_mdn.js"></script>

                @yield('js')
                <script>
                    (function ($) {

                        $.fn.toast = function (options) {

                            var settings = $.extend({
                                type: 'normal',
                                message: null
                            }, options);

                            var item = $('<div class="notification ' + settings.type + '"><span>' + settings.message + '</span></div>');
                            this.append($(item));
                            $(item).animate({"right": "12px"}, "fast");
                            setInterval(function () {
                                $(item).animate({"right": "-400px"}, function () {
                                    $(item).remove();
                                });
                            }, 4000);
                        }

                        $(document).on('click', '.notification', function () {
                            $(this).fadeOut(400, function () {
                                $(this).remove();
                            });
                        });

                    }(jQuery));
                </script>


                @if (session('fundsent'))
                    <script>
                        Swal.fire({
                            imageUrl: '{{asset('assets/images/sent.png')}}',
                            imageHeight: 200,
                            title: 'Your Request Has Been Submitted',
                            text: 'You will receive a call from our representative to confirm your transfer',
                            imageAlt: ''
                        })

                    </script>
                @endif
                @if (session('alert'))
                    <script>
                        $("#toast").toast({
                            message: '{{ session('alert') }}'
                        });
                    </script>
                @endif
                @if(Session::has('success'))
                    <script>
                        $("#toast").toast({
                            type: 'success',
                            message: '{{ Session::get('success') }}'
                        });
                    </script>

                @endif

                @if (session('message'))
                    <script>
                        $("#toast").toast({
                            message: '{{ session('message') }}'
                        });
                    </script>
                @endif

                @if(Session::has('danger'))
                    <script>
                        $("#toast").toast({
                            type: 'error',
                            message: '{{ session('danger') }}'
                        });
                    </script>
                @endif

                @if ($errors->has('fname'))

                    <script>
                        $("#toast").toast({
                            type: 'error',
                            message: '{{ $errors->first('fname') }}'
                        });
                    </script>
                @endif

                @if ($errors->has('lname'))
                    <script>
                        <
                        script >
                        $("#toast").toast({
                            type: 'error',
                            message: '{{ $errors->first('lname') }}'
                        });
                    </script>
                    </script>
                    @endif
                    @if ($errors->has('username'))
                    <
                    script >
                    < script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('username') }}'
                    });
                    </script>
                    </script>
                    @endif
                    @if ($errors->has('phone'))
                    <
                    script >
                    < script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('phone') }}'
                    });
                    </script>
                    </script>
                    @endif
                    @if ($errors->has('email'))
                    <
                    script >
                    < script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('email') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('password'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('password') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('currency'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('country') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('address'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('address') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('zip_code'))
                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('zip_code') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('current_password'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('currenct_password') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('password_confirmation'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('password_confirmation') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->has('city'))

                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $errors->first('city') }}'
                    });
                    </script>
                    @endif
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <script >
                    $("#toast").toast({
                        type: 'error',
                        message: '{{ $error }}'
                    });
                    </script>

                @endforeach

            @endif

	</body>
</html>
@endif
