@extends('include.userdashboard')
@section('content')
   
			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Product</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">product</li>
								</ol>
							</div>
							</div>
						<!-- End Page Header -->
						
						
						
						<!-- Row -->
						
						<div class="row row-sm">
						<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/bitcoin.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Digital Assets</h5>
											<p class="mb-1 tx-inverse">btc | eth | pm</p>
										</div>
										<a href="{{route('trade')}}" class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/airtime2.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Airtime</h5>
											<p class="mb-1 tx-inverse">Topup</p>
										</div>
										<a href="#"   data-toggle="modal" data-target="#airtime"  class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/airtime1.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Internet</h5>
											<p class="mb-1 tx-inverse">Subscription</p>
										</div>
										<a href="#"  data-toggle="modal" data-target="#internet"   class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/electric.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Utility</h5>
											<p class="mb-1 tx-inverse">Electricity bill</p>
										</div>
										<a href="#"  data-toggle="modal" data-target="#utility"  class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
						</div>
						<!--End Row -->
						

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/sms.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">SMS</h5>
											<p class="mb-1 tx-inverse">Instant sms</p>
										</div>
										<a href="#"  data-toggle="modal" data-target="#sms"  class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/gift.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Refer & Earn</h5>
											<p class="mb-1 tx-inverse">Instant Reward</p>
										</div>
										<a href="{{route('referral')}}" class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/pigbank.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">VX Vault</h5>
											<p class="mb-1 tx-inverse">Investment Bank</p>
										</div>
										<a href="{{route('coinvest')}}" class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6 col-md-6 col-xl-3">
								<div class="card custom-card">
									<div class="card-body user-card text-center">
										<div class="main-img-user avatar-lg online text-center">
											<img alt="avatar" class="rounded-circle" src="{{url('/')}}/assets/assets/img/pngs/cabletv.png">
										</div>
										<div class="mt-2">
											<h5 class="mb-1">Cable Tv</h5>
											<p class="mb-1 tx-inverse">Tv Subscription</p>
										</div>
										<a href="#"   data-toggle="modal" data-target="#cabletv"   class="btn ripple btn-primary mt-3">Get started</a>
									</div>
								</div>
							</div>
							
							
							</div>
						<!--End Row -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
			
			
			<!-- Airtime modal -->
			<form method="post" class="withdraw-pin-form" action="{{route('loadairtime') }}">
			@csrf
								    			
			<div class="modal" id="airtime">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Airtime Recharge</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body"> 
							<!-- Select2 -->
							<div class="withdraw-address">
							 <small>Please Select Network</small>
														 
							<select name="network" class="form-control select2">
							@foreach($networks as $k=>$data)
							<option value="{{$data->symbol}}"><img width="40"  src="{{url('assets/images')}}/{{$data->image}}" alt=""> {{$data->name}} Network</option>
							@endforeach
							</select>
							
												</div>

												<br>
												<div class="withdraw-address">
							 <small>Please Enter Phone Number</small>						 
													<input name="number" class="form-control" placeholder="0801234567890" ></input>
												</div>

												<br>
												<div class="withdraw-address">
													 <small>Enter Amount</small>
													<input name="amount" class="form-control" placeholder="{{$basic->currency_sym}}0.00" ></input>
												</div>

												<br>
												<div class="withdraw-address">
													 <small>Enter Transaction Pin</small>
													<input  type="tel" placeholder="****" maxlength="4" name="password" class="form-control" ></input>
												</div>

<br>
												 

 
							
							
							<!-- Select2 -->
							 
						</div>
						<div class="modal-footer">
						
							<button class="btn ripple btn-primary" type="submit">Recharge</button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End airtime modal -->
			
			
				
			<!-- internet modal -->
			<form method="post"  action="{{route('loadata') }}">
			@csrf
								    			
			<div class="modal" id="internet">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Internet Data</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body"> 
							<!-- Select2 -->
							<div class="withdraw-address">
							 <small>Please Select Network</small>
							<script>
function myFunction() { 
 var image = $("#mySelect option:selected").attr('data-image'); 
 document.getElementById("image").innerHTML = "<img width='20' src='{{url('assets/images')}}/"+image+"'>"; 
  
 };
</script>														
							<select name="network"  id="mySelect" onchange="myFunction()" class="form-control select2">
							@foreach($networks as $k=>$data)
							<option data-image="{{$data->image}}" value="{{$data->symbol}}" > {{$data->name}} Network</option>
							@endforeach
							</select>
							
												</div>

												<br>
												 <small>Please Enter Phone Number</small>	
												<div class="input-group">
												 
													<input name="number" class="form-control" placeholder="0801234567890" ></input>
													<span class="input-group-append">
														<button class="btn ripple btn-primary" type="button" ><a id="image">Phone</a></button>
													</span>
												</div>

												<br>
							 
						</div>
						<div class="modal-footer">
						
							<button class="btn ripple btn-primary" type="submit">Proceed</button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End internet modal -->
				
			<!-- Utility modal -->
			<form method="post" action="{{route('validatemeter') }}">
			@csrf
								    			
			<div class="modal" id="utility">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						 	<div class="modal-body"> 
							<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<h1 class="mb-3 tx-50 font-weight-semibold">Electricity Bill</h1>
												<p class="tx-18 mb-5 text-white-50">Pay your Prepaid & Postpaid Electricity Bill with instant activation of units</p>
											</div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
												<center><a id="pimage"></a></center>
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex p-4">
																
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																
																<script>
function myFunctionpower() { 
 var image = $("#mySelected option:selected").attr('data-image');  
 document.getElementById("pimage").innerHTML = "<img width='40'  src='{{url('assets/images')}}/"+image+"'>"; 
   
 };
</script>														 
																	<select name="meter" id="mySelected" onchange="myFunctionpower()" class="form-control select2  custom-select br-md-0">
																		@foreach($power as $k=>$data)
																		<option data-image="{{$data->image}}" value="{{$data->billercode}}" >{{$data->name}} ({{$data->type}})</option>
																		@endforeach
																	</select>
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 my-3 text-left">
																	<i class=" pe-7s-light exchange-icon tx-30 text-white inline-block"></i>
																</div>
																 
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																	<input type="number"  name="meternumber"  class="form-control mb-4 mb-lg-0" id="text6" placeholder="Meter Number">
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<button type="submit" class="btn btn-warning pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">Proceed</button>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>
 
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End Utility modal -->
			
			<!-- cabletv modal -->
			<form method="post" action="{{route('validatedecoder') }}">
			@csrf
								    			
			<div class="modal" id="cabletv">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						 	<div class="modal-body"> 
							<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<h1 class="mb-3 tx-50 font-weight-semibold">Cable TV</h1>
												<p class="tx-18 mb-5 text-white-50">Pay your cable TV subcription fee with instant activation</p>
											</div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
												<center><a id="pimage"></a></center>
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex p-4">
																
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																
															 													 
																	<select name="decoder"  class="form-control select2  custom-select br-md-0">
																		 
																		<option   value="dstv" >DSTV</option>
																		<option  value="gotv" >GOTV</option>
																		<option  value="startimes" >Startimes</option>
																		  
																	</select>
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 my-3 text-left">
																	<i class=" pe-7s-light exchange-icon tx-30 text-white inline-block"></i>
																</div>
																 
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																	<input type="number"  name="number"  class="form-control mb-4 mb-lg-0" id="text6" placeholder="Decoder/IUC Number">
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<button type="submit" class="btn btn-warning pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">Proceed</button>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>
 
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End cabletv modal -->
			
					
			<!-- SMS modal -->
			<form  action="{{route('sendsmsnow')}}" method="post">
			{{ csrf_field() }}
								    			
			<div class="modal" id="sms">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						 	<div class="modal-body"> 
							<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<h1 class="mb-3 tx-50 font-weight-semibold">Instant SMS</h1>
												<p class="tx-18 mb-5 text-white-50">Send SMS to any number all around the world</p>
											</div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
												<center><a id="pimage"></a></center>
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex p-4">
																
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																
																	<input name="phone" type="number" placeholder="080********"  class="form-control mb-4 mb-lg-0" id="text6">
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 my-3 text-left">
																	<i class=" pe-7s-mail exchange-icon tx-30 text-white inline-block"></i>
																</div>
																 
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																	<textarea  name="message" type="text"  class="form-control mb-4 mb-lg-0" id="text6" placeholder="Enter Message Body"></textarea>
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<button type="submit" class="btn btn-warning pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">Send</button>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>
 
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End SMS modal -->

@stop
