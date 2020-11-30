@extends('include.admindashboard')

@section('body')


<div class="page-content"><div class="container"><div class="content-area card"><div class="card-innr"><div class="card-head"><h4 class="card-title">{{$page_title}}</h4></div>


   <table class="data-table dt-filter-init admin-tnx"><thead><tr class="data-item data-head"><th class="data-col dt-tnxno">Customer</th><th class="data-col dt-token">Network</th><th class="data-col dt-token">Number</th> <th class="data-col dt-account">Amount</th><th class="data-col dt-type"><div class="dt-type-text">Status</div></th> </tr></thead><tbody>

@foreach($trx as $k=>$data)
<tr class="data-item"><td class="data-col dt-tnxno"><div class="d-flex align-items-center">


  @if( $data->status == 1 )
                                            <div class="data-state data-state-approved"><span class="d-none">Approved</span></div>
                                        @elseif( $data->status == -2 )
                                            <div class="data-state data-state-canceled"><span class="d-none">Rejected</span></div>
                                        @else
                                            <div class="data-state data-state-pending"><span class="d-none">Pending</span></div>
                                        @endif




<div class="fake-class"><span class="lead tnx-id"><a href="{{route('user.single',isset($data->user->id ) ? $data->user->id  : '0')}}">
                                            {{isset($data->user->username ) ? $data->user->username  : 'N/A'}}
                                        </a></span><span class="sub sub-date">{{$data->created_at}}</span></div></div></td><td class="data-col dt-token"><span class="lead token-amount">{{$data->gateway}}</span> </td><td class="data-col dt-token"><span class="lead amount-pay">{{$data->account_number}}</span> </td><td class="data-col dt-account"><span class="lead user-info">{{$basic->currency_sym}}{{number_format($data->amount, $basic->decimal)}}</span> </td>


 <td class="data-col dt-type">
  @if( $data->status == 1 )
<span class="dt-type-md badge badge-outline badge-success badge-md">Approved</span><span class="dt-type-sm badge badge-sq badge-outline badge-success badge-md">A</span>
     @elseif( $data->status == -2 )
<span class="dt-type-md badge badge-outline badge-danger badge-md">Declined</span><span class="dt-type-sm badge badge-sq badge-outline badge-danger badge-md">P</span>
                                        @else
<span class="dt-type-md badge badge-outline badge-warning badge-md">Pending</span><span class="dt-type-sm badge badge-sq badge-outline badge-warning badge-md">P</span>
                                        @endif
</td>
 </tr><!-- .data-item -->
@endforeach

<!-- .data-item --></tbody></table>

   </div></div></div></div></div>
@endsection
