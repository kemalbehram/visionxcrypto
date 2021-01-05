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
								<h2 class="main-content-title tx-24 mg-b-5">Referral Log</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Referral Log</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									 <a href="http://www.facebook.com/share.php?u={{ route('refer.register',auth::user()->username) }}&amp;title={{$gnl->title}} Referral Link">
									<button type="button" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fe fe-facebook mr-2"></i> Share Link
									</button>
									</a>
									<a href="whatsapp://send?text={{ route('refer.register',auth::user()->username) }}">
									<button type="button" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fa fa-share mr-2"></i> Share Link
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
											<label class="main-content-label mb-3 pt-1">Referral Earning</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="pe-7s-light float-left text-primary"></i><span class="font-weight-bold">{{$basic->currency_sym}}{{number_format(Auth::user()->bonus, $basic->decimal)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
					 
							 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
							 
								<div class="card custom-card">
									<div class="card-body">
										<div class="card-order ">
											<label class="main-content-label mb-3 pt-1">Total Referrals</label>
											<h2 class="text-right card-item-icon card-icon">
											<i class="pe-7s-user float-left text-primary"></i><span class="font-weight-bold">{{count($referral)}}</span></h2>
											 
										</div>
									</div>
								</div>
							</div>
							<!-- COL END -->
							
						
							 
						</div>
						<!-- End Row -->
<div class="card custom-card">
									<div class="card-body">
										<form>
											<div class="form-group mb-0"> <label>Referral Link</label>
												<div class="input-group"> <input type="text" class="form-control coupon" value="{{ route('refer.register',auth::user()->username) }}"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Copy</button> </span> </div>
											</div>
										</form>
									</div>
								</div>

						<!-- row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card transcation-crypto">
									<div class="card-header border-bottom-0">
										<div class="main-content-label">Referral Log</div> 
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table" id="exportexample" >
												<thead>
													<tr>
														<th class="wd-1"></th> 
														<th>Username</th>  
														<th>Country</th> 
														<th>Date Joined</th>
														<th>Last Login</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													@foreach($referral as $k=>$data)
													<tr class="border-bottom">
														<td>
															<span class="crypto-icon bg-primary-transparent mr-3 my-auto">
																<i class="pe-7s-user float-left text-primary"></i>
															</span>
														</td>
														<td>{{$data->username}}</td> 
														<td class="text-info font-weight-bold">{{$data->country ??	"Not Available"}}</td> 
														<td class="text-info font-weight-bold">{{ date('d M Y',strtotime($data->created_at))}}</td> 
														<td class="text-success font-weight-bold">{{ date('d M Y',strtotime($data->login_time))}}</td>
														<td> 
														@if($data->status == 1)
														<span class="text-success font-weight-semibold">ACTIVE</span>
														@else
														<span class="text-danger font-weight-semibold">INACTIVE</span>
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
