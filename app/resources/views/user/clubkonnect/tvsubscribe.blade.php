@extends('include.dashboard')
@section('content')
  <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content wallet-panel">
							<div class="row">
								<div class="col-xl-12">
									<div class="bg-box wallet-balance">
										<div class="title">Please Select Your Cable TV Bouquet</div>
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
												Select Bouquet
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that you will be charged a one time fee of {{$basic->currency_sym}}{{$basic->decoderfee}} for transaction processing.."><img src="{{url('assets/images/info.png')}}" alt=""></button>
											</h3> 
											<form method="post"  class="withdraw-action-form" action="{{route('paydecoder') }}">
										    @csrf
								    			<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix">
																		@if($decoder == "dstv")
																		<img width="50" src="{{url('assets/images/dstv.png')}}" alt=""> 
																		@elseif($decoder == "gotv")
																		<img width="50" src="{{url('assets/images/gotv.jpg')}}" alt=""> 
																		@else($decoder == "startimes")
																		<img width="50" src="{{url('assets/images/startime.jpg')}}" alt=""> 
																		@endif
																Select Bouquet</span>
																<span class="balance-inquery">
																	<span class="currency-title">{{$basic->currency_sym}}0.00</span> 
																</span>
													    	</span>
													    </span>
													</button>
													
													

													<div class="dropdown-menu dropdown-menu-right" >
													    <div class="balance-sheet-wrapper" style="overflow-y: scroll; height:400px;">
															<ul>
															@foreach($plans[$deco][0]['PRODUCT'] as $k=>$data)
																<li class="bitcoin-method clearfix select-currnecy-list"   onclick="goDoSomething(this);" data-plan="{{$data['PACKAGE_ID']}}" data-price="{{$data['PACKAGE_AMOUNT']}}"  data-amount="{{$basic->currency_sym}}{{$data['PACKAGE_AMOUNT']}}" >
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix">
																		@if($decoder == "dstv")
																		<img width="50" src="{{url('assets/images/dstv.png')}}" alt=""> 
																		@elseif($decoder == "gotv")
																		<img width="50" src="{{url('assets/images/gotv.jpg')}}" alt=""> 
																		@else($decoder == "startimes")
																		<img width="50" src="{{url('assets/images/startime.jpg')}}" alt=""> 
																		@endif
																		{{$data['PACKAGE_ID']}} </span>
																		<span class="balance-inquery">
																			<span class="currency-title">{{$basic->currency_sym}}{{$data['PACKAGE_AMOUNT']}}</span> 
																		</span>
																	</div>
																</li>
															@endforeach 
															</ul>
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
												</div> <!-- /.withdraw-method-dropdown -->
												
													<script type="text/javascript">

													function goDoSomething(identifier){
 
													 document.getElementById("plan").innerHTML = $(identifier).data('plan'); 
													 document.getElementById("package").value = $(identifier).data('plan'); 
													 document.getElementById("price").value = $(identifier).data('price'); 
													 document.getElementById("total").innerHTML = (+$(identifier).data('price') + +{{$basic->decoderfee}}); 
													 document.getElementById("totall").value = (+$(identifier).data('price') + +{{$basic->decoderfee}}); 
													 document.getElementById("amount").innerHTML = (+$(identifier).data('price') + +{{$basic->decoderfee}}); 
													  
													  

													 };
												 
													 </script>
												<div class="withdraw-address">
													<h3 class="main-title tooltip-holder">
														@if($decoder == "dstv")
																		Smartcard Number
																		@elseif($decoder == "gotv")
																		IUC Number
																		@else($decoder == "startimes")
																		Decoder Number
														@endif
														
													</h3>
													<textarea disabled placeholder="{{$number}}"></textarea>
												</div>

												<div class="wallet-amount withdraw-amount">
													<h3 class="main-title">Amount</h3>
													<div class="row">
														<div class="col-sm-6">
															<div class="input-group-wrapper main-currency">
																<input type="checkbox" class="cur-check">
								        						<label for="wdrw-main-cur">
								        							<span class="currency-icon">{{$basic->currency_sym}}</span>
									        						<input type="number" disabled id="price" value="0.00">
									        						<span class="currency-name">Price</span>
								        						</label>
								        					</div>
														</div> <!-- /.col- -->
													
														<div class="col-sm-6">
															<div class="input-group-wrapper">
								        						<input type="checkbox" class="cur-check">
								        						<label for="wdrw-crypto-cur">
								        							<input type="number" disabled placeholder="{{$basic->currency_sym}}{{$basic->decoderfee}}"   class="cryptocurrency-amount" id="wdrw-crypto-cur">
								        							<span class="currency-name">Fee</span>
								        						</label>
								        					</div>
														</div>
													</div> <!-- /.row -->
												</div> <!-- /.wallet-amount -->

												<p href="#" class="theme-button continue-button-two"><span></span>Make Payment - {{$basic->currency_sym}}<a id="total">0.00</a></p>
								    		 
								    	</div> <!-- /.details-option -->
										
												
													 


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Bouquet Summary</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}<a id="amount">0.00</a></div>
								    			<div class="main-balance font-fix"><a id="plan">Please Select A Bouquet</a></div>

								    			<ul>
								    				<li class="list-item">
								    					<div class="sidebar-title">Decoder</div>
								    					<div class="value font-fix">
														@if($decoder == "dstv")
																		<img width="50" src="{{url('assets/images/dstv.png')}}" alt=""> 
																		@elseif($decoder == "gotv")
																		<img width="50" src="{{url('assets/images/gotv.jpg')}}" alt=""> 
																		@else($decoder == "startimes")
																		<img width="50" src="{{url('assets/images/startime.jpg')}}" alt=""> 
																		@endif
														@if($decoder == "dstv")
																		DSTV
																		@elseif($decoder == "gotv")
																		GOTV
																		@else($decoder == "startimes")
																		STARTIMES
														@endif</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Customer</div>
								    					<div class="value font-fix">{{$name}}</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">
														@if($decoder == "dstv")
																		Smartcard Number
																		@elseif($decoder == "gotv")
																		IUC Number
																		@else($decoder == "startimes")
																		Decoder Number
														@endif
														</div>
								    					<div class="value font-fix">{{$number}}</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that you will be charged a one time fee of {{$basic->currency_sym}}{{$basic->decoderfee}} for transaction processing."><img src="{url('assets/images/help.png')}}" alt="">Subscription Help</button>
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
											<input hidden name="decoder" value="{{$decoder}}">
											<input hidden name="number" value="{{$number}}">
											<input  name="package" hidden id="package">
											<input  name="amount" hidden id="totall">
							        		<input type="tel" name="password" placeholder="0000" maxlength="4" class="font-fix">
							        	 
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
