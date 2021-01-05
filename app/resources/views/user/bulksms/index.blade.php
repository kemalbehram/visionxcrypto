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
								<h2 class="main-content-title tx-24 mg-b-5">Instant SMS Log</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">SMS Log</li>
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
											<i class="pe-7s-light float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format($sum, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					 
							 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Messages</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="pe-7s-mail float-left text-primary"></i><span class="font-weight-bold">{{$count}}</span></h2>
											 
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
										<div class="main-content-label">SMS Log</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="exportexample" >
												<thead>
													<tr>
														<th class="wd-1"></th> 
														<th>Number</th>  
														<th>Message</th> 
														<th>Cost</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($sms as $data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="pe-7s-mail float-left text-primary"></i>
															</span>
														</td>
														<td>{{$data->phone}}</td> 
														<td class="text-info font-weight-bold">{{$data->message}}</td> 
														<td class="text-info font-weight-bold">{{$basic->currency_sym}}{{number_format($data->amount,2)}}</td> 
														<td class="text-success font-weight-bold">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
														<td> 
														<span class="text-success font-weight-semibold">SUCCESSFUL</span>
													 

														
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
