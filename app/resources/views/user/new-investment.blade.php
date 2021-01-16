@extends('include.userdashboard')
@section('content')


			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">New VX Vault</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">New VX Vault</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">


							<div class="col-lg-12 col-xl-12 col-md-12">
							<form id="investnow"  action="{{route('coin-vest')}}" method="post">
							@csrf
							<script type="text/javascript">

													function goDoSomething2(identifier){


													 document.getElementById("ffinalamount").innerHTML = "$"+$(identifier).val() ;
													 document.getElementById("btc").innerHTML = {{$btcrate}}*$(identifier).val();
													 if({{$plan->interest_status}} == 1){
													 document.getElementById("return").innerHTML = {{$plan->interest}}*$(identifier).val();
													 }
													 else{
													 document.getElementById("return").innerHTML = {{$plan->interest}}*$(identifier).val();
														 }

													 total = {{$btcrate}}*$(identifier).val();
													 document.getElementById("totalbtc").innerHTML = total.toFixed(8)+"BTC";
													  }
													 </script>

								<div class="card custom-card">
									<div class="card-body">

											<div class="form-group mb-0"> <label><b>Enter Amount</b></label>
												<div class="input-group"> <input type="number" onkeyup="goDoSomething2(this);" name="amount" class="form-control coupon" placeholder="$0.00"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon"><i class="fa fa-usd"></i></button> </span> </div>
											</div>
											<br>
										    <div class="form-group mb-0"> <label><b>Select Payment Type</b></label>
												<div class="input-group">
												<select class="form-control select "  name="wallet_type">
												@foreach($wallets as $k=>$data)
												<option value="{{$data->id}}"> {{__(str_replace('_',' ',$data->type))}} ${{number_format($data->balance, 2)}}</option>
												@endforeach
												 <option value="1982100101281"> Deposit_Wallet {{__($basic->currency_sym)}}{{number_format(Auth::user()->balance, $basic->decimal)}}</option>
												  <option value="82718271565131"> Scan QR Code</option>
											</select>

												<span class="input-group-append"> <button class="btn btn-primary btn-apply coupon"><i class="fa fa-wallet"></i></button> </span> </div>
											</div>

									</div>
								</div>
								@php
									$time_name = \App\TimeSetting::where('time', $plan->times)->first();
								@endphp
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">INVESTMENT DETAILS</h5>
										<dl class="dlist-align">
											<dt class="">Name</dt>
											<dd class="text-right ml-auto">{{$plan->name}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Minimum:</dt>
											<dd class="text-right text-primary ml-auto">${{number_format($plan->minimum,2)}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Maximum:</dt>
											<dd class="text-right text-primary ml-auto">${{number_format($plan->maximum,2)}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Interest:</dt>
											<dd class="text-right text-success ml-auto">{{$plan->interest}} @if($plan->interest_status == 1) % @else USD @endif</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Payment Cycle:</dt>
											<dd class="text-right text-success ml-auto">{{$time_name->name}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Duration:</dt>
											<dd class="text-right text-success ml-auto">@if($plan->lifetime_status == 0) {{__($plan->repeat_time)}}{{__($time_name->slug)}} @else @lang('Lifetime') @endif</dd>
										</dl>
{{--										<hr>--}}
{{--										<dl class="dlist-align">--}}
{{--											<dt>BTC Invested:</dt>--}}
{{--											<dd class="text-right  ml-auto"><strong id="totalbtc">0.00BTC</strong></dd>--}}
{{--										</dl>--}}
{{--										--}}
{{--										<dl class="dlist-align">--}}
{{--											<dt>Expected Return:</dt>--}}
{{--											<dd class="text-right  ml-auto"><strong id="return">0.00USD</strong></dd>--}}
{{--										</dl>--}}

					        			<input value="{{$plan->id}}" hidden name="plan_id">
										<div class="step-footer">
											<button type="submit" class="step-btn btn btn-primary btn-block">Continue</button>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- End Row -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->

@stop
