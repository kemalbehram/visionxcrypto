@extends('include.dashboard')

@section('content')

    <style>
        .wrapperme {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .cardme {
            padding: 10px;
            width: 900px;
            height: 320px;
            border: none;
            overflow: hidden;
            border-radius: 15px;
            cursor: pointer;
            border: 1px solid #eee;
            background-image: url("{{url('')}}/assets/images/virtual-card-mock2.png");
        }

        .cardbe {
            padding: 10px;
            width: 900px;
            height: 320px;
            border: none;
            overflow: hidden;
            border-radius: 15px;
            cursor: pointer;
            border: 1px solid #eee;
            background-image: url("{{url('')}}/assets/images/virtual-card-mock-back.png");
        }

        .name {
            margin-top: -6px;
            opacity: 0
        }

        .visa {
            opacity: 0
        }

        .cardnumber {
            color: #fff
        }

        .card:hover .visa {
            animation: anim 0.8s ease-in forwards
        }

        .card:hover .name {
            animation: anim 0.8s ease-in-out forwards
        }

        @keyframes anim {
            0% {
                opacity: 0
            }

            50% {
                opacity: 0.3
            }

            75% {
                opacity: 0.7
            }

            100% {
                opacity: 1
            }
        }
    </style>
<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content settings-panel">
							<div class="user-settings-content">
								<ul class="nav nav-tabs settings-nav" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#virtual" role="tab" aria-controls="virtual" aria-selected="true">Virtual Card</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#physical" role="tab" aria-controls="physical" aria-selected="false">Physical Card</a>
									</li>
								</ul> <!-- /.settings-nav -->

								<div class="tab-content settings-tab-content">
									<div class="tab-pane fade show active" col="" id="virtual" role="tabpanel">

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addnewcard"><i class="fa fa-plus"></i> Add New Card</button>
                                            <br />
                                        <table class="table table-responsive table-striped">
                                            <thead>
                                            <th>SN</th>
                                            <th>Card Number</th>
                                            <th>Card Name</th>
                                            <th>Card Type</th>
                                            <th>Card Expiry</th>
                                            <th>Card Amount</th>
                                            <th>Card Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                            </thead>
                                            <tbody>
                                            @foreach($cards as $card)
                                            <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$card->masked_pan}}</td>
                                            <td>{{$card->name}}</td>
                                            <td>{{$card->type}}</td>
                                            <td>{{$card->expiration}}</td>
                                            <td>
                                                @if($card->currency=='NGN')
                                                    &#x20A6;
                                                @else
                                                    $
                                                @endif
                                                {{$card->amount}}</td>
                                            <td>
                                                @if($card->status == 'active')
                                                    <span class="badge badge-success">
                                                        <i class="fa fa-check fa-s"></i> @lang('active')</span>
                                                @elseif($card->status == 'disabled')
                                                    <span class="badge badge-warning">
                                                        <i class="fa fa-spinner fa-spin"></i> @lang('disabled')</span>
                                               @else
                                                    <span class="badge badge-danger">@lang($card->status)</span>
                                                @endif
                                            </td>
                                            <td>{{$card->created_at}}</td>
                                                <td>
                                                    @if($card->status!='terminated')
                                                    <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#cardview{{$card->id}}">View</button> <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#topup{{$card->id}}">Fund Card</button> <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#delete{{$card->id}}">Terminate</button>
                                                        @endif
                                                </td>
                                            </tr>


                                            <!-- Fundcard  Modal -->
                                            <div class="modal fade settings-page-modal" id="topup{{$card->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="theme-modal-header">
                                                            <h3 class="title font-fix">Fund Card</h3>
                                                            <div class="header-sub-title">Enter amount and transaction pin</div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body verification-code-details">
                                                            <form method="post" action="{{route('fundvcard') }}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$card->id}}" class="font-fix"/>
                                                                <input type="number" name="amount" placeholder="Enter Amount" class="form-control" required>

                                                                <br />
                                                                <br />
                                                                <input type="tel" placeholder="****" maxlength="4" name="password" class="form-control" required>
                                                                <div class="pin-attempt-text">3 attempts left</div>

                                                                <div class="button-group clearfix">
                                                                    <ul class="clearfix">
                                                                        <li><button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button></li>
                                                                        <li><button type="submit" class="theme-button"><span></span>Fund Card</button></li>
                                                                    </ul>
                                                                </div>
                                                            </form>
                                                        </div> <!-- /.modal-body -->
                                                    </div> <!-- /.modal-content -->
                                                </div> <!-- /.modal-dialog -->
                                            </div> <!-- /#fund-modal -->


                                            <!-- Deletecard  Modal -->
                                            <div class="modal fade settings-page-modal" id="delete{{$card->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="theme-modal-header">
                                                            <h3 class="title font-fix">Terminate Card</h3>
                                                            <div class="header-sub-title">Enter your transaction pin to confirm termination of card</div>
                                                            <div class="text-muted">Note: Kindly make use of the card fund before you proceed.</div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body verification-code-details">
                                                            <form method="post" action="{{route('deletevcard') }}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$card->id}}" class="font-fix"/>

                                                                <br />
                                                                <br />
                                                                <input type="tel" placeholder="****" maxlength="4" name="password" class="form-control" required>
                                                                <div class="pin-attempt-text">3 attempts left</div>

                                                                <div class="button-group clearfix">
                                                                    <ul class="clearfix">
                                                                        <li><button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button></li>
                                                                        <li><button type="submit" class="theme-button"><span></span>Terminate</button></li>
                                                                    </ul>
                                                                </div>
                                                            </form>
                                                        </div> <!-- /.modal-body -->
                                                    </div> <!-- /.modal-content -->
                                                </div> <!-- /.modal-dialog -->
                                            </div> <!-- /#delete-modal -->


                                            <!-- viewcard  Modal -->
                                            <div class="modal fade settings-page-modal" id="cardview{{$card->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="theme-modal-header">
                                                            <h3 class="title font-fix mb-2">Virtual Card</h3>
                                                            {{--					      	<div class="header-sub-title">Enter amount and transaction pin</div>--}}
                                                            <ul class="nav nav-tabs settings-nav" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active btn btn-outline-primary" data-toggle="tab" href="#fcard{{$card->id}}" role="tab" aria-controls="fcard" aria-selected="true">Front View</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link btn btn-outline-primary" data-toggle="tab" href="#bcard{{$card->id}}" role="tab" aria-controls="bcard" aria-selected="false">Back View</a>
                                                                </li>
                                                            </ul> <!-- /.settings-nav -->
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body verification-code-details">

                                                            <div class="tab-content settings-tab-content">
                                                                <div class="tab-pane fade show active" col="" id="fcard{{$card->id}}" role="tabpanel">

                                                                    <div class="wrapperme wrapper">
                                                                        <div class="cardme card">
                                                                            <div class="text-left mb-3" style="color: white; margin-left: 290px; margin-top: 15px; font-size: 18px; font-weight: bolder;">
                                                                                @if($card->currency=='NGN')
                                                                                    &#x20A6;
                                                                                @else
                                                                                    $
                                                                                @endif
                                                                                {{$card->amount}} </div>
                                                                            <div class="cardnumber d-flex justify-content-between align-items-center px-3 mb-3 ml-3" style="margin-top: 91px; margin-right: 50px; font-size: 20px; font-weight: bolder">
                                                                                <?php
                                                                                $str = $card->pan;
                                                                                $arr = str_split($str, 4);

                                                                                foreach($arr as $car){
                                                                                    echo "<span>".$car."</span> ";
                                                                                }

                                                                                ?>
                                                                            </div>
                                                                            <div class="text-left mb-3" style="color: white; margin-top: 1px; margin-left: 250px; font-size: 14px; font-weight: bolder">VALID THRU
                                                                                <?php
                                                                                // use of explode
                                                                                $string = $card->expiration;
                                                                                $str_arr = explode ("-", $string);

                                                                                $mm=$str_arr[1];
                                                                                $yy=substr($str_arr[0], 2, 4);
                                                                                echo $mm."/".$yy;
                                                                                ?>
                                                                            </div>
                                                                            <div class="text-left mb-3" style="color: white; margin-left: 35px; margin-top: 3px; font-size: 18px; font-weight: bolder;">{{$card->name}}</div>
                                                                        </div>
                                                                    </div>

                                                                </div> <!-- /.tab-pane -->



                                                                <div class="tab-pane fade" id="bcard{{$card->id}}" role="tabpanel">
                                                                    <div class="wrapperme wrapper">
                                                                        <div class="cardbe card">
                                                                            <div class="d-flex justify-content-between align-items-center px-3 mb-3 ml-3" style="margin-top: 160px; margin-left: 150px; font-size: 20px; font-weight: bolder; color: black">{{$card->cvv}}</div>
                                                                        </div>
                                                                    </div>

                                                                </div> <!-- /.tab-pane -->

                                                            </div> <!-- /.user-settings-content -->


                                                        </div> <!-- /.modal-body -->
                                                    </div> <!-- /.modal-content -->
                                                </div> <!-- /.modal-dialog -->
                                            </div> <!-- /#show-modal -->

                                            @endforeach
                                            </tbody>
                                        </table>
                                        </div>


									</div> <!-- /.tab-pane -->



									<div class="tab-pane fade" id="physical" role="tabpanel">
                                        <img src="{{asset('assets/images/cardsoon.png')}}" alt="" class="payout-icon">

									</div> <!-- /.tab-pane -->

							</div> <!-- /.user-settings-content -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->





<!-- New Card Modal -->
<div class="modal fade" id="addnewcard" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="tabs-wrap">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
                        <div class="theme-modal-header">
                            <h3 class="title font-fix">Add New Card</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <form method="post" action="{{route('createvcard') }}">
                                @csrf

                            <div class="form-group">
                                <label for="name" class="title font-fix">Card Name</label>
                                <input type="text" name="name" class="form-control" id="name" required />
                            </div>

                                <div class="form-group">
                                    <label for="amount" class="title font-fix">Amount to Fund</label>
                                    <input type="text" name="amount" class="form-control" id="amount" required />
                                </div>

                                <div class="form-group">
                                    <label for="country" class="title font-fix">Select Country</label>
                                    <select class="form-control" name="country">
                                        <option value="US">United States</option>
                                        <option value="NG">Nigeria</option>
                                    </select>
                                </div>


{{--                            <div class="form-group">--}}
{{--                                <label for="address" class="title font-fix">Card Address</label>--}}
{{--                                <input type="text" name="address" class="form-control" id="address" required />--}}
{{--                            </div>--}}


{{--                            <div class="form-group">--}}
{{--                                <label for="city" class="title font-fix">Card City</label>--}}
{{--                                <input type="text" name="city" class="form-control" id="city" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="state" class="title font-fix">Card State</label>--}}
{{--                                <input type="text" name="state" class="form-control" id="state" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="postal_code" class="title font-fix">Card Postal Code</label>--}}
{{--                                <input type="tel" name="postal_code" class="form-control" id="postal_code" required />--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <label for="country" class="title font-fix">Card Country</label>--}}
{{--                                <input type="text" name="country" class="form-control" id="country" required />--}}
{{--                            </div>--}}

                            <div class="bottom-button-group clearfix">
                                <ul class="clearfix">
                                    <button type="submit" class="theme-button"><span></span>Create</button>
                                    <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                                    <li></li>
                                </ul>
                            </div>
                            </form>
                        </div> <!-- /.modal-body -->
                    </div> <!-- /.tab-pane -->

                    </div> <!-- /.tab-pane -->


            </div> <!-- /.tabs-wrap -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /#-modal -->


@endsection
