@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** --> 
<div class="dashboard-user-content performance-panel">
							 	<div class=" t payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Preview Trade</div>
								<div class="payout-date">{{$data->currency->name}} </div>
								<img src="{{asset('assets/images/coins.png') }}" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							
								<div class="card-text"><p>Find below the summary of your {{$data->currency->name}} purchase. {{$basic->sitename}} will not be liable to any loss arising from wrong wallet address, or reduction in {{$data->currency->name}} price rate</p><p>You can cancel this operation by clicking <a href="{{ route('ebuydel',$data->trx) }}">here</a></p></div>
							<div class="fund-information-table table-responsive">
								<table class="table">
									<tbody>
									    <tr>
										    <td>
										    	<div class="title">Amount </div>
										    	<div class="text font-fix">{{number_format($data->amount, $basic->decimal)}} USD</div>
										    </td>
										    <td>
										    	<div class="title">Our Rate</div>
										    	<div class="text font-fix">$1.00 = {{$basic->currency_sym}}{{number_format($data->currency->buy, $basic->decimal)}}</div>
										    </td> 
									    </tr>
									    <tr>
										    <td>
										    	<div class="title">Amount In {{$basic->currency}}</div>
										    	<div class="text font-fix">{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</div>
										    </td>
										    <td>
										    	<div class="title">Price</div>
										    	<div class="text font-fix">1{{$data->currency->symbol}} = ${{number_format($data->currency->price, $basic->decimal)}}</div>
										    </td>
									    </tr>
									    <tr>
										   <td>
										    	<div class="title">Payment Gateway</div>
										    	<div class="text font-fix">@if($data->gateway)
												{{App\Gateway::whereId($data->gateway)->first()->name}}</span>

													@else
													Payment Method:

													{{App\PaymentMethod::whereId($data->method)->first()->name}}Bank: {{App\Bank::whereId($data->bank)->first()->name}}
													@endif
												</div>
										    </td> 
										    <td>
										    	<div class="title">My Payment Wallet Address</div>
										    	<div class="text font-fix">
												{{$data->wallet}}
												</div>
										    </td> 
									    </tr>
									</tbody>
								</table>
								<br><br>
								<a href="{{ route('ebuypost',$data->trx) }}"><span class="theme-button continue-button-two">Proceed With Payment</span></a>
								<br><br>
								
							</div><br><br> <!-- /.fund-information-table -->   
			
@stop
