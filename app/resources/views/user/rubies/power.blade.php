@extends('include.userdashboard')
@section('content')
  <!-- Main Content-->
   @if(Session::has('modal'))
        <script>
            $(document).ready(function () {
                $("#successpopup").modal('show');
            });
        </script>
    @endif
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Utility Bill Log</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Payment Data</li>
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
											<label class="main-content-label mb-3 pt-1">Total Payment</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="pe-7s-light float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($sum,2)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					 
							 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Bills</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="pe-7s-print float-left text-primary"></i><span class="font-weight-bold">{{$count}}</span></h2>
											 
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
										<div class="main-content-label">Bill Payment Log</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="exportexample" >
												<thead>
													<tr>
														<th class="wd-1"></th>
														<th>TRX ID</th>
														<th>Company</th> 
														<th>Customer</th> 
														<th>Amount</th>
														<th>Pin</th>
														<th>Serial</th>
														<th>Units</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($powered as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="pe-7s-light float-left text-primary"></i>
															</span>
														</td>
														<td class="font-weight-bold">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
														<td>{{App\Power::whereBillercode($data->gateway)->first()->name}}</td> 
														<td class="text-info font-weight-bold">{{$data->details}}</td> 
														<td class="text-info font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount,2)}}</td> 
														<td class="text-success font-weight-bold">({{$data->pin}})</td>
														<td class="text-success font-weight-bold">({{$data->serial}})</td>
														<td class="text-success font-weight-bold">({{$data->unit}})</td>
														<td class="text-success font-weight-bold">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</td>
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
