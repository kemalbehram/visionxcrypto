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


<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Electricity Bills</div>
								<div class="payout-date">

											 <button class="deposit-button btn btn-secondary" data-toggle="modal" data-target="#deposit-modal">Pay Bill</button>


 </div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Payment history <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The total utility bills you have paid so far."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix">Total Payment: <span>{{$basic->currency_sym}}{{number_format($sum,2)}}</span></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
									    @if(count($powered) < 1)
									  <h3><center> You dont Have Any Utility Bill Payment Yet</center></h3> <br><br><br><br><br><br><br><br><br><br><br><br>
									  <br><br>
									    @endif
										<table class="table">
											<tbody>
											    	@foreach($powered as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Ref #</div>
					        							<div class="value font-fix  ">{{$data->trx}}</div>
												    </td>
												    <td>
												    	<div class="title">Company</div>
												      	<div class="value font-fix">{{App\Power::whereBillercode($data->gateway)->first()->name}}<br><span class="text-primary">{{$data->method}}</span></div>
												    </td>
												    <td>
												    	<div class="title">Customer</div>
												      	<div class="value font-fix"><span class="text-success">{{$data->details}}</span></div>
												    </td>
												    <td>
												      	<div class="title">PIN</div>
												      	<div class="value font-fix"> {{$data->pin}}</div>
												    </td>
												    <td>
												      	<div class="title">Serial</div>
												      	<div class="value font-fix"> {{$data->serial}}</div>
												    </td>
												    <td>
												      	<div class="title">Date</div>
												      	<div class="value font-fix">{!! date('d-M-Y', strtotime($data->created_at)) !!}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">{{$basic->currency_sym}}{{number_format($data->amount,2)}}</div>
												    </td>
												    <td>
												    	<div class="title">Units</div>
					        							<div class="value font-fix payout-amount">{{$data->unit}}</div>
												    </td>
											    </tr>
											    @endforeach


											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
								{{$powered->links()}}
							</div> <!-- /.payout-history-wrapper -->

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

													 document.getElementById("name").innerHTML = $(identifier).data('deco');
													 document.getElementById("name1").innerHTML = $(identifier).data('name');
													 document.getElementById("name2").innerHTML = $(identifier).data('name');
													 document.getElementById("name3").innerHTML = $(identifier).data('type');
													 document.getElementById("type").innerHTML = $(identifier).data('metertype');
													 document.getElementById("code").value = $(identifier).data('code');

													 document.getElementById("image").innerHTML = "<img width='40'  src='{{url('assets/images')}}/"+$(identifier).data('image')+"'>";


													 };

													 </script>



								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title">Payment Method</h3>
										<form method="post" action="{{route('validatemeter') }}">
										@csrf
								    			<ul class="wallet-payment-method clearfix">
												@foreach($power as $k=>$data)
													<li class="single-checkbox" onclick="goDoSomething(this);" data-code="{{$data->billercode}}"  data-name="{{$data->name}}" data-metertype="{{$data->type}}"  data-deco="{{$data->symbol}}" data-type="Meter" data-image="{{$data->image}}" >
														<input type="checkbox" value="{{$data->billercode}}" name="meter" id="pay-bitcoin{{$data->id}}" class="pay-check">

														<label for="pay-bitcoin{{$data->id}}">
														    <b class="text-primary">{{$data->type}}</b>
															<img style="width:70px;height:60px;"  src="{{url('assets/images')}}/{{$data->image}}" alt="">

														</label>

													</li>
												@endforeach

												</ul>

													 <script type="text/javascript">
													function myAmount() {
													 var amount = $('#myPhone').val() ;

													  document.getElementById("decodernumber").innerHTML =  amount;
													  document.getElementById("decodernumber").value =  amount;

													 };
													</script>


												<div class="wallet-amount payment-amount">
													<h3 class="main-title">Meter Number</h3>
													<div class="input-group-wrapper main-currency">
														<input type="checkbox" class="cur-check">
						        						<label for="main-cur">

							        						<input type="number"  name="meternumber" id="myPhone" onkeyup="myAmount()" >
							        						<span class="currency-name"><a id="name1"></span>
						        						</label>
						        					</div>
												</div> <!-- /.wallet-amount -->
												<input name="code" id="code" hidden >

												<button type="submit" class="theme-button "><span></span>Validate Meter Number</button>
								    		</form>
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Available Balance</h4>
								    			<div class="crypto-balance font-fix">{{$basic->currency_sym}}{{number_format(Auth::user()->balance, $basic->decimal)}}</div>

								    			<ul><br>
								    				<li class="list-item">
								    					<div class="sidebar-title">Company</div>
								    					<div class="value font-fix"><a id="image"> </a> <a id="name2">Select Company</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title"><a id="name"> Meter </a> <a id="name3"> </a> Number</div>
								    					<div class="value font-fix"><a id="decodernumber">**********</a></div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Meter Type</div>
								    					<div class="value font-fix"id="type">Select Meter</div>
								    				</li>
								    			</ul>
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please select power service compnay and enter your meter or card number to validate your account."><img src="{{url('assets/images/help.png')}}" alt="">Payment Help</button>
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
