@extends('include.userdashboard')

@section('content')
<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">{{$page_title }}</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">{{$page_title }}</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- row -->
						<div class="row row-sm">
							<div class="col-xl-3 col-lg-4">
								<div class="card custom-card mail-container task-container overflow-hidden">
									<div class="">
										<div class="p-4 border-bottom">
											<a class="btn btn-main-primary btn-block btn-compose" href="" id="btnCompose">Compose</a>
										</div>
										<div class="card-body tab-list-items">
											<div class="main-content-left main-content-left-mail">
												<div class="main-mail-menu">
													<nav class="nav main-nav-column mg-b-20">
														<a class="nav-link active" href="">
															<i class="fe fe-mail"></i> Unread <span>{{$unread}}</span>
														</a>
														<a class="nav-link active" href="">
															<i class="fe fe-mail"></i> Viewed <span>{{$read}}</span>
														</a>
														<a class="nav-link" href="">
															<i class="fe fe-mail"></i> Inbox <span>{{$total}}</span>
														</a>
														<a class="nav-link" href="{{route('sent')}}">
															<i class="fe fe-send"></i> Sent <span>{{$sent}}</span>
														</a>
														 
													</nav>
													 
												</div><!-- main-mail-menu -->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-lg-8  main-content-body-mail1">
								<div class="card custom-card mail-container task-container overflow-hidden">
									<div class="inbox-body p-4">
										<div class="mail-option">
											 
											<div class="btn-group">
												<a href="" class="btn mini tooltips">
													<i class="fe fe-refresh-cw"></i>
												</a>
											</div>
											 
											<ul class="unstyled inbox-pagination">
												{{$inbox->links() }}

												 
											</ul>
										</div>
										<div class="table-responsive">
											<table class="table table-inbox text-md-nowrap table-hover text-nowrap">
												<tbody>
												@if(count($inbox)  < 1)
											<center><h4>You dont have any message in the inbox yet</h4></center>
										@endif
										 @foreach($inbox as $k=>$data)
										
													<tr class="">
														<td class="inbox-small-cells">
															<label class="custom-control custom-checkbox mb-0">
																<input type="checkbox" class="custom-control-input" name="example-checkbox2" value="option2">
																<span class="custom-control-label"></span>
															</label>
														</td>
														<td class="inbox-small-cells">  @if($data->status == 0)<i class="fa fa-star text-info"></i>@endif</td>
														<td class="inbox-small-cells"><i class="fa fa-bookmark"></i></td>
														 
														<td class="view-message dont-show font-weight-semibold">{{$basic->sitename}}</td>
														<td class="view-message"><a href="{{route('inbox-view',$data->id)}}">{{$data->title}}</a></td>
														<td class="view-message text-right font-weight-semibold">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
													</tr>
											</a>
										@endforeach
													 
												</tbody>
											</table>
										</div>
									</div>
									<!-- mail-content -->
								</div>
							</div>
						</div>
						<!-- /row -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->

@endsection
