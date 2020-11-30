@extends('include.dashboard')

@section('content') 
<div class="dashboard-user-content payout-panel">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Make Payment</div>
								<div class="payout-date">@if($data->gateway == 103)
 USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
 @else
 {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
 @endif</div>
								<img src="images/coins.png" alt="" class="coins">
							</div>  
 <!-- ***************** User Content **************** -->
						 <!-- /.next-payout-box -->
            <li class='notice list-group-item'>
                Do not pay below the {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}.
            </li>
            <li class="notice list-group-item">
                You are charged {{$basic->currency_sym}}{{number_format($basic->transcharge, $basic->decimal)}} Stamp Duty to the total amount payable.
            </li>
             
            <li class="notice list-group-item">
                Payment must originate from your own bank account bearing the same registered names with {{$basic->sitename}}. Third-party payment via internet transfer, mobile transfer and other electronic means are not allowed. Third-party payment will be refunded with various charges applied and the reversal of third-party payment involves a lengthy process that can take several weeks.
            </li>
            <li class="notice list-group-item">
                We may request for more documents as a proof that the money was paid by yourself. So, you must be ready to submit them if they are requested.
            </li>
            
            <li class="notice list-group-item">
                	{{$basic->sitename}} not be RESPONSIBLE for funding a wrong ACCOUNT or WALLET provided by you.
            </li>
            
            <li class="notice list-group-item">
                	By proceeding to pay into our bank account, you agree to these terms.
            </li>
        </ul>
<div class="token-overview-wrap">
<br>
@if($data->gateway)
	 

@if($data->gateway == 99)

<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											    <tr role="row">
												 
												    <td>
												      	<div class="title">Payment Method</div>
												      	<div class="value font-fix">Deposit Wallet</div>
												    </td>
												    <td>
												    	<div class="title">Type</div>
					        							<div class="value font-fix payout-amount">Self Serviced</div>
												    </td>
											    </tr>

											     
 
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
@else


<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											    <tr role="row">
												 
												    <td>
												      	<div class="title">Payment Method</div>
												      	<div class="value font-fix">{{isset(App\Gateway::whereId($data->gateway)->first()->name) ? App\Gateway::whereId($data->gateway)->first()->name  : 'N/A'}}</div>
												    </td>
												    <td>
												    	<div class="title">Type</div>
					        							<div class="value font-fix payout-amount">Online</div>
												    </td>
											    </tr>

											     
 
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
@endif

@else
	<br>
<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											    <tr role="row">
												 <td>
												      	<div class="title">Payment Method</div>
												      	<div class="value font-fix"><img width="100" src="{{url('assets/images/bank.png')}}" alt="" class="currency-icson"> </div>
												    </td>
											      	<td>
												      	<div class="title">Bank Name</div>
					        							<div class="value font-fix payment-status paid">{{App\Bank::whereId($data->bank)->first()->name}}</div>
												    </td>
												    <td>
												    	<div class="title">Account Name</div>
												      	<div class="value font-fix">{{App\Bank::whereId($data->bank)->first()->accname}}</div>
												    </td>
												   
												    <td>
												      	<div class="title">Account Number</div>
												      	<div class="value font-fix">{{App\Bank::whereId($data->bank)->first()->account}}</div>
												    </td>
												    <td>
												    	<div class="title">Amount</div>
					        							<div class="value font-fix payout-amount"> @if($data->gateway == 103)
 USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
 @else
 {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
 @endif</div>
												    </td>
											    </tr>

											     
 
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
 
@endif


<div class="note note-plane text-danger note-danger note-sm pdt-1x pl-0"><p>Do not pay below  @if($data->gateway == 103)
 USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
 @else
 {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
 @endif After payment, click Confirm Payment button below and fill/upload your payment information.</p></div></div>



<br>
<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											    <tr role="row">
												 
												    <td>
												      	<div class="title">What You Get</div>
												      	<div class="value font-fix">@if($data->currency->symbol == "PM")
{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}
@else
{{$data->currency->symbol}}{{number_format($data->getamo, 8)}}
@endif</div>
												    </td>
												    <td>
												    	<div class="title">Total Cost</div>
					        							<div class="value font-fix payout-amount"> @if($data->gateway == 103)
 USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
 @else
 {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
 @endif</div>
												    </td>
											    </tr>

											     
 
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
 
<br>


@if($data->gateway == 107)
<script src="https://js.paystack.co/v1/inline.js"></script>
<button  onclick="payWithPaystack()" class="theme-button continue-button-two">Pay With Paystack <em class="ti ti-credit-card"></em></button>


<script>
function payWithPaystack(){
var handler = PaystackPop.setup({
key: "{{App\Gateway::whereId($data->gateway)->first()->val1}}",
email: "{{ Auth::user()->email }}",
amount: "{{($data->main_amo)  * 100}}",
currency: "NGN",
						ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
						firstname: '',
						lastname: '',
						// label: "Optional string that replaces customer email"
						metadata: {
						custom_fields: [
						{
						display_name: "Mobile Number",
						variable_name: "",
						value: "{{ Auth::user()->phone }}"
						}
						]
						},
						callback: function(response){
						alert('Deposit successful. transaction refference number is ' + response.reference);
						window.location='javascript: submitform()';
						},
						onClose: function(){
						alert('window closed');
						}
						});
						handler.openIframe();
						}
						</script>



			 <script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>
			<form id="myform"  action="{{route('buy.paystack')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			</form>


@elseif($data->gateway == 100)
 <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<button  onclick="payWithRave()" class="theme-button continue-button-two" >Pay With Flutterwave <em class="ti ti-credit-card"></em></button>



    <script>
			const API_publicKey = "{{App\Gateway::whereId($data->gateway)->first()->val1}}";
			function payWithRave() {
			var x = getpaidSetup({
			PBFPubKey: API_publicKey,
			customer_email: "{{ Auth::user()->email }}",
			amount: "{{ round($data->main_amo, 2)}}",
			customer_phone: "{{ Auth::user()->mobile }}",
			currency: "NGN",
			txref: "rave-123456",
		    payment_options: "card",
			meta: [{
			metaname: "flightID",
			metavalue: "AP1234"
			}],
			onclose: function() {},
			callback: function(response) {
			var txref = response.tx.txRef; // collect txRef returned and pass to a 					server page to complete status check.
			console.log("This is the response returned after a charge", response);
			if (
			response.tx.chargeResponseCode == "00" ||
			response.tx.chargeResponseCode == "0"
			) {
			window.location='javascript: submitform()';
			} else {
			// redirect to a failure page.
			}

			x.close(); // use this to close the modal immediately after payment.
			}
			});
			}
			</script>
			 <script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>
			<form id="myform"  action="{{route('buy.rave')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			</form>



@elseif($data->gateway == 103)
<button  data-toggle="modal" data-target="#get-pay-address" class="theme-button continue-button-two">Pay With Stripe<em class="ti ti-credit-card"></em></button>


<!-- Modal End --><div class="modal fade" id="get-pay-address" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-close"></em></a><div class="popup-body"><h4 class="popup-title">Pay With Stripe</h4><p>Please Enter Your Credit Card Details Below.  <strong>USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}</strong> will be charged from your card and <strong>{{$data->get_amount}} {{$data->currency->symbol}}</strong> will be credited to your <strong>{{$data->currency->name}} Wallet</strong> once we recevied payment.</p><div class="gaps-1x"></div><h6 class="font-bold">Name Written On Card</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>
<form role="form" id="payment-form" method="POST" action="{{ route('buy.stripe')}}">
@csrf

<input type="text" name="name" placeholder="Card Name" class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-user"></em></button></div>


<div class="gaps-1x"></div><h6 class="font-bold">Card Number</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="tel" name="cardNumber" placeholder="Valid Card Number" class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-credit-card"></em></button></div>


<div class="gaps-1x"></div><h6 class="font-bold">Card Expiry Date</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="tel" name="cardExpiry" placeholder="MM / YYYY" autocomplete="off" required  class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-calendar"></em></button></div>

<div class="gaps-1x"></div><h6 class="font-bold">CCV</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<input type="numbert"  name="cardCVC"  placeholder="CVC"  class="copy-address"><button class="copy-trigger copy-clipboard" ><em class="ti ti-credit-card"></em></button></div>

<!-- .copy-wrap --><!-- .pay-info-list --><div class="pdb-2-5x pdt-1-5x"><input type="checkbox"  required class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the <strong>{{$basic->sitename}} purchase aggrement &amp; payment terms</strong>.</label></div><button class="btn btn-primary" type="submit">Pay USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}<em class="ti ti-credit-card mgl-4-5x"></em></button></form><div class="gaps-3x"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>Ensure you have confirmed your {{$data->currency->name}} wallet address before proceeding with payment.</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>{{$basic->sitename}} will not be liable to any loss arising from you providing a wrong walletaddress.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->



@section('script')
    <script type="text/javascript" src="https://rawgit.com/jessepollak/card/master/dist/card.js"></script>

    <script>
        (function ($) {
            $(document).ready(function () {
                var card = new Card({
                    form: '#payment-form',
                    container: '.card-wrapper',
                    formSelectors: {
                        numberInput: 'input[name="cardNumber"]',
                        expiryInput: 'input[name="cardExpiry"]',
                        cvcInput: 'input[name="cardCVC"]',
                        nameInput: 'input[name="name"]'
                    }
                });
            });
        })(jQuery);
    </script>
@stop
@elseif($data->gateway == 99)
<form id="myform"  action="{{route('buy.wallet')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
<button  type="submit" class="theme-button continue-button-two">Pay With Deposit Wallet  &nbsp;<em class="ti ti-wallet"></em></button>

			</form>


@else





<form role="form" method="POST" action="{{ route('ebuyupload') }}" class="withdraw-action-form" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input name="trx" hidden value="{{$data->trx}}">
												<button type="submit" class="theme-button continue-button-two"><span></span>Proceed</button>
								    		</form>
 <!--<a href="#" data-toggle="modal" data-target="#pay-confirm"><span class="theme-button continue-button-two">Confirm Payment</span></a>!-->
@endif
 </div>


</div></div>


</div></div> </div>

</div></div></div></div><!-- .container -->
</div>

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
												<button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Please fill the form below to uload yor proof of payment."><img src="images/info.png" alt=""></button>
											</h3> 
											<form role="form" method="POST" action="{{ route('ebuyupload') }}" class="withdraw-action-form" enctype="multipart/form-data">
											{{ csrf_field() }}
								    			<div class="dropdown withdraw-method-dropdown">
													<select required  class="form-control" name="method">
													<option selected>Choose...</option>
													@foreach($method as $cdata)
													<option value="{{$data->id}}">{{$cdata->name}} </option>
													@endforeach
													</select>
													 
												</div> <!-- /.withdraw-method-dropdown -->

												<div class="withdraw-address">
													 
													<textarea name="payer"   placeholder="Account Holder's Name"></textarea>
												</div>
												 
												
												
												<div class="withdraw-address">
													 
													<textarea name="tnum"  placeholder="Enter Trasaction Nnmber " ></textarea>
												</div>


												<div class="wallet-amount withdraw-amount">
													 
													<div class="row">
														<div class="col-sm-12">
															<div class="input-group-wrapper main-currency">
															<span class="currency-icon">{{number_format($data->main_amo, $basic->decimal)}}</span>
																<input  disabled   type="number"  class="cur-check">
								        						<label for="wdrw-main-cur">
								        						 	 <input name="amount" hidden value="{{$data->main_amo}}"  placeholder="Amount Sent" class="cur-check">
									        						<span class="currency-name">{{$basic->currency_sym}} </span>
								        						</label>
								        					</div>
														</div> <!-- /.col- -->

														 
													</div> <!-- /.row -->
												</div> <!-- /.wallet-amount -->
												
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
								    			<div class="crypto-balance font-fix">@if($data->currency->symbol == "PM")
{{$data->currency->symbol}}{{number_format($data->getamo, 2)}}
@else
{{$data->currency->symbol}}{{number_format($data->getamo, 8)}}
@endif</div>
								    			<div class="main-balance font-fix">@if($data->gateway == 103)
 USD{{number_format($data->main_amo/$basic->rate, $basic->decimal)}}
 @else
 {{$basic->currency_sym}}{{number_format($data->main_amo, $basic->decimal)}}
 @endif</div>

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
