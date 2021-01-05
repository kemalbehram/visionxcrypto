@extends('include.userdashboard')

@section('content')

   
	 

			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">VX Card</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">VX Card</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- row -->
								<div class="row row-sm">
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Virtual Card</label>
													<span class="d-block tx-12 mb-0 text-muted">Get access to make transactions easy 
													and convinient anywhere anytime instantly,
													through e-commerce and online platforms around the globe such as Netflix, 
													iTunes, Amazon, Facebook and so much more.</span>
												</div><br>
												
												<a href="{{route('showvcard')}}" class="btn btn-primary ml-auto">Apply Now</a>
											</div>
											<div class="  ">
												<img src="{{url('/')}}/assets/assets/img/pngs/cardproduct.png" alt="image" class="  ">
											</div>
										</div>
									</div>
								</div>
							</div><!-- End col -->
									
									<div class="col-xl-6 col-lg-12 col-md-12">
										<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Physical Card</label>
													<span class="d-block tx-12 mb-0 text-muted">Get access to make transactions easy 
													and convinient anywhere anytime instantly,
													through e-commerce and online platforms Atm, Cash Centers and many more.</span>
												</div><br>
												
												<button class="btn btn-primary ml-auto">Apply Now</button>
											</div>
											<div class="  ">
												<img src="{{url('/')}}/assets/assets/img/pngs/contatless.png" alt="image" class="  ">
											</div>
										</div>
									</div>
								</div>
					</div>
				</div>
			</div>
			<!-- End Main Content-->

@endsection
