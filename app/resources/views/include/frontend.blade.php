<!DOCTYPE html>
<html lang="en">
	 
<head>
		<meta charset="UTF-8">
		<!-- For IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- For Resposive Device -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- For Window Tab Color -->
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#1b1b1b">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#1b1b1b">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#1b1b1b">
		<title>{{isset($page_title) ? $page_title : ''}} | {{$basic->sitename}}</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" sizes="56x56" href="{{asset('assets/images/logo/favicon.png')}}">
		<link href="{{asset('front-assets/css/jquery.growl.css')}}" rel="stylesheet" />
		<!-- Main style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/style.css')}}">
		<!-- responsive style sheet -->
		<link rel="stylesheet" type="text/css" href="{{asset('front/css/responsive.css')}}">

		<!-- Fix Internet Explorer ______________________________________-->
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="vendor/html5shiv.js"></script>
			<script src="vendor/respond.js"></script>
		<![endif]-->	
	</head>

	<body>
		<div class="main-page-wrapper">


			<!-- 
			=============================================
				Cryonik Header
			============================================== 
			-->
			<div class="Cryonik-header ">
				<div class="container">
					<div class="main-header-wrapper clearfix ">
						<div class="logo"><a  href="{{url('/')}}"><img width="50"  src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>

						<!-- ================= Theme Menu Wrapper =================== -->
						<div class="navbar navbar-expand-lg bsnav bsnav-sticky-slide float-right">
					    	<button class="navbar-toggler toggler-spring"><span class="navbar-toggler-icon"></span></button>
					    	<div class="collapse navbar-collapse">
					    		<ul class="navbar-nav navbar-mobile mr-0">
					    			<li class="nav-item"><a class="nav-link" href="about-us">About Us</a></li>
					    			<li class="nav-item"><a class="nav-link" href="how-it-work">How it works</a></li>
					    			<li class="nav-item"><a class="nav-link" href="rates">Rates</a></li> 
					    			<li class="nav-item"><a class="nav-link" href="privacy">Privacy</a></li> 
					    			<li class="nav-item"><a class="nav-link" href="security">Security</a></li> 
					    			<li class="nav-item"><a class="nav-link" href="contact-us">Contact</a></li>
									@if(Auth::user())
										<li class="header-widget">
					    				<ul class="clearfix">
					    					<li class="login-button"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
											 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
					    					<li class="invest"><a href="{{route('home')}}" class="grdn-bg">Account</a></li>
					    					 
					    				</ul>
					    			</li> <!-- /.header-widget -->
									@else
					    			<li class="header-widget">
					    				<ul class="clearfix">
					    					<li class="login-button"><a href="login">Log in</a></li>
											 @if($basic->registration > 0)
					    					<li class="invest"><a href="register" class="grdn-bg">Register</a></li>
										@endif
					    					 
					    				</ul>
					    			</li> <!-- /.header-widget -->
									@endif
					    		</ul> <!-- /.navbar-nav -->
					    	</div> <!-- /.navbar-collapse -->
					    </div> <!-- /.bsnav -->
					    <div id="login-md"><a href="login">Log in</a></div>
					</div> <!-- /.main-header-wrapper -->
					<div class="bsnav-mobile">
				      <div class="bsnav-mobile-overlay"></div>
				      <div class="navbar"></div>
				    </div>
				</div> <!-- /.containe -->
			</div> <!-- /.Cryonik-header -->
			
@yield('content')
	<!--
			=====================================================
				Footer
			=====================================================
			-->
			<div class="Cryonik-footer">
				<div class="container">
					<div class="row top-footer">
						<div class="col-lg-3 col-md-6 footer-help-widget">
							<div class="select-box">
								<select class="theme-dropdown" tabindex="1">
							           <option value="English">English</option>
							           <option value="Русский">Русский</option>
							           <option value="Français">Français</option>
							           <option value="Español">Español</option>
							           <option value="Deutsch">Deutsch</option>
							           <option value="Português">Português</option>
						   		</select>
							</div>
					   		<a href="#" class="call">{{$basic->phone}}</a>
					   		<a href="#" class="help">{{$basic->email}}</a>
						</div>

						<div class="col-lg-3 col-md-6 footer-list">
							<h5 class="footer-title">Learn more</h5>
							<ul>
								<li><a href="about-us">About Us</a></li>  
								<li><a href="#">Loss Protection</a></li>
								<li><a href="security">Security</a></li> 
							</ul>
						</div> <!-- /.footer-list -->

						<div class="col-lg-3 col-md-6 footer-list">
							<h5 class="footer-title">Information</h5>
							<ul> 
								<li><a href="about-us">About</a></li>
								<li><a href="contact-us">Contacts</a></li> 
								<li><a href="pricacy">Privacy policy</a></li>
							</ul>
						</div> <!-- /.footer-list -->

						<div class="col-lg-2 col-md-4 footer-list">
							<h5 class="footer-title">Follow us</h5>
							<ul> 
								<li><a href="{{$basic->facebook}}">Facebook</a></li>
								<li><a href="{{$basic->instagram}}">Instagram</a></li>
								<li><a href="{{$basic->twitter}}">Twitter</a></li>
								<li><a href="{{$basic->google}}">Youtube</a></li> 
							</ul>
						</div> <!-- /.footer-list -->

						<div class="col-lg-1 col-md-2 footer-download">
							<ul class="clearfix">
								<li><a href="#"><i class="fab fa-apple"></i></a></li>
								<li><a href="#"><i class="fab fa-google-play"></i></a></li>
							</ul>
						</div> <!-- /.footer-download -->
					</div> <!-- /.row -->

					<div class="bottom-footer">
						<div class="row">
							<div class="col-lg-8 col-12">
								<p>Copyright {{date('Y')}} {{$basic->sitename}}.</p>
							</div>
							<div class="col-lg-4 col-12">
								<ul class="clearfix">
									<li><a href="#">Affiliates</a></li>
									<li><a href="#">Privacy Policy</a></li> 
								</ul>
							</div>
						</div>
					</div>
				</div> <!-- /.container -->
			</div> <!-- /.Cryonik-footer -->
			
			


		<!-- Optional JavaScript _____________________________  -->

    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<!-- jQuery -->
		<script src="{{asset('front/vendor/jquery.2.2.3.min.js')}}"></script>
		<!-- Popper js -->
		<script src="{{asset('front/vendor/popper.js/popper.min.js')}}"></script>
		<!-- Bootstrap JS -->
		<script src="{{asset('front/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	    <!-- menu  -->
		<script src="{{asset('front/vendor/bsnav-master/bsnav.min.js')}}"></script>
		<!-- Dropdown Selector  -->
		<script src="{{asset('front/vendor/chosen/chosen.jquery.min.js')}}"></script>
		<!-- Font-awesome -->
		<script src="{{asset('front/fonts/fontawesome/js/all.min.js')}}"></script>
		<!-- Range Slider -->
		<script src="{{asset('front/vendor/ion.rangeSlider/ion.rangeSlider.js')}}"></script>
		<!-- WOW js -->
		<script src="{{asset('front/vendor/WOW-master/dist/wow.min.js')}}"></script>
		<!-- owl.carousel -->
		<script src="{{asset('front/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
		<!-- js count to -->
		<script src="{{asset('front/vendor/jquery.appear.j')}}"></script>
		<script src="{{asset('front/vendor/jquery.countTo.js')}}"></script>
		<!-- Fancybox -->
		<script src="{{asset('front/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>

		<!-- Theme js -->
		<script src="{{asset('front/js/theme.js')}}"></script>
		</div> <!-- /.main-page-wrapper -->
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
