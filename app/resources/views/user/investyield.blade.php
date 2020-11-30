@extends('include.dashboard')
@section('content')
   	<!-- ***************** User Content **************** -->
	  <script>
        function createCountDown(elementId, sec) {
            var tms = sec;
            var x = setInterval(function() {
                var distance = tms*1000;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById(elementId).innerHTML =days+"d: "+ hours + "h "+ minutes + "m " + seconds + "s ";
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "{{__('COMPLETE')}}";
                }
                tms--;
            }, 1000);
        }
    </script>
						<div class="dashboard-user-content payout-panel">
						<div class="next-payout-box clearfix">
								<div class="title font-fix">Next Payout</div>
								<div class="payout-date"><small> @if($invest->status == '2')  <span class="badge badge-warning"><i class="fa fa-spinner fa-spin"></i> @lang('Pending')</span>  @elseif($invest->status == '17')  <span class="badge badge-danger"><i class="fa fa-trash fa-spzin"></i> @lang('Rejected')</span>  @else {{ Carbon\Carbon::parse($invest->next_time)->diffForHumans() }} @endif</small></div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Payouts history <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix">Total Payouts: <span>{{count($trans)}}</span></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											 @if(count($trans)==0)
												<tr>
													<td colspan="8" class="text-center">@lang('No Investment Yield Yet')</td>
												</tr>
												
											@endif

											@foreach($trans as $data)
													<tr role="row">
												
											      	<td>
												      	<div class="title">Status</div>
					        							<div class="value font-fix payment-status paid">Paid</div>
												    </td>
												    <td>
												    	<div class="title">Investment</div>
												      	<div class="value font-fix">{{$plans->name }}</div>
												    </td>
												    <td>
												      	<div class="title">Payment Type</div>
												      	<div class="value font-fix"> Interest</div>
												    </td>
												    <td>
												      	<div class="title">Paid out</div>
												      	<div class="value font-fix">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">${{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
												    <td>
												    	<div class="title">Value</div>
					        							<div class="value font-fix payout-amount"><img src="{{asset('assets/images/bitcoin2.png')}}" alt="" class="currency-icon">{{number_format($btcrate * $data->amount, 8)}}BTC</div>
												    </td>
											    </tr>
												
												@endforeach
 
											</tbody>
										</table>
										<br><br><br><br><br><br><br><br><br><br><br>
												<br><br><br><br><br><br><br><br><br>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->

			
			
			
			@endsection
