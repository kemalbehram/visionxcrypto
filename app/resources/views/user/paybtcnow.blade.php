@extends('include.userdashboard')

@section('content')
<<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Bitcoin</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Bitcoin</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card productdesc">
									<div class="card-body h-100">
										<div class="row">
											<div class="col-xl-6 col-lg-12 col-md-12">
												<div class="row">
													 
													<div class="col-md-10 offset-md-1 col-sm-12 col-12">
														<div class="product-carousel">
															<div id="carousel" class="carousel slide" data-ride="false">
																<div class="carousel-inner">
																	<div class="carousel-item active"><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$currency->payment_id}}&choe=UTF-8\" alt="QRCODE" class="img-fluid mx-auto d-block">
																		
<br>
																	<div class="form-group mb-0">  
												<div class="input-group"> <input    class="form-control coupon" value="{{$currency->payment_id}}"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon"><i class="fa fa-copy"></i></button> </span> </div>
											</div>
																		
																	</div>
																	 
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-xl-6 col-lg-12 col-md-12">
												<div class="mt-4 mb-4">
                                                    <h4 class="mt-1 mb-3">Amount in BTC/USD</h4>

                                                     
													<h5 class="mb-2">USD : <b>${{number_format($invest->amount, $basic->decimal)}}</b></h5>

													<h5 class="mb-2">BTC : <b>{{round($invest->amount * $btcrate,8)}} BTC</b></h5> 
													<h6 class="mt-4 fs-16 text-danger">Please read carefully before you pay into our BTC wallet address</h6>
													<p class="text-danger">{{$basic->sitename}} will not be responsible for you funding a wrong Bitcoin Wallet Address</p>
											
													<p class="text-info">Please ensure you sent eaxctly <strong>{{round($invest->amount * $btcrate,8)}} BTC (${{number_format($invest->amount, $basic->decimal)}} )</strong> to our specified Bitcoin Address alone. Please note; do not send below ${{number_format($invest->amount, $basic->decimal)}}. We only place investment based on what you send</p>
													</div>
													<p>To enhance your payment processing, click the buton below and upload a screenshot of your successful transaction with your transaction number if any.</p><br>
												<div class="text-center mt-4 mb-4 btn-list">
																			<a href="#" data-toggle="modal" data-target="#pay-confirm" class="btn ripple btn-primary"><i class="fe fe-check"> </i>I Have Paid</a> 
																		</div>
												 
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
			
			
			
			<!-- Select2 modal -->
			<form role="form" method="POST"  action="{{ route('btcpaynowupload') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
								    			
			<div class="modal" id="pay-confirm">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">Proof Of Payment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body"> 
							<!-- Select2 -->
							<div class="withdraw-address">
							 <small>Please Enter The Transaction Hash Code Gotten After Sending BTC</small>						 
													<textarea name="trxx" class="form-control" placeholder="Enter Transaction Hash Number " ></textarea>
												</div>

												<br>
												<div class="withdraw-address">
													 <small>Enter The BTC address You Are Sending From</small>
													<textarea name="btc" class="form-control" placeholder="BTC Wallet address" ></textarea>
												</div>

<br>
												<div class="withdraw-address">
													 <small>Upload Proof Of Payment Screenshot</small>
													<div class="input-group file-browser">
													<input type="text" class="form-control border-right-0 browse-file" placeholder="choose" readonly>
													<label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input  name="photo" type="file" style="display: none;" multiple>
														</span>
													</label>
												</div>
												</div>

 
							
							
							<!-- Select2 -->
							 
						</div>
						<div class="modal-footer">
						
												<input name="trx" hidden value="{{$invest->trx}}">
												<input name="btcvalue" hidden value="{{round($invest->amount * $btcrate,8)}}">
							<button class="btn ripple btn-primary" type="submit">Proceed</button>
							<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<!-- End Select2 modal -->



@endsection
