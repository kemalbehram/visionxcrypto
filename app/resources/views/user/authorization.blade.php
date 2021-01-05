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
@elseif(Auth::user()->email_verify < 1 )

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
            <h3 class="main-title">Email Verification</h3>
            <img src="{{asset('assets/images/mobile-banking.png')}}" width="300" alt="" class="icon">
            <div class="confirmation-text font-fix">A verification mail with a verification code was just sent to <span
                    class="mark-text">{{Auth::user()->email}}</span>. Please enter the code in the field below to verify
                your identity
            </div>
            <form class="verification-code-form" action="{{ route('user.email-verify')}}" method="post">
                @csrf
                <input type="text" name="email_code" placeholder="Enter verification code">
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <button type="submit" class="theme-button"><span></span>Verify</button>
            </form>
            <form id="requestphone" action="{{route('user.send-emailVcode') }}" method="post">
                @csrf
                <div class="condition-text text-center font-fix">Haven't received the code yet? <a
                        href="{{route('user.send-emailVcode') }}"
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
@endif