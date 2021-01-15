@extends('include.userdashboard')

@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Make Payment</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Make ayment</li>
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
											<div class="form-group mb-0"> <label>Have coupon?</label>
												<div class="input-group"> <input type="text" class="form-control coupon" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
											</div>
										</form>
									</div>
								</div>
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">MAKE PAYMENT</h5>
										<dl class="dlist-align">
											<dt class="">Payment Method</dt>
											<dd class="text-right ml-auto">{{isset(App\Gateway::whereId($data->gateway)->first()->name) ? App\Gateway::whereId($data->gateway)->first()->name  : 'N/A'}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Amount:</dt>
											<dd class="text-right ml-auto">${{number_format($data->main_amo, $basic->decimal)}}</dd>
										</dl>

										<dl class="dlist-align">
											<dt>Total price:</dt>
											<dd class="text-right text-danger ml-auto">{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</dd>
										</dl>
										<dl class="dlist-align">
											<dt>Wallet Address:</dt>
											<dd class="text-right text-success ml-auto">{{$data->wallet}}</dd>
										</dl>
										<hr>
										<dl class="dlist-align">
											<dt>You Get:</dt>
											<dd class="text-right  ml-auto"><strong>@if($data->currency->symbol == "PM")
{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}
@else
{{$data->currency->symbol}}{{number_format($data->getamo, 8)}}
@endif</strong></dd>
										</dl>


										<form role="form" method="POST" action="{{ route('ebuyupload') }}" class="withdraw-action-form" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input name="trx" hidden value="{{$data->trx}}">
										<div class="step-footer">
											<button type="submit" class="step-btn btn btn-primary btn-block">Buy {{$data->currency->name}}</button>
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


@endsection
