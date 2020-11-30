@extends('include.admindashboard')

@section('body')


<script>
function goBack() {
  window.history.back()
}
</script>
  <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head d-flex justify-content-between align-items-center"><h4 class="card-title mb-0">Investment Payment Details</h4><div class="d-flex align-items-center guttar-20px"><div class="flex-col d-sm-block d-none"><a href="#" onclick="goBack()"class="btn btn-sm btn-auto btn-primary"><em class="fas fa-arrow-left mr-3"></em>Back</a></div><div class="flex-col d-sm-none"><a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary"><em class="fas fa-arrow-left"></em></a></div><div class="relative d-inline-block"><a href="#" class="btn btn-dark btn-sm btn-icon toggle-tigger"><em class="ti ti-more-alt"></em></a><div class="toggle-class dropdown-content dropdown-content-top-left"><ul class="dropdown-list"><li><a href="{{route('investapprove',$invest->id)}}"><em class="ti ti-check"></em> Approve</a></li><li><a href="{{route('investreject',$invest->id)}}"><em class="ti ti-na"></em> Reject</a></li><li><a href="{{route('investdelete',$invest->id)}}"><em class="ti ti-trash"></em> Delete</a></li></ul></div></div></div></div><div class="gaps-1-5x"></div><div class="data-details d-md-flex flex-wrap align-items-center justify-content-between"><div class="fake-class"><span class="data-details-title">Submited By</span><span class="data-details-info">{{$invest->user->username}}</span></div><div class="fake-class"><span class="data-details-title">Investment Name</span><span class="data-details-info"> {{$plan->name}}</span></div><div class="fake-class"><span class="data-details-title">BTC Value:</span><span class="data-details-info"> {{number_format($invest->btcvalue,7)}}</span></div><div class="fake-class"><span class="data-details-title">Sender's Address</span><span class="data-details-info"> {{$invest->btcwallet}}</span></div><div class="fake-class"><span class="data-details-title">Amount Paid</span><span class="data-details-info"> ${{number_format($invest->amount,2)}}</span></div><div class="fake-class">@if($invest->status == 1)
<span class="dt-status-md badge badge-outldine badge-success badge-md">Approved</span>
@elseif($invest->status == 2)
<span class="dt-status-md badge badge-outldine badge-warning badge-md">Pending</span>
 
	@elseif($invest->status == 17)
<span class="dt-status-md badge badge-outldine badge-success badge-md">Rejected</span>
@else
<span class="dt-status-md badge badge-outlidne badge-warning badge-md">Complete</span>
@endif</div><div class="gaps-2x w-100 d-none d-md-block"></div><div class="w-100"><span class="data-details-title">Submission Date</span><span class="data-details-info">{{$invest->created_at}}</span></div>     </div><div class="gaps-3x"></div><h6 class="card-sub-title">Personal Information</h6><ul class="data-details-list"><li><div class="data-details-head">First Name</div><div class="data-details-des">{{$invest->user->fname}}</div></li><!-- li --><li><div class="data-details-head">Last Name</div><div class="data-details-des">{{$invest->user->lname}}</div></li><!-- li --><li><div class="data-details-head">Email Address</div><div class="data-details-des">{{$invest->user->email}}</div></li><!-- li --><li><div class="data-details-head">Phone Number</div><div class="data-details-des">{{$invest->user->phone}}</div></li><!-- li --><li><div class="data-details-head">Date of Birth</div><div class="data-details-des">{{$invest->user->dob}}</div></li><!-- li --><li><div class="data-details-head">Full Address</div><div class="data-details-des">{{$invest->user->address}}, {{$invest->user->city}}, {{$invest->user->zip_code}}.</div></li><!-- li --><li><div class="data-details-head">Country of Residence</div><div class="data-details-des">{{$invest->user->country}}</div></li><!-- li --><li><div class="data-details-head">User Image</div><div class="data-details-des"><span><div class="user-photo">  @if( file_exists($invest->image))
                        <img src=" {{url($invest->user->image)}} " width="100"
                             alt="Profile Pic">
                    @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " width="100"
                             alt="Profile Pic">
                    @endif</div> </span></div></li><!-- li --></ul><div class="gaps-3x"></div><h6 class="card-sub-title">Uploaded Documnets</h6><ul class="data-details-list"><li><div class="data-details-head">Proof Of Payment:
  </div><ul class="data-details-docs"><li><span class="data-details-docs-title"> </span><div class="data-doc-item data-doc-item-lg"><div class="data-doc-image"><img src="{{url('uploads/payments')}}/{{$invest->image}}" alt="passport"></div><ul class="data-doc-actions"><li><a href="{{url('uploads/payments')}}/{{$invest->image}}" download><em class="ti ti-import"></em></a></li></ul></div></li><!-- li --> </div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content --><div class="footer-bar"><div class="container"><div class="row align-items-center justify-content-center"></div>
@stop
