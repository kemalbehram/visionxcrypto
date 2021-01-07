@extends('include.userdashboard')
@section('content')
 <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Activities Log</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Activities Log</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->
 

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12">
								<div class="card custom-card">
									<div class="card-body">
										<div>
											<h6 class="main-content-label mb-1">Activity Log</h6>
											<p class="text-muted card-sub-title">Login activities on your account</p>
										</div>
										<div class="table-responsive border">
											<table class="table  text-nowrap text-md-nowrap table-striped mg-b-0">
												<thead>
													<tr> 
														<th>Location</th>
														<th>Info</th>
														<th>Date</th>
														<th>IP Address</th>
													</tr>
												</thead>
												<tbody>
												@foreach($activity as $k=>$data)
													<tr> 
														<td>{{$data->location}}</td>
														<td>{{$data->details}}</td>
														<td>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
														<td>{{$data->user_ip}}</td>
													</tr>
												@endforeach 
												</tbody>
											</table>
										</div>
										{{$activity->links()}}
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

					 
					</div>
				</div>
			</div>
			<!-- End Main Content-->
@stop
