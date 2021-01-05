@extends('include.userdashboard')
@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Withdraw</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Withdraw</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row">
							<div class="col-xl-12">
							
														<form method="post" class="withdraw-pin-form" action="{{route('withdraw.depo') }}">
															@csrf
								<div class="card custom-card">
									<div class="card-header bg-transparent border-bottom-0">
										<div>
											<label class="main-content-label mb-2">Withdraw Investment</label> <span class="d-block tx-12 mb-0 text-muted">You can choose to make withdrawal from your investment wallet at any time</span>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-8 mx-auto">
												<div class="checkout-steps wrapper">
													<div id="checkoutsteps">
														<!-- SECTION 1 -->
														<h4>Amount</h4>
														<section> 
																<h5 class="text-left mb-2">Enter Amount </h5>
																<p class="mb-4 text-muted tx-13 ml-0 text-left">Please enter an amount to withdrawa from your investment wallet. Please note you cant withdrawa above yur currenct earning of {{$basic->currency_sym}}{{number_format($investment->balance, $basic->decimal)}}
																
															 </p>
																<div class="form-group text-left">
																	<label>Current Earning</label>
																	<input class="form-control" readonly value="{{$basic->currency_sym}}{{number_format($investment->balance, $basic->decimal)}}" type="text">
																</div>
																 <script type="text/javascript">
																function myAmount() {
																 var amount = $('#mySelect').val() ; 

																  document.getElementById("amounted").value =  amount; 
																  document.getElementById("amounto").innerHTML =  "$"+amount; 
																 };
																</script>
																
															<div class="form-group text-left">
																	<label>Enter Amount</label>
																	<input class="form-control" id="mySelect" onkeyup="myAmount()" placeholder="{{$basic->currency_sym}}{{number_format(0, $basic->decimal)}}" type="number">
															</div>
																
															 
														</section> <!-- SECTION 2 -->
														<h4>Wallet</h4>
														<section>
																									
														<script>
														function myFunctioned() { 
														 var walleted = $("#mySelect option:selected").attr('data-name');  
														 var id = $("#mySelect option:selected").attr('data-id');  
														   
														 document.getElementById("walletname").innerHTML = walleted; 
														 document.getElementById("walletid").value = id; 
														 };
														</script>
															<a class="needs-validation" novalidate=""> 
																<p class="mb-4 text-muted tx-13 ml-0 text-left">Please select your convenient investment payment method to receive your payment</p>
																<div class="row">
																	<div class="col-md-12 mb-3">
																		<label for="firstName">Select Investment Wallet</label>
																		<select   id="mySelect" onchange="myFunctioned()"   class="form-control" tabindex="1">
							 
								    <option data-name="Investment Wallet" data-id="2"  >Investment Earning Wallet</option>
								 
								    
						    	</select>
																		<div class="invalid-feedback">Valid first name is required.</div>
																	</div>
																	 
																</div> 
															</a>
														</section> <!-- SECTION 3 -->
														
														<h4>Payments</h4>
														<section>
														<script type="text/javascript">

													function goDoSomething(identifier){

													 document.getElementById("gateway").value = $(identifier).data('id');
													 var bank = $(identifier).data('id');
													  document.getElementById("time").innerHTML = $(identifier).data('time') + " Day(s)";
													  document.getElementById("charge").innerHTML = "{{$basic->currency_sym}}" + $(identifier).data('fix') + " Flat Rate and " + $(identifier).data('perc') + "% of amount requested";
																										  
													  
													 };
												 
													 </script>
															<div class="">
																<h5 class="text-left mb-2">Payments</h5>
																<p class="mb-4 text-muted tx-13 ml-0 text-left">Please select a means of paying you your investment earning</p>
															</div>
															<div class="card-pay">
																<ul class="tabs-menu nav">
																@foreach($withdrawgate as $gate)
																	<li class="" onclick="goDoSomething(this);" 
 																data-perc="{{$gate->percent}}"   data-fix="{{$gate->fix}}"   data-time="{{$gate->duration}}"  data-id="{{$gate->id}}"><a href="#tab{{$gate->id}}"   data-toggle="tab">@if($gate->id == 1) <i class="fa fa-usd"></i>@elseif($gate->id == 2) <i class="fab fa-paypal"></i>@elseif($gate->id == 3) <i class="fa fa-university"></i>@endif {{$gate->name}}</a></li>
																@endforeach
																<!--
																	<li><a href="#tab21" data-toggle="tab" class=""><i class="fab fa-paypal"></i>  Paypal</a></li>
																	<li><a href="#tab22" data-toggle="tab" class=""><i class="fa fa-university"></i>  Transfer</a></li>
																-->
																</ul>
																<div class="tab-content">
																	<div class="tab-pane active show" id="tab1">
																	<br>
																		 <div class="form-group">
																			<label class="form-label">Please Enter Your Bitcoin Wallet Address</label>
																			<input type="text" class="form-control"  name='walletaddress' placeholder="BTC Wallet Address">
																		</div>
																		  
																	</div>
																	<div class="tab-pane" id="tab2">
																	<br>
																		 <div class="form-group">
																			<label class="form-label">Please Enter Your Paypal Username</label>
																			<input type="text" class="form-control" name="paypaladdress" placeholder="Paypal Username">
																		</div>	
																	</div>
																	<div class="tab-pane" id="tab3">
																		<p class="mt-4">Bank account details</p>
																		<dl class="card-text">
																		  <dt>BANK: </dt>
																		  <dd>@if(Auth::user()->bankyes < 1) Not Set Yet @else {{Auth::user()->bank}} @endif </dd>
																		</dl>
																		<dl class="card-text">
																		  <dt>Account number: </dt>
																		  <dd>@if(Auth::user()->bankyes < 1) Not Set Yet @else  {{Auth::user()->accountno}} @endif </dd>
																		</dl>
																		<dl class="card-text">
																		  <dt>Account Name: </dt>
																		  <dd>@if(Auth::user()->bankyes < 1) Not Set Yet @else {{Auth::user()->accountname}} @endif </dd>
																		</dl>
																		<p class="mb-0"><strong>Note:</strong>  </p>To change this b ank account details, please go to your oeifuke settings page or contact the administrator for support
																	</div>
																</div>
															</div>
														</section>
														<h4>Preview</h4>
														<section>
															<h5 class="text-left mb-2">Your Request</h5>
															<p class="mb-4 text-muted tx-13 ml-0 text-left">Please preview your withdrawal request before proceeding</p>
															<div class="product">
																 
																<div class="item">
																	<div class="left"> <a href="#" class="thumb"> <img src="{{url('assets/images/help.png')}}" alt=""> </a>
																		<div class="purchase">
																			<h6> <a href="#">Withdrawal Charge</a> </h6> 
																		</div>
																	</div> <span class="price" id="charge">0.00</span>
																</div>
																<div class="item">
																	<div class="left"> <a href="#" class="thumb"> <img src="{{url('assets/images/help.png')}}" alt=""> </a>
																		<div class="purchase">
																			<h6> <a href="#">Processing Time</a> </h6>  
																		</div>
																	</div> <span class="price" id="time">0.00</span>
																</div>
															</div>
															<div class="checkout">
																<div class="subtotal"> <span class="heading">Subtotal</span> <span class="total tx-20 font-weight-bold" id="amounto">$0.00</span> </div>
															</div>
															
															
							        		
							        		
							        		  <input name="method_id" hidden id="gateway"> 
											  <input name="amount" hidden id="amounted"> 
											  <br>
											   <h6 class="title font-fix">Enter your withdraw PIN</h6>
											  <input name="pin" type="password" placeholder="****" maxlength="4" class="form-control font-fix">
											  <hr>
											  <input id="walletid" hidden name="wallet">
											   
										<button type="subnit" class="btn btn-block btn-primary">Withdraw</button>
							        	
														</section>
														
											<!-- SECTION 4 -->
														 
													</div>
												</div>
										   </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->
						</form>
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
@stop
