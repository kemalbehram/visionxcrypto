 @extends('include.frontend')
@section('content')

		<!-- 
			=============================================
				Theme Inner Banner
			============================================== 
			-->
			<div class="theme-inner-banner">
				<div class="custom-container-one">
					<h2 class="banner-title">Security at {{$basic->sitename}}</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris bibendum diam turpis, aliquet eleifend ex dictum sit amet.</p>
				</div> <!-- /.custom-container-one -->
			</div> <!-- /.theme-inner-banner -->
			
			
			
			
			<!-- 
			=============================================
				Security Section
			============================================== 
			-->
			<div class="security-section">
				<div class="container">
					<div class="main-wrapper">
						<div class="row single-block block-one">
							<div class="col-md-6">
								<div class="text">
									<h2 class="title">Coin storage</h2>
									<p>To ensure that everything is safe we transfer and store your coins in our offline system. Offline storage provides an essential security measure against fraud or loss. </p>
								</div> <!-- /.text -->
							</div> <!-- /.col- -->
							<div class="col-md-6">
								<div class="img-box clearfix">
									<img src="{{asset('front/images/svg/coin-storage.svg')}}" alt="" class="svg-img">
								</div> <!-- /.img-box -->
							</div>
						</div> <!-- /.single-block -->
						<div class="row single-block block-two">
							<div class="col-md-6 order-md-last">
								<div class="text">
									<h2 class="title">2-Step Verification</h2>
									<p>Nunc vitae risus sed eros pulvinar imperdiet. Maecenas sed eros euismod massa pretium fringilla non id arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus.Phasellus sem mauris, consectetur ac tincidunt a, tempus at nisl.</p>
								</div> <!-- /.text -->
							</div> <!-- /.col- -->
							<div class="col-md-6 order-md-first">
								<div class="img-box clearfix">
									<img src="{{asset('front/images/svg/2FA.svg')}}" alt="" class="svg-img">
								</div> <!-- /.img-box -->
							</div>
						</div> <!-- /.single-block -->
						<div class="row single-block block-three">
							<div class="col-md-6">
								<div class="text">
									<h2 class="title">Withdraw PIN</h2>
									<p>Nunc vitae risus sed eros pulvinar imperdiet. Maecenas sed eros euismod massa pretium fringilla non id arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus.Phasellus sem mauris, consectetur ac tincidunt a, tempus at nisl.</p>
								</div> <!-- /.text -->
							</div> <!-- /.col- -->
							<div class="col-md-6">
								<div class="img-box clearfix">
									<img src="{{asset('front/images/svg/withdraw-pin.svg')}}" alt="" class="svg-img">
								</div> <!-- /.img-box -->
							</div>
						</div> <!-- /.single-block -->
						<div class="row single-block">
							<div class="col-md-6 order-md-last">
								<div class="text">
									<h2 class="title">Security procedures</h2>
									<p>Nunc vitae risus sed eros pulvinar imperdiet. Maecenas sed eros euismod massa pretium fringilla non id arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus.Phasellus sem mauris, consectetur ac tincidunt a, tempus at nisl.</p>
								</div> <!-- /.text -->
							</div> <!-- /.col- -->
							<div class="col-md-6 order-md-first">
								<div class="img-box clearfix">
									<img src="{{asset('front/images/svg/security.svg')}}" alt="" class="svg-img">
								</div> <!-- /.img-box -->
							</div>
						</div> <!-- /.single-block -->
						<div class="row single-block">
							<div class="col-md-6">
								<div class="text">
									<h2 class="title">Data protected</h2>
									<p>Nunc vitae risus sed eros pulvinar imperdiet. Maecenas sed eros euismod massa pretium fringilla non id arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus.Phasellus sem mauris, consectetur ac tincidunt a, tempus at nisl.</p>
								</div> <!-- /.text -->
							</div> <!-- /.col- -->
							<div class="col-md-6">
								<div class="img-box clearfix">
									<img src="{{asset('front/images/svg/ssl-security.svg')}}" alt="" class="svg-img">
								</div> <!-- /.img-box -->
							</div>
						</div> <!-- /.single-block -->
					</div> <!-- /.main-wrapper -->
				</div> <!-- /.container -->
			</div> <!-- /.security-section -->
			
			

 

			<!--
			=====================================================
				Get Started Banner
			=====================================================
			-->
			<div class="section-spacing">
				<div class="get-started-banner">
					<div class="container">
						<h2 class="title">Ready to get started?</h2>
						<ul>
							<li><a href="register" class="theme-button grdn-bg">Create account</a></li>
							<li><a href="#" class="apple-icon"><i class="fab fa-apple"></i></a></li>
							<li><a href="#"><i class="fab fa-google-play"></i></a></li>
						</ul>
					</div>
				</div> <!-- /.get-started-banner -->
			</div>

@endsection
