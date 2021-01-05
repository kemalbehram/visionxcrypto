@extends('include.userdashboard')

@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">View-Mail</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">View-Mail</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body h-100">
										<div class="email-media">
											<div class="mb-4 d-lg-flex">
												<h3>{{$inbox->title}} </h3>
												<div class="ml-auto d-none d-md-flex fs-18">
													<a href="#" class="mr-3 tx-inverse"><i class="fe fe-printer" data-toggle="tooltip" title="" data-original-title="Print"></i></a>
													<a href="{{route('inbox')}}" class="tx-inverse"><i class="fe fe-tag" ></i></a>
												</div>
											</div>
											<div class="media mt-0">
												<div class="main-img-user avatar-md mr-3 online">
													<img alt="avatar" class="rounded-circle" src="{{asset('assets/images/logo/logo.png')}}">
												</div>
												<div class="media-body tx-inverse">
													<div class="float-right d-none d-md-flex fs-15">
														<small class="mr-2">{!! date(' D-d-M-Y', strtotime($inbox->created_at)) !!}</small> 
														 
													</div>
													<div class="media-title font-weight-semiblod"><span class="tx-18 font-weight-bold">{{Auth::user()->username}}</span>
														<p class="mb-0 text-muted">{{Auth::user()->email}} </p>
														<small class="mr-2">{{ Carbon\Carbon::parse($inbox->created_at)->diffForHumans() }}</small> 
													</div>
												</div>
											</div>
										</div>
										<div class="eamil-body">
											<h6 class="mb-3">Hi {{Auth::user()->username}}</h6>
											<p> {{$inbox->details}}</p>
											<p class="mb-0">{{$basic->sitename}}</p>
											<hr>
											
									</div>
									 
								</div>
							</div>
						</div>
						<!-- End Row -->
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>
			<!-- End Main Content-->
@endsection
