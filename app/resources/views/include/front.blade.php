<!DOCTYPE html>
<html lang="en">

<head><meta charset="windows-1252">


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
<link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />
		<script src="{{asset('process/countries.js')}}"></script>
  <!-- js for Brwoser -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .subnav {
            float: left;
            overflow: hidden;
        }

        .subnav .subnavbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: inherit;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar .subnav:hover, subnavbtn:hover {
            background-color: #000080;
            color: white;
        }

        .subnav-content {
            display: none;
            position: absolute;
            left: 40px;
            margin-top: 50px;
            background-color: #000080;
            width: 50%;
            z-index: 1;
        }

        .subnav-content a {
            float: left;
            color: white;
            text-decoration: none;
        }

        .subnav-content a:hover {
            background-color: #eee;
            color: black;
        }

        .subnav:hover .subnav-content {
            display: block;
        }
    </style>

</head>

<body>
  <div id="wrapper">
    <div id="content">
      <!-- Start Fixed icons -->
     <!-- <div class="icon-fixed">
        <div class="fixed img01 floating-3">
          <img src="../../assets/img/gif/money_with_wings.gif" />
        </div>
        <div class="fixed img02 floating-2">
          <img src="../../assets/img/icons/money-bag.png" />
        </div>
        <div class="fixed img03 floating">
          <img src="../../assets/img/icons/purse.png" />
        </div>
        <div class="fixed img04 floating-4">
          <img src="../../assets/img/icons/credit-card.png" />
        </div>
        <div class="fixed img05 floating-3">
          <img src="../../assets/img/gif/money_mouth_face.gif" />
        </div>
        <div class="fixed img06 floating-2">
          <img src="../../assets/img/icons/ok-hand.png" />
        </div>
        <div class="fixed img07 floating">
          <img src="../../assets/img/icons/bitcoin01.svg" />
        </div>
        <div class="fixed img08 floating-3">
          <img src="../../assets/img/icons/old-key.png" />
        </div>
        <div class="fixed img09 floating-4">
          <img src="../../assets/img/icons/gem-stone.png" />
        </div>
        <div class="fixed img10 floating-4">
          <img src="../../assets/img/gif/globe.gif" />
        </div>
      </div>-->
      <!-- End. Fixed icons -->

      <!-- Start header -->
      <header class="header-nav-center header-nav-left no_blur crypto_1 light nav-product active-orange" id="myNavbar">
        <div class="container">
          <!-- navbar -->

          <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand c-white" href="{{url('/')}}">
              <img class="logo" src="{{asset('front/img/logo1.png')}}" alt="logo" style="width:200px;height:35px;" />
            </a>
            <button class="navbar-toggler menu ripplemenu" type="button" data-toggle="collapse"
              data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <svg viewBox="0 0 64 48">
                <path d="M19,15 L45,15 C70,15 58,-2 49.0177126,7 L19,37"></path>
                <path d="M19,24 L45,24 C61.2371586,24 57,49 41,33 L32,24"></path>
                <path d="M45,33 L19,33 C-8,33 6,-2 22,14 L45,37"></path>
              </svg>
            </button>



            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto nav-pills">

{{--                  <li class="nav-item">--}}
{{--                  <a class="nav-link" href="{{route('product')}}">Products</a>--}}
{{--                </li>--}}
                  <li class="nav-item">
                  <div class="subnav">
                      <a class="subnavbtn nav-link">Products</a>
                      <div class="subnav-content">
                          <div class="md:px-6 md:py-8 rounded-md grid-cols-2">
                              <div class="row ml-2 mr-2 text-center">
                              <div class="col-lg-6 col-md-12 text-center">
                                                                        <a href="products" class="flex items-center mb-6 hover:bg-yellow-pale rounded-md duration-500 tracking-normal font-normal p-3">
                                                                            <div>
                                                                                <p class="text-blue-base font-medium main mb-1"><img src="front/img/IMG_0232.PNG" width="30px" class="g-image" style="margin-right: 5px"> All Products</p>
                                                                                <p class="text-smoke-dark sub " style="font-size: 10px">View all Our Products</p>
                                                                            </div>
                                                                        </a>
                              </div>
                              <div class="col-lg-6 col-md-12">


                                                                    <a href="products/#dgassets" class="flex items-center hover:bg-red-pale rounded-md duration-500 tracking-normal font-normal p-3">
                                                                        <div>
                                                                            <p class="text-blue-base font-medium main mb-1"><img src="front/img/IMG_0231.PNG" width="30px" class="g-image" style="margin-right: 5px">Digital Assets</p>
                                                                            <p class="text-smoke-dark sub" style="font-size: 10px">
                                                                                Perfect Money, Bitcion &amp; more.
                                                                            </p>
                                                                        </div>
                                                                    </a>
                              </div>
                              <div class="col-lg-6 col-md-12">


                                                                    <a href="products/#vxcard" class="flex items-center hover:bg-red-pale rounded-md duration-500 tracking-normal font-normal p-3" style="margin-right: 50px">
                                                                        <div>
                                                                            <p class="text-blue-base font-medium main mb-1"><img src="front/img/IMG_0229.PNG" width="30px" class="g-image" style="margin-right: 5px">VX Card</p>
                                                                            <p class="text-smoke-dark sub" style="font-size: 10px">
                                                                                Physical and Virtual cards <br/>for instant Cash Out!
                                                                            </p>
                                                                        </div>
                                                                    </a>
                              </div>
                              <div class="col-lg-6 col-md-12">


                                                                    <a href="products/#vxcard" class="flex items-center hover:bg-red-pale rounded-md duration-500 tracking-normal font-normal p-3">
                                                                        <div>
                                                                            <p class="text-blue-base font-medium main mb-1"><img src="front/img/IMG_0230.PNG" width="30px" class="g-image" style="margin-right: 5px">VX Vault</p>
                                                                            <p class="text-smoke-dark sub" style="font-size: 10px">
                                                                                Highly secure for you!
                                                                            </p>
                                                                        </div>
                                                                    </a>
                              </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  </li>
				<li class="nav-item">
                  <a class="nav-link" href="{{route('rates')}}">Rates</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="{{route('contact-us')}}">Help</a>
                </li>

              </ul>
              <div class="nav_account">
                  @if(Auth::user())
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-default c-white" data-toggle="modal" data-target="#mdllLogin">
                  Logout
                </button></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <a href="{{route('home')}}" class="btn scale btn_sm_primary bg-orange-red c-white effect-letter rounded-8">
                  My Account
                </a>
                @else
                <a type="button" class="btn btn-default c-white" data-toggle="modal" data-target="#mdllLogin">
                  Sign in
                </a>
                @if($basic->registration > 0)
                <a href="{{route('register')}}" class="btn scale btn_sm_primary bg-orange-red c-white effect-letter rounded-8">
                  Get Started
                </a>
                @endif
                @endif
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
        <!-- end container -->
      </header>
      <!-- End header -->
@yield('content')
		<!-- Start footer -->
    <footer class="defalut-footer light padding-py-12">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="item_about">
              <a class="logo" href="{{url('/')}}">
                <img class="logo" src="{{asset('front/img/logo33.png')}}" alt="logo" style="width:200px;height:40px;" />
              </a>
              <p>
                The way forward....
              </p>
              <div class="address">
                <span>Registered with CAC</span>
                <span>RC Number: 1650977.</span>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Learn more</h4>
              <a class="nav-link" href="{{route('blog')}}">Blog</a>
              <a class="nav-link" href="{{route('blog')}}">Press</a>
              <a class="nav-link" href="https://graphics.reuters.com/CHINA-HEALTH-MAP/0100B59S39E/index.html" target="_blank">Covid-19</a>
              <a class="nav-link" href="{{route('contact-us')}}">Help Center</a>

            </div>
          </div>

		  <div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Legal</h4>
              <a class="nav-link" href="{{route('privacy-policy')}}">Privacy Policy</a>
              <a class="nav-link" href="{{route('privacy-policy')}}">Terms & conditions</a>
              <a class="nav-link" href="{{route('moneylaunder')}}">Anti-Money Laundering Policy</a>
            </div>
          </div>
          <div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Company</h4>
              <a class="nav-link" href="{{route('about')}}">About</a>
              <a class="nav-link" href="{{route('career')}}">Careers</a>
			  <a class="nav-link" href="{{route('rates')}}">Rates</a>
			  <a class="nav-link" href="{{route('product')}}">Product</a>
            </div>
          </div>

		  <div class="col-6 col-md-6 col-lg-2">
            <div class="item_links">
              <h4>Social</h4>
              <a class="nav-link" href="https://www.facebook.com/Vision-X-Crypto-Services-Ltd-105417581108721/">Facebook</a>
              <a class="nav-link" href="https://twitter.com/visionxcrypto">Twitter</a>
			  <a class="nav-link" href="https://www.instagram.com/visionxcryptoservicesltd/">Instagram</a>
			  <a class="nav-link" href="#">Youtube</a>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mt-4 mt-lg-0">
            <!--<div class="item_subscribe">
              <h4>Subscribe</h4>
              <p>
                Subscribe to get the latest<br />
                news form us
              </p>
              <form class="form-row">
                <div class="col-md-12 form-group input_subscribe dark">
                  <div class="item_input">
                    <input type="email" class="form-control rounded-8" id="email02" placeholder="Enter email address" />
                    <button type="button" class="btn scale btn_md_primary rounded-8 btn_subscribe">
                      Subscribe
                    </button>
                  </div>
                </div>
              </form>-->


        </div>

        <div class="col-12 text-center padding-t-4">
          <div class="copyright">
            <span>© {{date('Y')}}
              <a href="  " target="_blank">{{$basic->sitename}}.</a>
              All Right Reseved</span>
          </div>
        </div>
      </div>
    </footer>
	<!-- End Footer -->

    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>


    <!-- Tosts -->
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">
      <div class="toast toast_demo" id="myTost" role="alert" aria-live="assertive" aria-atomic="true"
        data-animation="true" data-autohide="false">
        <div class="toast-body">
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <i class="tio clear"></i>
          </button>
          <h5>Hello 👋</h5>
          <p>We are here to help <a href="{{route('contact-us')}}">Contact us</a></p>
        </div>
      </div>
    </div>
    <!-- End. Toasts -->

    <!-- Start Section Loader -->
    <section class="loading_overlay">
      <div class="loader_logo">
        <img class="logo" src="{{asset('front/img/loading.gif')}}" alt="logo" style="width:115px;height:115px;"/>
      </div>
    </section>
    <!-- End. Loader -->

    <!-- Login Modal  -->
    <div class="modal mdllaccount fade" id="mdllLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="tio clear"></i>
            </button>
          </div>
          <div class="modal-body">
            <div class="form_account">
              <div class="head_account">
                <div class="img_profile">
                  <img src="{{asset('front/img/gif/avatar.png')}}" />
                </div>
                <div class="title">
                  <h4>Visionxcrypto.</h4>
                  <p>
                    Welcome back,<br />
                    Please sign in
                  </p>
                </div>
              </div>
              	<form action="{{ route('login') }}" method="post"  novalidate="">
					@csrf
              <div class="form-row">
                <div class="col-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="test" name="username" class="form-control" placeholder="Username" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group mb-1 --password" id="show_hide_password">
                        <label>Password</label>
                        <div class="input-group">
                          <input type="password"name="password" class="form-control" data-toggle="password" placeholder="+6 Characters"
                            required="" />
                          <div class="input-group-prepend hide_show">
                            <a href=""><span class="input-group-text tio hidden_outlined"></span></a>
                          </div>
                        </div>
                      </div>
                      <a href="#" class="btn mt-2 font-s-12 font-w-400 c-gray p-0">Forgot Passowrd?</a>
                    </div>
                    <div class="col-12 mt-4">
                      <button type="submit" class="btn rounded-8 btn_xl_primary btn_login effect-letter">Sign in</button>
                      <a href="{{route('register')}}" class="btn mt-3 font-s-15 c-dark text-center w-100">Create new account</a>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End. Modal -->
  </div>
  <!-- End. warapper -->

  <!-- jquery -->
  <script src="{{asset('front/js/jquery-3.5.0.js')}}" type="text/javascript"></script>
  <!-- jquery-migrate -->
  <script src="{{asset('front/js/jquery-migrate.min.js')}}" type="text/javascript"></script>
  <!-- popper -->
  <script src="{{asset('front/js/popper.min.js')}}" type="text/javascript"></script>
  <!-- bootstrap -->
  <script src="{{asset('front/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <!--
  ============
  vendor file
  ============
   -->
  <!-- particles -->
  <script src="{{asset('front/js/vendor/particles.min.js')}}" type="text/javascript"></script>
  <!-- TweenMax -->
  <script src="{{asset('front/js/vendor/TweenMax.min.js')}}" type="text/javascript"></script>
  <!-- ScrollMagic -->
  <script src="{{asset('front/js/vendor/ScrollMagic.js')}}" type="text/javascript"></script>
  <!-- animation.gsap -->
  <script src="{{asset('front/js/vendor/animation.gsap.js')}}" type="text/javascript"></script>
  <!-- addIndicators -->
  <script src="{{asset('front/js/vendor/debug.addIndicators.min.js')}}" type="text/javascript"></script>
  <!-- Swiper js -->
  <script src="{{asset('front/js/vendor/swiper.min.js')}}" type="text/javascript"></script>
  <!-- countdown -->
  <script src="{{asset('front/js/vendor/countdown.js')}}" type="text/javascript"></script>
  <!-- simpleParallax -->
  <script src="{{asset('front/js/vendor/simpleParallax.min.js')}}" type="text/javascript"></script>
  <!-- waypoints -->
  <script src="{{asset('front/js/vendor/waypoints.min.js')}}" type="text/javascript"></script>
  <!-- counterup -->
  <script src="{{asset('front/js/vendor/jquery.counterup.min.js')}}" type="text/javascript"></script>
  <!-- charming -->
  <script src="{{asset('front/js/vendor/charming.min.js')}}" type="text/javascript"></script>
  <!-- imagesloaded -->
  <script src="{{asset('front/js/vendor/imagesloaded.pkgd.min.js')}}" type="text/javascript"></script>
  <!-- BX-Slider -->
  <script src="{{asset('front/js/vendor/jquery.bxslider.min.js')}}" type="text/javascript"></script>
  <!-- Sharer -->
  <script src="{{asset('front/js/vendor/sharer.js')}}" type="text/javascript"></script>
  <!-- sticky -->
  <script src="{{asset('front/js/vendor/sticky.min.js')}}" type="text/javascript"></script>
  <!-- Aos -->
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



</body></html>
<!-- Localized -->
