@extends('include.userdashboard')

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

   <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Virtual Card</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashbooard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Virtual Card</li>
								</ol>
							</div>
							<div class="d-flex">
								<div class="justify-content-center">
									 
									<button type="button" data-toggle="modal" data-target="#addnewcard" class="btn btn-primary my-2 btn-icon-text">
									  <i class="fe fe-download-cloud mr-2"></i> Create New Card
									</button>
								</div>
							</div>
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-xl-12 col-md-12">
								<div class="card custom-card">
									<div class="card-header">
										<h5 class="mb-3 font-weight-bold tx-14">Virtual Cards</h5>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table border table-hover text-nowrap table-shopping-cart mb-0">
												<thead class="text-muted">
													<tr class="small text-uppercase">
														<th scope="col">Card</th>
														<th scope="col">Status</th>
														<th scope="col" class="wd-120">Creation Date</th>
														<th scope="col" class="wd-120">Expiry Date</th>
														<th scope="col" class="wd-120">Balance</th>
														<th scope="col" class="text-center " >Action</th>
													</tr>
												</thead>
												<tbody>
												@if(count($cards) > 0)
												 @foreach($cards as $card)
													<tr>
														<td>
															<div class="media">
																<div class="card-aside-img">
																	<img src="{{url('/')}}/assets/assets/img/pngs/cardproduct.png" alt="img" class="img-sm">
																</div>
																<div class="media-body my-auto">
																	<div class="card-item-desc mt-0">
																		<h6 class="font-weight-semibold mt-0 text-uppercase">{{$card->masked_pan}}</h6>
																		<dl class="card-item-desc-1">
																		  <dt>{{$card->name}} </dt>
																		  <dd>{{$card->type}}</dd>
																		</dl>
																	</div>
																</div>
															</div>
														</td>
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
															{{$card->expiration}}
														</td>
														<td>
															<div class="price-wrap"> <span class="price font-weight-bold tx-16"> @if($card->currency=='NGN')
                                                    &#x20A6;
                                                @else
                                                    $
                                                @endif
                                                {{$card->amount}}</span></div>
														</td>
														<td class="text-center">
														@if($card->status!='terminated')
														<div class="dropdown">
		<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" type="button">Action <i class="fas fa-caret-down ml-1"></i></button>
		<div  class="dropdown-menu tx-13">
			<a class="dropdown-item"  data-toggle="modal" data-target="#cardview{{$card->id}}" href="#">View Card</a>
			<a class="dropdown-item" data-toggle="modal" data-target="#topup{{$card->id}}" href="#">Fund Card</a>
			<a class="dropdown-item"  data-toggle="modal" data-target="#delete{{$card->id}}" href="#">Delete Card</a>
		</div>
	</div>
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
												@else
												You dot have any virtual card at the moment. Please proceed to click on the create button above to vreate a virtual acard
												@endif
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							 
						</div>
						<!-- End Row -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->
			
			
			
			
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
