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
    content="Welcome to {{$basic->sitename}}, Easy and convenient way to buy and sell cryptocurrency" />
  <meta name="keywords"
    content="Crypto, Currency, Bitcoin-Delta, Ethereum, Bitcoin, Mobile, App, Printing, Charity" />
  <meta name="author" content="Vison-X Crypto Services" />

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

<body>
  <div id="wrapper">
    <div id="content">
      <section class="section_account">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="fixed_side_data">
                <div class="head_nav">
                  <a href="{{url('/')}}" class="btn btn_logo">
                    <img class="logo" src="{{asset('front/img/logo1.png')}}" alt="logo" style="width:127px;height:25;" />
                  </a>
                  <h3 class="title_nav">The Future is<br />Now.</h3>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-5 mx-auto">
              <div class="have_account">
                Already a member?
                 <a href="{{url('/login')}}"><button type="button" class="btn" >
                  Sign in
                </button></a>
              </div>

              <div class="box--signup">
                <div class="title">
                  Sign up to Visionxcrypto.
                </div>
                

                
                <form  method="POST" action="{{ route('register') }}" class="sign-up-form" autocomplete="off">
					@csrf
                <div class="form-row">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>First name</label>
                          <input type="text" name="fname" value="{{ old('fname') }}" class="form-control" placeholder="First Name" />
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Last name</label>
                          <input type="text" name="lname" value="{{ old('lname') }}" class="form-control" placeholder="Last Name" />
                        </div>
                      </div>
                      @if(isset($reference))
						<input type="text" hidden readonly name="referBy" value="{{$reference}}"  >
						@endif
                      <div class="col-6">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username" />
                        </div>
                                        
                        
                        
                         @if ($errors->has('username'))
                        <a class="text-danger"> {{ $errors->first('username') }}</a>
                        
                        @endif
                      </div>
                      <div class="col-6">
                        <div class="form-group">
                          <label>Email address</label>
                          <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email Address" />
                        </div>
                        
                         @if ($errors->has('email'))
                       <a class="text-danger">  {{ $errors->first('email') }}</a>
                        @endif
                        

                      </div>
					  <div class="col-md-12">
                        <div class="form-group">
                          <label>Phone Number</label>
                          <input type="tel"  name="phone"  required  value="{{ old('phone') }}"  class="form-control" placeholder="Email Address" />
                        </div>
                        
                         @if ($errors->has('phone'))
                       <a class="text-danger"> {{ $errors->first('phone') }}</a>
                        
                        @endif
                      </div>
                      <div class="col-6">
                        <div class="form-group --password" id="show_hide_password">
                          <label>Password</label>
                          <div class="input-group">
                            <input required  type="password" name="password"  class="form-control" data-toggle="password"
                              placeholder="+6 Characters" required="" />
                            <div class="input-group-prepend hide_show">
                              <a href="#"><span class="input-group-text tio hidden_outlined"></span></a>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                       <div class="col-6">
                        <div class="form-group --password" >
                          <label>Confirm Password</label>
                          <div class="input-group">
                            <input required  type="password" name="password_confirmation"  class="form-control"
                              placeholder="+6 Characters" required="" />
                            
                          </div>
                        </div>
                      </div> 
                      <div class="col-12 terms">
                        <p>
                          By clicking on the Sign Up button, you agree to
                          Visionxcrypto.
                          <a href="privacy-policy">terms and conditions.</a>
                        </p>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn mt-3 rounded-6 btn_md_primary c-white effect-letter bg-blue">
                          Create account</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- [id] content -->

    <!-- Back to top with progress indicator-->
    <div class="prgoress_indicator">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>

    <!-- Login Modal  -->
    <div class="modal mdllaccount fade" id="mdllLogin"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
  <!-- End. Wrapper -->

  
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
