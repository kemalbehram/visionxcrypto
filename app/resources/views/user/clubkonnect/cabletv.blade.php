@extends('include.dashboard')
@section('content')


    @if(Session::has('modal'))
        <script>
            $(document).ready(function () {
                $("#successpopup").modal('show');
            });
        </script>
    @endif

  <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content wallet-panel">
							<div class="row">
								<div class="col-xl-6">
									<div class="bg-box wallet-balance">
										<div class="title">Your TV Subscription Summary</div>
									    <div class="balance-sheet-wrapper">
											<ul>
												<li class="bitcoin-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="50" src="{{url('assets/images/dstv.png')}}" alt="">  </span>
														<span class="balance-inquery">
															<span class="currency-title">{{$basic->currency_sym}}{{number_format($dstv,2)}}</span>
														</span>
													</a>
												</li>
												<li class="ethereum-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="50" src="{{url('assets/images/gotv.jpg')}}" alt="">  </span>
														<span class="balance-inquery">
															<span class="currency-title">{{$basic->currency_sym}}{{number_format($gotv,2)}}</span>
														</span>
													</a>
												</li>
												<li class="litecoin-method clearfix">
													<a class="clearfix" href="#">
														<span class="name font-fix"><img width="50" src="{{url('assets/images/startimes.jpg')}}" alt="">  </span>
														<span class="balance-inquery">
															<span class="currency-title">{{$basic->currency_sym}}{{number_format($startimes,2)}}</span>
														</span>
													</a>
												</li>
											</ul>
											<div class="total-balance clearfix">
												<div class="balance-title">Total Transaction ≈</div>
												<div class="balance-figure">{{$basic->currency_sym}}{{number_format($dstv+$gotv+$startimes,2)}}</div>
											</div>
										</div> <!-- /.balance-sheet-wrapper -->
										<ul class="button-group clearfix">
											<li><button class="deposit-button" data-toggle="modal" data-target="#deposit-modal">Subscribe Now</button></li>

										</ul>
									</div> <!-- /.bg-box -->


								</div> <!-- /.col- -->






								<div class="col-xl-6">
									<div class="transactions-history bg-box">
										<div class="title tooltip-holder">
											Transactions Log
											<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button>
										</div>

										<div class="table-responsive transactions-list">
											<table class="table">
												<tbody>
												@if(count($cabletv) < 1)
													<center><h4>No TV Subscription at the moment<h4></center><br><br><br><br><br><br><br>
												@endif
												 @foreach($cabletv as $k=>$data)
												    <tr role="row" class="single-list">
												      	<td class="time font-fix">
															<div class="month">{!! date('M', strtotime($data->created_at)) !!}</div>
															<div class="date">{!! date(' d', strtotime($data->created_at)) !!}</div>
													    </td>
													    <td>
													    	<div class="heading font-fix">{{$data->remark}}</div>
													      	<div class="value">{{$data->trx}}</div>
													    </td>
													    <td> </td>
													    <td>
													    	<div class="heading font-fix">{{$data->method}}</div>
													      	<div class="value">{{$basic->currency_sym}}{{number_format($data->amount,2)}}</div>
													    </td>
												    </tr>
												@endforeach
												</tbody>
											</table>
										</div> <!-- /.table-data -->
									</div> <!-- /.transactions-history -->
									{{$cabletv->links()}}

								</div> <!-- /.col- -->


							</div> <!-- /.row -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->



			<!-- Deposit  Modal -->
			<div class="modal fade wallet-page-modal" id="deposit-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="wallet-info-tab" data-toggle="tab" href="#wallet-info" role="tab" aria-controls="wallet-info" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="wallet-paymet-success-tab" data-toggle="tab" href="#wallet-paymet-success" role="tab" aria-controls="wallet-paymet-success" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="wallet-info" role="tabpanel" aria-labelledby="wallet-info-tab">
									<div class="theme-modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

													<script type="text/javascript">

													function goDoSomething(identifier){

													 document.getElementById("name").innerHTML = $(identifier).data('name');
													 document.getElementById("name1").innerHTML = $(identifier).data('name');
													 document.getElementById("name2").innerHTML = $(identifier).data('name');
													 document.getElementById("name3").innerHTML = $(identifier).data('type');
													 document.getElementById("deco").value = $(identifier).data('deco');

													 document.getElementById("image").innerHTML = "<img width='40'  src='{{url('assets/images')}}/"+$(identifier).data('image')+"'>";


													 };

													 </script>



								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title">Payment Method</h3>
										<form method="post" action="{{route('validatedecoder') }}">
										@csrf
										<input id="deco" hidden name="deco">
								    			<ul class="wallet-payment-method clearfix">
													<li class="single-checkbox" onclick="goDoSomething(this);" data-name="DSTV"  data-deco="DStv" data-type="Smart Card" data-image="dstv.png" >
														<input type="checkbox" value="dstv" name="decodertype" id="pay-bitcoin" class="pay-check">
														<label for="pay-bitcoin">
															<img src="{{url('assets/images/dstv.png')}}" alt="">
														</label>
													</li>
													<li class="single-checkbox"  onclick="goDoSomething(this);" data-name="GOTV"  data-deco="GOtv" data-type="IUC"  data-image="gotv.jpg" >
														<input type="checkbox"  name="decodertype"  value="gotv" id="pay-ethereum" class="pay-check">
														<label for="pay-ethereum">
															<img src="{{url('assets/images/gotv.jpg')}}" alt="">
														</label>
													</li>
													<li class="single-checkbox"  onclick="goDoSomething(this);" data-type="Decoder"  data-deco="Startimes"  data-name="Startimes" data-image="startimes.jpg" >
														<input type="checkbox" value="startimes"  name="decodertype"  id="pay-litecoin" class="pay-check">
														<label for="pay-litecoin">
															<img src="{{url('assets/images/startimes.jpg')}}" alt="">
														</label>
													</li>
												</ul>

													 <script type="text/javascript">
													function myAmount() {
													 var amount = $('#myPhone').val() ;

													  document.getElementById("decodernumber").innerHTML =  amount;
													  document.getElementById("decodernumber").value =  amount;

													 };
													</script>


												<div class="wallet-amount payment-amount">
													<h3 class="main-title">Decoder Number</h3>
													<div class="input-group-wrapper main-currency">
														<input type="checkbox" class="cur-check">
						        						<label for="main-cur">

							        						<input type="number"  name="decodernumber" id="myPhone" onkeyup="myAmount()" >
							        						<span class="currency-name"><a id="name1"></span>
						        						</label>
						        					</div>
												</div> <!-- /.wallet-amount -->

												<button type="submit" class="theme-button "><span></span>Validate Number</button>
								    		</form>
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Available Balance</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</div>

								    			<ul><br>
								    				<li class="list-item">
								    					<div class="sidebar-title">Decoder Name</div>
								    					<div class="value font-fix"><a id="image"> </a> <a id="name">Select Decoder</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title"><a id="name2">Decoder</a> <a id="name3"> </a>Number</div>
								    					<div class="value font-fix"><a id="decodernumber">**********</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Processing Time</div>
								    					<div class="value font-fix">Instant</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please select a decoder name and enter your IUC or Smart Card Number to validate your decoder number."><img src="{{url('assets/images/help.png')}}" alt="">Subscription Help</button>
								    		</div> <!-- /.summary-content -->
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->


							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#deposite-modal -->



  <!-- success  Modal -->
  <div class="modal fade settings-page-modal" id="successpopup" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="container h-100">
                  <div class="row justify-content-center h-100 align-items-center text-center">
                      <div class="col-xl-5 col-md-6">

                          <div class="identity-content">
                              <img src="{{asset('dash-assets/images/success-tick-dribbble.gif')}}"/>
                              <h4>Transaction Successful</h4>
                              <br/>
                          </div>
                          <br/>

                          <div class="mb-5">
                              <a href="{{route('products')}}" class="btn btn-dark pl-5 pr-5">Goto Products</a> <br/><br/> <a href="{{route('home')}}" class="btn btn-success pl-5 pr-5">Goto Dashboard</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div> <!-- /.modal-content -->
      </div> <!-- /.modal-dialog -->
  </div> <!-- /#success-->




@stop
