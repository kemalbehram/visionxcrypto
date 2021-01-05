@extends('include.userdashboard')
@section('content')
    <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Verification</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Verification</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<div class="row square">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="profile-tab tab-menu-heading">
											<nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
												 
												<a class="nav-link active" data-toggle="tab" href="#bvn">BVN</a>
												<a class="nav-link" data-toggle="tab" href="#timeline">KYC Verification</a>
												<a class="nav-link" data-toggle="tab" href="#bank">Payment</a>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card main-content-body-profile">
									<div class="tab-content">
									
									
									
									 
									<div class="main-content-body tab-pane p-4 border-top-0" id="bank">
											<div class="card-body border">
												<div class="mb-4 main-content-label">Bank Account Verification</div>
												  @if(Auth::user()->bankyes == 1)
                                
                                    
                                            <div class="col-xl-12 card">
														<div class="table-responsive">
															<table class="table mb-0 border-top table-bordered text-nowrap">
																<tbody>
																	<tr>
																		<th scope="row">Bank Name</th>
																		<td>{{Auth::user()->bank}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Account Name</th>
																		<td>{{Auth::user()->accountname}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Account Number</th>
																		<td>{{Auth::user()->accountno}}</td>
																	</tr>
																	 
																	<tr>
																		<th scope="row">Status</th>
																		<td>
																		@if(Auth::user()->bankyes == 1)
																		<button class="btn btn-success btn-sm">Verified</button>
																		@elseif(Auth::user()->verified == 0)
																		<button class="btn btn-warning btn-sm">Pending</button>
																		@elseif(Auth::user()->verified == 2)
																		<button class="btn btn-danger btn-sm">Rejected</button>
																		@endif
																		</td>
																	</tr>
																	 
																</tbody>
															</table>
														</div>
													</div>
												@endif
										 
                                 
							
												 
												 
													
													 @if(Auth::user()->bankyes != 1)
													 <p>Please  update your bank account details below. You will need this to facilitate your fund withdrawal from {{$basic->sitename}}</p>
													 <form class="form-horizontal" action="{{route('post.banky') }}" method="post">
												  @csrf
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-9">
															<script>
                                function myFunctionbank() {
                                    var bank = $("#mybank option:selected").attr('data-name'); 

                                    document.getElementById("bankname").value = bank;
                              

                                };
                            </script>
																<select name="bank" id='mybank' onchange='myFunctionbank()' class="form-control select2 custom-select br-md-0">
												 <option disabled selected >Select Bank Name</option>
										    	@foreach($list as $k=>$data)
												<option  data-name="{{$data['bankname']}}" value="{{$data['bankcode']}}">{{$data['bankname']}}</option> 
												@endforeach  
												</select>
												<input id="bankname" name="bankname" hidden>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-9">
																<input  class="form-control"  name='actnumber'  placeholder="Enter your bank account number" type="tel">
															</div>
														</div>
													</div>
													
													
													<div class="form-group mb-0">
														<div class="row row-sm">
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button  type="submit" class="btn btn-primary ml-auto">Verify Now</button><br><br>
																</div>
															</div>
														</div>
													</div>
													</form>
													@endif
											</div>
										</div>
										
										
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="bvn">
											<div class="card-body border">
												<div class="mb-4 main-content-label">BVN Verification</div>
												 @if(Auth::user()->bvn_verify == 1)
                                
                                    
                                            <button class="btn btn-success">BVN Has Been Verified</button>
												@endif
                            
                                 
							
												 
												 
													
													 @if(Auth::user()->bvn_verify != 1)
													 <p>We need your BVN to be able to process transactions and verify your identity.
													Dial *565*0# on your device to view your BVN</p>
													 <form class="form-horizontal" action="{{ route('user.bvn-verify')}}" method="post">
												  @csrf
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-9">
																<input  class="form-control"  name="bvn" placeholder="Enter your BVN" type="tel">
															</div>
														</div>
													</div>
													
													
													<div class="form-group mb-0">
														<div class="row row-sm">
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button  type="submit" class="btn btn-primary ml-auto">Verify Now</button><br><br>
																</div>
															</div>
														</div>
													</div>
													</form>
													@endif
											</div>
										</div>
										
										<div class="main-content-body  tab-pane border-top-0" id="timeline">
										 @if(Auth::user()->verified == 0)
                        <form role="form" method="POST" class="form-horizontal" action="{{ route('document.upload') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
										
											<div class="border p-4">
												<div class="main-content-body main-content-body-profile">
													
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
										<div class="mb-4 main-content-label">KYC Verification</div>
											<div class="card-body border">
											<label for="cars">Choose your prefered verification document:</label>
											<select class="form-control select2" name="type">
											<option value="id card">ID Card</option>
											<option value="passport">Passport</option>
											<option value="voters card">Voters Card</option>
											<option value="driving license">Driving License</option>
											</select>
											</div>
													
													
													<br><br><div class="mb-4 main-content-label">Expiry Date</div>
												
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input type="date" class="form-control" placeholder="User Name" name="date">
															</div>
														</div>
													</div>
													
													<div class="mb-4 main-content-label">Front View</div>
												 
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																	<div class="input-group file-browser">
													<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Avatar" readonly>
													<label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input type="file"  name="photo" accept="image/png, image/jpeg" style="display: none;" multiple>
														</span>
													</label>
												</div>
															</div>
														</div>
													</div>
													<div class="mb-4 main-content-label">Back View</div>
												 
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																	<div class="input-group file-browser">
													<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Avatar" readonly>
													<label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input type="file"  name="photo2" accept="image/png, image/jpeg" style="display: none;" multiple>
														</span>
													</label>
												</div>
															</div>
														</div>
													</div>
													<div class="mb-4 main-content-label">ID Number</div>
												 
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input type="text" class="form-control" placeholder="ID Number"  name="number">
															</div>
														</div>
													</div>
													
													<div class="form-group mb-0">
														<div class="row row-sm">
															
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button type="submit" class="btn btn-primary ml-auto">Verify Now</button><br><br>
																</div>
															</div>
														</div>
													</div>
												 
											</div>
										</div>
										</form>
										@endif
										@if(Auth::user()->verified > 0)
										@if($kyccount > 0)
										<div class="col-xl-12 card">
														<div class="table-responsive">
															<table class="table mb-0 border-top table-bordered text-nowrap">
																<tbody>
																	<tr>
																		<th scope="row">Type</th>
																		<td>{{$kyc->type}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Date</th>
																		<td>{{$kyc->date}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Number</th>
																		<td>{{$kyc->number}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Date Submited</th>
																		<td>{{$kyc->created_at}}</td>
																	</tr>
																	<tr>
																		<th scope="row">Status</th>
																		<td>
																		@if(Auth::user()->verified == 2)
																		<button class="btn btn-success btn-sm">Verified</button>
																		@elseif(Auth::user()->verified == 1)
																		<button class="btn btn-warning btn-sm">Pending</button>
																		@elseif(Auth::user()->verified == 3)
																		<button class="btn btn-danger btn-sm">Rejected</button>
																		@endif
																		</td>
																	</tr>
																	 
																</tbody>
															</table>
														</div>
													</div>
												@endif
												@endif
											<!-- main-profile-body -->
												</div>
												
											</div>
										</div>	
										
										
										
										
										
										
										
										
										</div>
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
