@extends('include.dashboard')

@section('content')

	<!-- ******************** Dashboard Body Wrapper *********************** -->
				<div class="container">
					<div id="dashboard-main-body" class="clearfix">
 


						<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content investment-panel">
							<ul class="investment-history clearfix">
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Sales</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}{{number_format($totalsell, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Pending Sales</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}{{number_format($pendsell, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Purchase</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}{{number_format($totalbuy, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Pending Purchase</h6>
										<div class="figure total-earn">{{$basic->currency_sym}}{{number_format($pendbuy, $basic->decimal)}}</div>
									</div> <!-- /.inner-warpper -->
								</li>
							</ul> <!-- /.investment-history -->

							<div class="investment-list-item-wrapper">
								<div class="item-filter-header clearfix">
									<h6 class="title">Purchase Log </h6>
									<ul class="right-button-group">
										<li>
											<select class="theme-select-dropdown" name="Status">
												<option value="AL">Status</option>
											  <option value="Active">Active</option>
											  <option value="Waiting">Waiting</option>
											</select>
										</li>
										<li><button type="button" class="new-invest-button" data-toggle="modal" data-target="#new-investment-modal">+ Buy</button></li> 
									</ul> <!-- /.right-button-group -->
								</div> <!-- /.item-filter-header -->

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											  @if(count($buy) >0)
										    @foreach($buy as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
														@if($data->status == 2)
					        							<div class="value font-fix payment-status paid">Approved</div>
														@elseif($data->status == 1)
					        							<div class="value font-fix payment-status open">Pending</div>
														@endif
												    </td>
												    <td>
												    	<div class="title">Units</div>
												      	<div class="value font-fix">{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}</div>
												    </td>
												    <td>
												      	<div class="title">Currency Type</div>
												      	<div class="value font-fix"> {{isset($data->currency->name) ? $data->currency->name : 'N/A'}}</div>
												    </td>
												    <td>
												      	<div class="title">Trade Date</div>
												      	<div class="value font-fix">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">${{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
											    </tr>
												@endforeach
											@else
											<b>No Transaction Log At The Moment</b>
											@endif

											     
											</tbody>
										</table>
									</div> <!-- /.table-data -->
									{{$buy->links()}}
								</div> <!-- /.payout-single-table -->

								 
							</div> <!-- /.investment-list-item-wrapper -->
							
							
							
							<div class="investment-list-item-wrapper">
								<div class="item-filter-header clearfix">
									<h6 class="title">Sales Log </h6>
									<ul class="right-button-group">
										<li>
											<select class="theme-select-dropdown" name="Status">
												<option value="AL">Status</option>
											  <option value="Active">Active</option>
											  <option value="Waiting">Waiting</option>
											</select>
										</li> 
										<li><button type="button" class="new-invest-button" data-toggle="modal" data-target="#investment-modal">+ Sell</button></li>
									</ul> <!-- /.right-button-group -->
								</div> <!-- /.item-filter-header -->

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											  @if(count($sell) >0)
											  @foreach($sell as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
														@if($data->status == 2)
					        							<div class="value font-fix payment-status paid">Approved</div>
														@elseif($data->status == 1)
					        							<div class="value font-fix payment-status open">Pending</div>
														@endif
												    </td>
												    <td>
												    	<div class="title">Units</div>
												      	<div class="value font-fix">{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}</div>
												    </td>
												    <td>
												      	<div class="title">Currency Type</div>
												      	<div class="value font-fix"> {{isset($data->currency->name) ? $data->currency->name : 'N/A'}}</div>
												    </td>
												    <td>
												      	<div class="title">Trade Date</div>
												      	<div class="value font-fix">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">${{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
											    </tr>
												@endforeach
											@else
											<b>No Transaction Log At The Moment</b>
											@endif

											     
											</tbody>
										</table>
									</div> <!-- /.table-data -->
									{{$sell->links()}}
								</div> <!-- /.payout-single-table -->
								 
							</div> <!-- /.investment-list-item-wrapper -->
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->

					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->



 


			<!-- New Investment  Modal -->
			<div class="modal fade new-invest-modal" id="new-investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs-two" id="myTabTwo" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="start-invest-tab" data-toggle="tab" href="#start-invest" role="tab" aria-controls="start-invest" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="new-invest-name-tab" data-toggle="tab" href="#new-invest-name" role="tab" aria-controls="new-invest-name" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-time-frame-tab" data-toggle="tab" href="#invest-time-frame" role="tab" aria-controls="invest-time-frame" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-payout-frequency-tab" data-toggle="tab" href="#invest-payout-frequency" role="tab" aria-controls="invest-payout-frequency" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="new-invest-amount-tab" data-toggle="tab" href="#new-invest-amount" role="tab" aria-controls="new-invest-amount" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-payment-method-tab" data-toggle="tab" href="#invest-payment-method" role="tab" aria-controls="invest-payment-method" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="final-check-tab" data-toggle="tab" href="#final-check" role="tab" aria-controls="final-check" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="new-invest-ready-tab" data-toggle="tab" href="#new-invest-ready" role="tab" aria-controls="new-invest-ready" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="cancel-invest-tab" data-toggle="tab" href="#cancel-invest" role="tab" aria-controls="cancel-invest" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContentTwo">
								<div class="tab-pane fade show active default-text-wrapper" id="start-invest" role="tabpanel" aria-labelledby="start-invest-tab">
									<div class="theme-modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>

								    <div class="modal-body">
				        				<img width="100" src="{{asset('assets/images/coins2.png')}}" alt="" class="coin">
				        				<h4 class="title font-fix">Buy Crypto Assets in 4 <br>simple steps with {{$basic->sitename}}!</h4>
				        				<p>Its never been so easy to buy crypto asset, in just 3 minutes,  Enjoy the freedom of crypto asset trade.</p>
				        				<a href="#" class="theme-button continue-button-two"><span></span>Get Started</a>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
																
								 
													 


								<div class="tab-pane fade" id="new-invest-name" role="tabpanel" aria-labelledby="new-invest-name-tab">
								  	<div class="theme-modal-header">
								      	<div class="title font-fix"><a class="back-button-two"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a></div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<div class="main-content-wrapper">
								    			<form method="POST"  action="{{ route('buyecoin') }}" class="invest-name-form">
												@csrf
								    				<h4 class="main-title font-fix">Please Select Cryptocurrency</h4>
								    				 
														<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix"><img width="50" src="{{url('assets/images/coins2.png')}}" alt=""> Currency</span>
																 
													    	</span>
													    </span>
													</button>
													<script type="text/javascript">

													function goDoSomething(identifier){

													 document.getElementById("coinid").value = $(identifier).data('id');
													 document.getElementById("currency").innerHTML = $(identifier).data('name');
													 document.getElementById("walletaddress").innerHTML = $(identifier).data('name');
													 document.getElementById("sell2").innerHTML = "1 USD = {{$basic->currency_sym}}"+$(identifier).data('sell');
													 document.getElementById("fsell2").innerHTML = "1 USD = {{$basic->currency_sym}}"+$(identifier).data('sell');
													 document.getElementById("currencyy2").innerHTML = $(identifier).data('symbol');
													 document.getElementById("fcurrencyy2").innerHTML = $(identifier).data('symbol');
													 document.getElementById("fcurrencyy").innerHTML = $(identifier).data('name');
													 document.getElementById("currencyy").innerHTML = $(identifier).data('name');
													 document.getElementById("sell").innerHTML = "1 USD = {{$basic->currency_sym}}"+$(identifier).data('sell');
													 document.getElementById("currency2").innerHTML = $(identifier).data('symbol');
													  
													 }
													 </script>
													
													 
													<div class="dropdown-menu dropdown-menu-right">
													    <div class="balance-sheet-wrapper">
															<ul>
															@foreach($currency as $gate)
																<li onclick="goDoSomething(this);" data-symbol="{{$gate->symbol}}"    data-name="{{$gate->name}}"   data-sell="{{$gate->sell}}"  data-id="{{$gate->id}}" class="bitcoin-method clearfix select-currnecy-list">
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix">
																		 
																		<img width="40" src="{{url('assets/images/currency')}}/{{$gate->image}}" alt=""> 
																		 
																		{{$gate->name}}</span>
																		 
																	</div>
																</li>
															@endforeach
															<input id="coinid" hidden name="coin">
															</ul> 
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
												</div> <!-- /.withdraw-method-dropdown -->
												
												
														<a href='#'  class='theme-button continue-button-two'><span></span>Get Started</a>
														 
														 
								    			 
								    		</div> <!-- /.main-content-wrapper -->
								    	</div> <!-- /.details-option -->

								    	<div class="modal-sidebar">
								    		<h6 class="sidebar-title font-fix">Step 1<br>Select A Cryptocurrency For the list of currencies and click on the Get Started button to proceed</h6>

								    	 
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="invest-time-frame" role="tabpanel" aria-labelledby="invest-time-frame-tab">
									<div class="theme-modal-header">
										<div class="title font-fix"><a class="back-button-two"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a></div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>
									 <script type="text/javascript">
													function myAmount() {
													 var amount = $('#mySelect').val() ; 
													  document.getElementById("amounted").innerHTML =  amount; 
													  document.getElementById("famounted").innerHTML =  amount; 
													 };
													</script>
													
													
									<script type="text/javascript">

													function goDoSomething2(identifier){

													 
													 document.getElementById("amountt").innerHTML = "$"+$(identifier).val();
													 document.getElementById("finalamount").innerHTML = "$"+$(identifier).val();
													 document.getElementById("ffinalamount").innerHTML = "$"+$(identifier).val();
													  }
													 </script>
													
								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<div class="main-content-wrapper"> 
								    				<div class="invest-amount-details">
								        				<div class="input-box-wrapper">
								        					<div class="input-group-wrapper main-currency">
								        						 
								        						<input type="number"  onkeyup="goDoSomething2(this);"  name="usd" placeholder="$0.00">
								        						<div class="currency-name">USD</div>
								        					</div> 
								        					 
								        					<div class="invest-amount-condition">Please note your trade will be procesed based on the current rate when your trade is approved</div>
								        				</div> <!-- /.input-box-wrapper -->

								        				 

														<ul class="clearfix button-group">
															<li><a href="#" class="theme-button continue-button-two"><span></span>Continue</a></li>
															 
														</ul>
								      				</div> <!-- /.invest-amount-details -->
								    		 
								    			
								    		</div> <!-- /.main-content-wrapper -->
								    	</div> <!-- /.details-option -->

								    	<div class="modal-sidebar">
								    		<h6 class="sidebar-title font-fix">Process Summary</h6>
								    		<ul>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Name</h6>
								    				<h5 class="font-fix"  id="currency">Please select a cryptocurrency</h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Symbol</h6>
								    				<h5 class="font-fix"  id="currency2">Please select a cryptocurrency first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Our Rate</h6>
								    				<h5 class="font-fix"  id="sell">Please select a cryptocurrency first </h5>
								    			</li>
								    		</ul>
								    	 
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="invest-payout-frequency" role="tabpanel" aria-labelledby="invest-payout-frequency-tab">
									<div class="theme-modal-header">
										<div class="title font-fix"><a class="back-button-two"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a></div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<div class="main-content-wrapper">
								    			<form action="#" class="invest-payout-form">
								    				<h4 class="main-title font-fix">Payment Method</h4>
								    				<p class="sub-info">Please select your prefered payment method below.</p>
													
													<script type="text/javascript">

													function goDoSomething3(identifier){
 
													 document.getElementById("method").innerHTML = $(identifier).data('name'); 
													 document.getElementById("payid").value = $(identifier).data('payid'); 
													  
													 }
													 </script>
													 <input id="payid" hiddsen name="payment"> 

								    				<ul class="clearfix payout-frequency-list">
								    				<!--	<li onclick="goDoSomething3(this);" data-name="Bank Transfer"  data-payid="2"  data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								    						<input type="checkbox" id="weekly" class="pay-check">
								    						<label for="weekly">
								    							<span class="font-fix lTitle">Bank Transfer</span>
								    							<span>(Requires Cerification)</span>
								    						</label>
								    					</li>!-->
								    					 
														<li data-toggle="collapse"  onclick="goDoSomething3(this);"  data-payid="1"   data-name="Online Payment"   data-parent="#accordion" href="#collapse2">
								    						<input type="checkbox" id="at-the-end" class="pay-check">
															<label for="at-the-end">
								    							<span class="font-fix lTitle">Naira Wallet</span>
								    							<span>(Deposit Wallet)</span>
								    							<span class="return-bonus"><i class="fa fa-bank"></i></span>
								    						</label>
								    					</li> 
								    				</ul>
													
													<!-- 
			=============================================
				FAQ Section
			============================================== 
			-->
			<div class="section-spacing faq-section">
				<div class="custom-container-two">
					 

					<div class="accordion-one">
						<div class="panel-group theme-accordion" id="accordion">
						  <div class="panel">
						    
						    <div id="collapse1" class="panel-collapse collapse">
						      <div class="panel-body">
						      	<p>
								<label>Select Payment Method</label>
								<select required  class="form-control" id="mySelect" onchange="myFunction()" name="method">
								<? $method = DB::table('payment_methods')->get(); ?>
								 
								@foreach($method as $data)
								<option value="{{$data->id}}">{{$data->name}} </option>
								@endforeach
								</select>
								<br>
								<label>Select Bank</label>
								<select required  class="form-control" name="bank">
								 
								@foreach($bank as $data)
								<option value="{{$data->id}}">{{$data->name}} </option>
								@endforeach
								</select>
								<br>
								</p>
						      </div>
						    </div>
						  </div> <!-- /panel 1 -->
						  <div class="panel">
						   <!--
						    <div id="collapse2" class="panel-collapse collapse">
						      <div class="panel-body">
							  <label>Select Payment Gateway</label>
						      	<p><select required  class="form-control" name="gateway">
								 
								<? $method = DB::table('gateways')->where('id', '<' ,'512')->whereStatus(1)->get(); ?>
								@foreach($method as $data)
								<option value="{{$data->id}}">{{$data->name}} </option>
								@endforeach

								</select>
								<br></p>
						      </div>
						    </div>
						    	-->
						  </div> <!-- /panel 2 --> 
						</div> <!-- end #accordion -->
					</div> <!-- End of .accordion-one -->
				</div> <!-- /.custom-container-two -->
			</div> <!-- /.faq-section -->
			


													
													<a href="#" class="theme-button continue-button-two"><span></span>Continue</a>
													<p>Please note that you may be charged payment processing fee by some payment gateways.</p>
								    			 
								    			
								    		</div> <!-- /.main-content-wrapper -->
								    	</div> <!-- /.details-option -->

								    	<div class="modal-sidebar">
								    		<h6 class="sidebar-title font-fix">Trade Summary</h6>
								    		<ul>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Name</h6>
								    				<h5 class="font-fix"  id="currencyy">Please select a cryptocurrency</h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Symbol</h6>
								    				<h5 class="font-fix"  id="currencyy2">Please select a cryptocurrency first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Exchange Rate</h6>
								    				<h5 class="font-fix"  id="sell2">Please select a cryptocurrency first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Amount</h6>
								    				<h5 class="font-fix"  id="amountt">Please enter amount first </h5>
								    			</li>
								    		</ul>
								    	 
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="new-invest-amount" role="tabpanel" aria-labelledby="new-invest-amount-tab">
									<div class="theme-modal-header">
										<div class="title font-fix"><a class="back-button-two"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a></div>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<div class="main-content-wrapper">
								    			<h4 class="main-title font-fix">Please enter your <a id="walletaddress">wallet</a> address</h4>
								    			<form action="#" class="invest-amount-form">
								    				<div class="invest-amount-details">
								        				<div class="input-box-wrapper">
								        					<div class="input-group-wrapper main-currency">
								        						 
								        						<input type="text"  name="wallet" Placeholder="Enter Address">
								        						 
								        					</div>
								        					<div class="input-group-wrapper">
								        						 
								        						<input type="text" name="rewallet" Placeholder="Confirm Address" >
								        					</div>
								        					<div class="invest-amount-condition">{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong wallet address</div>
								        				</div> <!-- /.input-box-wrapper -->

								        				<div class="total-return-figure">
															<h4 class="title">Expected Payment</h4>
															<span class="return-value"><strong id="finalamount" class="total-return-value usd-return">$0.00</strong></span>
														</div>

														<ul class="clearfix button-group">
															<li><button type="submit" class="theme-button continue-button-two"><span></span>Continue</button></li>
															 
														</ul>
								      				</div> <!-- /.invest-amount-details -->
								    			</form>
								    		</div> <!-- /.main-content-wrapper -->
								    	</div> <!-- /.details-option -->

								    	<div class="modal-sidebar">
								    		<h6 class="sidebar-title font-fix">Trade Summary</h6>
								    		<ul>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Name</h6>
								    				<h5 class="font-fix"  id="fcurrencyy">Please select a cryptocurrency</h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Currency Symbol</h6>
								    				<h5 class="font-fix"  id="fcurrencyy2">Please select a cryptocurrency first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Exchange Rate</h6>
								    				<h5 class="font-fix"  id="fsell2">Please select a cryptocurrency first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Amount</h6>
								    				<h5 class="font-fix"  id="ffinalamount">Please enter amount first </h5>
								    			</li>
								    			<li class="sidebar-action-list">
								    				<h6>Payment Method</h6>
								    				<h5 class="font-fix"  id="method">Please select payment method fist </h5>
								    			</li>
								    		</ul>
								    		 
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								  
								 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#new-investment-modal -->
			
			
			
			
			
			
			<!-- Investment  Modal -->
			<div class="modal fade" id="investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="invest-name-tab" data-toggle="tab" href="#invest-name" role="tab" aria-controls="invest-name" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-amount-tab" data-toggle="tab" href="#invest-amount" role="tab" aria-controls="invest-amount" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-return-tab" data-toggle="tab" href="#invest-return" role="tab" aria-controls="invest-return" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix">Sell Cryprocurrency</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>
	 

								    <div class="modal-body">
				        				<form method="POST" action="{{ route('sellecoin') }}">
										@csrf
				        					 
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Select Cryprocurrency <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Select the cryptocurrency you would like to sell."><img src="{{asset('assets/images/info.png')}}" alt=""></button></h6>
											 
   
					        				</div> <!-- /.single-input-wrapper -->
											
											<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix"><img width="50" src="{{url('assets/images/coins2.png')}}" alt=""> Currency</span>
																 
													    	</span>
													    </span>
													</button>
													<script type="text/javascript">

													function goDoSomethingsell(identifier){
 
													 document.getElementById("sellrate").innerHTML = "$1.00 = {{$basic->currency_sym}}"+$(identifier).data('buy');
													 
													 document.getElementById("coinex").innerHTML = $(identifier).data('coin');
													 document.getElementById("crypid").value = $(identifier).data('cur');
													 document.getElementById("coinname").innerHTML = $(identifier).data('coin');
													  
													 }
													 </script>
													
													 
													<div class="dropdown-menu dropdown-menu-right">
													    <div class="balance-sheet-wrapper">
															<ul>
															@foreach($currency as $data)
																<li onclick="goDoSomethingsell(this);" data-coin="{{$data->name}}"  data-cur="{{$data->id}}" data-buy="{{$data->buy}}"  data-name="{{$data->name}}" data-address="{{App\Cryptowallet::whereCoin_id($data->id)->first()->address}}"  data-price="{{$data->price}}"  class="bitcoin-method clearfix select-currnecy-list">
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix">
																		 
																		<img width="40" src="{{url('assets/images/currency')}}/{{$data->image}}" alt=""> 
																		 
																		{{$data->name}}</span>
																		 
																	</div>
																</li>
															@endforeach
															<input id="crypid" hidden name="coin">
															</ul> 
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
												</div> <!-- /.withdraw-method-dropdown -->
												
					        				 

					        				<a href="#" class="add-funds-button continue-button">Continue</a>

					        				<div class="bottom-button-group clearfix">
					        					<ul class="clearfix">  
					        						<li><button class="cancel-action" data-dismiss="modal" aria-label="Close">Cancel</button></li>
					        					</ul>
					        				</div>
				        				 
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->


								<script type="text/javascript">

													function goDoSomethingsell2(identifier){

													 
													 document.getElementById("amountsell").innerHTML = "$"+$(identifier).val();
													 document.getElementById("amountsell2").innerHTML = "$"+$(identifier).val(); 
													  }
													 </script>
													
								<div class="tab-pane fade" id="invest-amount" role="tabpanel" aria-labelledby="invest-amount-tab">
								  	<div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button"><img src="{{url('assets/images/left-arrow.png')}}" alt=""></a> Please Enter Amount To Sell</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="modal-body invest-amount-details">
				        				<div class="input-box-wrapper">
				        					<h6 class="title">amount</h6>
				        					<div class="input-group-wrapper main-currency"> 
				        						<input type="number"  onkeyup="goDoSomethingsell2(this);"  name="usd" >
				        						<div class="currency-name">USD</div>
				        					</div>
				        					<div class="input-group-wrapper">
				        						<div class="cryptocurrency-amount" id="sellrate">Select Currency First</div>
				        						 
				        					</div>
				        					<div class="invest-amount-condition">Our Sell Rate</div>
				        				</div> <!-- /.input-box-wrapper -->
				        				 
				        				<a href="#" class="add-funds-button continue-button">Proceed</a>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="invest-return" role="tabpanel" aria-labelledby="invest-return-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button"><img src="{{url('assets/images/left-arrow.png')}}" alt=""></a> Enter Payment Details</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="invest-vs-deposit clearfix">
								    	<div class="previous-invest">
								    		<div class="title">Currency</div>
								    		<div class="amount font-fix" id="coinex">Not Selected</div>
								    	</div>
								    	<div class="new-deposit">
								    		<div class="title">Amount</div>
								    		<div class="amount font-fix"  id="amountsell">Not Entered</div>
								    	</div>
								    </div> <!-- /.invest-vs-deposit -->

								    <div class="modal-body invest-amount-details">
				        				<div class="input-box-wrapper">
				        				    <center>
				        				        <img width="150" src="{{asset('assets/images/mywallet.jpeg')}}" alt="">
				        				    </center>
				        				    <br>
				        				    
				        					<h5 class="title">Your Fund Will Be Credited Into Your Naira Wallet As Soon As Your Trasaction Is Confrimed.</h5>
				        					<div class="input-group-wrapper main-currency">
											
<script>
function myFunction() {
  

  var bank = $("#mybank option:selected").attr('data-bank');
  var bankname = $("#mybank option:selected").attr('data-bankname');

 if(bank ==  0){
  document.getElementById("bank").innerHTML = " ";
 }
 if(bank ==  1)
 {
 document.getElementById("bank").innerHTML = "<br><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your " + bankname + " Account Number</label><input name='actnumber'  required  class='input-bordered' type='text'></div> ";}
 if(bank ==  2)
 {
 document.getElementById("bank").innerHTML = "<br> <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Bank Name</label><input required name='bankname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='acctname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='actnumber'  required  class='input-bordered' type='text'></div>";}

 };
</script> <!--
				        						<select required  class="form-control" name="bank" id="mybank" onchange="myFunction()">
<? $method = DB::table('localbanks')->get(); ?>
 

@foreach($method as $data)
<option data-bank="1" data-bankname="{{$data->bank}}" value="{{$data->code}}">{{$data->bank}} </option>
@endforeach

<option data-bank="2" value="other"><b>Other Banks</b></option>
</select>

<a id="bank"></a>!-->





				        					</div>
				        				</div> <!-- /.input-box-wrapper -->
				        				<div class="tostal-return-figure">
											 
										</div> <!-- /.total-return-figure -->
 
				        				<button type="submit" class="add-funds-button">Confirm</button>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->


@endsection
