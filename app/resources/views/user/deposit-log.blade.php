@extends('include.dashboard')
@section('content')
  <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Total Deposit </div>
								<div class="payout-date">{{$basic->currency_sym}}{{number_format($sum, $basic->decimal)}}</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Deposit history <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix">All Deposits: <span>{{$count}}</span></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											@if(count($deposit) >0)
											@foreach($deposit as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
														@if($data->status == 1)
														<div class="value font-fix payment-status paid">Approved</div>
														@elseif($data->status == 2)
														<div class="value font-fix payment-status open">Pending</div>
														@elseif($data->status == 0)
														<div class="value font-fix payment-status open">Unfinished</div>
														@elseif($data->status == -2)
														<div class="value font-fix payment-status open">Declined</div>
														@endif

					        							
												    </td>
												    <td>
												    	<div class="title">Transaction ID</div>
												      	<div class="value font-fix">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</div>
												    </td>
												    <td>
												      	<div class="title">Payment Method</div>
												      	<div class="value font-fix"> {{isset($data->gateway->name) ? $data->gateway->name : 'Bank Transfer'}}</div>
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
												 <b>No Deposit Log At The Moment<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></b>
												 @endif
												

											    
											</tbody>
										</table>
										 {{$deposit->links()}}
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->
@stop
