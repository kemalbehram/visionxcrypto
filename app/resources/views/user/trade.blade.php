@extends('include.userdashboard')

@section('content')

	<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Crypto buy/sell</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Crypto buy/sell</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row-->
						<div class="row row-sm">
							<div class="col-md-12">
								<div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="#" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Bitcoin Prices</a>&nbsp;by {{$basic->sitename}}</div></div>
							<br></div>

							<div class="col-lg-12 col-xl-6  col-md-12">
							<form method="POST"  action="{{ route('buyecoin') }}">
												@csrf
								<div class="card custom-card overflow-hidden crypto-buysell-card">
									<div class="card-body">
										<div class="card-header border-bottom-0 pl-0 pt-0">
											<label class="main-content-label my-auto">Buy Crypto</label>
										</div>
										<div class="d-flex mt-3 mb-3">
											<div class="">
												<p class="tx-16 text-muted mb-2">Our buy rate</p>
												<h3 id="buy">0.00<span class="text-success tx-15 ml-2">NGN</span></h3>
											</div>

										</div>
																	<script>
																	function myFunctionbuy() {

																	var usd = $('#usd').val() ;
																	 var buy = $("#mySelect option:selected").attr('data-buy');
																	 var bname = $("#mySelect option:selected").attr('data-bname');
																	 document.getElementById("buy").innerHTML = "{{$basic->currency_sym}}"+buy;
																	 document.getElementById("bname").innerHTML = "Enter Your "+bname+" Wallet Address";
																	 document.getElementById("bcoin").innerHTML = bname;
																	 document.getElementById("bget").value = usd*buy;

																	 };
																	</script>
										<div class="form-group">
											<div class="input-group">
												<input name="usd" onkeyup="myFunctionbuy()" id="usd" class="form-control input-lg" type="text" placeholder="Amount in USD">
												<div class="input-group-append wd-30p">
													<select name="coin" id="mySelect" onchange="myFunctionbuy()"  class="form-control border-left-0 icons_select2 br-0" data-placeholder="Choose one">
														<optgroup label="Coins">
														<option selected disabled>Select Coin</option>
														@foreach($currency as $gate)
															<option value="{{$gate->id}}" data-buy="{{$gate->buy}}"  data-bname="{{$gate->name}}" data-icon="cf cf-{{$gate->icon}} cryptoicon bg-primary-transparent text-primary">{{$gate->symbol}}</option>
														@endforeach
														</optgroup>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control input-lg" id="bget" type="text" readonly placeholder="Amount you pay">
												<div class="input-group-append wd-30p">
													<select class="form-control border-left-0 icons_select2 br-0" data-placeholder="Choose one">
														<optgroup label="Currency">
															<option value="{{$basic->currency_sym}}" data-icon="{{$basic->currency_sym}}">NGN</option>
														</optgroup>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group fs-14">
										<small id="bname"></small>
											<input class="form-control input-lg" name="wallet" type="text" placeholder="Enter your valid wallet Address">
										</div>
										<div class="form-group fs-14">
											<input class="form-control input-lg" name="rewallet" type="text" placeholder="Enter your wallet Address again">
										</div>
										<p style="color:red">*Ensure your enter the correct <a id="bcoin">wallet</a> address.</p>
										<p style="color:red">*Minimum trade amount accepted is $50.</p>
										<label class="main-content-label mt-4 mb-4">payment method</label>

											<div class="payment-type d-flex">
												<input type="radio" name="payment" id="credit" value="1" checked><label class="credit-label payment-cards four ml-0 col" for="credit"><span class="d-none d-md-block">Naira Wallet</span><img src="{{url('/')}}/assets/assets/img/visa.png" alt="visa"></label>
												</div>
											<button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Buy Now</button>

									</div>
								</div>
								</form>
							</div>
							<div class="col-lg-12 col-xl-6  col-md-12">
							<form method="POST" action="{{ route('sellecoin') }}">
							@csrf
								<div class="card custom-card overflow-hidden crypto-buysell-card">
									<div class="card-body">
										<div class="card-header border-bottom-0 pl-0 pt-0">
											<label class="main-content-label my-auto">Sell Crypto</label>
										</div>
										<div class="d-flex mt-3 mb-3">
											<div class="">
												<p class="tx-16 text-muted mb-2">Our sell rate</p>
												<h3 id="sell">0.00<span class="text-success tx-15 ml-2">NGN</span></h3>
											</div>
										</div>
										<script>
																	function myFunctionsell() {

																	var usd = $('#usds').val() ;
																	 var sell = $("#mySelect2 option:selected").attr('data-sell');
																	 var sname = $("#mySelect2 option:selected").attr('data-sname');
																	 document.getElementById("sell").innerHTML = "{{$basic->currency_sym}}"+sell;
																	 document.getElementById("sget").value = usd*sell;

																	 };
																	</script>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control input-lg" name="usd" onkeyup="myFunctionsell()" id="usds" type="text" placeholder="Amount in USD">
												<div class="input-group-append wd-30p">
													<select name="coin" id="mySelect2" onchange="myFunctionsell()"  class="form-control border-left-0 icons_select2 br-0" data-placeholder="Choose one">
														<optgroup label="Coins">
														<option selected disabled>Select Coin</option>
														@foreach($currency as $gate)
															<option value="{{$gate->id}}" data-sell="{{$gate->sell}}"  data-sname="{{$gate->name}}" data-icon="cf cf-{{$gate->icon}} cryptoicon bg-primary-transparent text-primary">{{$gate->symbol}}</option>
														@endforeach
														</optgroup>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control input-lg" type="text" id="sget" readonly placeholder="Amount you get">
												<div class="input-group-append wd-30p">
													<select class="form-control border-left-0 icons_select2 br-0" data-placeholder="Choose one">
														<optgroup label="Coins">
															<option value="{{$basic->currency_sym}}" data-icon="{{$basic->currency_sym}}">NGN</option>
														</optgroup>
													</select>
												</div>
											</div>
										</div>
										<br>
										<p style="color:red">*Your fund will be credited into your Naira wallet as soon as your transaction as been confirmed.</p>
										<p style="color:red">*Minimum trade amount accepted is $50.</p><br>
										<label class="main-content-label mt-4 mb-4">Credit payment destination</label>
										<a class="payment-form form">
											<div class="payment-type d-flex">
												<input type="radio" name="radio3" id="credit" value="credit" checked><label class="credit-label payment-cards four ml-0 col" for="credit"><span class="d-none d-md-block">Naira Wallet</span><img src="{{url('/')}}/assets/assets/img/visa.png" alt="visa"></label>
												</div>
											<button type="Submit" class="btn btn-primary btn-lg btn-block mt-4">Sell Now</button>
										</a>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- Row End -->

						<!-- Row-->
						<div class="row row-sm">
							<div class="col-xl-12">
								<div class="card custom-card">
									<div class="card-header border-bottom-0">
										<label class="main-content-label my-auto pt-2">Recent Buying & selling Orders</label>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table card-table text-nowrap table-bordered border-top">
												<thead>
													<tr>
														<th>ID</th>
														<th>Type</th>
														<th>Currrency</th>
														<th>Amount (USD)</th>
														<th>Status</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												 @if(count($trade) >0)
											    @foreach($trade as $k=>$data)
													<tr>
														<td>#{{$data->trx}}</td>
														<td class="text-success">@if($data->type == 2)
														<span class="badge badge-success-light badge-pill">Sell</span>
														@elseif($data->type == 1)
														<span class="badge badge-danger-light badge-pill">Buy</span>
														@endif</td>
														<td><i class="cc BTC-alt text-warning"></i> {{isset($data->currency->name) ? $data->currency->name : 'N/A'}}</td>
														<td><i class="cc BTC-alt text-warning"></i> ${{number_format($data->amount, $basic->decimal)}}</td>

														<td>
														@if($data->status == 2)
														<span class="badge badge-success-light badge-pill">Successful</span>
														@elseif($data->status == 1)
														<span class="badge badge-warning-light badge-pill">Pending</span>
														@endif</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td>
													</tr>
														@endforeach
											@else
											<b>No Transaction Log At The Moment</b>
											@endif

												</tbody>
											</table>
										</div>
										{{$trade->links()}}
									</div>
								</div>
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->


@endsection
