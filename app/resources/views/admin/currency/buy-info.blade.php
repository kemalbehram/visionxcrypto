@extends('include.admindashboard')

@section('body')


<script>
function goBack() {
  window.history.back()
}
</script>

   <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Transaction Details</h4><a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex"><div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{{date('d M Y',strtotime($exchange->created_at))}}</span></div><div class="fake-class"><span class="data-details-title">Tranx Status</span> @if( $exchange->status ==2 )
                                                <span class="badge badge-success">Success</span>
                                            @elseif( $exchange->status == -2 )
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif</div><div class="fake-class"><span class="data-details-title">Tranx Time</span><span class="data-details-info"> {{$exchange->created_at}}</span></div></div><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Info</h6><ul class="data-details-list"><li><div class="data-details-head">Transaction Type</div><div class="data-details-des"><strong>Purchase</strong></div></li><!-- li --><li><div class="data-details-head">Buyer's Bank</div><div class="data-details-des"><strong>{{App\User::whereId($exchange->user_id)->first()->bank}}</strong></div></li>
                                            
                                            
                                            <!-- li --><li><div class="data-details-head">Amount</div><div class="data-details-des"><strong>{{number_format($exchange->amount, $basic->decimal)}} USD</strong></div></li>
                                            
                                            <!-- li --><li><div class="data-details-head">Cryptocurrency</div><div class="data-details-des"><strong>{{$exchange->currency->name}}</strong></div></li><!-- li --><li><div class="data-details-head">Amount In {{$basic->currency}}</div><div class="data-details-des"><span>{{$basic->currency_sym}}{{number_format($exchange->main_amo, $basic->decimal)}}</span> <span></span></div></li><!-- li --><li><div class="data-details-head">Transaction ID</div><div class="data-details-des"><span>{{$exchange->trx}} </span> <span></span></div></li>
                                            <!-- li --></ul><!-- .data-details --><div class="gaps-3x"></div><h6 class="card-sub-title">Transaction Details</h6><ul class="data-details-list"><li><div class="data-details-head">Payment Method</div><div class="data-details-des"><strong>
     @if($exchange->gateway)

{{App\Gateway::whereId($exchange->gateway)->first()->name}}

@else
                                            {{App\PaymentMethod::whereId($exchange->method)->first()->name}}
           @endif

                                            </strong></div></li><!-- li --><li>





                                            <div class="data-details-head">Amount Paid</div><div class="data-details-des"><span><strong>{{number_format($exchange->amountpaid , $basic->decimal)}} {{$basic->currency}}</strong>  </span> <span>({{number_format($exchange->amount - $exchange->charge, $basic->decimal)}} {{$basic->currency}} + {{$exchange->currency->buy}}%)</span></div></li><!-- li --><li><div class="data-details-head">TRX Charge</div><div class="data-details-des"><strong>{{number_format($exchange->charge, $basic->decimal)}} {{$basic->currency}} <small> {{$exchange->currency->buy}}%</small></strong></div></li><!-- li --><li><div class="data-details-head">{{$exchange->currency->symbol}} To Receive</div><div class="data-details-des"><span>{{number_format($exchange->getamo, 8)}} {{$exchange->currency->symbol}}</span></div></li><!-- li --><li><div class="data-details-head">Amount To Credit</div><div class="data-details-des"><span>${{$exchange->amount}} worth of {{$exchange->currency->symbol}}</span></div></li><!-- li --><li><div class="data-details-head">Payment To</div><div class="data-details-des"><span><strong>{{$exchange->wallet}}</strong></span></div></li>

<!-- li --></ul>







<!-- .data-details --><div class="gaps-3x"></div><h6 class="card-sub-title">Bank Account Details</h6><ul class="data-details-list">


										  <script type="text/javascript">

													function bank(identifier){


													 document.getElementById("bank").value = $(identifier).val();


													  }
													 </script>

													  <script type="text/javascript">

													function number(identifier){



													   document.getElementById("number").value = $(identifier).val();

													  }
													 </script>

													  <script type="text/javascript">

													function aname(identifier){
													   document.getElementById("name").value = $(identifier).val();
													  }
													 </script>

                                         <li>
                                        <div class="data-details-head">Bank Name</div><div class="data-details-des"><span><strong><input class="form-control"  onkeyup="bank(this);" value="{{$exchange->bankname}}" placeholder="Enter Bank Name" @if($exchange->bankname) readonly @endif /></strong>  </span> </div></li>


                                        <li><div class="data-details-head">Account Number</div><div class="data-details-des"><strong><input type="number"  onkeyup="number(this);"  value="{{$exchange->accountnumber}}"  class="form-control" placeholder="Enter Account Number" @if($exchange->accountnumber) readonly @endif /> </strong></div></li><!-- li --><li><div class="data-details-head">Account Name</div><div class="data-details-des"><span><input   onkeyup="aname(this);" value="{{$exchange->accountname}}"  class="form-control"  placeholder="Enter Account Name"></span></div></li><!-- li -->


                                        <li><div class="data-details-head"></div><div class="data-details-des"><span><strong>

                                    @if( $exchange->status != 0 )
                                            <button type="submit" class="btn btn-success btn-block"  onclick="event.preventDefault(); document.getElementById('pair-form').submit();"
                                                       >Pair User</button></strong></span></div></li>
                                            <form role="form" id="pair-form" method="POST" action="{{ route('buy-peeruser',$exchange->id) }}">
											{{ csrf_field() }}
											 <input hidden class="form-control"id="bank" name="bank_name">
                                              <input class="form-control"id="number" hidden name="account_number">
                                               <input hidden class="form-control"id="name" name="account_name">
                                            </form>
                                    @endif

<!-- li --></ul>




@if($exchange->tnum || $exchange->image)
<!-- .data-details --><div class="gaps-3x"></div><h6 class="card-sub-title">Proof of Payment</h6><ul class="data-details-list">


<li><br><div class="data-details-head">Payment Screenshot</div><div class="data-doc-item data-doc-item-lg"><div class="data-doc-image"><img src="{{asset('uploads/payments/'.$exchange->image)}}" alt="passport"></div><ul class="data-doc-actions"><li><a href="{{asset('uploads/payments/'.$exchange->image)}}" download><em class="ti ti-import"></em></a></li></ul></div></li>

<!-- li --></ul>
@endif




<!-- .data-details --></div></div><!-- .card --></div><!-- .container --></div>
@endsection
@section('script')
@endsection
