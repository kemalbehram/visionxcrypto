@extends('include.dashboard')
@section('content')
  
						<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content investment-panel">
						<ul class="investment-history clearfix">
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Transfer</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}{{number_format($transfers, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Deposit Balance</h6>
										<strong class="figure">{{$basic->currency_sym}} {{number_format(Auth::user()->balance, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Bonus Balance</h6>
										<strong class="figure">{{$basic->currency_sym}} {{number_format(Auth::user()->bonus, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Investment earnings</h6>
										<strong class="figure ">${{number_format($wallet->balance, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li> 
							</ul> <!-- /.investment-history -->
						 

							<div class="investment-list-item-wrapper">
							<p class="lead text-primary"> <p>To transfer fund from your wallets to another user's deposit wallet, enter the receiver's username and proceed to enter amount to transfer.</p><p>To <strong>ensure safe delivery</strong> of fund to user please enter <strong>a valid account username. Please note that transfer made from investment wallet will be converted from USD to system local currency before it is delivered to benefeciary</strong> </p>
								<div class="item-filter-header clearfix">
									<h6 class="title">Your Transfer Log ({{count($transfer) }})</h6>
									<ul class="right-button-group">
										 
										<li><button type="button" class="new-invest-button" data-toggle="modal" data-target="#investment-modal">+ Transfer Fund</button></li> 
										<li><button type="button" class="new-invest-button" data-toggle="modal" data-target="#payout-modal">+ Convert Bonus</button></li>
									</ul> <!-- /.right-button-group -->
								</div> <!-- /.item-filter-header -->

								<div class="table-responsive investment-table-sheet">
									<table class="table">
										<thead>
										@if(count($transfer) >0)
										@foreach($transfer as $k=>$data)
										    <tr>
											    <td>
											      <span class="title">Benefeciary</span>
											      <div class="info font-fix">{{$data->send_details}}</div>
											    </td>
										    	<td>
											      <span class="title">Date</span>
											      <div class="info font-fix">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</div>
											    </td>
											    <td>
											      <span class="title">Earnings</span>
											      <div class="info earn">{!! $basic->currency !!} {{$data->amount}}</div>
											    </td>
											    <td>
											     @if($data->status == 1)
												<span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span>
												 @elseif($data->status == 2)
												<span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span>
												@elseif($data->status == -2)
												<span class="dt-type-md badge badge-outline badge-sdanger badge-md">Declined</span>
												@endif
											    </td> 
										    </tr>
											 @endforeach
											@else
												<center><h4>You dont have any transfer log yet</h4></center>
											@endif	
										</thead>
										 
									</table>
								</div> <!-- /.investment-table-sheet -->

								 
							</div> <!-- /.investment-list-item-wrapper -->
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->

					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->




			 
			<!-- Investment  Modal -->
			<div class="modal fade" id="investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="invest-name-tab" data-toggle="tab" href="#invest-name" role="tab" aria-controls="invest-name" aria-selected="true"></a>
								</li> 
							</ul>
							
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix">Transfer Fund</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>
									
								    <div class="modal-body">
				        				<form method="post" action="{{route('update.transfer') }}">
										@csrf
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Beneficiary's Username</h6>
					        					<input type="text" name="username"  placeholder="Please Enter Username">
					        				</div> <!-- /.single-input-wrapper -->
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Select Wallet <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></h6>
					        					<select name="wallet" class="theme-select-dropdown">
													<option value="0">Deposit Wallet</option>
													<option value="1">Investment Return</option> 
												</select>
					        				</div> <!-- /.single-input-wrapper -->
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Enter Amount <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Please enter an amount to transfer to benefeciary."><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
					        					<input type="number" name="amount"  placeholder="0.00" class="end-date"     >
					        					 
					        				</div> <!-- /.single-input-wrapper -->

					        				<button type="submit" class="add-funds-button continue-button">Transfer Fund</button>

					        				<div class="bottom-button-group clearfix">
					        					<ul class="clearfix"> 
					        						<li><button class="cancel-action" data-dismiss="modal" aria-label="Close">Cancel</button></li>
					        					</ul>
					        				</div>
				        				</form>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->



								 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->


 
			
			
			
<!-- Payouts Modal -->
			<div class="modal fade" id="payout-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				      	<div class="theme-modal-header">
					      	<h3 class="title font-fix">Convert Bonus</h3>
							<h5>   You can convert the available Bonus in your bonus wallet into spendable cash. This Please enter the amount of bonus to convert and click on the conver button to proceed </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
				      	</div>
						
				      	<div class="modal-body">
						<center><img src="{{url('assets/images/vmg.jpg')}}" alt="" width="100" class="payout-icon"></center>
					        <div class="next-payout-box">
					        	<img src="{{url('assets/images/icon-1.png')}}" alt="" class="payout-icon">
					        	<div class="text">Available Balance</div>
					        	<div class="date">{{$basic->currency_sym}} {{number_format(Auth::user()->bonus, $basic->decimal)}}</div>
					        </div>

					        <div class="payousst-history">
					        	 
								<form method="post" action="{{route('update.convert') }}">
								@csrf
					        		 
					        			<div class="title">Amount</div>
					        			 <input required  name="amount" class="form-control" type="number" >
					        		 <br>
									<button type="submit" class="btn btn-info add-funds-button continue-button">Convert Bonus</button>	
					        	 
					        </div>
					         
				      	</div>
			    	</div>
			  	</div>
			</div> <!-- /#payout-modal -->
			
			
			


@stop
