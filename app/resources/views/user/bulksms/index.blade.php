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
						<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Amount Spent</div>
								<div class="payout-date">{{$basic->currency_sym}}{{number_format($sum, $basic->decimal)}}</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->

							<div class="payout-history-wrapper">
								<div class="clearfix">
									<div class="payout-history-title">Instant SMS History <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="The amount you want to invest, you can always add funds to your investment at any time."><img src="images/info.png" alt=""></button></div>

									<div class="total-payout-count font-fix"><span><button type="button" class="btn btn-sm btn-prismary btn-outline-primary"  data-toggle="modal" data-target="#investment-modal">+ Send New SMS</button></span></div>
								</div>

								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											    @if(count($sms) < 1)
											    <h4><center>You dont have any sent SMS yet.</center></h4>
											    @endif
									      @foreach($sms as $data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
					        							<div class="value font-fix payment-status paid">Sent</div>
												    </td>
												    <td>
												    	<div class="title">Phone</div>
												      	<div class="value font-fix">{{$data->phone}}</div>
												    </td>
												    <td>
												      	<div class="title">Message</div>
												      	<div class="value font-fix"><img src="{{asset('assets/images/sms.png')}}" alt="" class="currency-icon"> {{$data->message}}</div>
												    </td>
												    <td>
												      	<div class="title">Date</div>
												      	<div class="value font-fix">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
												    </td>
											    </tr>
                                        @endforeach
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
								{{$sms->links()}}
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->
	<!-- Investment  Modal -->
			<div class="modal fade" id="investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="invest-name-tab" data-toggle="tab" href="#invest-name" role="tab" aria-controls="invest-name" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-amount-tab" data-toggle="tab" href="#invest-amount" role="tab" aria-controls="invest-amount" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-return-tab" data-toggle="tab" href="#invest-return" role="tab" aria-controls="invest-return" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix">New Instant SMS</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								    </div>

								    <div class="modal-body">
				        				<form  action="{{route('sendsmsnow')}}" method="post">
										{{ csrf_field() }}
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Phone Number</h6>
					        					<input name="phone" type="number" placeholder="080********">
					        				</div> <!-- /.single-input-wrapper -->
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Message</h6>
					        					<input name="message" type="text" placeholder="Enter Message Body">
					        				</div> <!-- /.single-input-wrapper -->

					        				<button button="submit" class="add-funds-button continue-button">Send SMS</button>


				        				</form>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->




							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->

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



@endsection
