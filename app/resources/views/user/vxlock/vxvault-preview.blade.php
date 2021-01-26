@extends('include.userdashboard')

@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Lock Bitcoin</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Lock Bitcoin</li>
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
											<div class="form-group mb-0"> <label>Wallet Address</label>
												<div class="input-group"> <input type="text" readonly class="form-control coupon" value="{{$data->address}}"> <span class="input-group-append"> <a class="btn btn-primary btn-apply coupon">Copy</a> </span> </div>
											</div>

											<br>
											<center><img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl={{'bitcoin:'.$data->address.'?amount='.$data->btc}}&choe=UTF-8\" style='width:190px;' />
											<br>
											<span class="dt-type-md badge badge-outline badge-info badge-sm"><i class = "fa fa-spinner fa-spin"></i>&nbsp;Awaiting</span>
											</center>

										</form>
									</div>
								</div>
								<div class="card custom-card cart-details">
									<div class="card-body">
										<h5 class="mb-3 font-weight-bold tx-14">PAYMENT SUMMARY</h5>
										<dl class="dlist-align">
											<dt>Amount To Lock:</dt>
											<dd class="text-right ml-auto">${{number_format($data->usd, $basic->decimal)}}</dd>
										</dl>


										<dl class="dlist-align">
											<dt>Total Units:</dt>
				 							<dd class="text-right text-danger ml-auto"> 
{{$data->btc}} BTC
</dd>
										</dl>

										<hr>
										<dl class="dlist-align">
											<dt>Naira Equivalent:</dt>
											<dd class="text-right  ml-auto"><strong>{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</strong></dd>
										</dl>
										<dl class="dlist-align">
											<dt class="">Withdrawal Date</dt>
											<dd class="text-right ml-auto">{{ Carbon\Carbon::parse($data->expire)->diffForHumans() }}</dd>
										</dl>

 <small class="text-info"><p>Your fund will be credited into your Naira wallet after <span style="color: red"> three (3) confirmations</span>.</p><br></small>

										<form role="form" method="POST"  action="{{ route('elockcallback') }}">
										{{ csrf_field() }}

										<input name="trx" hidden value="{{$data->code}}">
										<button type="submit" class="step-btn btn btn-primary btn-block">Confirm </button>
										</form>
    

									</div>
								
						</div>
						<!-- End Row -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->


@endsection
