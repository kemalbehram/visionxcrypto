@extends('include.userdashboard')
@section('content')
  

			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">VX Vault</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">VX Vault</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- row -->
								<div class="row row-sm">
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Coin Lock</label>
													<span class="d-block tx-12 mb-0 text-muted">Secure your Digital coins on the coin lock platform 
													and have your assets saved for  your future  purposes.</span>
												</div><br>
												
												
												<a href="#scrollmodal" class="btn ripple btn-primary mt-3" data-effect="effect-just-me" data-toggle="modal">Get Started</a>
												
											</div>
											<div class="  ">
												<img src="{{url('/')}}/assets/assets/img/pngs/bankvault2.png" alt="image" class="  ">
											</div>
										</div>
									</div>
								</div>
							</div><!-- End col -->
									
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Investment</label>
													<span class="d-block tx-12 mb-0 text-muted">Grow your assets and portfolios with  our investment  platform and let your
													digital assets  put you on a payroll.</span>
												</div><br>
												
												<a href="{{route('coinvest')}}" class="btn ripple btn-primary mt-3">Get Started</a>
											</div>
											<div class="  ">
												<img src="{{url('/')}}/assets/assets/img/pngs/coininvest.png" alt="image" class="  ">
											</div>
										</div>
									</div>
								</div>
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			<!-- Scroll with content modal -->
			<div class="modal" id="scrollmodal">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Important Notice</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<p>Maximum coin lock withdrawal duration is 1 one month.</p><br>
							<p>Minimum of $100 usd is accepted on coin lock.</p><br>
							<p>Coins can be locked three (3) time in a month.</p><br>
							<p>You must complete your verification process to level 2 and above before you can lock your coin.</p><br>
							<p>Vision-X Crypto will not be liable to any loss arising from rise or fall in the market value of bitcoin at the time you are withdrawing your fund.</p><br>
							<p>Vision-X Crypto will not be liable to any loss arising from sending bitcoin to any wallet address other than the one given on this website.</p><br>
							<h6>*DATA SECURITY*</h6><br>
							<p>Vision-X has implemented safeguards designed to protect your Personal Data, including measures designed to prevent Personal Data against loss, misuse, and unauthorized access and disclosure.</p><br>
							<p>However, we cannot guarantee that loss, misuse, unauthorized acquisition, or alteration of your data will not occur. Please recognize that you play a vital role in protecting your own personal information. When registering with our Services, it is important to choose a password of sufficient length and complexity, to not reveal this password to any third-parties,
							and to immediately notify us if you become aware of any unauthorized access to or use of your account.</p><br>
							<p>Furthermore, we cannot ensure or warrant the security or confidentiality of information you transmit to us or receive from us by Internet or wireless connection, including email, phone, or SMS, since we have no way of protecting that information once it leaves and until it reaches us. If you have reason to believe that your data is no longer secure, please contact us using the contact information provided in this Privacy Policy.<a href="mailto:support@visionxcrypto.com">support@visionxcrypto.com</a></p>
						</div>
						<div class="modal-footer">
						
						<form action="{{ route('vxlockproceed') }}" method="post" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions'); return false; }">
                        {{ csrf_field() }}
                        <input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the Terms and Conditions
                        <button class="btn ripple btn-primary pd-x-30" type="submit" value="5">Continue</button>
                        </form>
						</div>
					</div>
				</div>
			</div>
			<!--End Scroll with content modal -->
@stop
