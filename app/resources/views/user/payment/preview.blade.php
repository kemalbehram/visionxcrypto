@extends('include.userdashboard')
@section('content')
	<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Preview Payment</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Pages</a></li>
									<li class="breadcrumb-item active" aria-current="page">Invoice</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="d-lg-flex">
											<h2 class="main-content-label mb-1">Preview Payment</h2>
											<div class="ml-auto">
												<p class="mb-1"><span class="font-weight-bold">Payment Gateway :</span> Bank Deposit</p> 
											</div>
										</div>
										<hr class="mg-b-40">
										<div class="table-responsive mg-t-40">
											<table class="table table-invoice table-bordered">
												<thead>
													<tr>
														<th class="wd-20p">#</th>
														<th class="wd-40p">Description</th> 
														<th class="tx-right">Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td class="tx-12">Amount</td> 
														<td class="tx-right">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</td>
													</tr>
													<tr>
														<td>2</td>
														<td class="tx-12">Stamp duty charge</td> 
														<td class="tx-right">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</td>
													</tr>
													<tr>
														<td>3</td>
														<td class="tx-12">Total Amount</td> 
														<td class="tx-right">{{$basic->currency_sym}}{{number_format($data->charge + $data->amount, $basic->decimal)}}</td>
													</tr>
													  
															 
													 
													 
												</tbody>
											</table>
											<div class="invoice-notes">
																<label class="main-content-label tx-13">Notes</label>
																<p>Make Payment To The Account Number on Rubies Bank and your deposit wallet will be credited instantly </p>
															</div><!-- invoice-notes -->
                                                            
                                                           <br><br>
                                                           
                                                           <div class="invoice-notes">
																<label class="main-content-label tx-13">Notes</label>
																<p class="text-danger"> Bank Transfers from third party accounts will be applied to your account after 24hrs. For instant Transactions, please send funds from accounts owned by you. </p>
															</div><!-- invoice-notes -->
													
<div class="fund-information-table table-responsive">
								<table class="table">
									<tbody>
							 
										 	
									    <tr>
										    <td>
										   <div class="title"><b>Bank Name</b></div>
										    	<div class="text font-fix"><b>Rubies Bank</b></div>
										    </td>
										    <td>
										    	<div class="title"><b>Account Number</b></div>
										    	<div class="text font-fix"><b>{{auth::user()->account_number}}</b></div>
										    </td> 
									    </tr> 
																	
									</tbody>
								</table>
							</div> <!-- /.fund-information-table -->	 
										</div>
									</div>
									 <div class="card-footer text-right">
									
										<a href="{{route('deposit')}}"><button type="button" class="btn ripple btn-secondary mb-1"><i class="fe fe-x-circle mr-1"></i> Cancel Deposit</button> </a> 
										<!--<button type="button" class="btn ripple btn-primary mb-1"><i class="fe fe-credit-card mr-1"></i> Pay Invoice</button>
										<button type="button" class="btn ripple btn-info mb-1" onclick="javascript:window.print();"><i class="fe fe-printer mr-1"></i> Print Invoice</button> -->
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->

@endsection
