<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Welcome to {{$basic->sitename}}, Easy User Experience and Responsive payment for all platforms" />
  <meta name="keywords"
    content="HTML, CSS, JavaScript, Bootstrap, jQuery, Rakon, Themeforest, Template, envato, SASS, SCSS, HTML5, landing page, SaaS Product, SaaS Modern,  MultiPurpose, Crypto, Currency, ICO, Hosting, Agency, Mobile, App, Interior, Charity" />
  <meta name="author" content="Rakon - Creative Multi-Purpose HTML5 Templates" />

  <title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="{{asset('front/img/favicon.png')}}" type="image/x-icon" />
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}" type="text/css" />
  <!-- animate -->
  <link rel="stylesheet" href="{{asset('front/css/animate.css')}}" type="text/css" />
  <!-- Swiper -->
  <link rel="stylesheet" href="{{asset('front/css/swiper.min.css')}}" />
  <!-- icons -->
  <link rel="stylesheet" href="{{asset('front/css/icons.css')}}" type="text/css" />
  <!-- aos -->
  <link rel="stylesheet" href="{{asset('front/css/aos.css')}}" type="text/css" />
  <!-- main css -->
  <link rel="stylesheet" href="{{asset('front/css/main.css')}}" type="text/css" />
  <!-- normalize -->
  <link rel="stylesheet" href="{{asset('front/css/normalize.css')}}" type="text/css" />
  <!-- js for Brwoser -->
  <link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />
		<script src="{{asset('process/countries.js')}}"></script>
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="signup_full bg_dark">

  <!-- Start form_signup_onek -->
  <section class="form_signup_one signup_two">
    <div class="container">
      <div class="row">

        <div class="col-md-7 col-lg-5 mx-auto">
          <div class="item_group"> 
              <div class="col-12">
                   @if ($errors->has('email'))
                                            <span class="error ">{{ $errors->first('email') }}</span>
                     @endif
					 @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(Session::has('danger'))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('danger') }}
                            </div>
                        @endif
					<form action="{{ route('user.password.email') }}" method="post" class="row"  novalidate="">
					@csrf
					 
                <div class="title_sign">
                  <h2>Reset Password?</h2>
                  <p>Please fill the form below to request a password reset link</p>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email"   class="form-control" placeholder="email address">
                </div>
              </div>

                 

              <div class="col-12">
                <button type="submit" class="btn w-100 btn_account bg-orange-red c-white rounded-8">
                  Reset Password
                </button>
                
                 <div class="google_sign margin-t-3">
                  <a href="login" class="text-center w-100 d-inline-block font-s-14 c-gray">Undo reset</a>
                </div>
                 
              </div>

            </form>
          </div>

          <!-- Start item_footer -->
          <div class="item_footer text-center margin-t-3">
            <div class="container">
              <p>© {{date('Y')}} <a href="#" >{{$basic->sitename}}</a>
                All Right Reseved
              </p>
            </div>
          </div>
          <!-- End. item_footer -->

        </div>
      </div>

    </div>
  </section>
  <!-- End.form_signup_one -->


  <!-- Back to top with progress indicator-->
  <div class="prgoress_indicator">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>

 
  <script src="{{asset('front/js/vendor/aos.js')}}" type="text/javascript"></script>
  <!-- main file -->
  <script src="{{asset('front/js/main.js')}}" type="text/javascript"></script>
</body>

</html>
@yield('script') 

    <script src="{{asset('front-assets/js/rainbow.js')}}"></script>
	<script src="{{asset('front-assets/js/sample.js')}}"></script>
	<script src="{{asset('front-assets/js/jquery.growl.js')}}"></script> 


@yield('js')
@if (session('alert'))
	<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ session('alert') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif


@if ($errors->has('fname'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('fname') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif

@if ($errors->has('lname'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('lname') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif
@if ($errors->has('username'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('username') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif
@if ($errors->has('phone'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('phone') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif
@if ($errors->has('email'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('email') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif
@if ($errors->has('password'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('password') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif


@if(Session::has('success'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.notice({
				message: "{{ Session::get('success') }}"
			});
  		  });
		}).call(this);
 	</script>
 @endif

@if (session('message'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.notice({
				message: "{{ session('message') }}"
			});
  		  });
		}).call(this);
 	</script>
 @endif
@if(Session::has('danger'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ session('danger') }}"
			});
  		  });
		}).call(this);
 	</script>
 @endif

 @if ($errors->has('sms_code'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('sms_code') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif

 @if ($errors->has('email_code'))
<script>
		 (function () {
		  $(function () {
		   return $.growl.error({
				message: "{{ $errors->first('email_code') }}"
			});
  		  });
		}).call(this);
 	</script>
@endif
@if(Session::has('ref'))
<script>
 swal("Hello", "{!! session()->get('ref')  !!}", "info");
</script>
@endif
@if(Session::has('referror'))
<script>
 swal("Hello", "{!! session()->get('referror')  !!}", "error");
</script>
@endif