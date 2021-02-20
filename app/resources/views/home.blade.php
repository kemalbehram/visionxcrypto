@extends('include.userdashboard')
@section('content')


@php
$ip = \App\UserLogin::whereUser_id(Auth::user()->id)->latest()->take(1)->first();
 $ncount = \App\Message::whereUser_id(Auth::user()->id)->whereAdmin(1)->whereStatus(0)->count();
 $tpend = \App\Trx::whereUser_id(Auth::user()->id)->whereStatus(1)->count();
 $tsuc = \App\Trx::whereUser_id(Auth::user()->id)->whereStatus(2)->count();
 $tdec = \App\Trx::whereUser_id(Auth::user()->id)->whereStatus(3)->count();

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
<!-- Main Content-->
			<div class="main-content side-content pt-0">



				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Hello!!</h2>

							</div>

						</div>
						<!-- End Page Header -->

						<!--Row-->
						<div class="row row-sm">
							<div class="col-sm-12 col-lg-12 col-xl-8">

								<!--Row-->
								<div class="row row-sm  mt-lg-4">
									<div class="col-sm-12 col-lg-12 col-xl-12">
										<div class="card bg-primary custom-card card-box">
											<div class="card-body p-4">
												<div class="row align-items-center">
													<div class="offset-xl-3 offset-sm-6 col-xl-8 col-sm-6 col-12 img-blue ">
														<h4 class="d-flex  mb-3">
															<span class="font-weight-bold text-white "> {{Auth::User()->fname}} {{Auth::User()->lname}}!</span>
														</h4>
														<p class="tx-white-7 mb-1">{{$news}}
													</div>
													<img src="{{url('/')}}/assets/assets/img/pngs/work3.png" alt="user-img">
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--Row -->

								<!--Row-->
								<div class="row row-sm">
									<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="card custom-card">
											<div class="card-body">
												<div class="card-item">
													<div class="card-item-icon card-icon">


														<i class="fas fa-wallet"style="color:green"></i>

														</div>
													<div class="card-item-title mb-2">
														<label class="main-content-label tx-13 font-weight-bold mb-1">Naira Walet</label>
														<span class="d-block tx-12 mb-0 text-muted">Previous month vs this months</span>
													</div>
													<div class="card-item-body">
														<div class="card-item-stat">
															<h4 class="font-weight-bold">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</h4>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
{{--									<div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">--}}
{{--										<div class="card custom-card">--}}
{{--											<div class="card-body">--}}
{{--												<div class="card-item">--}}
{{--													<div class="card-item-icon card-icon">--}}

{{--														<i class="fas fa-dollar"style="color:green"></i>--}}

{{--														</div>--}}
{{--													<div class="card-item-title mb-2">--}}
{{--														<label class="main-content-label tx-13 font-weight-bold mb-1">Investment</label>--}}
{{--														<span class="d-block tx-12 mb-0 text-muted">Employees joined this month</span>--}}
{{--													</div>--}}
{{--													<div class="card-item-body">--}}
{{--														<div class="card-item-stat">--}}
{{--															<h4 class="font-weight-bold">${{number_format($investment->balance, $basic->decimal)}}</h4>--}}

{{--														</div>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
									<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
										<div class="card custom-card">
											<div class="card-body">
												<div class="card-item">
													<div class="card-item-icon card-icon">

														<i class="fas fa-gift"style="color:green"></i>

														</div>
													<div class="card-item-title  mb-2">
														<label class="main-content-label tx-13 font-weight-bold mb-1">Referral Bonus</label>
														<span class="d-block tx-12 mb-0 text-muted">Previous month vs this months</span>
													</div>
													<div class="card-item-body">
														<div class="card-item-stat">
															<h4 class="font-weight-bold">{{$basic->currency_sym}}{{number_format(Auth::user()->bonus, $basic->decimal)}}</h4>

														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--End row-->

								<!--row-->
								<div class="row row-sm">
									<div class="col-sm-12 col-lg-12 col-xl-12">
										<div class="card custom-card overflow-hidden">
											<div style="height:420px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="#" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Bitcoin Prices</a>&nbsp;by {{$basic->sitename}}</div></div>
										</div>
									</div><!-- col end -->
									<!-- col end -->
									<!-- col end -->
									<div class="col-lg-12">
										<div class="card custom-card mg-b-20">
											<div class="card-body">
												<div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
													<div>
														<label class="main-content-label mb-2">Split Payment</label> <span class="d-block tx-12 mb-3 text-muted">Split bills with family and friends with just a click without getting stuck</span>

													<p class="mb-0 tx-24 mt-2"><b class="text"style="color:orange">COMING SOON</b></p>

													</div>

													<div class="  col-6 ">
												<img src="{{url('/')}}/assets/assets/img/pngs/split.png" >
											</div>


												</div>
											</div>
										</div>

										<!--Row-->


										<div class="card custom-card mg-b-20">
											<div class="card-body">
												<div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
													<div>
														<label class="main-content-label mb-2">Trade Bitcoin With Convinience</label> <span class="d-block tx-12 mb-3 text-muted">Enjoy crypto trade with us either on Btc, Eth, or Pm at the best rates</span>

													<br>
											<p> * Convinient trading rate <i class="fas fa-check"style="color:green" ></i></p>
											<p> * Swift transaction request <i class="fas fa-check"style="color:green" ></i></p>
											<p> * Instant Payout settlement <i class="fas fa-check"style="color:green" ></i></p>

											<br>
											<a href="{{route('trade')}}"><button class="btn btn-primary ml-auto">Buy Bitcoin</button></a><br><br><br>

													</div>


													<div class="  col-6 ">
												<img src="{{url('/')}}/assets/assets/img/pngs/coins2.png" >
											</div>


												</div>
											</div>
										</div>


									</div><!-- col end -->
								</div><!-- Row end -->
							</div><!-- col end -->

							<div class="col-sm-12 col-lg-12 col-xl-4 mt-xl-4">






								<div class="card custom-card">
									<div class="card-body h-100">
										<div>
											<h6 class="main-content-label mb-1">What's New!</h6>
											<br>
										</div>
										<div>
											<div class="carousel slide" data-ride="carousel" id="carouselExample4">
												<ol class="carousel-indicators">
													<li class="active" data-slide-to="0" data-target="#carouselExample4"></li>
													<li data-slide-to="1" data-target="#carouselExample4"></li>
													<li data-slide-to="2" data-target="#carouselExample4"></li>
												</ol>
												<div class="carousel-inner">
													<div class="carousel-item active">
														<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/assets/img/pngs/advert1.png">

													</div>
													<div class="carousel-item">
														<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/assets/img/pngs/advert2.png">

													</div>
													<div class="carousel-item">
														<img alt="img" class="d-block w-100 op-10" src="{{url('/')}}/assets/assets/img/pngs/advert3.png">

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>


								<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Quick Links</label>
													<span class="d-block tx-12 mb-0 text-muted">Airtime/Data Topup</span>
												</div>
												<p class="mb-0 tx-24 mt-2"><b class="text"style="color:green">100%</b></p>
												<a href=" " class="text-muted">Instant topup </a>
											</div>
											<div class="col-6">
												<img src="{{url('/')}}/assets/assets/img/pngs/airtime.png" alt="image" class="best-emp">
											</div>
										</div>
									</div>
								</div>
								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
										<div>
											<label class="main-content-label mb-2 pt-2">Verification Level</label>
											<span class="d-block tx-12 mb-2 text-muted">No verification, No Enjoyment</span>

											 @php
							  if(Auth::user()->bankyes == 1 ){

							  $a = 1; }
							 if(Auth::user()->bankyes != 1 ){

							 $a = 0;
							}

							 if(Auth::user()->bvn_verify == 1 ){
							 $b = 1; }
							  if(Auth::user()->bvn_verify != 1 ){

							 $b = 0;
							 }
							 if(Auth::user()->verified == 2 ){

							 $c = 1; }
							 if(Auth::user()->verified != 2 ){
							 $c = 0;
							}

							@endphp

							 @php
							 $stars = $a + $b + $c;
							 @endphp

							 @if($stars == 1)
							 <p> Level 1----- ₦1000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>
											<p> Level 2----- ₦2,000,000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>
											<p> Level 3----- ₦10,000,000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>

							 @elseif($stars == 2)

							 <p> Level 1----- ₦1000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>
											<p> Level 2----- ₦2,000,000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>
											<p> Level 3----- ₦10,000,000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>

							 @elseif($stars == 3)

							 <p> Level 1----- ₦1000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>
											<p> Level 2----- ₦2,000,000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>
											<p> Level 3----- ₦10,000,000 limit <i class="fas fa-check-circle"style="color:green" ></i></p>

							 @else

							<p> Level 1----- ₦1000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>
											<p> Level 2----- ₦2,000,000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>
											<p> Level 3----- ₦10,000,000 limit <i class="fas fa-check-circle"style="color:red" ></i></p>

							 @endif

										</div>
									</div>

								</div>



								<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-6">
												<div class="card-item-title">
													<label class="main-content-label mb-2 pt-2">Refer & Earn</label>
													<span class="d-block tx-12 mb-0 text-muted">Stay at the peak of your game</span>
												</div><br>

											<a  href="{{route('referral')}}" >	<button class="btn btn-primary ml-auto">Invite Now</button></a>
											</div>
											<div class="col-6">
												<img src="{{url('/')}}/assets/assets/img/pngs/reward.png" alt="image" class="  ">
											</div>
										</div>
									</div>
								</div>



								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
										<div>
											<label class="main-content-label mb-2 pt-2">Total Withdrawal</label>

											<p class="mb-0 tx-24 mt-2"><b class="text"style="color:green">{{$basic->currency_sym}}{{number_format($withdraw, $basic->decimal)}}</b></p>
											<br>

										</div>
									</div>

								</div>


								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
										<div>
											<label class="main-content-label mb-2 pt-2">Successful Transaction</label>

											<p class="mb-0 tx-24 mt-2"><b class="text"style="color:green">{{$tsuc}}</b></p>
											<br>
										</div>
									</div>

								</div>


								<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
										<div>
											<label class="main-content-label mb-2 pt-2">Pending Transaction</label>

											<p class="mb-0 tx-24 mt-2"><b class="text"style="color:orange">{{$tpend}}</b></p>
											<br>
										</div>
									</div>

								</div>


										<div class="card custom-card">
									<div class="card-header border-bottom-0 pb-0 d-flex pl-3 ml-1">
										<div>
											<label class="main-content-label mb-2 pt-2">Declined Transaction</label>

											<p class="mb-0 tx-24 mt-2"><b class="text"style="color:red">{{$tdec}}</b></p>
											<br>
										</div>
									</div>

								</div>
									</div>
								</div>


								<!-- Row-->
						<div class="row row-sm">
							<div class="col-xl-12">
								<div class="card custom-card">
									<div class="card-header border-bottom-0">
										<label class="main-content-label my-auto pt-2">Incomplete Transactions Log</label>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table card-table text-nowrap table-bordered border-top">
												<thead>
													<tr>
														<th>ID</th>
														<th>Type</th>
														<th>Amount</th>
														<th>Currency</th>
														<th>Status</th>
														<th>Fee (%)</th>
														<th>Action</th>
														<th>Cancel</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												@if(count($trx) >0)
										@foreach($trx as $k=>$data)
													<tr>
														<td>#{{$data->trx}}</td>
														<td class="text-success">@if($data->type == 1) BUY @else SELL @endif</td>
														<td><i class="cc BTC-alt text-warning"></i> ${{number_format($data->amount, $basic->decimal)}}</td>
														<td><i class="cc BTC-alt text-warning"></i> {{App\Currency::whereId($data->currency_id)->first()->name ?? "Unknown"}}</td>
														<td><span class="badge badge-warning-light badge-pill">Pending</span></td>
														<td>${{number_format($data->charge , $basic->decimal)}}</td>
														<td>
														  @if($data->type == 2)
											    <a href="{{ route('esellpost22', $data->trx) }}">  <span class="badge badge-info-light badge-pill">Pay</span></a>
											        @else
											        <a href="{{ route('ebuypost22', $data->trx) }}">  <span class="badge badge-info-light badge-pill">Pay</span></a>
											    @endif
														 <td><a href="{{ route('ebuydel',$data->trx) }}"><span class="badge badge-danger-light badge-pill">Cancel</span></a></td>
														<td>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
													</tr>
													@endforeach
											@else
											No Transaction Record Found Yet
											@endif

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Row End -->
					</div>
				</div>
			</div>
			<!-- End Main Content-->
@endsection
