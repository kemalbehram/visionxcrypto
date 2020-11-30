@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content wallet-panel">
							<div class="row">
								<div class="col-xl-5">
									<div class="bg-box wallet-balance">
										<div class="title">Total Internet Data Subscription</div>
									    <div class="balance-sheet-wrapper">
											<ul>
											@foreach($networks as $k=>$data)
												<li class="bitcoin-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="40"  src="{{url('assets/images')}}/{{$data->image}}" alt=""> {{$data->name}}</span>
														<span class="balance-inquery">
															<span class="currency-title">{{$basic->currency_sym}}{{number_format(App\Transaction::whereUser_id(Auth::user()->id)->whereType(2)->whereStatus(1)->whereGateway($data->symbol)->sum('amount'),2)}}</span>
															<span class="total-currency"> </span>
														</span>
													</a>
												</li>
											@endforeach
												 
											</ul>
											<div class="total-balance clearfix">
												<div class="balance-title">Total Airtime ≈</div>
												<div class="balance-figure">{{$basic->currency_sym}}{{number_format(App\Transaction::whereUser_id(Auth::user()->id)->whereType(2)->whereStatus(1)->sum('amount'),2)}}</div>
											</div>
										</div> <!-- /.balance-sheet-wrapper -->
										<ul class="button-group clearfix"> 
											<li><button class="withdraw-button theme-button" data-toggle="modal" data-target="#withdraw-modal"><span></span>Recharge</button></li>
										</ul>
									</div> <!-- /.bg-box -->

									 
								</div> <!-- /.col- -->

								<div class="col-xl-7">
									 

									 
									<div class="transactions-history completed-transactions-history bg-box">
										<div class="title tooltip-holder">
											Completed Transactions
											<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to invest, you can always add funds to your investment at any time."><img src="{{url('assets/images/airtime.png')}}" alt=""></button>
										</div>

										<div class="table-responsive transactions-list">
										@if(count($transactions) < 1)
										<center><h2>No Data Subscription Yet</h2></center>
										@endif
										
											<table class="table">
												<tbody>
												
										        @foreach($transactions as $k=>$data)
												    <tr role="row" class="single-list">
												      	<td class="time font-fix">
															<div class="month">{!! date(' M', strtotime($data->created_at)) !!}</div>
															<div class="date">{!! date(' d', strtotime($data->created_at)) !!}</div>
													    </td>
													    <td>
													    	<div class="heading font-fix">{{$data->method}}</div>
													      	<div class="value">{{$data->trx}}</div>
													    </td>
													    <td>
													    	<div class="heading font-fix"><b>({{$data->gateway}})</b><br>{{$basic->currency_sym}}{{number_format($data->amount,2)}}</div> 
													    </td>
												    </tr>
												    @endforeach
													
													
												</tbody>
											</table>
										</div> <!-- /.table-data --><br>
										{{$transactions->links()}}
									</div> <!-- /.transactions-history -->
								</div>
							</div> <!-- /.row -->
							
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->
			
		 



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
												Airtime Recharge
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Load airime and get recharged instantly."><img src="{{url('assets/images/info.png')}}" alt=""></button>
											</h3>
								    	 
								    			<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix"><img width="40"  src="{{url('assets/images/airtime.png')}}" alt=""> Select Network</span>
																 
													    	</span>
													    </span>
													</button>
													
													<script type="text/javascript">

													function goDoSomething(identifier){

													 document.getElementById("network").value = $(identifier).data('id');
													 document.getElementById("name").innerHTML = $(identifier).data('name');
													 document.getElementById("name2").innerHTML = $(identifier).data('name');
													 var id = $(identifier).data('id');
													 if(id == "mtn")
													 {
													 document.getElementById("plan").innerHTML = "<select id='mySelect' onchange='myFunction1()'  name='plan' class='form-control'>@foreach($mtn as $k=>$data)<option value='{{ $data['productcode']}}>{{ $data['name']}}</option>@endforeach</select>";
													 }
													 if(id == "airtel")
													 {
													 document.getElementById("plan").innerHTML = "<select id='mySelect' onchange='myFunction1()'  name='plan' class='form-control'>@foreach($airtel as $k=>$data)<option value='{{ $data['productcode']}}'>{{ $data['name']}}</option>@endforeach</select>";
													 }
													 if(id == "glo")
													 {
													 document.getElementById("plan").innerHTML = "<select id='mySelect' onchange='myFunction1()'  name='plan' class='form-control'>@foreach($glo as $k=>$data)<option value='{{ $data['productcode']}}>{{ $data['name']}}</option>@endforeach</select>";
													 }
													 if(id == "9mobile"){
													 document.getElementById("plan").innerHTML = "<select id='mySelect' onchange='myFunction1()' name='plan' class='form-control'>@foreach($ninemobile as $k=>$data)<option value='{{ $data['productcode']}} data-amount='34' >{{ $data['name']}}</option>@endforeach</select>";
													 }
													 document.getElementById("image").innerHTML = "<img width='40'  src='{{url('assets/images')}}/"+$(identifier).data('image')+"'>";
													  

													 };
												 
													 </script>
													<script type="text/javascript">
													function myAmount() { 
													 var phone = $('#myphone').val() ;  
													  document.getElementById("phonenumber").innerHTML =  phone; 
													  document.getElementById("number").value =  phone; 
													 };
													</script>
													<script type="text/javascript">
													function myFunction1() {
													 var amount = $("#mySelect option:selected").attr('data-pricer');
														 document.getElementById("pricer").innerHTML = amount;
													 };
													</script>
													 
													 
													<div class="dropdown-menu dropdown-menu-right">
													    <div class="balance-sheet-wrapper">
															<ul>
															@foreach($networks as $k=>$data)
																<li data-toggle="collapse"  onclick="goDoSomething(this);" data-id="{{$data->code}}" data-image="{{$data->image}}"  data-name="{{$data->name}}" class="bitcoin-method clearfix select-currnecy-list">
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix"><img width="40"  src="{{url('assets/images')}}/{{$data->image}}" alt=""> {{$data->name}} Network</span>
																		 
																	</div>
																</li>
															@endforeach
															</ul>
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
												</div> <!-- /.withdraw-method-dropdown -->
										 
 
												
												<form method="post"  action="{{route('loadata') }}">
											    @csrf	
												 
												
												<div class="wallet-amount withdraw-amount">
													<h3 class="main-title">Phone Number</h3>
													<div class="row">
														<div class="col-sm-12">
															<div class="input-group-wrapper main-currency">
																<input type="checkbox" class="cur-check">
								        						<label for="wdrw-main-cur">
								        							 
									        						<input  id="myphone" onkeyup="myAmount()" type="number" placeholder="080********" min="100" >
									        						<span class="currency-name"><a id="name2"></a></span>
								        						</label>
								        					</div>
														</div> <!-- /.col- -->

														 <input id="network" hidden name="network">
											            <input id="number" hidden name="number">
													</div> <!-- /.row -->
												</div> <!-- /.wallet-amount -->

												<button class="theme-button"><span></span>Confirm</button>
								    	 
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			 
								    			<ul>
								    				<li class="list-item">
								    					<div class="sidebar-title">Network</div>
								    					<div class="value font-fix"><a id="image"></a> <a id="name">Select Network</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Phone Number</div>
								    					<div class="value font-fix"><a id="phonenumber">Enter Phone Number</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Processing Time</div>
								    					<div class="value font-fix">Instantly</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please note that {{$basic->sitename}} will not be liable to any loss arising from loading internet data on a wrong phone number entered by you."><img src="{{url('assets/images/help.png')}}" alt=""> Help</button>
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
									 
							        	</form>
							      	</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#withdraw-modal -->

@stop
