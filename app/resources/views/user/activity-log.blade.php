@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Total:</div>
								<div class="payout-date">{{count($activity)}} Sessions</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
 								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
												@foreach($activity as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
					        							<div class="value font-fix payment-status paid">Login</div>
												    </td>
												    <td>
												    	<div class="title">Location</div>
												      	<div class="value font-fix">{{$data->location}}</div>
												    </td>
												    <td>
												      	<div class="title">Info</div>
												      	<div class="value font-fix"> {{$data->details}}</div>
												    </td>
												    <td>
												      	<div class="title">Date</div>
												      	<div class="value font-fix">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
												    </td>
												    <td>
												    	<div class="title">IP</div>
					        							<div class="value font-fix payout-amount">{{$data->user_ip}}</div>
												    </td>
											    </tr>
												@endforeach
												

											    
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
								{{$activity->links()}}
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->

			
			
@stop
