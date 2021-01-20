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
									<li class="breadcrumb-item active" aria-current="page">VX Vault Yield</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
						 


						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Investment Return History</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="example1">
												<thead>
													<tr>
														<th>Plan</th> 
														<th>Date</th> 
														<th>Amount USD</th>
														<th>Amount BTC</th>
														<th>Type</th> 
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($trans as $k=>$data)
													<tr class="border-bottom">
														<td>
														<td class="font-weight-bold">{{$plans->name ?? "" }}</td>
														<td>{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td>  
														<td class="text-success font-weight-bold">${{number_format($data->amount, $basic->decimal)}}</td>
														<td class="text-success font-weight-bold">{{number_format($btcrate * $data->amount, 8)}}BTC</td>
														<td class="text-success font-weight-bold">Interest</td>
														<td>
														 
														<span class="text-success font-weight-semibold">Paidd</span>
														 
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
