@extends('include.dashboard')
@section('content')
   	<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content wallet-panel">
							<div class="row">
								<div class="col-xl-5">
									<div class="bg-box wallet-balance">
										<div class="title">Your Wallet Accounts</div>
									    <div class="balance-sheet-wrapper">
										 
											<ul>
												<li class="bitcoin-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="40" src="{{asset('assets/images/bank2.png')}}" alt=""> Account Number</span>
														<span class="balance-inquery"><br>
															<span class="currency-title">{{Auth::user()->account_number}}</span>
														</span>
													</a>
												</li>
												
												 
												<li class="ethereum-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="40" src="{{asset('assets/images/bonus.png')}}" alt=""> Bonus</span>
														<span class="balance-inquery"><br>
															<span class="currency-title">{{$basic->currency_sym}}{{number_format(Auth::user()->bonus, $basic->decimal)}}</span> 
														</span>
													</a>
												</li>
												<li class="litecoin-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="34" src="{{asset('assets/images/naira.jpeg')}}" alt=""> Naira Wallet</span>
														<span class="balance-inquery"><br>
															<span class="currency-title">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</span>
															 
														</span>
													</a>
												</li>
											</ul>
											<div class="total-balance clearfix">
												<div class="balance-title">Total Balance ≈</div>
												<div class="balance-figure">{{$basic->currency_sym}}{{number_format(Auth::user()->balance + Auth::user()->bonus, $basic->decimal)}}</div>
											</div>
										</div> <!-- /.balance-sheet-wrapper -->
										<ul class="button-group clearfix">
											<li><button class="btn btn-outline-primary" data-toggle="modal" data-target="#deposit-modal">Deposit</button></li>
											<li><button class="btn btn-outline-primary" data-toggle="modal" data-target="#withdraw-modal"><span></span>Investment</button></li>
											 
										</ul>
									<ul class="button-group clearfix">
											<li><a href="{{route('banktransfer')}}"><button class="btn btn-outline-primary" >Bank Transfer</button></a></li>
											<li><a href="{{route('transfer')}}"><button class="btn btn-outline-primary" ><span></span>User Transfer</button></a></li>
											 
										</ul>
									</div> <!-- /.bg-box -->

									 
								</div> <!-- /.col- -->

								<div class="col-xl-7">
									<ul class="wallet-history clearfix">
										<li>
											<div class="inner-warpper">
												<h6 class="inner-title">Pending Deposit</h6>
												<strong class="figure text-warning">{{$basic->currency_sym}}{{number_format($pdep, $basic->decimal)}}</strong><br>
												<a href="{{route('user.depositLog')}}"><label class="badge btn-info">View Deposit Log</label></a>
											</div> <!-- /.inner-warpper -->
										</li>
										<li>
											<div class="inner-warpper">
												<h6 class="inner-title">Total Withdrawals</h6>
												<strong class="figure text-success">{{$basic->currency_sym}}{{number_format($twith, $basic->decimal)}}</strong><br>
												<a href="{{route('user.withdrawLog')}}"><label class="badge btn-info">View Withdrawal Log</label></a>
											</div> <!-- /.inner-warpper -->
										</li>
										<li>
											<div class="inner-warpper">
												<h6 class="inner-title">Pending withdrawal</h6>
												<strong class="figure text-warning">{{$basic->currency_sym}}{{number_format($pwith, $basic->decimal)}}</strong>
											</div> <!-- /.inner-warpper -->
										</li>
									</ul> <!-- /.wallet-history -->

									<div class="transactions-history bg-box">
										<div class="title tooltip-holder">
											Pending Withdrawals 
											<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button>
										</div>

										<div class="table-responsive transactions-list">
											<table class="table">
												<tbody>
												    @if(count($pwithdrawlog) >0)
												@foreach($pwithdrawlog as $k=>$data)
												    <tr role="row" class="single-list">
												      	<td class="time font-fix">
															<div class="month">{!! date(' M', strtotime($data->created_at)) !!}</div>
															<div class="date">{!! date(' d', strtotime($data->created_at)) !!}</div>
													    </td>
													    <td>
													    	<div class="heading font-fix">{{isset($data->method->name) ? $data->method->name : 'N/A'}}</div>
													      	<div class="value">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
													    </td>
													    <td><a href="{{route('cancelmywithdraw',$data->id)}}"><button class="cancel-transactions bg-warning">Cancel</button></a></td>
													    <td>
													    	<div class="heading font-fix">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
													      	<div class="value text-warning"> Charge: {{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</div>
													    </td>
												    </tr>
													@endforeach
													@else
														<center><b>	No Pending Withdrawal At The Moment </b></center>
													@endif
												</tbody>
											</table>
										</div> <!-- /.table-data -->
									</div> <!-- /.transactions-history -->
									
									<div class="transactions-history bg-box">
										<div class="title tooltip-holder">
											Pending Deposits
											<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button>
										</div>

										<div class="table-responsive transactions-list">
											<table class="table">
												<tbody>
												@if(count($pdepositlog) >0)
												@foreach($pdepositlog as $k=>$data)
												    <tr role="row" class="single-list">
												      	<td class="time font-fix">
															<div class="month">{!! date(' M', strtotime($data->created_at)) !!}</div>
															<div class="date">{!! date(' d', strtotime($data->created_at)) !!}</div>
													    </td>
													    <td>
													    	<div class="heading font-fix">
															@if($data->gateway_id == 0)
															Bank Transfer
															@else
															{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}} @endif</div>
													      	<div class="value">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
													    </td>
													    <td><button class="cancel-transactions">  <i class="text-warning fa fa-spinner fa-pulse"></i></button></td>
													    <td>
													    	<div class="heading font-fix">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
													      	<div class="value  text-warning">Charge: {{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</div>
													    </td>
												    </tr>
													@endforeach
													@else
													<center><b>	No Pending Deposit At The Moment </b></center>
													@endif
												</tbody>
											</table>
										</div> <!-- /.table-data -->
									</div> <!-- /.transactions-history -->
									 
								</div>
							</div> <!-- /.row -->
							
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->
			


			<!-- Deposit  Modal -->
			<div class="modal fade wallet-page-modal" id="deposit-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="wallet-info-tab" data-toggle="tab" href="#wallet-info" role="tab" aria-controls="wallet-info" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="wallet-paymet-success-tab" data-toggle="tab" href="#wallet-paymet-success" role="tab" aria-controls="wallet-paymet-success" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="wallet-info" role="tabpanel" aria-labelledby="wallet-info-tab">
									<div class="theme-modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title">Payment Method</h3>
											<script type="text/javascript">

													function goDoSomething2(identifier){
 
													 document.getElementById("currency").innerHTML = $(identifier).data('currency'); 
													 document.getElementById("currency2").innerHTML = $(identifier).data('currency'); 
													 document.getElementById("name").innerHTML = $(identifier).data('name'); 
												 	 };
												 
													 </script>
											 
								    		<form method="post" action="{{route('deposit.data-insert')}}">
											@csrf
								    			<ul class="wallet-payment-method clearfix">
											<!--	
												  @foreach($gates as $gate)
													<li class="single-checkbox" onclick="goDoSomething2(this);" data-currency="{{$gate->val6}}" data-name="{{$gate->name}}">
														<input value="{{$gate->id}}" name="gateway" type="checkbox" id="pay-{{$gate->id}}" class="pay-check">
														<label for="pay-{{$gate->id}}">
															<img width="50" src="{{url('assets/images')}}/{{$gate->val7}}" alt="">
															<span class="payment-currnecy font-fix">{{$gate->name}}</span>
														</label>
													</li>
													@endforeach !-->
													<li class="single-checkbox" onclick="goDoSomething2(this);" data-currency="{{$basic->currency}}"  data-name="Bank Transfer">
														<input type="checkbox"  name="gateway" value="bank" id="pay-bank" class="pay-check">
														<label for="pay-bank">
															<img src="{{url('assets/images/bank.png')}}" alt="">
															<span class="payment-currnecy font-fix">Bank</span>
														</label>
													</li>
													 
												</ul>
												
												 <script type="text/javascript">
													function myAmount2() { 
													var amount = $('#amount').val() ; 
													  document.getElementById("topay").innerHTML = amount; 
													  
													   
													 };
													</script>
													

												<div class="wallet-amount payment-amount">
													<h3 class="main-title">Amount</h3>
													<div class="input-group-wrapper main-currency">
														<input placeholder="0.00" id="amount" onkeyup="myAmount2()"  type="number" name="amount"  class="cur-check">
						        						<label for="main-cur">  
							        						<span class="currency-name"><a id="currency">{{$basic->currency_sym}}</a></span>
						        						</label>
						        					</div>
						        					 
												</div> <!-- /.wallet-amount -->

												<button type="submit" class="theme-button continue-button">Proceed With Deposit</button>
								    		</form>
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Available Balance</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</div>
								    			<div class="main-balance font-fix">Deposit Wallet Balance</div>

								    			<ul>
								    				<li class="list-item">
								    					<div class="sidebar-title">Payment Gateway</div>
								    					<div class="value font-fix" id="name"> Select Payment Gateway</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Amount</div>
								    					<div class="value font-fix"><a id="topay">0.00</a><a id="currency2"> {{$basic->currency}}</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">STEP 3</div>
								    					<div class="value font-fix">Make Payment</div>
														
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to deposit, you can always add funds to your deposit wallet at any time. Please note, Payment gateway company may charge you a processing fee"><img src="images/help.png" alt="">Deposit Help</button>
								    		</div> <!-- /.summary-content -->
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#deposite-modal -->
 
			

			 
 
			<!-- Withdraw  Modal -->
			 
			<div class="modal fade wallet-page-modal" id="withdraw-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs-two" id="myTabTwo" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="withdraw-panel-tab" data-toggle="tab" href="#withdraw-panel" role="tab" aria-controls="withdraw-panel" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="wallet-pin-tab" data-toggle="tab" href="#wallet-pin" role="tab" aria-controls="wallet-pin" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContentTwo">
								<div class="tab-pane fade show active" id="withdraw-panel" role="tabpanel" aria-labelledby="withdraw-panel-tab">
									<div class="theme-modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title tooltip-holder">
												Withdraw Investment
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to invest, you can always add funds to your investment at any time."><img src="{{url('assets/images/info.png')}}" alt=""></button>
											</h3>
								    	 
								    			<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix"><img width="50" src="{{url('assets/images/about-video-image.jpg')}}" alt=""> Payment Method</span>
																<span class="balance-inquery">
																	<span class="currency-title">Select</span>
																	<span class="total-currency">{{$basic->currency_sym}}0.00</span>
																</span>
													    	</span>
													    </span>
													</button>
													<script type="text/javascript">

													function goDoSomething(identifier){

													 document.getElementById("gateway").value = $(identifier).data('id');
													 var bank = $(identifier).data('id');
													  document.getElementById("time").innerHTML = $(identifier).data('time') + " Day(s)";
													  document.getElementById("charge").innerHTML = "{{$basic->currency_sym}}" + $(identifier).data('fix') + " Flat Rate and " + $(identifier).data('perc') + "% of amount requested";
																										  
													 
													 if(bank ==  1)
													 {
													 document.getElementById("bank").innerHTML = "<div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your Bitcoin Wallet Address</label><input name='walletaddress'  required  class='form-control' type='text'></div> ";}
													  if(bank ==  2)
													 {
													 document.getElementById("bank").innerHTML = "<div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your Paypal Email Address</label><input name='paypaladdress'  required  class='form-control' type='text'></div> ";}
													 if(bank ==  3)
													 {
													 document.getElementById("bank").innerHTML = " <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Bank Name</label><input required name='bankname' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='accountname' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='accountnumber'  required  class='form-control' type='text'></div>";}
													if(bank ==  4)
													 {
													 document.getElementById("bank").innerHTML = " <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Cashapp Name</label><input required name='cashname' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='accountnumber' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='accountname'  required  class='form-control' type='text'></div>";}

													 };
												 
													 </script>
													 <script type="text/javascript">
													function myAmount() {
													 var amount = $('#mySelect').val() ; 

													  document.getElementById("amounted").value =  amount; 
													 };
													</script>
													 
													<div class="dropdown-menu dropdown-menu-right">
													    <div class="balance-sheet-wrapper">
															<ul>
															@foreach($withdrawgate as $gate)
																<li onclick="goDoSomething(this);" 
 																data-perc="{{$gate->percent}}"   data-fix="{{$gate->fix}}"   data-time="{{$gate->duration}}"  data-id="{{$gate->id}}" class="bitcoin-method clearfix select-currnecy-list">
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix">
																		@if($gate->id == 1)
																		<img width="50" src="{{url('assets/images/bitcoin2.png')}}" alt=""> 
																		@elseif($gate->id == 2)
																		<img width="80" src="{{url('assets/images/pay-c.png')}}" alt=""> 
																		@elseif($gate->id == 3)
																		<img width="80"  src="{{url('assets/images/bank.png')}}" alt=""> 
																		@elseif($gate->id == 4)
																		<img width="50" src="{{url('assets/images/cash.jpg')}}" alt=""> 
																	
																		@endif
																		{{$gate->name}}</span>
																		 
																	</div>
																</li>
															@endforeach
																 
															</ul>
															
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
													
												</div> <!-- /.withdraw-method-dropdown -->
										<br>
											
<script>
function myFunctioned() { 
 var walleted = $("#mySelect option:selected").attr('data-name');  
 var id = $("#mySelect option:selected").attr('data-id');  
   
 document.getElementById("walletname").innerHTML = walleted; 
 document.getElementById("walletid").value = id; 
 };
</script>
										<h3 class="main-title">Wallet</h3>
								 <select   id="mySelect" onchange="myFunctioned()"   class="form-control" tabindex="1">
							 
								    <option data-name="Investment Wallet" data-id="2"  >Investment Earning Wallet</option>
								 
								    
						    	</select><br>
												
												
												
												 
												 	 

												<div class="wallet-amount withdraw-amount">
													<h3 class="main-title">Amount</h3>
													<div class="row">
														<div class="col-sm-12">
															<div class="input-group-wrapper main-currency">
																<input type="checkbox" class="cur-check">
								        						<label for="wdrw-main-cur">
								        							<span class="currency-icon">{{$basic->currency_sym}}&nbsp;&nbsp;</span>
									        						<input type="number"  id="mySelect" onkeyup="myAmount()" placeholder=" 0.00" >
									        						<span class="currency-name">{{$basic->currency}}</span>
								        						</label>
								        					</div>
														</div> <!-- /.col- -->

														 
													</div> <!-- /.row -->
												</div> <!-- /.wallet-amount -->

												<button   class="theme-button continue-button-two"><span></span>Withdraw Fund  </button>
								    		 
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Available Fund</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}{{number_format($investment->balance, $basic->decimal)}}</div>
								    			<div class="main-balance font-fix">Investment Earning Balance</div>

												
											 

								    			<ul>
								    				<li class="list-item">
								    					<div class="sidebar-title">From</div>
								    					<div class="value font-fix"><img src="{{url('assets/images/wallet.png')}}" alt=""><a id="walletname"> No Wallet Selected</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Charges</div>
								    					<div class="value font-fix" id="charge">0.00</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Processing Time</div>
								    					<div class="value font-fix" id="time">0.0 hours</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that you will be charged a one time withdrawal fee according to the payment method you select."><img src="{{url('assets/images/help.png')}}" alt="">Withdraw Help</button>
								    		 
								    		</div> <!-- /.summary-content -->
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="wallet-pin" role="tabpanel" aria-labelledby="wallet-pin-tab">
								    <div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button-two"><img src="{{url('assets/images/left-arrow.png')}}" alt=""> &nbsp;</a></h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>					

								    <div class="modal-body"> 
										<form method="post" class="withdraw-pin-form" action="{{route('withdraw.depo') }}">
										@csrf
							        		
							        		
							        		 <input name="method_id" hidden id="gateway"> 
											  <input name="amount" hidden id="amounted"> 
											  <br>
											  
											  <h3 class="title font-fix" id="bank">You must select a withdrawal method before you proceed from this page. Else we wont be able to pay you your earnings</h3> 
											  <br>
											  <h3 class="title font-fix">Enter your withdraw PIN</h3>
											  <input name="pin" type="password" placeholder="****" maxlength="4" class="font-fix">
											  <hr>
											  <input id="walletid" hidden name="wallet">
											  <div class="pin-attempt-text">Your default password is 1234, <br> ensure to change it from the security settings</div>
							        		<button type="submit" class="theme-button"><span></span>Confirm</button>
							        	</form>
							      	</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#withdraw-modal -->


			<br><br><br><br><br><br 
			@endsection
