@extends('include.dashboard')
@section('content')
         

@php
$ip = \App\UserLogin::whereUser_id(Auth::user()->id)->latest()->take(1)->first();
 $ncount = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();

 $ipcount = \App\UserLogin::whereUser_id(Auth::user()->id)->count();
@endphp

@if(Auth::user()->balance < 1 )
<!-- ******************** Dashboard Body Wrapper *********************** -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
<script>
 Swal.fire({
  title: 'Balance: {{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}',
  text: '',
  imageUrl: '{{asset('assets/images/Walletdeposit.gif')}}',
  imageWidth: 230,
  imageHeight: 250,
  imageAlt: 'Custom image',
  html:
    '<h6>Fund your Naira Wallet to enjoy seamless transactions on Vision-X Crypto.</h6><br><br>' +
    '<a href="{{route('my-wallet')}}"><button class="btn btn-outline-primary"><i class="fa fa-bank"></i> Deposit</button></a> <br>' +
    '',
  showCloseButton: true,
  showCancelButton: false,
  showConfirmButton: false 
 
})
</script>
@endif


						<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content investment-panel">
						@if($ncount > 0)
<div class="alert alert-info alert-dismissible fade show">Hello {{Auth::User()->username}}!, You have {{$ncount}} unread message(s). Please <a href="{{route('inbox')}}">Click Here</a> to open your inbox<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
@endif
						<div class="performance-chart-wrapper">
								<div class="row">
									<div class="col-lg-9">
										<div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="#" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Bitcoin Prices</a>&nbsp;by {{$basic->sitename}}</div></div><br>
									</div>
									<div class="col-lg-3">
										<div class="chart-information-box clearfix">
											<div class="single-action-box">
												<h6 class="title">Total Purchased Cryptos <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Total cryptocurrency purchased on{{$basic->sitename}}"><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
												<div class="value profit-value font-fix">{{$basic->currency_sym}}{{number_format($buy - $bacharge, $basic->decimal)}}</div>
											</div> <!-- /.single-action-box -->

											<div class="single-action-box">
												<h6 class="title">Total Sold Cryptos <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Total cryptocurrency sales made on{{$basic->sitename}}."><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
												<div class="value profit-value font-fix">{{$basic->currency_sym}}{{number_format($sell, $basic->decimal)}}</div>
											</div> <!-- /.single-action-box -->

											<div class="single-action-box bg-info">
												<h6 class="title text-white">Total Investment <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The total investment calculated in Bitcoin."><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
												<div class="value profitd-value font-fix text-white">${{number_format($invested, $basic->decimal)}}<br><small><h6 class="text-white">{{$btcrate*$invested}}BTC</h6></small></div>
											</div> <!-- /.single-action-box -->

											<div class="single-action-box bg-success">
												<h6 class="title text-white">Available Earning <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The total available units in BTC after investment."><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
												<div class="value profit-vsalue font-fix text-white">${{number_format($investment->balance, $basic->decimal)}}<br><small><h6 class="text-white">{{$btcrate*$investment->balance}}BTC</h6></small></div>
											</div> <!-- /.single-action-box -->

										</div> <!-- /.chart-information-box -->
										<div class="chart-update-last-date">Last Updated: <span>{{$time}}</span></div>
									</div>
								</div> <!-- /.row -->
							</div> <!-- /.performance-chart-wrapper -->

 
  
							<ul class="investment-history clearfix">
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Wallet Balance</h6>
										<strong class="figure total-earn">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Total Bonus</h6>
										<strong class="figure total-earn ">{{$basic->currency_sym}}{{number_format(Auth::user()->bonus, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li> 
 

 

									<div class="inner-warpper">
										<h6 class="inner-title">Total Withdrawal</h6>
										<strong class="figure text-success">{{$basic->currency_sym}}{{number_format($withdraw, $basic->decimal)}}</strong>
									</div> <!-- /.inner-warpper -->
								</li>
								<li>
									<div class="inner-warpper">
										<h6 class="inner-title">Pending Withdrawal</h6>
										<div class="figure text-warning">{{$basic->currency_sym}}{{number_format($withdrawpend, $basic->decimal)}}</div>
									</div> <!-- /.inner-warpper -->
								</li>
								
								
							</ul> <!-- /.investment-history -->

							<div class="investment-list-item-wrapper">
								<div class="item-filter-header clearfix">
									<h6 class="title">Unfinished Transactions</h6>
									<ul class="right-button-group">
										<li>
											<select class="theme-select-dropdown" name="Status"> 
											  <option value="Active">All</option>
											  <option value="Active">Buy</option>
											  <option value="Waiting">Sell</option>
											</select>
										</li>
										 
									</ul> <!-- /.right-button-group -->
								</div> <!-- /.item-filter-header -->

								<div class="table-responsive investment-table-sheet">
									<table class="table">
										<thead>
										@if(count($trx) >0)
										@foreach($trx as $k=>$data)
										    <tr>
											    <td>
											      <span class="title">Type</span>
											      <div class="info font-fix">@if($data->type == 1) BUY @else SELL @endif</div>
											    </td>
										    	<td>
											      <span class="title">Time</span>
											      <div class="info font-fix">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
											    </td>
											    <td>
											      <span class="title">Amount</span>
											      <div class="info earn">${{number_format($data->amount, $basic->decimal)}}</div>
											    </td>
											    <td>
											     <a href="{{ route('ebuydel',$data->trx) }}">  <button type="button" class="payout-button font-fix bg-danger" >Cancel</button>
											    </td>
											    <td>
											        @if($data->type == 2)
											    <a href="{{ route('esellpost22', $data->trx) }}">  <button type="button" class="edit-invest-button"  >Complete Transaction</button></a>
											        @else
											        <a href="{{ route('ebuypost22', $data->trx) }}">  <button type="button" class="edit-invest-button"  >Complete Transaction</button></a>
											    @endif
											       
											    </td>
										    </tr>
											@endforeach
											@else
											No Transaction Record Found Yet
											@endif
											

										</thead>
										 
									</table>
									{{$trx->links()}}
								</div> <!-- /.investment-table-sheet -->

								 
							</div> <!-- /.investment-list-item-wrapper -->
						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->

					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->



@endsection
