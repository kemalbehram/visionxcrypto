@extends('include.dashboard')
@section('content')
<div class="dashboard-user-content investment-panel">
						
<div class="tab-pane fadse" id="invest-payment-method" role="tabpanel" aria-labelledby="invest-payment-method-tab">
									 

								    <div class="main-container clearfix">
								    	<div class="details-option">
								    		<div class="main-content-wrapper">
								    			<h4 class="main-title font-fix">Preview Payment</h4>
								    			<p class="sub-info">You have opted to deposit using  @if($data->gateway_id == 0)
Bank Transfer
@else
{{App\Gateway::whereId($data->gateway_id)->first()->name}}.
@endif
 Please find your pre-payment summary below.</p>
								    			 
								    				<div class="invest-amount-details">
								        				<div class="input-box-wrapper">
								        					<ul class="payment-method-one">
								        						 
								        						<li class="clearfix payment-action-list list-item">
								        							<div class="currency-name font-fix">
								        								<img src="images/bitcoin2.png" alt=""> Gateway
								        							</div>
								        							<div class="payment-time"> 
																	@if($data->gateway_id == 0)
																	<img width="50" src="{{url('assets/images')}}/bank.png" alt="">
																	@else
																		
																	<img width="50" src="{{url('assets/images')}}/{{App\Gateway::whereId($data->gateway_id)->first()->val7}}" alt="">
																	@endif
																	</div>
								        						</li>
								        						<li class="clearfix payment-action-list list-item">
								        							<div class="currency-name font-fix">
								        								<img src="images/bitcoin2.png" alt=""> Amount
								        							</div>
								        							<div class="payment-time">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</div>
								        						</li>
																<li class="clearfix payment-action-list list-item">
								        							<div class="currency-name font-fix">
								        								<img src="images/bitcoin2.png" alt=""> Charges
								        							</div>
								        							<div class="payment-time">{{$basic->currency_sym}}{{number_format($data->charge, $basic->decimal)}}</div>
								        						</li>
								        						<li class="clearfix payment-action-list list-item">
								        							<div class="currency-name font-fix">
								        								<img src="images/ethereum2.png" alt=""> Total Amount
								        							</div>
								        							<div class="payment-time">{{$basic->currency_sym}}{{number_format($data->charge + $data->amount, $basic->decimal)}}</div>
								        						</li>
								        						<li class="clearfix payment-action-list list-item">
								        							<div class="currency-name font-fix">
								        								<img src="images/litecoin2.png" alt=""> Amount In USD
								        							</div>
								        							<div class="payment-time">${{number_format($data->usd, $basic->decimal)}}</div>
								        						</li>
								        					</ul>
								        				</div> <!-- /.input-box-wrapper -->
														@if($data->gateway_id == 0)
<div class="card-text"><p>Make Payment To The Account Number on Rubies Bank and your deposit wallet will be credited instantly with the amount credited </p></div>
 

<div class="fund-information-table table-responsive">
								<table class="table">
									<tbody>
							 
 
									    <tr>
										    <td>
										    	<div class="title">Bank Name</div>
										    	<div class="text font-fix">Rubies Bank</div>
										    </td>
										    <td>
										    	<div class="title">Account Number</div>
										    	<div class="text font-fix">{{auth::user()->account_number}}</div>
										    </td> 
									    </tr> 
									     									
									</tbody>
								</table>
							</div> <!-- /.fund-information-table -->
							 
 
@elseif($data->gateway_id == 103)
<style>
 /* If you like this, please check my blog at codedgar.com.ve */
@import url('https://fonts.googleapis.com/css?family=Work+Sans');
 

.card{
  background:#16181a;  border-radius:14px; max-width: 300px; display:block; margin:auto;
  padding:60px; padding-left:20px; padding-right:20px;box-shadow: 2px 10px 40px black; z-index:99;
}

.logo-card{max-width:50px; margin-bottom:15px; margin-top: -19px;}

label{display:flex; font-size:10px; color:white; opacity:.4;}

input{font-family: 'Work Sans', sans-serif;background:transparent; border:none; border-bottom:1px solid transparent; color:#dbdce0; transition: border-bottom .4s;}
input:focus{border-bottom:1px solid #1abc9c; outline:none;}

.cardnumber{display:block; font-size:20px; margin-bottom:8px; }

.name{display:block; font-size:15px; max-width: 200px; float:left; margin-bottom:15px;}

.toleft{float:left;}
.ccv{width:50px; margin-top:-5px; font-size:15px;}

.receipt{background: #dbdce0; border-radius:4px; padding:5%; padding-top:200px; max-width:600px; display:block; margin:auto; margin-top:-180px; z-index:-999; position:relative;}

.col{width:50%; float:left;}
.bought-item{background:#f5f5f5; padding:2px;}
.bought-items{margin-top:-3px;}

.cost{color:#3a7bd5;}
.seller{color: #3a7bd5;}
.description{font-size: 13px;}
.price{font-size:12px;}
.comprobe{text-align:center;}
.proceed{position:absolute; transform:translate(300px, 10px); width:50px; height:50px; border-radius:50%; background:#1abc9c; border:none;color:white; transition: box-shadow .2s, transform .4s; cursor:pointer;}
.proceed:active{outline:none; }
.proceed:focus{outline:none;box-shadow: inset 0px 0px 5px white;}
.sendicon{filter:invert(100%); padding-top:2px;}

@media (max-width: 600px){
  .proceed{transform:translate(250px, 10px);}
  .col{display:block; margin:auto; width:100%; text-align:center;}
}
</style>  

<form role="form" id="payment-form" method="POST" action="{{ route('ipn.stripe')}}">
                  @csrf
<div class="container">
  <div class="card">
    <button type="submit" class="proceed"><svg class="sendicon" width="24" height="24" viewBox="0 0 24 24">
  <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
</svg></button>
   <img src="{{url('assets/images')}}/{{App\Gateway::whereId($data->gateway_id)->first()->val7}}" width="100" class="logo-card">
 <label>Card number:</label>
 <input id="user" type="number"   name="cardNumber" class="input cardnumber"  placeholder="1234 5678 9101 1121">
 <label>Name:</label>
 <input class="input name" name="name" placeholder="Name on Card">
 <label class="toleft">CCV:</label>
 <input class="input toleft ccv"  name="cardCVC" placeholder="321">
 
  
 
 <input class="input toleft cv"   name="cardExpiry" placeholder="MM / YYYY">
 <br>
  </div>
  <div class="receipt">
    <div class="col"><p>Amount:</p>
    <h2 class="cost">${{number_format($data->charge + $data->amount, $basic->decimal)}}</h2><br>
 
    </div>
    <div class="col">
      <p>Payment Gateway:</p>
      <h3 class="cost ">Stripe</h3> 
    </div>
	<br>
	<center>
    <span class="comprobe">Please note that all payment made using this payment gateway is charged in USD.  </span> </center>
  </div>
</div>
@elseif($data->gateway_id == 513)
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


 <ul class='list-group text-secondary'>
            <li class='notice list-group-item'>
                Do not pay below <b>  {{round($total/$rate,8)}}  BTC or ${{number_format($data->charge + $data->amount, $basic->decimal)}}</b>.
            </li>

            <li class="notice list-group-item">
             {{$basic->sitename}} will not be responsible for any loss arising from you sending bitcoin to a wrong wallet address
            </li>

        </ul>


<center>
<h5 class="card-title card-title-md">Wallet QR Code</h5>
 <center><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{App\Currency::whereId(5)->first()->payment_id}}&choe=UTF-8\" style='width:100px;' /></center>
 

<br>
<span class="dt-type-md badge badge-outline badge-info badge-sm"><i class = "fa fa-spinner fa-spin"></i>&nbsp;Awaiting</span>
</center>
 <form method="POST" action="{{route('deposit2.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
 
	<div class="d-flex justify-content-between align-items-center"><h6 class="mb-0 font-bold">Wallet Address</h6><a href="#" class="link link-primary link-ucap">Copy</a></div><div class="copy-wrap mgb-1-5x mgt-1-5x"><span class="copy-feedback"></span> <input type="text" class="form-control" value="{{App\Currency::whereId(5)->first()->payment_id}}" disabled><button class="copy-trigger copy-clipboard" data-clipboard-text="{{App\Currency::whereId(5)->first()->payment_id}}"><em class="ti ti-files"></em></button></div>
	
	<hr>
  <div class="input-item input-with-label"><label class="input-item-label text-exlight">Hash Number</label><input   name="code" class="form-control" required type="text"><label class="input-item-label text-exlight"><small> (Please enter your Cryptocurrency Transaction Hash Number ,)</small></label></div>

<input name="bank" value="bank" hidden >


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fa fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"> 
</div>
<small> (Please attach a screenshot of your successful Bitcoin transfer page)</small>
</div>

</div>
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button>
 </form> 
@elseif($data->gateway_id == 514)
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}


 <ul class='list-group text-secondary'>
            <li class='notice list-group-item'>
                Do not pay below <b>{{round($total / $rate,8)}} ETH or ${{number_format($data->charge + $data->amount, $basic->decimal)}}</b>.
            </li>

            <li class="notice list-group-item">
             {{$basic->sitename}} will not be responsible for any loss arising from you sending etherem to a wrong ethereum wallet address
            </li>

        </ul>


<center>
<h5 class="card-title card-title-md">Wallet QR Code</h5>
 <center><img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{App\Currency::whereId(5)->first()->payment_id}}&choe=UTF-8\" style='width:100px;' /></center>
 

<br>
<span class="dt-type-md badge badge-outline badge-info badge-sm"><i class = "fa fa-spinner fa-spin"></i>&nbsp;Awaiting</span>
</center>
 <form method="POST" action="{{route('deposit2.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
 
	<div class="d-flex justify-content-between align-items-center"><h6 class="mb-0 font-bold">Wallet Address</h6><a href="#" class="link link-primary link-ucap">Copy</a></div><div class="copy-wrap mgb-1-5x mgt-1-5x"><span class="copy-feedback"></span> <input type="text" class="form-control" value="{{App\Currency::whereId(5)->first()->payment_id}}" disabled><button class="copy-trigger copy-clipboard" data-clipboard-text="{{App\Currency::whereId(5)->first()->payment_id}}"><em class="ti ti-files"></em></button></div>
	
	<hr>
  <div class="input-item input-with-label"><label class="input-item-label text-exlight">Hash Number</label><input   name="code" class="form-control" required type="text"><label class="input-item-label text-exlight"><small> (Please enter your Cryptocurrency Transaction Hash Number ,)</small></label></div>

<input name="bank" value="bank" hidden >


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><em class="input-file-icon fa fa-upload"></em><input type="file" name="image" class="input-file" id="file-01"> 
</div>
<small> (Please attach a screenshot of your successful Ethereum transfer page)</small>
</div>

</div>
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button>
 </form> 
 
 
 
@elseif($data->gateway_id == 102)
 <form action="https://perfectmoney.is/api/step1.asp" method="POST" id="payment_form">
    <input type="hidden" name="PAYEE_ACCOUNT" value="{{ $perfectval }}">
    <input type="hidden" name="PAYEE_NAME" value="{{$gnl->sitename}}">
    <input type='hidden' name='PAYMENT_ID' value='{{ $track}}'>
    <input type="hidden" name="PAYMENT_AMOUNT" value="{{$total}}">
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="{{route('ipn.perfect')}}">
    <input type="hidden" name="PAYMENT_URL" value="{{route('my-wallet')}}">
    <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="NOPAYMENT_URL" value="{{route('deposit')}}">
    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="SUGGESTED_MEMO" value="{{Auth::user()->username}}">
    <input type="hidden" name="BAGGAGE_FIELDS" value="IDENT"><br>
 

 <ul class='list-group text-secondary'>
            <li class='notice list-group-item'>
                Do not pay below <b>   ${{number_format($data->charge + $data->amount, $basic->decimal)}}</b>.
            </li>

            <li class="notice list-group-item">
             {{$basic->sitename}} will not be responsible for any loss arising from you sending perfect money address
            </li>

        </ul>


<center>
 
<br> 
<button  type="submit" id="btn-confirm" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></button>
 </form> 
 
 
 
 
 

@else
<div class="card-text"><p>To complete deposit please make you payment. You can send payment directly to our address or you may pay online. Once you paid, you will receive an email about the successfull deposit and fund will be credited into your wallet. </p></div>
@endif

<div class="pay-buttons"><div class="pay-button">
 <form method="POST" action="{{route('deposit.confirm')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

@if($data->gateway_id == 0)
	
  
@endif


@if($data->gateway_id == 100)
<badge  onClick="payWithRave()" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 107)
<script src="https://js.paystack.co/v1/inline.js"></script>
<badge onclick="payWithPaystack()" class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@elseif($data->gateway_id == 109)
<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
<badge onclick="makePayment()"  class="btn btn-primary btn-between w-100">Proceed To Pay <em class="ti ti-wallet"></em></badge>
@else

</form>@endif




</div><div class="pay-button-sap">or</div><div class="pay-button"><a href="{{route('deposit')}}" class="btn btn-danger btn-between w-100">Cancel <em class="ti ti-arrow-right"></em></a></div></div><div class="pay-notes"><div class="note note-plane note-light note-md font-italic"><em class="fas fa-info-circle"></em><p>Fund will appear in your account after payment successfully made. </div></div></div> <!-- .card-innr --></div> <!-- .content-area --></div></div><!-- .page-content -->

@section('js')
 @if($data->gateway_id == 107)
        <script>
						function payWithPaystack(){
						var handler = PaystackPop.setup({
						key: "{{ $data->gateway->val1 }}",
						email: "{{ Auth::user()->email }}",
						amount: "{{ round($data->amount+$data->charge, 2)*100 }}",
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
						value: "+2348012345678"
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

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>
 @elseif($data->gateway_id == 109)
      <script>
					function makePayment() {
					  var paymentEngine = RmPaymentEngine.init({
					     key: "{{ $data->gateway->val1 }}",
					      customerId: "{{ Auth::user()->id }}",
					      firstName: "{{ Auth::user()->fname }}",
					      lastName: "{{ Auth::user()->lname }}",
					      email: "{{ Auth::user()->email }}",
					      narration: "{{ $data->trx }}",
					      amount: "{{ round($data->amount+$data->charge, 2)*1 }}",
					      onSuccess: function (response) {
					      window.location='javascript: submitform()';
					      },
					      onError: function (response) {
					      console.log('callback Error Response', response);
					      },
					      onClose: function () {
					      console.log("closed");
					      }
					      });
					      paymentEngine.showPaymentWidget();
					    }
					</script>

                    <script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>
    @elseif($data->gateway_id == 100)
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>

    <script>
			const API_publicKey = "{{ $data->gateway->val1 }}";
			function payWithRave() {
			var x = getpaidSetup({
			PBFPubKey: API_publicKey,
			customer_email: "{{ Auth::user()->email }}",
			amount: "{{ round($data->amount, 2)}}",
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

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}" />
			<input type="hidden" name="id" value="{{ $data->gateway->id }}" />
			</form>
    @elseif($data->gateway_id == 108)
        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            closedFunction = function () {

            }
            successFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/success';
            }
            failedFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/error';
            }

            function pay(item, price) {
                //Initiate voguepay inline payment
                Voguepay.init({
                    v_merchant_id: "{{ $data->gateway->val1 }}",
                    total: price,
                    notify_url: "{{ route('ipn.voguepay') }}",
                    cur: 'USD',
                    merchant_ref: "{{ $data->trx }}",
                    memo: 'Buy ICO',
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5af93ca2913fd',
                    store_id: "{{ $data->user_id }}",
                    custom: "{{ $data->trx }}",

                    closed: closedFunction,
                    success: successFunction,
                    failed: failedFunction
                });
            }

            $(document).ready(function () {
                $(document).on('click', '#btn-confirm', function (e) {
                    e.preventDefault();
                    pay('Buy', {{ $data->usd }});
                });
            })
        </script>

    @endif
@endsection

<script type="text/javascript">
			function submitform()
			{
			document.forms["myform"].submit();
			}
			</script>

			<form id="myform"  action="{{route('cardpay')}}" method="post">
			{{csrf_field()}}
			<input type="hidden" name="trx" value="{{ $data->trx }}">
            </form>

  
								      				</div> <!-- /.invest-amount-details -->
								    			</form>
								    		</div> <!-- /.main-content-wrapper -->
								    	</div> <!-- /.details-option -->

								    	  


								    </div> <!-- /.main-container -->
								</div> <!-- /.tab-pane -->
@endsection
