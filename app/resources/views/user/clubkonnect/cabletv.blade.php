@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">TV Subscription History</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">TV Subscription History</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
						<!-- Row -->
						<div class="row row-sm">
						 
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">DSTV</label>
											<h2 class="text-right card-item-icon card-icon">
											<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/dstv.png')}}" alt=""><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($dstv,2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">GOTV</label>
											<h2 class="text-right card-item-icon card-icon">
											<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/gotv.jpg')}}" alt=""><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($gotv,2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Startimes</label>
											<h2 class="text-right card-item-icon card-icon">
											<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/startimes.jpg')}}" alt=""><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($startimes,2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					 <!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Payment</label>
											<h2 class="text-right card-item-icon card-icon">
											<img width="40"  class=" icon-size float-left text-primary" src="{{url('/')}}/assets/assets/img/pngs/cabletv.png" alt=""><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($dstv+$gotv+$startimes,2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					 
							 
						</div>
						<!-- End Row -->


						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Subscription Log</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>TRX ID</th>
														<th>Date</th> 
														<th>Bouquet</th> 
														<th>Total</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($cabletv as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
															@if($data->gateway ==  "DSTV")
															<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/dstv.png')}}" alt="">
															@elseif($data->gateway ==  "GOTV")
															<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/gotv.jpg')}}" alt="">
															@elseif($data->gateway ==  "STARTIMES")
															<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images/startime.jpg')}}" alt="">
															@endif
																
															</span>
														</td>
														<td class="font-weight-bold">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td> 
														<td class="text-info font-weight-bold">{{$data->method}}</td> 
														<td class="text-success font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount,2)}} </td>
														<td>
														@if($data->status == 1)
														<span class="text-success font-weight-semibold">SUCCESSFUL</span>
														 @elseif($data->status == 0)
														<span class="text-warning font-weight-semibold">PENDING</span>
														@else
														<span class="text-danger font-weight-semibold">DECLINED</span>
														@endif

														
														</td>
													</tr>
													 @endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Row End -->
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
@stop
