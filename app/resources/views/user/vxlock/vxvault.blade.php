@extends('include.userdashboard')
@section('content')
  
  

		<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Coin Lock</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Coin Lock</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									<button type="button"  data-toggle="modal" data-target="#addnewlock" class="btn btn-primary my-2 btn-icon-text">
									  <i class="si si-login mr-2"></i> Create new lock
									</button>
								</div>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
						    
						    @if(Session::has('success'))
						    <div class="alert alert-success">
                              <strong>Success!</strong> {{ Session::get('success') }}
                            </div>  
                            
                              @endif
						    @if(Session::has('danger'))
                            <div class="alert alert-danger">
                              <strong>Error!</strong> {{ Session::get('danger') }}
                            </div>  
                            
                              @endif
                            						    
                            
						    @foreach($vault as $k=>$data)
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
								<div class="card custom-card wallet">
											<div class="card-body">
												<label class="main-content-label mb-2">COIN LOCK</label>
												<br>
											 
											 
												   @if($data->status == 1 && $data->paid != 1)
                                                      <span class="text-muted">Available In {{ Carbon\Carbon::parse($data->expire)->diffForHumans() }}</span>
                                                   @endif
                                                  

												<br>
												<div class="d-flex mt-4">
													<img src="{{url('/')}}/assets/assets/img/svgs/crypto-currencies/btc.svg" class="wd-40 ht-40 mr-3 my-auto" alt="">
													<div class="">
														<span class="text-uppercase tx-14 mt-4 text-muted">LOCKED COIN</span>
														<div class="d-flex my-auto"><h4 class="mt-1 mb-0">{{$data->btc}}</h4><span class="mt-auto ml-2">BTC</span></div>
													</div>
												</div>
												<br><br>
													<i class="pe-7s-repeat my-3 mt-xl-0 mb-xl-0 tx-30"></i>
												<br><br>
												<div class="row">
													<div class="col-md-6">
														<p class="text-uppercase tx-13 text-muted mb-1">NGN</p>
														<div class="d-flex my-auto">
														<span class="my-auto ml-2">₦</span>
															<h5 class="my-auto">{{number_format($data->amount,2)}}</h5>
														</div>
													</div>
													<div class="col-md-6 mt-3 mt-md-0">
														<p class="text-uppercase tx-13 text-muted mb-1">USD</p>
														<div class="d-flex my-auto">
														<span class="my-auto ml-2">$</span>
															<h5 class="my-auto">{{$data->usd}}</h5>
														</div>
													</div>
												</div>
												<div class="row mt-4">
												    @if(\Carbon\Carbon::Now() < $data->expire && $data->status == 1 && $data->paid != 1)
													<div class="col-6">
													    	<a href="#" class="btn btn-warning btn-lg btn-block mt-4"><li class="fa fa-lock"></li>&nbsp; locked</a>
													</div>
													
													@elseif($data->status == 2 )
													<div class="col-6">
													    	<a href="#" class="btn btn-primary btn-sm btn-block"><li class="fa fa-spinner fa-spin"></li>&nbsp; Pending Withdrawal</a>
													</div>
													@elseif($data->status == 4)
													<div class="col-6">
													    	<a href="#" class="btn btn-danger btn-sm btn-block"><li class="fa fa-trash"></li>&nbsp; Withdrawal Rejected</a>
													</div>
													@elseif($data->status == 3 && $data->paid ==  1 )
													<div class="col-6">
													    	<a href="#" class="btn btn-success btn-sm btn-block"><li class="fa fa-check"></li>&nbsp; Paid Out</a>
													</div>
												 
													
													@elseif(\Carbon\Carbon::Now() > $data->expire  && $data->status == 1 && $data->paid != 1)
													<div class="col-6">
													    
													    <button class="btn btn-block btn-success" data-target="#modalwithdraw{{$data->id}}" data-toggle="modal">Withdraw</button>
													</div>
													<div class="col-6">
														<button class="btn btn-block btn-outline-warning" data-target="#modalrelock{{$data->id}}" data-toggle="modal">Relock</button>
													</div>
													@endif
												</div>
											</div>
										</div>
							       </div>
							<!-- COL END -->
							
							
                    							<!-- Withdraw Modal alert message -->
                    			<div class="modal" id="modalwithdraw{{$data->id}}">
                    				<div class="modal-dialog modal-dialog-centered" role="document">
                    					<div class="modal-content tx-size-sm">
                    						<div class="modal-body tx-center pd-y-20 pd-x-20">
                    							<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                    							<h4 class="tx-success tx-semibold mg-b-20">Congratulations!</h4>
                    							<p class="mg-b-20 mg-x-20">Your fund is available for withdrawal. Click on the 'Continue' button to initiate your withdrawal.<br><b>Note: A withdrawal ticket will be created in view of your request automaticaly and your fund is disbursed in
                    							less than 24 hours</b> <br>Thank you for trusting {{$basic->sitename}}</p>
                    								<form role="form" method="POST"  action="{{ route('vxvaultwithdraw') }}">
                    										{{ csrf_field() }}
                                                    <input name="wallet" placeholder="Enter Your BTC Wallet Address" class="form-control">
                                                    <br>
                                                    <input name="confirm_wallet" placeholder="Confirm Your BTC Wallet Address" class="form-control">
                    									<br>
                                                    <input name="password" placeholder="Enter Transaction Password" class="form-control">
                    										<input name="trx" hidden value="{{$data->code}}"><br>
                    										<button type="submit" class="btn ripple btn-success pd-x-25">Confirm </button>
                    								</form>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    				<!-- Relock Modal alert message -->
                    			<div class="modal" id="modalrelock{{$data->id}}">
                    				<div class="modal-dialog modal-dialog-centered" role="document">
                    					<div class="modal-content tx-size-sm">
                    						<div class="modal-body tx-center pd-y-20 pd-x-20">
                    							<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon ion-ios-lock tx-100 tx-warning lh-1 mg-t-20 d-inline-block"></i>
                    							<h4 class="tx-success tx-semibold mg-b-20">Relock Vault!</h4>
                    							
                    							<form role="form" method="POST"  action="{{ route('relockvault') }}">
										{{ csrf_field() }}

										        <input name="trx" hidden value="{{$data->code}}">
                    							<p class="mg-b-20 mg-x-20">Dear {{Auth::user()->username}}, you have opted to relock your vault. Please enter the numbers of months you want to relock your vault and click on the 
                    							"Relock Now" button to proceed with lock</p>
                    							<input name="months" type="number" placeholder="Number of Months" class="form-control input">
                    							<br>
                    							<button type="submit" class="btn ripple btn-success pd-x-25" type="button">Relock Now</button>
                    						</div>
                    						</form>
										
                    					</div>
                    				</div>
                    			</div>
                    			
						@endforeach
						@if(count($vault) < 1)
							<div class="col-xxl-3 col-xl-6 col-md-12 col-lg-6">
								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-1">
										<label class="main-content-label mb-2 pt-1 text-warning">VX VAULT</label>
										</div><br>
									<div class="card-body pt-0">
										<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/img/pngs/loadicon.gif">
										<div class="card-header border-bottom-0 pb-1 text-center font-weight-bold text-warning">
										<p>You have no bitcoin in your vault at the moment. Please click on the 'create new lock' button to start</p>
										</div>
									</div>
								</div>
							</div>
						@endif
					 
						 
						</div>
						<!-- End Row -->

						

						<!-- row opened -->
						<div class="row row-sm">
							<div class="col-xxl-3 col-xl-6 col-md-12 col-lg-6">
								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-1">
										<label class="main-content-label mb-2 pt-1 text-warning">Built For Convenience</label>
										</div><br>
									<div class="card-body pt-0">
										<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/img/pngs/bankvault.png">
										<div class="card-header border-bottom-0 pb-1 text-center font-weight-bold text-warning">
										<p>Zero% charge on deposit | processing | withdrawal.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xxl-3 col-xl-6 col-md-12 col-lg-6">
								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-1">
										<label class="main-content-label mb-2 pt-1 text-warning">Lock Withdrawal Transation</label>
										</div><br>
									<div class="card-body pt-0">
									    @if(count($withdraw) > 0)
									    <table class="table-responsive table table-striped table-bordered text-nowrap" >
												<thead>
												   
													<tr>
														<th>Vault ID</th>
														<th>USD</th>
														<th>BTC</th>
														<th>NGN</th>
														<th>Payment BTC Address</th>
														<th>Status</th>
													 
													</tr>
												
												</thead>
												<tbody>
												     @foreach($withdraw as $k=>$data)
													<tr>
														<td>{{$data->code}}</td>
														<td>${{App\Vxvault::whereCode($data->code)->first()->usd ?? "0.00"}}</td>
														<td>{{App\Vxvault::whereCode($data->code)->first()->btc ?? "0.00"}}BTC</td>
														<td>{{$basic->currency_sym}}{{App\Vxvault::whereCode($data->code)->first()->amount ?? "0.00"}}</td>
													    <td>{{$data->address}}</td>
														@if($data->status == 1)
														<td><button class="btn btn-sm btn-success">Paid</button></td>
														@elseif($data->status == 0)
														<td><button class="btn btn-sm btn-warning">Pending</button></td>
														@elseif($data->status == 2)
														<td><button class="btn btn-sm btn-danger">Declined</button></td>
														@endif
													</tr>
													@endforeach
												 
												</tbody>
											</table>
											{{$withdraw->links()}}
											@else
										<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/img/pngs/loadicon.gif">
										<div class="card-header border-bottom-0 pb-1 text-center font-weight-bold text-warning">
										<p>You have no VX-Vault Withdrawal transactions.</p>
										</div>
										@endif
									</div>
								</div>
							</div>
							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
			
			
<!-- New VX Modal --> 
			

			<div class="modal" id="addnewlock">
				<div class="modal-dialog" role="document">
				    
				  
				    
					<div class="modal-content modal-content-demo">
						 	<div class="modal-body">
						 	    
						 	      @if(Auth::user()->phone_verify < 1)
						 	      
						 	      
<div class="alert alert-danger">
  <strong>Hello! </strong> It appears that you have not verified your Phone Number. Please proceed to verify your phone number and come back here to create your new vault
</div>
				    
				    @elseif(Auth::user()->email_verify < 1)
				    
				    					 	      
<div class="alert alert-danger">
  <strong>Hello! </strong> It appears that you have not verified your email address. Please proceed to verify your email and come back here to create your new vault
</div>
				    
				    @elseif(Auth::user()->bvn_verify < 1)
				    					 	      
<div class="alert alert-danger">
  <strong>Hello! </strong> It appears that you have not enrolled for BVN on our platform. Please proceed to verify your BVN and come back here to create your new vault
</div>
				    
				    @elseif(Auth::user()->verified < 2)
				    
				    					 	      
<div class="alert alert-danger">
  <strong>Hello! </strong> It appears that you have not verified you KYC status. Please proceed to verify your KYC and come back here to create your new vault
</div>
				    
				    @elseif(Auth::user()->bankyes < 1)
				    
				    					 	      
<div class="alert alert-danger">
  <strong>Hello! </strong> It appears that you have not verified you Bank Account Details. Please proceed to verify your Bank Account Number and come back here to create your new vault
</div>
				    
				    @else
				    
				    <form  action="{{route('lockfund')}}" method="post">
			{{ csrf_field() }}
							<div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
									<div class="header-text mb-0">
										<div class="container-fluid p-5">
											<div class="text-left text-white background-text">
												<cemter><h3 class="mb-3 font-weight-semibold">New VX Lock</h3></cemter>
												
											</div>
											<div class="row">
															<div class="form row mx-auto justify-content-center ">

																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
                                                                    <label class="text-white">Enter Amount</label>
																	<input name="amount" type="number" placeholder="$0.00"  class="form-control mb-4 mb-lg-0" id="text6">
																</div>
															
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																    <label class="text-white">VX Lock Cycle</label>
																	 <select class="form-control" name="tenure">
                                                                        <option value="1">Monthly</option>
                                                                    </select>
																</div>
																
																
																<div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
																    <br>
                                                                    <label class="text-white">Enter Lock Tenure In Months</label>
																	<input name="duration" type="number" placeholder="Tenure"  class="form-control mb-4 mb-lg-0" id="text6">
																</div>
																
																
																<div class="text-center background-text">
            														<button type="submit" class="btn btn-success pl-6 pr-6 pt-2 pb-2 mx-auto float-left mt-5">Proceed With Lock</button>
            													</div>
															</div>
														
													
												</div>
											</div>
										</div>
									</div><!-- /header-text -->
								</div>

						</form>
						
						@endif
						</div>
					</div>
				</div>
			</div>
		
			<!-- End VX modal -->
@stop
