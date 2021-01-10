@extends('include.userdashboard')
@section('content')
    <!-- Main Content-->
    <div class="main-content side-content pt-0">

        <div class="container-fluid">
            <div class="inner-body">

                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">VX Card</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">VX card</li>
                        </ol>
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            <button type="button" class="btn btn-primary my-2 btn-icon-text"  data-effect="effect-flip-horizontal" data-toggle="modal" href="#modalcreate">
                                <i class="si si-credit-card mr-2"></i> Create new card
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Row -->
                <div class="row row-sm">
                    @foreach($cards as $card)
                    <div onclick="showCard({{$card->id}}); showCardtrnx({{$card->id}});" class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                        <div class="card custom-card bg-primary">
                            <div class="card-body">
                                <div class="card-order">
                                    <label class="main-content-label mb-5 pt-1 text-white">{{$card->name}}</label>
                                    <h2 class="text-right">

                                        <div class="main-dropdown-form-demo float-left">
                                            <button class="btn ripple btn-main-primary" data-toggle="dropdown">
                                                <i class="ion-plus-circled icon-size float-left text-primary bg-white"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <h6 class="dropdown-title text-center mb-4">Fund Card</h6>
                                                <form method="post" action="{{route('fundvcard') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input class="form-control" id="fid" name="id" value="{{$card->id}}" type="hidden">
                                                        <input class="form-control" name="amount" placeholder="Enter Amount" type="number" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" name="password" placeholder="Pin" maxlength="4" type="text" required>
                                                    </div>
                                                    <button class="btn ripple btn-primary btn-block">Submit</button>
                                                </form>
                                            </div>
                                        </div>


{{--                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-flip-horizontal" data-toggle="modal" href="#fundmodal">--}}
{{--                                            <i class="ion-plus-circled icon-size float-left text-primary bg-white"></i>--}}
{{--                                        </a>--}}
                                        <span class="font-weight-lighter text-white" style="font-size: 20px">
                                            <?php
                                            $str = $card->pan;
                                            $arr = str_split($str, 4);

                                            foreach($arr as $car){
                                                echo $car." ";
                                            }

                                            ?>
                                        </span></h2>
                                    <p class="mb-8 mt-4 font-weight-bold text-white">
                                        <?php
                                        // use of explode
                                        $string = $card->expiration;
                                        $str_arr = explode ("-", $string);

                                        $mm=$str_arr[1];
                                        $yy=substr($str_arr[0], 2, 4);
                                        echo $mm."/".$yy;
                                        ?>
                                        <span class="float-right text-white font-weight-bold">
                                            @if($card->currency=='NGN')
                                                &#x20A6;
                                            @else
                                                $
                                            @endif
                                            {{$card->amount}}
                                        </span></p>
                                    <div class="card-item-icon card-icon">
                                        <i class="fab fa-cc-visa icon-size float-right text-primary bg-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL END -->
                    @endforeach

                </div>
                <!-- End Row -->



                <!-- row opened -->
                <div class="row row-sm">
                    <div class="col-xxl-3 col-xl-6 col-md-12 col-lg-6">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-1">
                                <label class="main-content-label mb-2 pt-1">Card details & Settings</label>
                            </div>
                            <div class="product-timeline card-body pt-3 mt-1"><br>
                                <form method="post" action="{{route('deletevcard') }}" class="form-horizontal">
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">CARD NAME</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="cardname" class="form-control" placeholder="CARD NAME">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">CARD NUMBER</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="cardnumber" class="form-control" placeholder="CARD NUMBER">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">CARD CVV</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="cardcvv" class="form-control" placeholder="CARD CVV">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">BILLING ADDRESS</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="billingaddress" class="form-control" placeholder="BILLING ADDRESS">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row row-sm">
                                            <div class="col-md-3">
                                                <label class="form-label">ZIP CODE</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="cardzipcode" class="form-control" placeholder="ZIP CODE">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-controls-stacked">
                                                    <br>
                                                    <div id="classdelete" class="main-dropdown-form-demo" style="display: none">
                                                        <button class="btn ripple btn-danger ml-auto pd-x-20" data-toggle="dropdown">Delete Card</button>
                                                        <div class="dropdown-menu">
                                                            <h6 class="dropdown-title text-center mb-4">Delete Card</h6>
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" id="cardid" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <input class="form-control" placeholder="Pin" name="password" maxlength="4" type="text" required>
                                                            </div>
                                                            <button class="btn ripple btn-primary btn-block">Submit</button>
                                                        </div>
                                                    </div>

                                                    <br><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-6 col-md-12 col-lg-6">
                        <div class="card custom-card">
                            <div class="card-header border-bottom-0 pb-1">
                                <label class="main-content-label mb-2 pt-1">Card Transaction</label>
                            </div><br>
                            <div class="card-body pt-0">
{{--                                <img alt="img" class="d-block w-100 op-10" src="/assets/img/pngs/trans.png">--}}

                                <div id="sac" class="card-header border-bottom-0 pb-1 text-center font-weight-bold">
                                    <p id="cardtrans">Select a card</p>
                                </div>

                                <div id="transtable" class="table-responsive" style="display: none">
                                    <table class="table text-nowrap text-md-nowrap table-striped mg-b-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-20p">Name</th>
                                            <th class="wd-25p">Amount</th>
                                            <th class="wd-20p">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody id="translist">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Create Form Modal -->
    <div class="modal" id="modalcreate">
        <div class="modal-dialog wd-xl-400" role="document">
            <div class="modal-content">
                <div class="modal-body pd-20 pd-sm-40">
                    <button aria-label="Close" class="close pos-absolute t-15 r-20 tx-26" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title mb-4 text-center">Create New Account</h5>
                    <form method="post" action="{{route('createvcard') }}">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" name="name" placeholder="Card Name" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="amount" placeholder="Amount to Fund" type="number" required>
                        </div>
                        <div class="form-group">
                            <select name="country" class="form-control select select2" required>
                                <option value="US">United States</option>
                                <option value="NG">Nigeria</option>
                            </select>
                        </div>
                        <button type="submit" class="btn ripple btn-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Create Form Modal -->

@stop
