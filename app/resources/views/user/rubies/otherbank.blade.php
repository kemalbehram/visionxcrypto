@extends('include.userdashboard')
@section('content')
 <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Preview Bank Transfer</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Preview Bank Transfer</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
						 <form method="post"  action="{{route('completeotherbanktransfer') }}">
  ``					@csrf 
						<!-- Row-->
						<div class="row">
							<div class="col-md-12">
								<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<h1 class="mb-3 tx-50 font-weight-semibold">Bank Transfer</h1>
												<p class="tx-18 mb-5 text-white-50">Please note you will be charged {{$basic->currency_sym}} {{number_format($basic->transcharge,2)}} transfer fee for fund transfer to anothr bank</p>
											</div>
											<div class="row">
												<div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
													<div class="item-search-tabs mb-6 background-text">
														<div class="buy-sell">
															<div class="form row mx-auto justify-content-center d-flex p-4">
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																	<select name="bank" id='mySelect' onchange='myFunction()' class="form-control select2 custom-select br-md-0">
												 <option disabled selected >Select Bank Name</option>
										    	@foreach($rep['banklist'] as $k=>$data)
												<option data-name="{{$data['bankname']}}" value="{{$data['bankname']}}">{{$data['bankname']}}</option> 
												@endforeach  
												</select>
																</div>
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																	<input type="text" class="form-control mb-4 mb-lg-0" type="number" required name="accountnumber" placeholder="Enter Account Number">
																</div>
																<div class="col-xl-12 col-lg-12 col-md-12 my-3 text-left">
																	<i class=" fa fa-bank exchange-icon tx-30 text-white inline-block"></i>
																</div>
																<div class="form-group  col-xl-6 col-lg-6 col-md-12 mb-0">
																	<input type="text" class="form-control mb-4 mb-lg-0" required name="accountname" placeholder="Enter Account Name" >
																</div>
																<div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
																	<input type="text" class="form-control mb-4 mb-lg-0" i disabled="" value="{{$basic->currency_sym}}{{number_format($amount,2)}}">
																</div>
															</div>
														</div>
													</div>
													<div class="text-center background-text">
														<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-warning pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">TRANSFER NOW</a>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>
							</div> 
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
			
			

<!-- Deposit  Modal --> 
			<div class="modal" id="myModal">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Bank Transfer</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<h6>Enter Transaction Pin</h6>
							<!-- Select2 -->
							<input type="tel" placeholder="****" maxlength="4" name="password" class="form-control">
							<br>
							<h6>Enter Narration</h6>
							<!-- Select2 -->
							<input placeholder="Please Enter Narration" name="naration"   type="test"  class="form-control">
						        						
							<!-- Select2 -->
						 </div>
						<div class="modal-footer">
							<button type="submit" class="btn ripple btn-primary" type="button">Proceed With Transfer</button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End Select2 modal -->

@stop
