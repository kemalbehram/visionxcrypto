@extends('include.userdashboard')
@section('content')
 <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Pay Bill</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Pay Bill</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							 <div class="col-lg-12 col-xl-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<form method="post"  class="withdraw-action-form" action="{{route('paypower') }}">
										    @csrf
										 <script type="text/javascript">
													function myAmount() {
													 var amount2 = $('#myPhone').val() ; 
													 var amount = +amount2 + +{{$basic->electricityfee}} ; 
 
													  document.getElementById("amount2").innerHTML =  "{{$basic->currency_sym}}"+amount; 
													  document.getElementById("pay").value =  amount2; 
													   
													 };
													</script>

											<div class="form-group mb-0"> <label>Enter Amount</label>
												<div class="input-group"> <input type="number" class="form-control coupon"  id="myPhone" onkeyup="myAmount()" placeholder="{{$basic->currency_sym}}0.00"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">{{$basic->currency_sym}}</button> </span> </div>
											</div>
									</div>
								</div>
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">PAYMENT DETAILS</h5>
										<dl class="dlist-align">
											<dt class="">Meter Type</dt>
											<dd class="text-right ml-auto">{{$type}} METER</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Discos:</dt>
											<dd class="text-right text-success ml-auto">{{App\Power::whereBillercode($meter)->first()->name}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Meter Number:</dt>
											<dd class="text-right text-success ml-auto">{{$number}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Customer Name:</dt>
											<dd class="text-right text-success ml-auto">{{$name}}</dd>
										</dl>
										
										<dl class="dlist-align">
											<dt>Transaction Fee:</dt>
											<dd class="text-right ml-auto"> {{$basic->currency_sym}}{{$basic->electricityfee}}</dd>
										</dl>
										<hr>
										<dl class="dlist-align">
											<dt>Total:</dt>
											<dd class="text-right  ml-auto"><strong id="amount2">{{$basic->currency_sym}}0.00</strong></dd>
										</dl>
										<hr>
										<div class="step-footer">
										<h6 class="title font-fix">Enter your transaction PIN</h6>
											<input hidden name="meter" value="{{$meter}}">
											<input hidden name="number" value="{{$number}}"> 
											<input  name="amount" hidden id="pay">
											<input  name="type" hidden value="{{$type}}">
											<input  name="name" hidden value="{{$name}}">
							        		<input type="tel" name="password" placeholder="****" maxlength="4" class="form-control"><br>
											<button type="submit" class="step-btn btn btn-primary btn-block">Make Payment</button>
										</div>
										
										</form>
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
