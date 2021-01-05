@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Transfer History</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Transfer History</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
						<!-- Row -->
						<div class="row row-sm">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Transfer</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="mdi mdi-account-multiple icon-size float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($transfers, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order">
											<label class="main-content-label mb-3 pt-1">Current Balance</label>
											<h2 class="text-right"><i class="mdi mdi-cube icon-size float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}} {{number_format(Auth::user()->balance, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order">
											<label class="main-content-label mb-3 pt-1">Bonus Balance</label>
											<h2 class="text-right"><i class="icon-size mdi mdi-poll-box   float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}} {{number_format(Auth::user()->bonus, $basic->decimal)}}</span></h2>
											 
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
										<div class="main-content-label">Wallet Transfer History</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>TRX ID</th>
														<th>Date</th> 
														<th>Benefeciary</th> 
														<th>Total</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($transfer as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="fa fa-bank text-primary"></i>
															</span>
														</td>
														<td class="font-weight-bold">{{isset($data->transaction_id ) ? $data->transaction_id  : 'N/A'}}</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td> 
														<td class="text-info font-weight-bold">{{$data->send_details}}</td> 
														<td class="text-success font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</td>
														<td>
														@if($data->status == 1)
														<span class="text-success font-weight-semibold">PENDING</span>
														@elseif($data->status == 2)
														<span class="text-success font-weight-semibold">COMPLETED</span>
														@elseif($data->status == 0)
														<span class="text-WARNING font-weight-semibold">PENDING</span>
														@elseif($data->status == -2)
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
