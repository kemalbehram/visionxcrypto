@extends('include.userdashboard')
@section('content')
  <div class="page-content"><div class="container"><div class="row"><div class="col-lg-12 main-content"><!-- Modal End -->








  <div class="mosdal fsade" id="get-pay-address" tabindex="-1"><div class="modal-dsialog modal-diaslog-md modal-disalog-centered"><div class="modal-content">






  <a href="#" class="modal-close" data-dismiss="modal" aria-label="Close"><em class="ti ti-credit-card"></em></a><div class="popup-body">



 <div class="gaps-3x"></div><div class="card-head"></div><div class="schedule-item"><div class="row"><div class="col-xl-5 col-md-5 col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Bank Name</span> </h5><span>{{Auth::user()->bank}}</span></div>

 <div class="pdb-1x"><h5 class="schedule-title"><span>Account Name</span> </h5><span>{{Auth::user()->accountname}}</span></div>
 <div class="pdb-1x"><h5 class="schedule-title"><span>Account Number</span> </h5><span>{{Auth::user()->accountno}}</span></div>

 </div><div class="col-xl-4 col-md col-lg-6"><div class="pdb-1x"><h5 class="schedule-title"><span>Paypal Email Address</span></h5><span>{{Auth::user()->paypal}}</span></div>


 <div class="pdb-1x"><h5 class="schedule-title"><span>Bitcoin Wallet Address</span></h5><span>{{Auth::user()->btcwallet}}</span></div>


 </div>




 </div></div>




  <h4 class="popup-title">Bank Account Setup</h4><p>Please Ensure You Setup Your Bank Account Status Here In Order To Be Eligible For Payment Via Bank Transfer.</p><div class="gaps-1x"></div><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

<form method="post" action="{{route('post.banky') }}">
@csrf

<div class="row"><div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Select Bank</label>

<script>
function myFunction() {
  var bank = $("#mybank option:selected").attr('data-bank');
  var bankname = $("#mybank option:selected").attr('data-bankname');

 if(bank ==  0){
  document.getElementById("bank").innerHTML = " ";
 }
 if(bank ==  1)
 {
 document.getElementById("bank").innerHTML = "<div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your " + bankname + " Account Number</label><input name='actnumber'  required  class='input-bordered' type='text'></div> ";}
 if(bank ==  2)
 {
 document.getElementById("bank").innerHTML = " <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Bank Name</label><input required name='bankname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='acctname' class='input-bordered' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='actnumber'  required  class='input-bordered' type='text'></div>";}

 };
</script>





<select required  class="select-bordered select-block" name="bank" id="mybank" onchange="myFunction()">
<? $method = DB::table('localbanks')->get(); ?>
<option value="none">Choose...</option>

@foreach($method as $data)
<option data-bank="1" data-bankname="{{$data->bank}}" value="{{$data->code}}">{{$data->bank}} </option>
@endforeach

<option data-bank="2" value="other"><b>Other Banks</b></option>
</select></div></div></div>





<div id="bank"></div>
</button></div>




  <div class="gaps-1x"></div><h6 class="input-item-label text-exlight">Paypal Address</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

  <input type="text" name="paypal" class="copy-address" value="{{Auth::user()->paypal}}" ><badge class="copy-trigger"><em class="ti ti-wallet"></em></badge></div>
<small> Please leave empty if you dont have a Paypal address



  <div class="gaps-1x"></div><h6 class="input-item-label text-exlight">Bitcoin Address</h6><div class="copy-wrap mgb-0-5x"><span class="copy-feedback"></span>

  <input type="text" name="btc" class="copy-address" value="{{Auth::user()->btcwallet}}" ><badge class="copy-trigger"><em class="ti ti-wallet"></em></badge></div>
<small> Please leave empty if you dont have a Bitcoin address


  <!-- .copy-wrap --><ul class="pay-info-list row"><li class="col-sm-6"></ul><!-- .pay-info-list --><div class="pdb-2-5x pdt-1-5x"><input required type="checkbox" class="input-checkbox input-checkbox-md" id="agree-term"><label for="agree-term">I hereby agree to the {{$basic->sitename}} <a href="#"><strong > aggrement &amp; term</strong>.</a></label></div><button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#pay-confirm">Update Payment Account  <em class="ti ti-arrow-right mgl-4-5x"></em></button>
</form>

<div class="gaps-3x"></div><div class="note note-plane note-light mgb-1x"><em class="fas fa-info-circle"></em><p>If your bank us not listed, please select other banks and Enter full details of your bank in the account number field</p></div><div class="note note-plane note-danger"><em class="fas fa-info-circle"></em><p>You can lock your bank account details from being changed via the settings menu.</p></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End --</div></div></div><!-- .container --></div>
@stop
