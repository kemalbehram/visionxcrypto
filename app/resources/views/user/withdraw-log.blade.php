@extends('include.dashboard')
@section('content')
  <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Total Withdrawal </div>
								<div class="payout-date">{{$basic->currency_sym}}{{number_format($sum, $basic->decimal)}}</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Withdrawal history <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix">All Withdrawal: <span>{{$count}}</span></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											@if(count($withdraw) >0)
											@foreach($withdraw as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
														@if($data->status == 2)
														<div class="value font-fix payment-status paid">Approved</div>
														@elseif($data->status == 1)
														<div class="value font-fix payment-status open">Pending</div>
														@elseif($data->status == -2)
														<div class="value font-fix payment-status open">Declined</div>
														@endif

					        							
												    </td>
												    <td>
												    	<div class="title">Transaction ID</div>
												      	<div class="value font-fix">{{isset($data->transaction_id ) ? $data->transaction_id  : 'N/A'}}</div>
												    </td>
												    <td>
												      	<div class="title">Payment Method</div>
												      	<div class="value font-fix"><img src="images/bitcoin2.png" alt="" class="currency-icon"> {{isset($data->method->name) ? $data->method->name : 'N/A'}}</div>
												    </td>
												    <td>
												      	<div class="title">Date</div>
												      	<div class="value font-fix">{!! date(' d/M/Y', strtotime($data->created_at)) !!}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
											    </tr>
												 @endforeach
												 @else
												 <b>No Withdrawal Log At The Moment</b><br><br><br><br><br><br><br><br><br>
											 </b><br><br><br><br><br><br><br><br><br>
											 
												 @endif
												

											    
											</tbody>
										</table>
										 {{$withdraw->links()}}
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->
@stop
