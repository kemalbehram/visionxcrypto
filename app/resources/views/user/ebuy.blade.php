@extends('include.userdashboard')
@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Buy Coin</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Buy Coin</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
						 
						
						<div class="col-md-12">
								<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<h4 class="mb-3 tx-30 font-weight-semibold">Buy {{$data->currency->name}}</h4>
												<p class="tx-18 mb-5 text-white-50">Find below the summary of your {{$data->currency->name}} purchase. {{$basic->sitename}} will not be liable to any loss arising from wrong wallet address, or reduction in {{$data->currency->name}} price rate. <br>You can cancel this operation by clicking <a href="{{ route('ebuydel',$data->trx) }}">here</a></p>
											</div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex p-4">
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																<label class="text-white-50">Amount</label>
																	<input type="text" readonly  class="form-control mb-4 mb-lg-0" id="text7" value="$ {{number_format($data->amount, $basic->decimal)}}">
																</div>
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																<label class="text-white-50">Our Rate</label>
																	<input type="text" readonly  class="form-control mb-4 mb-lg-0" id="text7" value="$1.00 = {{$basic->currency_sym}}{{number_format($data->currency->buy, $basic->decimal)}}">
																
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 my-3 text-left">
																	<i class="cf cf-{{$data->currency->icon}} exchange-icon tx-30 text-white inline-block"></i>
																</div>
																<div class="form-group  col-xl-6 col-lg-6 col-md-12 mb-0">
																<label class="text-white-50">Your Wallet Address</label>
																	<input type="text" class="form-control mb-4 mb-lg-0" id="text6" readonly value="{{$data->wallet}}">
																</div>
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																<label class="text-white-50">Total Amount</label>
																	<input type="text" readonly  class="form-control mb-4 mb-lg-0" id="text7" value="{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}">
																
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<a href="{{ route('ebuypost',$data->trx) }}" class="btn btn-warning pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">CONTINUE</a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>
							</div>
							
							 
						</div>
						<!-- End Row -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
@stop
