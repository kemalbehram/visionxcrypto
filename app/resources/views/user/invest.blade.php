@extends('include.dashboard')
@section('content')
   	<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content investment-panel">
							<ul class="investment-history clearfix">
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Investments</h6>
										<strong class="figure">{{$invcount}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Invested</h6>
										<strong class="figure">${{number_format($invsum, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Available earnings</h6>
										<strong class="figure total-earn">${{number_format($earn->balance, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Completed</h6>
										<div class="figure text-success">{{$invcomplete}}</div>
									</div> <!-- /.inner-warpper -->
								</li>
							</ul> <!-- /.investment-history -->

							<div class="investment-list-item-wrapper">
								<div class="item-filter-header clearfix">
									<h6 class="title">Your investments</h6>
									<ul class="right-button-group">
										<li>
											<select class="theme-select-dropdown" name="Status">
												<option value="AL">Status</option>
											  <option value="Active">Active</option>
											  <option value="Waiting">Waiting</option>
											</select>
										</li>
										<li><button type="button" class="new-invest-button" data-toggle="modal" data-target="#investment-modal">+ Create a new Investment</button></li>
									</ul> <!-- /.right-button-group -->
								</div> <!-- /.item-filter-header -->

								<div class="table-responsive investment-table-sheet">
									<table class="table">

										<tbody>
										@if(count($trans) >0)
										@foreach($trans as $k=>$data)

										    <tr>
										      	<td>
											      <span class="title">Plan</span>
											      <div class="info status-active">{{__($data->plan->name)}}</div>
											    </td>
											    <td>
											      <span class="title">TimeFrame</span>
											      <div class="info font-fix"> {{__($data->time_name)}} </div>
											    </td>
											    <td>
											      <span class="title">Invested</span>
											      <div class="info font-fix">${{number_format($data->amount, $basic->decimal)}}</div>
											    </td>
											    <td>
											      <span class="title">Status</span>
											      <div class="info font-fix">  @if($data->status == '1')  <span class="badge badge-warning"><i class="fa fa-spinner fa-cog"></i> @lang('Running')</span>  @elseif($data->status == '2')  <span class="badge badge-danger"><i class="fa fa-spinner fa-spin"></i> @lang('Pending')</span> @elseif($data->status == '17')  <span class="badge badge-secondary"><i class="fa fa-trash fa-s"></i> @lang('Rejected')</span>  @else <span class="badge badge-primary">@lang('Complete')</span> @endif </div>
											    </td>
											    <td rowspan="2"><a href="{{route('coinvestyield',$data->id)}}"><button type="button" class="btn btn-sm badge-info " >View</button></a></td>
										    </tr>
										    <tr>
										      	<td>
											      <span class="title">Open Date</span>
											      <div class="info font-fix">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</div>
											    </td>
											    <td>
											      <span class="title">Payout Frequency</span>
											      <div class="info font-fix">$ {{__($data->interest)}} / {{__($data->time_name)}}</div>
											    </td>
												 <td>
											      <span class="title">Epected Yielded</span>
											      <div class="info font-fix">@if($data->period == '-1') <span class="badge badge-success">@lang('Life-time')</span>  @else {{__($data->period)}} @lang('Times') @endif</div>
											    </td>
											    <td>
											      <span class="title">Total Yields</span>
											      <div class="info profit">{{__($data->return_rec_time)}} @lang('Times')</div>
											    </td>

										    </tr>

											@endforeach
											@else
											No Investment Record Found Yet
											@endif
										</tbody>
									</table>
								</div> <!-- /.investment-table-sheet --><br>
								{{$trans->links()}}
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
								      	<h3 class="title font-fix">New Crypto Investment</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="modal-body">



					        				<div class="single-input-wrapper">
					        					<h6 class="title">Payout Frequency <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></h6>
					        						<div class="dropdown withdraw-method-dropdown">
													<button class="dropdown-toggle withdraw-dropdown-button" data-toggle="dropdown">
													    <span class="balance-sheet-wrapper selected-currency">
													    	<span class="withdraw-currency-list clearfix">
													    		<span class="name font-fix"><img width="50" src="{{url('assets/images/coins2.png')}}" alt=""> Currency</span>

													    	</span>
													    </span>
													</button>
													<script type="text/javascript">

													function goDoSomethingf(identifier){

													 document.getElementById("name").innerHTML = $(identifier).data('name');
													 document.getElementById("pname").innerHTML = $(identifier).data('name');
													 document.getElementById("planid").value = $(identifier).data('id');
													 document.getElementById("mini").innerHTML = $(identifier).data('mini');
													 document.getElementById("maxi").innerHTML = $(identifier).data('maxi');
													 document.getElementById("interest").innerHTML = $(identifier).data('interest');
													 document.getElementById("duration").innerHTML = $(identifier).data('duration');
													 document.getElementById("cycle").innerHTML = $(identifier).data('cycle');


													 }
													 </script>


													<div class="dropdown-menu dropdown-menu-right">
													    <div class="balance-sheet-wrapper">
															<ul>
															@foreach($plans as $data)
															@php
                        $time_name = \App\TimeSetting::where('time', $data->times)->first();
                    @endphp
																<li onclick="goDoSomethingf(this);" data-interest="{{$data->interest}} @if($data->interest_status == 1) % @else $ @endif"    data-name="{{$data->name}}"   data-cycle="{{$time_name->name}}"   data-mini="{{$data->minimum}}" data-maxi="{{$data->maximum}}"  data-duration="@if($data->lifetime_status == 0) {{__($data->repeat_time)}}{{__($time_name->slug)}} @else @lang('Lifetime') @endif"  data-id="{{$data->id}}" class="bitcoin-method clearfix select-currnecy-list">
																	<div class="withdraw-currency-list clearfix">
																		<span class="name font-fix">

																		<img width="40" src="{{url('assets/images/coins2.png')}}" alt="">

																		{{$data->name}}</span>

																	</div>
																</li>
															@endforeach

															</ul>
														</div> <!-- /.balance-sheet-wrapper -->
													</div>
												</div> <!-- /.withdraw-method-dropdown -->
					        				</div> <!-- /.single-input-wrapper -->
					        				<a href="#" class="add-funds-button continue-button">Continue</a>

					        				<div class="bottom-button-group clearfix">
					        					<ul class="clearfix">
					        						<li><button class="cancel-action" data-dismiss="modal" aria-label="Close">Cancel</button></li>
					        					</ul>
					        				</div>
				        				</form>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->



								<div class="tab-pane fade" id="invest-amount" role="tabpanel" aria-labelledby="invest-amount-tab">
								  	<div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a> How much would you like to invest?</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

											<form id="investnow"  action="{{route('coin-vest')}}" method="post">
										@csrf
					        				 <input id="planid" hidden name="plan_id">
								    <div class="modal-body invest-amount-details">
				        				<div class="input-box-wrapper">
				        					<h6 class="title">amount</h6>
				        					<div class="input-group-wrapper main-currency">
				        						<div class="currency-icon">$</div>

									<script type="text/javascript">

													function goDoSomething2(identifier){


													 document.getElementById("ffinalamount").innerHTML = "$"+$(identifier).val() ;
													 document.getElementById("btc").innerHTML = {{$btcrate}}*$(identifier).val();
													 total = {{$btcrate}}*$(identifier).val();
													 document.getElementById("totalbtc").innerHTML = total.toFixed(8)+"BTC";
													  }
													 </script>

				        						<input type="number" name="amount" onkeyup="goDoSomething2(this);" placeholder="0.0">
				        						<div class="currency-name">USD</div>
				        					</div>
				        					<div class="input-group-wrapper">
				        						<div class="cryptocurrency-amount" id="btc" >0.000000</div>
				        						<select class="theme-select-dropdown">
													<option value="Value 1">BTC</option>
												</select>
				        					</div>
				        					<div class="invest-amount-condition">Exchange Rate: $1.00 = {{number_format($btcrate,8)}}BTC</div>
				        				</div> <!-- /.input-box-wrapper -->
				        				<div class="input-box-wrapper">
				        					<h6 class="title">Payment Method</h6>
				        					<ul class="payment-method-one">
				        						<li class="clearfix payment-header list-item">
				        							<div class="title-text font-fix">Plan</div>
				        							<div class="payment-time" id="name" >No Plan Yet</div>
				        						</li>
				        						<li class="clearfix payment-action-list list-item">
				        							<div class="currency-name font-fix" >
				        								 Minimum
				        							</div>
				        							<div class="payment-time" id="mini" >No Plan Yet</div>
				        						</li>
				        						<li class="clearfix payment-action-list list-item">
				        							<div class="currency-name font-fix">
				        								  Maximum
				        							</div>
				        							<div class="payment-time" id="maxi" >No Plan Yet</div>
				        						</li>
				        						<li class="clearfix payment-action-list list-item">
				        							<div class="currency-name font-fix">
				        								  Interest
				        							</div>
				        							<div class="payment-time" id="interest" >No Plan Yet</div>
				        						</li>

				        						<li class="clearfix payment-action-list list-item">
				        							<div class="currency-name font-fix">
				        								  Duration
				        							</div>
				        							<div class="payment-time" id="duration" >No Plan Yet</div>
				        						</li>

				        						<li class="clearfix payment-action-list list-item">
				        							<div class="currency-name font-fix">
				        								  Payout Cycle
				        							</div>
				        							<div class="payment-time" id="cycle" >No Plan Yet</div>
				        						</li>


				        					</ul>
				        				</div> <!-- /.input-box-wrapper -->
				        				<a href="#" class="add-funds-button continue-button">Add funds to your investment</a>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->

								<div class="tab-pane fade" id="invest-return" role="tabpanel" aria-labelledby="invest-return-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix"><a class="back-button"><img src="{{asset('assets/images/left-arrow.png')}}" alt=""></a> See how much your coins can grow</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="invest-vs-deposit clearfix">
								    	<div class="previous-invest">
								    		<div class="title">Amount</div>
								    		<div class="amount font-fix"  id="ffinalamount">$0.00</div>
								    	</div>
								    	<div class="new-deposit">
								    		<div class="title">Plan Name</div>
								    		<div class="amount font-fix"  id="pname">No Plan</div>
								    	</div>
								    </div> <!-- /.invest-vs-deposit -->

								    <div class="modal-body invest-amount-details">
				        				<div class="input-box-wrapper">
				        					<h6 class="title">New total invested amount</h6>
				        					<div class="input-group-wrapper main-currency">
				        						 <select class="form-control"  name="wallet_type">
                                        @foreach($wallets as $k=>$data)
                                        <option value="{{$data->id}}"> {{__(str_replace('_',' ',$data->type))}} ({{number_format($data->balance, 2)}} {{__($basic->currency)}})</option>
                                        @endforeach
										 <option value="1982100101281"> Deposit_Wallet ${{number_format(Auth::user()->balance, $basic->decimal)}}</option>
										  <option value="82718271565131"> Scan QR Code</option>
                                    </select>
				        					</div>
				        				</div> <!-- /.input-box-wrapper -->
				        				<div class="total-return-figure">
											<h4 class="title">Total Investment</h4>

											<h1> <a class="text-white total-return-value usd-return" id="totalbtc" >0.000BTC</a> </h1>
										</div> <!-- /.total-return-figure -->

				        				<button type="submit"  onclick="event.preventDefault(); document.getElementById('investnow').submit();" class="add-funds-button">Confirm</button>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
						</form>
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->




			@endsection
