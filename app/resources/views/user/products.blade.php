@extends('include.dashboard')
@section('content')
    <!-- ***************** User Content **************** -->
							<!-- ***************** User Content **************** -->

    <div class="dashboard-user-content investment-panel">

<section class="card-container">

    <div class="row mt-lg-2">
        <div class="card col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/bit.svg')}}" width="110" alt=""></center>
            <br />
            <p class="text-center col-12"><a href="{{route('trade')}}" class="btn btn-sm btn-outline-primary"><span></span>Digital Assets</a></p>
        </div>

        <div class="card  col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/airtime.png')}}" width="80" alt=""></center>
            <br />
            <p class="text-center"><a href="{{route('airtime')}}" class="btn btn-sm btn-outline-primary"><span></span>Airtime</a></p>
        </div>

        <div class="card col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/internet.png')}}" width="80" alt=""></center>
            <br />
            <p class="text-center"><a href="{{route('internet')}}" class="btn btn-sm btn-outline-primary"><span></span>Internet Data</a></p>
        </div>


        <div class="card col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/tvbill.png')}}" width="90" alt=""></center>
            <br>
            <p class="text-center"><a href="{{route('tvbill')}}" class="btn btn-sm btn-outline-primary"><span></span>TV Bills</a></p>
        </div>

        <div class="card col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/utility.png')}}" width="90" alt=""></center>
            <br>
            <p class="text-center"><a href="{{route('utilitybill')}}" class="btn btn-sm btn-outline-primary"><span></span>Utility Bills</a></p>
        </div>

        <div class="card col-md-3 col-sm-12 ml-4 mr-4 pt-4 pb-4 mt-5">
            <center><img src="{{url('assets/images/sms.png')}}" width="90" alt=""></center>
            <br>
            <p class="text-center"><a href="{{route('instantsms')}}" class="btn btn-sm btn-outline-primary"><span></span>Instant SMS</a></p>
        </div>

    </div>

</section>
    </div>

@stop
