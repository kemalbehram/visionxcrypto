@extends('include.userdashboard')
@section('content')
   <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Wallet</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Wallet</li>
								</ol>
							</div>
							
						</div>
						<!-- End Page Header -->

						<!-- row -->
						
						<div class="row row-sm">
						<div class="col-xl-6 col-lg-12 col-md-12">
						
							<form method="post" action="{{route('update.transfer') }}">
										@csrf
										<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">TRANSFER TO WALLET</label>
												<br>
												<span class="text-muted">User-2-User</span>
												<br>
												<div class="d-flex mt-4">
													<img src="{{asset('assets/images/naira.jpeg')}}" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">Available Fund</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{number_format(Auth::user()->balance, $basic->decimal)}}</h4><span class="mt-auto ml-2">{{$basic->currency}}</span></div>
													</div>
													<img src="{{url('/')}}/assets/assets/img/pngs/qrcode.png" class="wd-50 ht-50  my-auto ml-auto float-right" alt="">
												</div>
												<div class="input-group my-4">
													<span class="input-group-addon-left bg-light"><i class="fe fe-user"></i></span>
													<input type="text" required class="form-control input-lg" name="username"  placeholder="Enter Username">
												 </div>
												<div class="input-group my-4">
													<span class="input-group-addon-left bg-light">{{$basic->currency_sym}}</span>
													<input type="number" required class="form-control input-lg" type="number" name="amount"  placeholder="{{$basic->currency_sym}} 1000">
												 </div>
												 
												<div class="row mt-4">
													<div class="col-6">
														<button type="submit" class="btn btn-block btn-primary">Transfer</button>
													</div>
													<div class="col-6">
														<a href="{{route('transfer')}}" class="btn btn-block btn-outline-primary">Transfer Log</a>
													</div>
												</div>
											</div>
										</div>
										</form>
									</div><!-- End col -->
									<div class="col-xl-6 col-lg-12 col-md-12">
									<form  action="{{route('bank.validate')}}" method="post">
										{{ csrf_field() }}
										<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">Bank Transfer</label>
												<br>
												<span class="text-muted">Wallet To Bank</span>
												<br>
												<div class="d-flex mt-4">
													<img src="{{asset('assets/images/naira.jpeg')}}" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">Available Fund</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{number_format(Auth::user()->balance, $basic->decimal)}}</h4><span class="mt-auto ml-2">{{$basic->currency}}</span></div>
													</div>
												</div>
												<div class="input-group my-4">
													<span class="input-group-addon-left bg-light">{{$basic->currency_sym}}</span>
													<input name="amount"  required type="text" placeholder="{{$basic->currency_sym}} 0.00" class="form-control input-lg">
												</div>
												
												<div class="input-group my-4">
													<span class="input-group-addon-left bg-light"><i class="fa fa-bank"></i></span>
													<select name="bank" id='mySelect' required onchange='myFunction()' class="form-control input-lg select">
												 <option disabled selected >Select Bank Name</option>
												 @if(Auth::user()->bankyes == 1)
												 <option data-name="{{Auth::user()->bank}}" value="{{Auth::user()->bankcode}}">{{Auth::user()->bank}}(Account #: {{Auth::user()->accountno}})</option> 
												 @endif
												 <option value="others">Other Bank</option>
											 
												</select>
												</div>
												
											<input id="bank" hidden name="bankname">
												 
												<div class="row mt-4">
													<div class="col-6">
														<button type="submit" class="btn btn-block btn-primary">Proceed</button>
													</div>
													<div class="col-6">
														<a href="{{route('banktransfer')}}" class="btn btn-block btn-outline-primary">Transfer Log</a>
													</div>
												</div>
											</div>
										</div>
										</form>
									</div><!-- End col -->
						
						
						
						
						
						<!--
							<div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12">
							
							<form method="post" action="{{route('update.transfer') }}">
										@csrf
								<div class="card custom-card">
									<div class="card-body">
										<label class="main-content-label mb-0">Transfer to Wallet</label>
										<div class="row mt-3 crypto-wallet">
											<div class="col-md-10">
												<p>Wallet ID</p>
												<div class="input-group">
													<input type="text" class="form-control input-lg" id="wallet-address" name="username"  placeholder="Please Enter Username">
													<div class="input-group-prepend">
														<button class="btn btn-primary clipboard-icon clipboard-box" data-clipboard-target="#wallet-address">COPY</button>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<img src="{{url('/')}}/assets/assets/img/pngs/qrcode.png" alt="qrcode" class="ht-100 float-right">
											</div>
										</div>
										
										
										<div class="row mt-3 crypto-wallet">
											<div class="col-md-10">
												<p>Amount</p>
												<div class="input-group">
													<input type="number" class="form-control input-lg" id="wallet-address" type="number" name="amount"  placeholder="₦ 1000">
												</div>
											</div>
										</div>
										
										
									</div>
									
									
									
									
										
										</div><br>
								</div>
								</form>
								-->
								<!-- row -->
								<div class="row row-sm">
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">Naira  Wallet</label>
												<br>
												<br>
												<div class="d-flex mt-4">
													<img src="{{url('/')}}/assets/assets/img/pngs/naira.png" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">Available NGN</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{number_format(Auth::user()->balance, $basic->decimal)}}</h4><span class="mt-auto ml-2">{{$basic->currency}}</span></div>
													</div>
												</div><br><br><br><br>
												<div class="row">
													<div class="col-md-6">
														<p class="text-uppercase tx-13 text-muted mb-1">Total Received</p>
														<div class="d-flex my-auto">
															<span class="crypto-icon bg-primary-transparent mr-3">
																<i class="fa fa-bank text-primary"></i>
															</span>
															<h5 class="my-auto">{{number_format($tdep, $basic->decimal)}}</h5>
															<span class="my-auto ml-2">{{$basic->currency}}</span>
														</div>
													</div>
													<div class="col-md-6 mt-3 mt-md-0">
														<p class="text-uppercase tx-13 text-muted mb-1">Pending Deposit</p>
														<div class="d-flex my-auto">
															<span class="crypto-icon bg-warning-transparent mr-3">
																<i class="fe fe-loader text-warning"></i>
															</span>
															<h5 class="my-auto">{{number_format($pdep, $basic->decimal)}}</h5>
															<span class="my-auto ml-2">{{$basic->currency}}</span>
														</div>
													</div>
												</div>
												<div class="row mt-4">
													<div class="col-6">
														<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#deposit-modal">Deposit</button>
													</div>
													<div class="col-6">
													<a href="{{route('user.depositLog')}}"><button class="btn btn-block btn-outline-primary">Deposit Log</button></a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- End col -->
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">Investment  Wallet</label>
												<br>
												<br>
												<div class="d-flex mt-4">
													<img src="{{url('/')}}/assets/assets/img/pngs/dollar.png" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">Available USD</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{number_format($investment->balance, $basic->decimal)}}</h4><span class="mt-auto ml-2">USD</span></div>
													</div>
												</div><br><br><br><br>
												<div class="row">
													<div class="col-md-6">
														<p class="text-uppercase tx-13 text-muted mb-1">Running Investment</p>
														<div class="d-flex my-auto">
															<span class="crypto-icon bg-primary-transparent mr-3">
																<i class="fa fa-spinner spinner text-primary"></i>
															</span>
															<h5 class="my-auto">{{$activeinv}}</h5> 
														</div>
													</div>
													<div class="col-md-6 mt-3 mt-md-0">
														<p class="text-uppercase tx-13 text-muted mb-1">Closed Investment</p>
														<div class="d-flex my-auto">
															<span class="crypto-icon bg-success-transparent mr-3">
																<i class="fe fe-pie-chart text-success"></i>
															</span>
															<h5 class="my-auto">{{$endinv}}</h5> 
														</div>
													</div>
												</div>
												<div class="row mt-4">
													<div class="col-6">
														 <a href="{{route('coinvest')}}"><button class="btn btn-block btn-primary">My Investment</button></a>
													</div>
													<div class="col-6">
														<a href="{{route('withdrawinvest')}}" class="btn btn-block btn-outline-primary">Withdraw</a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- End col -->
									
									
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">Referal  Wallet</label>
												<br>
												<br>
												<div class="d-flex mt-4">
													<img src="{{url('/')}}/assets/assets/img/pngs/naira.png" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">Available NGN</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{number_format(Auth::user()->bonus, $basic->decimal)}}</h4><span class="mt-auto ml-2">{{$basic->currency}}</span></div>
													</div>
												</div><br>
												<form method="post" action="{{route('update.convert') }}">
												@csrf
												<div class="input-group my-4">
													<span class="input-group-addon-left bg-light"><i class="si si-present"></i></span>
													<input type="text" class="form-control input-lg" name="amount" id="referal-wallet">
												</div>
												
												<div class="row">
													<div class="col-md-12 mt-3 mt-md-0">
														<p class="text-uppercase tx-13 text-primary mb-1">You can convert the available Bonus in your bonus wallet into spendable cash. Please enter the amount of bonus to convert and click on the convert button to proceed</p>
														 
													</div>
												</div>
												<div class="row mt-4">
													<div class="col-6">
														<button type="submit" class="btn btn-block btn-outline-primary">Convert</button>
													</div>
												</div>
												</form>
											</div>
										</div>
									</div><!-- End col -->
									
									
								</div>
								<!-- Row End -->
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->



<!-- Deposit  Modal -->
<form method="post" action="{{route('deposit.data-insert')}}">
											@csrf
			<div class="modal" id="deposit-modal">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Deposit Fund</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<h6>Select Payment Gateway</h6>
							<!-- Select2 -->
							<select   name="gateway" class="form-control ">
								<option label="Choose one">
								</option>
								<option value="bank" >
								Bank Deposit
								</option>
						    
							</select>
							<br>
							<h6>Enter Amount</h6>
							<!-- Select2 -->
							<input placeholder="0.00" id="amount" onkeyup="myAmount2()"  type="number" name="amount"  class="form-control">
						        						
							<!-- Select2 -->
						 </div>
						<div class="modal-footer">
							<button type="submit" class="btn ripple btn-primary" type="button">Proceed With Deposit</button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End Select2 modal -->


 
			@endsection
