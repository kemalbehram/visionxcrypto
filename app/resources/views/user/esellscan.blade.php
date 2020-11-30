@extends('include.dashboard')

@section('content')
<div class="dashboard-user-content performance-panel">
							<div class="performance-chart-wrapper"> 
									 <div class="dashbsoard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Preview Trade</div>
								<div class="payout-date">{{$data->currency->name}}</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> </div> <!-- /.next-payout-box --><div class="content-area card"><div class="card-innr"><center>
  <h6 class="text-danger">Please read carefully before you pay into our {{$data->currency->name}} address</h6></center>
        <ul class='list-group text-secondary'>
            <li class='notice list-group-item'>
                Do not pay below {{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} ).
            </li>

            <li class="notice list-group-item">
             {{$basic->sitename}} will not be responsible for funding a wrong account number provided by you
            </li>

        </ul></div>
<div class="content-area card"><div class="card-innr"><div class="card-head"></div>
<center>
<h5 class="card-title card-title-md">Order details ({{$data->currency->name}})</h5>
@if($data->currency->id != 11)<center><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$data->currency->payment_id}}&choe=UTF-8\" style='width:100px;' /></center>
@else
Perfect Money Account: {{$data->currency->payment_id}}

@endif

<br>
<span class="dt-type-md badge badge-outline badge-info badge-sm"><i class = "fa fa-spinner fa-spin"></i>&nbsp;Awaiting</span>
</center>

<div class="col-12">
@if($data->currency->id != 11)
<div class="card-text center"><p>Please pay <strong>{{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} )</strong> to the wallet address below or scan the wallet QR Code above to initiate payment form your wallet app. Please note; do not send below ${{number_format($data->amount, $basic->decimal)}}. We only credit what you send</p></div>
@else

<div class="card-text"><p>Please send <strong>{{round($data->amount / $data->currency->price,8)}} {{$data->currency->symbol}} (${{number_format($data->amount, $basic->decimal)}} )</strong> to the Perfect Money account below. Please note; do not send below ${{number_format($data->amount, $basic->decimal)}}. We only credit what you send</p></div>
@endif


<div class="referral-form"><br>
@if($data->currency->id != 11)
<div class="d-flex justify-content-between align-items-center"><h6 class="mb-0 font-bold">Wallet Address</h6><a href="#" class="link link-primary link-ucap">Copy</a></div><div class="copy-wrap mgb-1-5x mgt-1-5x"><span class="copy-feedback"></span> <input type="text" class="form-control" value="{{$data->currency->payment_id}}" disabled><button class="copy-trigger copy-clipboard" data-clipboard-text="{{$data->currency->payment_id}}"><em class="ti ti-files"></em></button></div>
@endif


 <div class="note note-plane note-danger note-sm pdt-1x pl-0"><p>To enhance your payment processing, click the buton below and upload a screenshot of your successful transaction with your transaction number if any.</p><br></div>
<!-- .copy-wrap --></div><ul class="share-links"><li> <a href="#" data-toggle="modal" data-target="#pay-confirm""><span class="btn btn-info">Process Payment</span></a><br><br></li> </ul></div></div>




</div></div>


</div></div> </div>                             </div></div></div><!-- .container --></div>
 


<!-- Withdraw  Modal -->
			<div class="modal fade wallet-page-modal" id="pay-confirm" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs-two" id="myTabTwo" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="withdraw-panel-tab" data-toggle="tab" href="#withdraw-panel" role="tab" aria-controls="withdraw-panel" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="wallet-pin-tab" data-toggle="tab" href="#wallet-pin" role="tab" aria-controls="wallet-pin" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContentTwo">
								<div class="tab-pane fade show active" id="withdraw-panel" role="tabpanel" aria-labelledby="withdraw-panel-tab">
									<div class="theme-modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<h3 class="main-title tooltip-holder">
												Upload Proof Of Payment
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please fill the form below to uload yor proof of payment."><img src="{{url('assets/images/info.png') }}" alt=""></button>
											</h3> 
											<form role="form" method="POST"  action="{{ route('esellupload') }}" class="withdraw-action-form" enctype="multipart/form-data">
											{{ csrf_field() }}
								    			 

												 
												
												
												<div class="withdraw-address">
													 
													<textarea name="trxx"  placeholder="Enter Trasaction Nnmber " ></textarea>
												</div>

 
												
												<div class="wallet-amount withdraw-amount">
													  <label  class="input-item-label">Upload Payment Screenshot</label>
													 
															<div class="input-group-wrapper main-currency">
																<input name="photo" type="file"   class="cur-check">
								        						 
								        					</div>
														 
												</div> <!-- /.wallet-amount -->
												<input name="trx" hidden value="{{$data->trx}}">
												<button type="submit" class="theme-button continue-button-two"><span></span>Proceed</button>
								    		</form>
								    	</div> <!-- /.details-option -->


								    	<div class="modal-sidebar">
								    		<div class="summary-content">
								    			<h4 class="summary-title font-fix">Amount</h4>
								    			<div class="crypto-balance font-fix">{{round($data->amount / $data->currency->price,8)}}{{$data->currency->symbol}} </div>

								    			<ul>
								    				<li class="list-item">
								    					<div class="sidebar-title">Currency</div>
								    					<div class="value font-fix">{{$data->currency->name}}</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Transaction Number</div>
								    					<div class="value font-fix">{{$data->trx}}</div>
								    				</li>
								    				<li class="list-item">
								    					<div class="sidebar-title">Processing Time</div>
								    					<div class="value font-fix">Processed in 10 Mins</div>
								    				</li>
								    			</ul>
												
												
								    			<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please noe that all offline payment remains pending unil confirmed on our server."><img src="{{asset('assets/images/help.png')}}" alt="">Trade Help</button>
								    		</div> <!-- /.summary-content -->
								    	</div> <!-- /.modal-sidebar -->
								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->

								 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#withdraw-modal -->
@endsection
