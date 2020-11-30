@extends('include.admindashboard')

@section('body')

    @php
        $totalusers = \App\User::count();
       $banusers = \App\User::where('status',0)->count();
       $verified = \App\User::where('verified',2)->count();
       $activeusers = \App\User::where('status',1)->count();
       $users = \App\User::where('status',1)->take(5)->orderby('id', 'desc')->get();
       $inbox = \App\Message::where('view',0)->where('admin',0)->orderby('id', 'desc')->get();
       $trx = \App\Trx::take(3)->orderby('id', 'desc')->get();

		$totalvest =  App\Invest::where('status', '!=', 2)->sum('amount');
        $pendvest =  App\Invest::where('status', '=', 101)->sum('amount');
        $donevest =  App\Invest::where('status', '=', 0)->sum('amount');
        $runvest =  App\Invest::where('status', '=', 1)->sum('amount');
     
        $gateway =  App\Gateway::count();
        $deposit =  App\Deposit::whereStatus(1)->count();
        $totalDeposit =  App\Deposit::whereStatus(1)->sum('amount');
        $pendingDeposit =  App\Deposit::whereStatus(0)->sum('amount');
        $declinedDeposit =  App\Deposit::whereStatus(-2)->sum('amount');
        $totalWithdraw =  App\WithdrawLog::whereStatus(2)->sum('amount');
        $bal =  App\User::sum('balance');
         $totalTransfer =  App\Transfer::whereStatus(1)->sum('amount');
        $blog =App\Post::count();
        $subscribers =App\Subscriber::count();


         $ppro =  App\Trx::whereStatus(2)->whereType(1)->sum('main_amo');
         $pdec =  App\Trx::whereStatus(12)->whereType(1)->sum('main_amo');
         $ppend =  App\Trx::whereStatus(1)->whereType(1)->sum('main_amo');


         $spro =  App\Trx::whereStatus(2)->whereType(0)->sum('main_amo');
         $sdec =  App\Trx::whereStatus(-2)->whereType(0)->sum('main_amo');
         $spend =  App\Trx::whereStatus(1)->whereType(0)->sum('main_amo');

         $wpro =  App\WithdrawLog::whereStatus(1)->sum('amount');
         $wdec =  App\WithdrawLog::whereStatus(-2)->sum('amount');
         $wpend =  App\WithdrawLog::whereStatus(0)->sum('amount');


    $currency =  App\Currency::count();

    @endphp

  <div class="page-content"><div class="container"><div class="row">

<div class="col-lg-4"><div class="token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-gift"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Total Investment</h6><span class="lead">{{number_format($totalvest, $basic->decimal)}} <span>{{$basic->currency}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($pendvest, $basic->decimal)}} </span><span class="sub">Pending </span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($donevest, $basic->decimal)}}</span><span class="sub">Completed</span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($runvest, $basic->decimal)}}</span><span class="sub">Running </span></li></ul></div></div></div></div>




<div class="col-lg-4"><div class="token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-wallet"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Users' Wallet Balance</h6><span class="lead">{{number_format($bal, $basic->decimal)}} <span>{{$basic->currency}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($pendingDeposit, $basic->decimal)}} </span><span class="sub">Pending Deposits</span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($declinedDeposit, $basic->decimal)}}</span><span class="sub">Declined Deposits</span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($totalTransfer, $basic->decimal)}}</span><span class="sub">Total Transfer</span></li></ul></div></div></div></div>


<div class="col-lg-4"><div class="bg-theme token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-shopping-cart"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Total Withdrawal</h6><span class="lead">{{number_format($wpro, $basic->decimal)}} <span>{{$basic->currency}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($wpro, $basic->decimal)}} </span><span class="sub">Processed</span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($wpend, $basic->decimal)}} </span><span class="sub">Unprocessed</span></li><li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($wdec, $basic->decimal)}} </span><span class="sub">Declined</span></li></ul></div></div></div></div>


  <div class="col-lg-4"><div class="bg-primary token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-user"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Total Users</h6><span class="lead">{{$totalusers}} <span>Users</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"><li class="token-balance-sub"><span class="lead">{{$activeusers}} User(s) </span><span class="sub">Active Users</span></li><li class="token-balance-sub"><span class="lead">{{$verified}} User(s)</span><span class="sub">Verified Users</span></li><li class="token-balance-sub"><span class="lead">{{ $banusers}} User(s)</span><span class="sub">Inactive Users</span></li></ul></div></div></div></div>


  <div class="col-lg-4"><div class="bg-secondary token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-import"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Purchased Cryptocurrency</h6><span class="lead">{{number_format($ppro, $basic->decimal)}} <span>{{$basic->currency}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"> <li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($ppend, $basic->decimal)}} </span><span class="sub">Pending</span></li>&nbsp;&nbsp;<li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($pdec, $basic->decimal)}} </span><span class="sub">Declined</span></li></ul></div></div></div></div>




  <div class="col-lg-4"><div class="bg-primary token-statistics card card-token height-auto"><div class="card-innr"><div class="token-balance token-balance-with-icon"><div class="token-balance-icon"><em class="h2 color-white ti ti-export"></em></div><div class="token-balance-text"><h6 class="card-sub-title">Sold Cryptocurrency</h6><span class="lead">{{number_format($spro, $basic->decimal)}} <span>{{$basic->currency}}</span></span></div></div><div class="token-balance token-balance-s2"><h6 class="card-sub-title">Summary</h6><ul class="token-balance-list"> <li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($spend, $basic->decimal)}}</span><span class="sub">Pending</span></li>&nbsp;&nbsp;<li class="token-balance-sub"><span class="lead">{{$basic->currency_sym}}{{number_format($sdec, $basic->decimal)}}</span><span class="sub">Declined</span></li></ul></div></div></div></div>










  <!-- .col -->

   <!-- .col --><div class="col-lg-6"><div class="card card-full-height"><div class="card-innr"><div class="card-head has-aside pb-0"><h4 class="card-title">Recent Users</h4></div><table class="data-table user-list"><tbody>

@foreach($users as $k=>$data)
<tr class="data-item"><td class="data-col dt-user"><div class="user-block"><div class="user-photo"> @if( file_exists($data->image))
                        <img src=" {{url($data->image)}} " width="100"
                             alt="Profile Pic">
                    @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " width="100"
                             alt="Profile Pic">
                    @endif</div><div class="user-info"><span class="lead user-name">{{$data->username}}</span><span class="sub user-id">{{$data->email}}</span></div></div></td><td class="data-col dt-join text-right"><span class="sub join-time">{!! date(' D, d/M/Y', strtotime($data->created_at)) !!}</span></td></tr>
@endforeach

<!-- .data-item --></tbody></table></div></div><!-- .card --></div><!-- .col --><div class="col-lg-6"><div class="card card-timeline card-full-height"><div class="card-innr"><div class="card-head has-aside"><h4 class="card-title">Requests & Messages</h4></div>


<div class="timeline-wrap" id="timeline-notify">
<div data-simplebar="init"><div class="timeline-innr"><div class="timeline"><div class="timeline-line"></div>

@if(count($inbox) > 0)
@foreach($inbox as $k=>$data)
<div class="timeline-item secondary"><div class="timeline-time">{!! date('d/M/y', strtotime($data->created_at)) !!}</div><div class="timeline-content"><a href="{{route('ticket.view',$data->id)}}" class="timeline-content-url">{{$data->title}}</a><span class="timeline-content-info">{{App\User::whereId($data->user_id)->first()->username}}</span></div></div>
@endforeach
@else
<div class="timeline-item secondary"><div class="timeline-time">Today</div><div class="timeline-content"><a href="#" class="timeline-content-url">Message Inbox Is Empty As No User Has Made Any Request Or Complaints So Far. Keep up the good management task</a><span class="timeline-content-info">Empty</span></div></div>
@endif
 </div></div></div><div class="timeline-load"><a href="" class="link load-timeline" data-target="timeline-notify" data-show="2">Load More</a></div></div></div></div><!-- .card --></div><!-- .col -->
 <!-- .container --></div><!-- .page-content -->

@endsection

@section('script')


@stop

