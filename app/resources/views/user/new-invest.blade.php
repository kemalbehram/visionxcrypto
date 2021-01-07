@extends('include.userdashboard')
@section('content')
  

			<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">VX Vault</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">VX Vault</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							 
							@foreach($plans as $data)
															@php
                        $time_name = \App\TimeSetting::where('time', $data->times)->first();
                    @endphp
							<div class="col-xl-3 col-md-6 col-sm-12 col-lg-3">
								<div class="card custom-card pricingTable2 info">
									<div class="pricingTable2-header">
										<h3>{{$data->name}}</h3>
										<span>{{$data->name}} VX Plan</span>
									</div>
									<div class="pricing-plans">
										<span class="price-value1">{{$data->interest}} @if($data->interest_status == 1) % @else $ @endif</span></span>
										<span class="month">/{{$time_name->name}}</span>
									</div>
									<div class="pricingContent2">
										<ul>
											<li><b>Minimum Investment</b> ${{number_format($data->minimum,2)}}</li>
											<li><b>Maximum Investment</b> ${{number_format($data->maximum,2)}}</li>
											<li><b>Capital access</b> after 3 months</li>
											<li><b>99.9%</b> Secure</li>
											<li><b>KYC/BVN</b> verification</li>
											<li><b>24/7</b> Support</li>
										</ul>
									</div><!-- CONTENT BOX-->
									<div class="pricingTable2-sign-up">
										<a href="{{route('newcoinvest',$data->id)}}" class="btn btn-block btn-primary">get started</a>
									</div><!-- BUTTON BOX-->
								</div>
							</div>
						@endforeach
						</div>
						<!-- End Row -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->

@stop
