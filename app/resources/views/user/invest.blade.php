@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">My VX Vault</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">VX Vault</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									 
								<a href="{{route('newinvest')}}">
								<button type="button" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fe fe-pie-chart mr-2"></i> New Investment
									</button>
								</a>
								</div>
							</div>
						</div>
						<!-- End Page Header -->
						<!-- Row -->
						<div class="row row-sm">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Invested</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="mdi mdi-wallet icon-size float-left text-primary"></i><span class="font-weight-bold">${{number_format($invsum, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order">
											<label class="main-content-label mb-3 pt-1">Available Earning</label>
											<h2 class="text-right"><i class="mdi mdi-wallet icon-size float-left text-warning"></i><span class="font-weight-bold">${{number_format($earn->balance, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							 
						</div>
						<!-- End Row -->


						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Investment History</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>Plan ID</th>
														<th>Date</th> 
														<th>Plan</th> 
														<th>Time Frame</th> 
														<th>Amount</th>
														<th>Payout</th>
														<th>Expected Yield</th>
														<th>Total Yield</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($trans as $k=>$data)
													<tr class="border-bottom">
														<td>
														<a href="{{route('coinvestyield',$data->id)}}">	<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="fa fa-eye text-primary"></i>
															</span> </a>
														</td>
														<td class="font-weight-bold">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td> 
														<td class="text-info font-weight-bold">{{__($data->plan->name ?? "N/A")}}</td> 
														<td class="text-info font-weight-bold">{{__($data->time_name)}}</td> 
														<td class="text-success font-weight-bold">${{number_format($data->amount, $basic->decimal)}}</td>
														<td class="text-success font-weight-bold">$ {{__($data->interest)}} / {{__($data->time_name)}}</td>
														<td class="text-success font-weight-bold">@if($data->period == '-1')  @lang('Life-time')   @else {{__($data->period)}} @lang('Times') @endif</td>
														<td class="text-success font-weight-bold">{{__($data->return_rec_time)}} @lang('Times')</td>
														<td>
														@if($data->status == 1)
														<span class="text-info font-weight-semibold">RUNNING</span>
														@elseif($data->status == 2)
														<span class="text-warning font-weight-semibold">PENDING</span>
														@elseif($data->status == 0)
														<span class="text-suucess font-weight-semibold">FINISHED</span>
														@elseif($data->status == 17)
														<span class="text-danger font-weight-semibold">REJECTED</span>
														@else
														<span class="text-danger font-weight-semibold">CLOSED</span>
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
