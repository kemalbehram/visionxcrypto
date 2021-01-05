@extends('include.userdashboard')
@section('content')
 <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Preview Withdrawal</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Preview</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							
							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<form>
											<div class="form-group mb-0"> <label>Payout Time</label>
												<div class="input-group"> <input type="text" readonly class="form-control coupon" value="in {!! $method->duration !!} Day(s)"> </div>
											</div>
										</form>
									</div>
								</div>
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">WITHDRAWAL DETAIL</h5>
										<dl class="dlist-align">
											<dt class="">Percentage Charge</dt>
											<dd class="text-right ml-auto">{!! $method->percent !!} %</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Total Charge:</dt>
											<dd class="text-right text-danger ml-auto">{{$basic->currency_sym}} {{$charge}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Sub Amount:</dt>
											<dd class="text-right ml-auto">${{number_format( $amount,2)}}</dd>
										</dl> 
										<hr>
										<dl class="dlist-align">
											<dt>Total Amount:</dt>
											<dd class="text-right  ml-auto"><strong>${{number_format( $amount + $charge,2)}}</strong></dd>
										</dl>
										<div class="step-footer">
										<form method="post" action="{{route('withdraw.submit')}}">
{{ csrf_field() }}
<input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
 <input name="send_details" value="{{$pay}}" hidden>
 <button type="submit" class="step-btn btn btn-success btn-block">Submit Request</button></form> 
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
