@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** --> 
<div class="dashboard-user-content performance-panel">
							 	<div class=" t payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Next Payout</div>
								<div class="payout-date">in {!! $method->duration !!} Day(s)</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							
								<div class="card-text"><p>Please ensure you have double checked your withdrawal details before proceeding with withdrawal</p></div>
							<div class="fund-information-table table-responsive">
								<table class="table">
									<tbody>
									    <tr>
										    <td>
										    	<div class="title">Payment Method</div>
										    	<div class="text font-fix">{!! $method->name !!}</div>
										    </td>
										    <td>
										    	<div class="title">Fixed Charge</div>
										    	<div class="text font-fix">{{$basic->currency_sym}}{!! $method->fix !!}</div>
										    </td> 
									    </tr>
									    <tr>
										    <td>
										    	<div class="title">Percentage Charge</div>
										    	<div class="text font-fix">{!! $method->percent !!} %</div>
										    </td>
										    <td>
										    	<div class="title">Total Charge</div>
										    	<div class="text font-fix">{{$basic->currency_sym}} {{$charge}}</div>
										    </td> 
									    </tr>
									    <tr>
										    <td>
										    	<div class="title">Total Amount</div>
										    	<div class="text font-fix">{{$basic->currency_sym}} {{$charge + $amount}}</div>
										    </td>
										    <td>
										    	<div class="title">{{$method->name}} Account Details</div>
										    	<div class="text font-fix">{{$pay}}</div>
										    </td> 
									    </tr>
									</tbody>
								</table>
								<br><br><br><br>
							</div><br><br> <!-- /.fund-information-table -->  
 <form method="post" action="{{route('withdraw.submit')}}">
{{ csrf_field() }}
<input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
 <input name="send_details" value="{{$pay}}" hidden>
 <button type="submit" class="btn btn-primary bonus">Submit Request</button></form>
			
@stop
