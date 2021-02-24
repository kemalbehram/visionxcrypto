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
									<li class="breadcrumb-item active" aria-current="page">Make payment</li>
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
												<div class="input-group"> <input type="text" readonly class="form-control coupon" value="{{$address}}"> <span class="input-group-append"> <a class="btn btn-primary btn-apply coupon">Copy</a> </span> </div>
											</div>

											<br>
											<center><img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl={{'bitcoin:'.$address.'?amount='.$btcvalue}}&choe=UTF-8\" style='width:190px;' />
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
											<dt>Amount To Sell:</dt>
											<dd class="text-right ml-auto">${{number_format($data->amount, $basic->decimal)}}</dd>
										</dl>


										<dl class="dlist-align">
											<dt>Total Units:</dt>
											<dd class="text-right text-danger ml-auto">@if($data->currency->symbol == "PM")
{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}
@else
{{$data->currency->symbol}}{{$btcvalue}}
@endif</dd>
										</dl>

										<hr>
										<dl class="dlist-align">
											<dt>You Get:</dt>
											<dd class="text-right  ml-auto"><strong>{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</strong></dd>
										</dl>
										<dl class="dlist-align">
											<dt class="">Payment Destination</dt>
											<dd class="text-right ml-auto">P2P</dd>
										</dl>

 <small class="text-info"><p>Your fund will be credited into your Naira wallet after <span style="color: red"> three (3) confirmations</span>.</p><br></small>

										<form role="form" method="POST"  action="{{ route('esellcallback') }}">
										{{ csrf_field() }}

										<input name="trx" hidden value="{{$data->trx}}">
										<button type="submit" class="step-btn btn btn-primary btn-block">Confirm </button>
										</form>

										<!--
										<div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
											<div class="card">
												<div class="card-header" id="headingOne" role="tab">
												<button aria-controls="collapseOne" aria-expanded="false" data-toggle="collapse" href="#collapseOne" class="step-btn btn btn-primary btn-block">Procedd </button>

												</div>
												<div aria-labelledby="headingOne" class="collapse " data-parent="#accordion" id="collapseOne" role="tabpanel">
													<div class="card-body">
														<form role="form" method="POST"  action="{{ route('esellupload') }}"  enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="withdraw-address">

													<textarea name="trxx"  class="form-control" placeholder="Enter Trasaction Nnmber " ></textarea>
												</div><br>

												<div class="input-group file-browser">
													<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Proof Of Payment" readonly>
													<label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input type="file" name="photo"  style="display: none;" multiple>
														</span>
													</label>
												</div>

											<input name="trx" hidden value="{{$data->trx}}">
										<div class="step-footer">
											<button type="submit" class="step-btn btn btn-primary">Submit </button>
										</div>
										</form>
													</div>
												</div>
											</div>

										</div><!-- accordion -->

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
