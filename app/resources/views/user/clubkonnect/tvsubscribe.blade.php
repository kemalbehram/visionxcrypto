@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Cable TV</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cable TV</li>
								</ol>
							</div>

						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">

							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<form method="post"  class="withdraw-action-form" action="{{route('paydecoder') }}">
										    @csrf
											<div class="form-group mb-0"> <label>Select Bouquet</label>
												<div class="input-group">
																														<script>
													function myFunctioncabletv() {
													 var price = $("#mySelected2 option:selected").attr('data-price');
													 var amount = $("#mySelected2 option:selected").attr('data-amount');
													 var name = $("#mySelected2 option:selected").attr('data-plan');
													 document.getElementById("price").innerHTML = amount;
													 document.getElementById("planname").innerHTML = name;
													 document.getElementById("total").innerHTML = +price + +{{$basic->decoderfee}};
													 document.getElementById("package").value = name;
													 document.getElementById("total").value = +price + +{{$basic->decoderfee}};

													 };
													</script>
												<select name="decoder"  required id="mySelected2" onchange="myFunctioncabletv()" class="form-control select2  custom-select br-md-0">
												<option selected disabled>Select A Plan</option>
												@foreach($plans[$deco][0]['PRODUCT'] as $k=>$data)
												<option data-plan="{{$data['PACKAGE_ID']}}" data-price="{{$data['PACKAGE_AMOUNT']}}"  data-amount="{{$basic->currency_sym}}{{$data['PACKAGE_AMOUNT']}}" >{{$data['PACKAGE_NAME']}}</option>
												@endforeach
												</select>

											</div>

									</div>
								</div>
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">SUBSCRIPTION DETAIL</h5>
										<dl class="dlist-align">
											<dt class="">Decoder</dt>
											<dd class="text-right ml-auto">@if($decoder == "dstv")
																		<img width="50" src="{{url('assets/images/dstv.png')}}" alt="">
																		@elseif($decoder == "gotv")
																		<img width="50" src="{{url('assets/images/gotv.jpg')}}" alt="">
																		@else($decoder == "startimes")
																		<img width="50" src="{{url('assets/images/startime.jpg')}}" alt="">
																		@endif</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Decoder Number:</dt>
											<dd class="text-right text-info  ml-auto" >{{$number}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Customer Name:</dt>
											<dd class="text-right text-info ml-auto" >{{$name}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Bouquet</dt>
											<dd class="text-right ml-auto text-info" id="planname">Please Select A Plan</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Amount:</dt>
											<dd class="text-right text-info ml-auto" id="price">{{$basic->currency_sym}}0.00</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Fee:</dt>
											<dd class="text-right ml-auto text-info">+ {{$basic->currency_sym}}{{$basic->decoderfee}}</dd>
										</dl>
										<hr>
										<dl class="dlist-align">
											<dt>Total:</dt>
											<dd class="text-right  text-success ml-auto"><strong id="total">{{$basic->currency_sym}}0.00</strong></dd>
										</dl>
										<div class="step-footer">
										<input hidden name="decoder" value="{{$decoder}}">
											<input hidden name="number" value="{{$number}}">
											<input  name="package" hidden id="package">
											<input  name="amount" hidden id="total">

											<small>Enter Transaction Password</small>
							        		<input type="tel" name="password" placeholder="****" maxlength="4" required class="form-control">
											<br>
											<button type="submit" class="step-btn btn btn-primary">Make Payment</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->
@stop
