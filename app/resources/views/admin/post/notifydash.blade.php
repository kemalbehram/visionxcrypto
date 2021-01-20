@extends('include.admindashboard')

@section('body')

<div class="page-header"><div class="container"><div class="row justify-content-center"> </div></div><!-- .container --><center><div class="col-lg-8 col-xl-7 text-center"><h4 class="page-title">Create New Notification</h4></div></center></div><div class="page-content"><div class="container"><div class="row">


<div class="col-lg-12">

<form role="form" method="POST" action="{{route('user.notifypost')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
<div class="content-area card"><div class="card-innr card-innr-fix"><div class="card-head"><h6 class="card-title">Create New Dashboard Notification</h6></div><div class="gaps-1x"></div><!-- .gaps --><div class="row">
 </div>

 


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea name="details" class="input-bordered input-textarea">{{$basic->news}}</textarea></div><div class="gaps-1x"></div><button class="btn btn-primary">Post Notification</button></form></div><!-- .card-innr --></div><!-- .card --></div> <!-- .col --></div><!-- .row --></div><!-- .container --></div>


@endsection
