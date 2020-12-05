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
        <script src="{{asset('assets/js/jquery3.5.1.js')}}"></script>

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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

    @endphp

    <body>
    <div id="toast"></div>
    <div class="main-page-wrapper">
        <div class="dropdown-overlay"></div>


        <!-- *********************** Dashboard Main Container ************************** -->
        <div id="dashboard-wrapper">

            <!-- ******************** Main Top Header *********************** -->
            <div id="main-top-header">
                <div class="container">
                    <div class="wrapper clearfix">
                        <!-- Toggle Menu Button -->
                        <button class="toggle-show-menu-button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- Logo -->
                        <div class="hidden-xs-down hidden-md-down hidden">
                            <a href="{{route('home')}}" class="logo-wrapperme"><img width="150"
                                                                                    src="{{asset('assets/images/logo/logo.png')}}"
                                                                                    alt=""></a>
                        </div>

                        <div class="hidden-lg-up hidden-sm-up hidden-md-up hidden-xl-up">
                            <a href="{{route('home')}}" class="logo-wrapper"><img width="100"
                                                                                  src="{{asset('assets/images/logo/logo.png')}}"
                                                                                  alt=""></a>
                        </div>
                        <!-- Top Bar Action List -->
                        <div class="top-bar-action-list">
                            <ul class="clearfix">
                                @if(\Illuminate\Support\Facades\Auth::user()->verified=="" || \Illuminate\Support\Facades\Auth::user()->verified==1)
                                    <li class="action-list-item">
                                        <a href="{{route('verification')}}" class="invite-button">Upgrade to Level 2</a>
                                    </li> <!-- /.action-list-item -->
                                @else
                                    <li class="action-list-item">
                                        <button class="btn btn-success"
                                                style="text-align: center; color: #fff; font-size: 1.166em; border:1px solid #dee0e7; border-radius: 5px; line-height: 37px; padding: 0 17px; margin-top: 13px;">
                                            Verified
                                        </button>
                                    </li> <!-- /.action-list-item -->
                            @endif
                            <!-- Balance Figure -->
                                <li class="action-list-item balance-action-button">
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" data-toggle="dropdown">
                                            <span
                                                class="font-fix">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}} </span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <div class="clearfix dropdown-top-header">
                                                <div class="dropdown-title">Your balance</div>
                                                <a href="{{route('my-wallet')}}" class="deposite-action">+ Deposit</a>
                                            </div>
                                            <div class="balance-sheet-wrapper">
                                                <ul>
                                                    <li class="bitcoin-method clearfix">
                                                        <a class="clearfix" href="#">
                                                            <span class="name font-fix"><img width="40"
                                                                                             src="{{url('assets/images/invest.png')}}"
                                                                                             alt=""> Investment Vault</span>
                                                            <span class="balance-inquery">
																@php
                                                                    $baseUrl = "https://blockchain.info/";
                                                                    $endpoint = "tobtc?currency=USD&value=1";
                                                                    $httpVerb = "GET";
                                                                    $contentType = "application/json"; //e.g charset=utf-8
                                                                    $headers = array (
                                                                        "Content-Type: $contentType",

                                                                );

                                                                    $ch = curl_init();
                                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                                    curl_setopt($ch, CURLOPT_URL, $baseUrl.$endpoint);
                                                                    curl_setopt($ch, CURLOPT_HTTPGET, true);
                                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                                                                    $bbttcc = json_decode(curl_exec( $ch ),true);
                                                                    $err     = curl_errno( $ch );
                                                                    $errmsg  = curl_error( $ch );
                                                                    curl_close($ch);
                                                                @endphp

																<span class="currency-title">{{number_format(App\UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first()->balance * $bbttcc,7)}} BTC</span>
																	<span
                                                                        class="total-currency">${{number_format(App\UserWallet::where('user_id', Auth::id())->where('type', 'interest_wallet')->first()->balance,2)}}</span>
																</span>
                                                        </a>
                                                    </li>
                                                    <li class="ethereum-method clearfix">
                                                        <a class="clearfix" href="#">
                                                            <span class="name font-fix"><img width="40"
                                                                                             src="{{asset('assets/images/bonus.png')}}"
                                                                                             alt=""> bonus</span>
                                                            <span class="balance-inquery">
																	<span
                                                                        class="currency-title">{{$basic->currency_sym}}{{number_format(Auth::user()->bonus, $basic->decimal)}} </span>
																</span>
                                                        </a>
                                                    </li>
                                                    <li class="litecoin-method clearfix">
                                                        <a class="clearfix" href="#">
                                                            <span class="name font-fix"><img width="40"
                                                                                             src="{{asset('assets/images/naira.jpeg')}}"
                                                                                             alt=""> Naira Wallet</span>
                                                            <span class="balance-inquery">
																	<span
                                                                        class="currency-title">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}} </span>
																</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="total-balance clearfix">
                                                    <div class="balance-title">Total Balance �</div>
                                                    <div
                                                        class="balance-figure">{{$basic->currency_sym}}{{number_format(Auth::user()->balance + Auth::user()->bonus, $basic->decimal)}}</div>
                                                </div>
                                            </div> <!-- /.balance-sheet-wrapper -->
                                        </div>
                                    </div>
                                </li> <!-- /.action-list-item -->
                                <!-- User Panel -->
                                <li class="action-list-item user-profile-action">
                                    <div class="dropdown">
                                        <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                            @if( file_exists(Auth::User()->image))
                                                <img src="{{asset(Auth::user()->image)}}" alt="" class="user-img">
                                            @else
                                                <img src="{{url('assets/user/images/user-default.png')}}" alt=""
                                                     class="user-img">
                                            @endif
                                            <span class="user-name font-fix">{{Auth::user()->username}}</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <div class="user-account-information">

                                                @if( file_exists(Auth::User()->image))
                                                    <img src="{{asset(Auth::user()->image)}}" alt=""
                                                         class="user-lg-img">
                                                @else
                                                    <img src="{{url('assets/user/images/user-default.png')}}" alt=""
                                                         class="user-lg-img">
                                                @endif
                                                <div
                                                    class="user-name font-fix">{{Auth::user()->fname}} {{Auth::user()->lname}}</div>
                                                <div class="user-email">{{Auth::user()->email}}</div>
                                                <div class="member-rank">Member</div>
                                            </div> <!-- /.user-account-information -->
                                            <ul class="user-useful-link">
                                                <li><a href="{{route('profile')}}" class="font-fix">Your Profile</a>
                                                </li>
                                                <li><a href="{{route('activities')}}" class="font-fix">Activity Log</a>
                                                </li>
                                                <li><a href="{{route('inbox')}}"
                                                       class="font-fix">Messages @if($ncount > 0)<span
                                                            class="free-button">{{$ncount}} New</span> @endif </a></li>
                                                <li><a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                       class="font-fix">Log Out</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">{{ csrf_field() }}</form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> <!-- /.action-list-item -->
                            </ul>
                        </div> <!-- /.top-bar-action-list -->
                    </div> <!-- /.wrapper -->
                </div> <!-- /.container -->
            </div> <!-- #main-top-header -->   <!-- ***** End Main Top Header ***** -->
            <div class="container">
                <div id="dashboard-main-body" class="clearfix">

                    <!-- ***************** Sidebar **************** -->
                    <div class="dashboard-sidebar-navigation">
                        <button class="close-aside-menu tran3s round-border">
                            <img src="{{asset('assets/images/close.png')}}" alt="">
                        </button>
                        <ul class="navigation-link">
                            <li class="{{ Request::segment(2) === 'home' ? 'active-link' : null }}"><a
                                    href="{{route('home')}}"><img src="{{url('assets/images/dashboard.svg')}}" alt=""
                                                                  class="svg"> Dashboard</a></li>
                            <li class="{{ Request::segment(2) === 'coin-vest' ? 'active-link' : null }} {{ Request::segment(2) === 'coinvestyield' ? 'active-link' : null }}">
                                <a href="{{route('coinvest')}}"><img src="{{url('assets/images/invest.png')}}" alt=""
                                                                     class="svg size-fix"> VX Vault</a></li>
                            <li class="{{ Request::segment(2) === 'my-wallet' ? 'active-link' : null }} {{ Request::segment(2) === 'transfer' ? 'active-link' : null }}">
                                <a href="{{route('my-wallet')}}"><img src="{{url('assets/images/wallet.png')}}" alt=""
                                                                      class="svg size-fix"> Wallet</a></li>
                            <li class="{{ Request::segment(2) === 'products' ? 'active-link' : null }} {{ Request::segment(2) === 'trade-coin' ? 'active-link' : null }}{{ Request::segment(2) === 'airtime' ? 'active-link' : null }} {{ Request::segment(2) === 'internet' ? 'active-link' : null }} {{ Request::segment(2) === 'pay-tv-bills' ? 'active-link' : null }} {{ Request::segment(2) === 'utilitybills' ? 'active-link' : null }} {{ Request::segment(2) === 'instantsms' ? 'active-link' : null }}">
                                <a href="{{route('products')}}"><img src="{{url('assets/images/cart.png')}}" alt=""
                                                                     class="svg"> Products</a></li>
                            <li class="{{ Request::segment(2) === 'visionxcard' ? 'active-link' : null }}"><a
                                    href="{{route('showvcard')}}"><img src="{{url('assets/images/airtime.jpg')}}" alt=""
                                                                       class="svg"> VXCard</a></li>
                            <li class="{{ Request::segment(2) === 'edit-profile' ? 'active-link' : null }} {{ Request::segment(2) === 'activity-log' ? 'active-link' : null }} {{ Request::segment(2) === 'inbox' ? 'active-link' : null }}">
                                <a href="{{route('profile')}}"><img src="{{url('assets/images/settings.png')}}" alt=""
                                                                    class="svg"> Settings</a></li>
                            <li class="{{ Request::segment(2) === 'verification' ? 'active-link' : null }}"><a
                                    href="{{route('verification')}}"><img src="{{url('assets/images/shield.png')}}"
                                                                          alt="" class="svg"> Verification</a></li>
                        </ul>

                        @if(\Illuminate\Support\Facades\Auth::user()->verified=="")
                            <li class="action-list-item">
                                <a href="{{route('verification')}}" class="invite-button">Upgrade to Level 2</a>
                            </li> <!-- /.action-list-item -->
                        @else
                            <li class="action-list-item">
                                <button class="btn btn-success"
                                        style="text-align: center; color: #fff; font-size: 1.166em; border:1px solid #dee0e7; border-radius: 5px; line-height: 37px; padding: 0 17px; margin-top: 13px;">
                                    Verified
                                </button>
                            </li> <!-- /.action-list-item -->
                        @endif

                    </div> <!-- /.dashboard-sidebar-navigation --> <!-- ***** End Sidebar **** -->


                @yield('content')




                <!-- Optional JavaScript _____________________________  -->

                    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                    <!-- jQuery -->
                    <script src="{{asset('assets/vendor/jquery.2.2.3.min.js')}}"></script>
                    <!-- Popper js -->
                    <script src="{{asset('assets/vendor/popper.js/popper.min.js')}}"></script>
                    <!-- Bootstrap JS -->
                    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
                    <!-- Country Select -->
                    <script
                        src="{{asset('assets/vendor/country-select-js-master/build/js/countrySelect.min.js')}}"></script>
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


            <!-- Payouts Modal -->
                <div class="modal fade" id="payout-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="theme-modal-header">
                                <img src="{{asset('assets/images/cardsoon.png')}}" alt="" class="payout-icon">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div> <!-- /#payout-modal -->

    </body>

    </html>
@endif
