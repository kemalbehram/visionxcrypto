@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							<!-- ***************** User Content **************** -->
						 
							<ul class="investment-history clearfix">
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Transfer</h6>
										<strong class="figure">{{count($transferlog)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Transfer</h6>
										<strong class="figure">{{$basic->currency_sym}}{{number_format($totaltransfer, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Last Transfer</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}
										
										{{isset($lasttransfer->amount ) ? number_format($lasttransfer->amount, $basic->decimal)  : '0.00'}} 
										
										 </strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Date
										<div class="date">{{isset($lasttransfer->created_at ) ? date(' dS,M,Y', strtotime($lasttransfer->created_at))  : 'N/A'}} </div>
									</div> <!-- /.inner-warpper -->
								</li>
							</ul> <!-- /.investment-history -->
							 	
		 




							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Transfer history <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix"><button type="button" class="btn btn-sm btn-prismary btn-outline-primary"  data-toggle="modal" data-target="#investment-modal">+ Transfer Fund</button></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
										@if(count($transferlog) < 1)
											<h4><center>You Dont Have Any Transfer History At The Moment</h4></center>
										<br><br><br><br><br><br><br><br><br> 
										@endif
											<tbody>
											@foreach($transferlog as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Account N<u>o</u></div>
												      	@if($data->status == 1)
					        							<div class="value font-fix payment-status paid">{{$data->account_number}}</div>
												      	@elseif($data->status == 2)
					        							<div class="value font-fix payment-status open">{{$data->account_number}}<br><a class="text-danger">Rejected</a></div>
					        								@else
					        							<div class="value font-fix payment-status open">{{$data->account_number}}<br><a class="text-danger">Pending</a></div>
					        							@endif
												    </td>
												    <td>
												    	<div class="title">Beneficiary</div>
												      	<div class="value font-fix">{{$data->method}}</div>
												    </td>
												    <td>
												      	<div class="title">Bank</div>
												      	<div class="value font-fix"><img src="{{asset('assets/images/bank2.png')}}" alt="" class="currency-icon"> {{$data->gateway}}</div>
												    </td>
												    <td>
												      	<div class="title">TRX Time</div>
												      	<div class="value font-fix">{!! date(' dS,M,Y', strtotime($data->created_at)) !!}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
											    </tr>
											@endforeach 
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
								{{$transferlog->links()}}
							</div> <!-- /.payout-history-wrapper -->

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
								      	<h3 class="title font-fix">Bank Transfer</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>
									<script type="text/javascript">
													function myFunction() {
													 var bank = $("#mySelect option:selected").attr('data-name');
														 document.getElementById("bank").value = bank;
													 };
									</script>
								    <div class="modal-body">
				        				<form  action="{{route('bank.validate')}}" method="post">
										{{ csrf_field() }}
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Amount</h6>
					        					<input name="amount" type="text" placeholder="{{$basic->currency_sym}} 0.00">
					        				</div> <!-- /.single-input-wrapper 
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Account Number</h6>
					        					<input name="number" type="text" placeholder="Enter Account Number">
					        				</div> <!-- /.single-input-wrapper -->
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Bank <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Please select the beneficiary's bank name and click on proceed to validate account number."><img src="{{asset('assets/images/info.png')}}" alt=""></button></h6>
					        					<select name="bank" id='mySelect' onchange='myFunction()' class="theme-select-dropdown">
												 <option disabled selected >Select Bank Name</option>
												 @if(Auth::user()->bankyes == 1)
												 <option data-name="{{Auth::user()->bank}}" value="{{Auth::user()->bankcode}}">{{Auth::user()->bank}}(Account #: {{Auth::user()->accountno}})</option> 
												 @endif
												 <option value="others">Other Bank</option>
											<!--	@foreach($rep['banklist'] as $k=>$data)
												<option data-name="{{$data['bankname']}}" value="{{$data['bankcode']}}">{{$data['bankname']}}</option> 
												@endforeach !-->
												</select>
					        				</div> <!-- /.single-input-wrapper -->
					        				 
											<input id="bank" hidden name="bankname">
					        				<button button="submit" class="add-funds-button continue-button">PROCEED WITH TRANSFER</button>

					        				 
				        				</form>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->



							 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->
			
			
			


			

@stop
