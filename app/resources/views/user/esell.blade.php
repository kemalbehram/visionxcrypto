@extends('include.dashboard')

@section('content')

						<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content performance-panel">
							<div class="performance-chart-wrapper"> 
									 <div class="dashbsoard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Preview Trade</div>
								<div class="payout-date">{{$data->currency->name}}</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> </div> <!-- /.next-payout-box -->

								
							<div class="fund-information-table table-responsive">
								<table class="table">
									<tbody>
									    <tr>
										    <td>
										    	<div class="title">Coin Name</div>
										    	<div class="text font-fix">{{$data->currency->name}}</div>
										    </td>
										    <td>
										    	<div class="title">Amount In USD</div>
										    	<div class="text font-fix">${{number_format($data->amount, $basic->decimal)}}</div>
										    </td>
										    <td>
										    	<div class="title">Amount In {{$basic->currency}}</div>
										    	<div class="text font-fix">{{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}</div>
										    </td>
										    <td>
										    	<div class="title">Our Rate</div>
										    	<div class="text font-fix profit-balance">$1.00 = {{$basic->currency_sym}}{{number_format($data->currency->buy, $basic->decimal)}}</div>
										    </td>
									    </tr>
									    <tr>
										    <td>
										    	<div class="title">Bank Name</div>
										    	<div class="text font-fix">{{$data->bankname}}</div>
										    </td>
										    <td>
										    	<div class="title">Account Number</div>
										    	<div class="text font-fix">{{$data->accountnumber}}</div>
										    </td>
										    <td>
										    	<div class="title">Account Name</div>
										    	<div class="text font-fix">{{$data->accountname}}</div>
										    </td>
										    <td>
										    	<div class="title">Activation Time</div>
										    	<div class="text font-fix loss-balance">30Mins</div>
										    </td>
									    </tr>
									</tbody>
								</table>
							</div> <!-- /.fund-information-table --><br><br>
							
							 <li class='notice list-group-item'>
                Do not pay below the {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}.
            </li>
            <li class="notice list-group-item">
                Ensure you verify your bank account details properly before proceeding
            </li>
             
            <li class="notice list-group-item">
                 {{$basic->sitename}} will not be liable to any loss arising from providing wrong account details. Only send your coin to the wallet address shown in the next screen. Will will not call you to sell to another wallet adddress.
            </li><br>
							<a href="{{ route('esellscan',$data->trx) }}"><button class="btn btn-info add-funds-button continue-button">Proceed </button></a><br><br><br><br><br><br><br>
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->

			
			
			
@endsection
