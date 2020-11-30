@extends('include.dashboard')
@section('content')
  <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content wallet-panel">
							<div class="row">
								<div class="col-xl-12">
									<div class="bg-box wallet-balance">
										<div class="title">Please Continue To Make Payment</div>
									   <!-- Withdraw  Modal -->
			<div class="msodal  wallet-page-modal" id="withdraw-modal" tabindex="-1" role="dialog"  >
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
									 

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title tooltip-holder">
												Pay Bill
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that you will be charged a one time fee of {{$basic->currency_sym}}{{$basic->electricityfee}} for transaction processing.."><img src="{{url('assets/images/info.png')}}" alt=""></button>
											</h3> 
											<form method="post"  class="withdraw-action-form" action="{{route('paypower') }}">
										    @csrf
								    			<div class="dropdown withdraw-method-dropdown">
													<div class="  withdraw-dropdown-button" >
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix">
																	 
																		<img width="50" src="{{url('assets/images')}}/{{App\Power::whereBillercode($meter)->first()->image}}" alt=""> 
																	 
																{{$type}} METER</span>
															 
													    	</span>
													    </span>
													</div>
													
													<script type="text/javascript">

													function goDoSomething(identifier){
  
													 document.getElementById("type").value = $(identifier).data('type'); 
													  

													 };
												 
													 </script>
													
													

												 
												</div> <!-- /.withdraw-method-dropdown -->
												
												 
												 
												 <script type="text/javascript">
													function myAmount() {
													 var amount2 = $('#myPhone').val() ; 
													 var amount = +amount2 + +{{$basic->electricityfee}} ; 

													  document.getElementById("amount").innerHTML =  amount;
													  document.getElementById("amount2").value =  amount2; 
													   
													 };
													</script>

												<div class="wallet-amount withdraw-amount">
													<h3 class="main-title">Amount</h3>
													<div class="row">
														<div class="col-sm-6">
															<div class="input-group-wrapper main-currency">
																<input type="checkbox" class="cur-check">
								        						<label for="wdrw-main-cur">
								        							<span class="currency-icon">{{$basic->currency_sym}}</span>
									        						<input type="number" id="myPhone" onkeyup="myAmount()" >
									        						<span class="currency-name">{{$basic->currency}}</span>
								        						</label>
								        					</div>
														</div> <!-- /.col- -->
													
														<div class="col-sm-6">
															<div class="input-group-wrapper">
								        						<input type="checkbox" class="cur-check">
								        						<label for="wdrw-crypto-cur">
								        							<input type="number" disabled placeholder="{{$basic->currency_sym}}{{$basic->electricityfee}}"   class="cryptocurrency-amount" id="wdrw-crypto-cur">
								        							<span class="currency-name">Fee</span>
								        						</label>
								        					</div>
														</div>
													</div> <!-- /.row -->
												</div> <!-- /.wallet-amount -->

												<p href="#" class="theme-button continue-button-two"><span></span>Make Payment  </p>
								    		 
								    	</div> <!-- /.details-option -->
										
												
													 


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Payment Summary</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}<a id="amount">0.00</a></div>
								    		 
								    			<ul><br>
								    				<li class="list-item">
								    					<div class="sidebar-title">Company</div>
								    					<div class="value font-fix">
													 
																		<img width="50" src="{{url('assets/images')}}/{{App\Power::whereBillercode($meter)->first()->image}}" alt=""> {{App\Power::whereBillercode($meter)->first()->name}}
																	 </div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Customer</div>
								    					<div class="value font-fix">{{$name}}</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">
													Meter Number
														</div>
								    					<div class="value font-fix">{{$number}}</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that you will be charged a one time fee of {{$basic->currency_sym}}{{$basic->electricityfee}} for transaction processing."><img src="{url('assets/images/help.png')}}" alt="">Subscription Help</button>
								    		</div> <!-- /.summary-content -->
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="wallet-pin" role="tabpanel" aria-labelledby="wallet-pin-tab">
								    <div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button-two"><img src="{{url('assets/images/left-arrow.png')}}" alt=""> &nbsp;</a></h3>
								        
								    </div>					

								    <div class="modal-body">
							        	<div class="withdraw-pin-form">
							        		<h3 class="title font-fix">Enter your transaction PIN</h3>
											<input hidden name="meter" value="{{$meter}}">
											<input hidden name="number" value="{{$number}}"> 
											<input  name="amount" hidden id="amount2">
											<input  name="type" hidden value="{{$type}}">
											<input  name="name" hidden value="{{$name}}">
							        		<input type="tel" name="password" placeholder="****" maxlength="4" class="font-fix">
							        	 
							        		<button class="theme-button"><span></span>Confirm</button></div>
							        	</form>
							      	</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#withdraw-modal -->
										 
									</div> <!-- /.bg-box -->

									 
								</div> <!-- /.col- -->
								
								
								
								
								
								
								 

								
							</div> <!-- /.row -->
							
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->



			 


@stop
