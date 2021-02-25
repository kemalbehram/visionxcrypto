@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Internet Data Log</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Internet Data</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
						<!-- Row -->
						<div class="row row-sm">
						@foreach($networks as $k=>$data)
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">{{$data->name}}</label>
											<h2 class="text-right card-item-icon card-icon">
											<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images')}}/{{$data->image}}" alt=""><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format(App\Transaction::whereUser_id(Auth::user()->id)->whereType(2)->whereStatus(1)->whereGateway($data->symbol)->sum('amount'),2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					@endforeach
							 
						</div>
						<!-- End Row -->


						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Internet Subscription Log</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>TRX ID</th>
														<th>Date</th> 
														<th>Remark</th> 
														<th>Total</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($transactions as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<img width="40"  class=" icon-size float-left text-primary" src="{{url('assets/images')}}/{{App\Network::whereSymbol($data->gateway)->first()->image ?? ""}}" alt="">
															</span>
														</td>
														<td class="font-weight-bold">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td> 
														<td class="text-info font-weight-bold">{{$data->remark}}<br>
                                                        <b>{{$data->account_number}}</b>
                                                        </td> 
														<td class="text-success font-weight-bold">({{$data->method}})<br>{{$basic->currency_sym}}{{number_format($data->amount,2)}} </td>
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
