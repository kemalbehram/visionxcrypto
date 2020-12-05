@extends('include.dashboard')
@section('content')
    <!-- ***************** User Content **************** -->
    <div class="dashboard-user-content settings-panel">
        <div class="user-settings-content">

            @if(Session::has('modal'))
                @if (session('modal')=="bvn")
                    <script>
                        $(document).ready(function () {
                            $("#bvnpopup").modal('show');
                        });
                    </script>
                @endif

                @if (session('modal')=="bank")
                    <script>
                        $(document).ready(function () {
                            $("#bankpopup").modal('show');
                        });
                    </script>
                @endif

                @if (session('modal')=="kyc")
                    <script>
                        $(document).ready(function () {
                            $("#kycpopup").modal('show');
                        });
                    </script>
                @endif
            @endif

            <ul class="nav nav-tabs settings-nav" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#edit-profile2" role="tab"
                       aria-controls="edit-profile2" aria-selected="true">Account Verification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile"
                       aria-selected="true">KYC Verification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#preferences" role="tab" aria-controls="preferences"
                       aria-selected="false">Payment</a>
                </li>
            </ul> <!-- /.settings-nav -->

            <div class="tab-content settings-tab-content">


                <div class="tab-pane fade " id="edit-profile" role="tabpanel">
                    <form action="#" class="left-space-fix bottom-border-style">
                        <div class="block-title font-fix">KYC Verification</div>
                        <ul class="user-phone-list">
                            @if(Auth::user()->verified == 2)
                                <li class="single-number-input verified-success">
                                    <div class="number">KYC</div>
                                    <button class="verify-status">Verified</button>
                                </li>
                            @elseif(Auth::user()->verified == 1)
                                <li class="single-number-input verified-pending">
                                    <div class="number">KYC</div>
                                    <button class="verify-status">Pending</button>
                                </li>
                            @elseif(Auth::user()->verified == 3)
                                <li class="single-number-input verified-success">
                                    <div class="number">KYC</div>
                                    <button class="verify-status">Rejected</button>
                                </li>
                            @else
                                <li class="single-number-input verified-pending">
                                    <div class="number">KYC</div>
                                    <button class="verify-status">Unverified</button>
                                </li>
                            @endif
                        </ul>
                    </form>


                    @if(Auth::user()->verified == 0)
                        <form role="form" method="POST" class="left-space-fix" action="{{ route('document.upload') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group smahll-box">
                                <label for="name" class="title font-fix">Front View</label>
                                <input type="file" name="photo" class="form-control" class="font-fix" id="name">
                            </div> <!-- /.single-input-group -->

                            <div class="form-group small-box">
                                <label for="bio" class="title font-fix">Back View</label>

                                <input type="file" name="photo2" class="form-control" class="font-fix" id="name">
                            </div> <!-- /.single-input-group -->

                            <div class="single-input-group large-box">
                                <label for="bio" class="title font-fix">Type</label>
                                <select class="theme-select-dropdown" required name="type">

                                    <option value="Driver's Licence">Driver's Licence</option>
                                    <option value="International Passport">International Passport</option>
                                    <option value="National ID Card">National ID Card</option>
                                    <option value="Voters' Card">Voters' Card</option>
                                </select>
                            </div> <!-- /.single-input-group -->

                            <div class="single-input-group large-box">
                                <div class="row">
                                    <div class="col-sm-4 col-12">
                                        <div class="single-input-group">
                                            <label for="gender" class="title font-fix">ID Nnumber</label>
                                            <input class="from-control" type="text" id="token-address" name="number">
                                        </div> <!-- /.single-input-group -->
                                    </div> <!-- /.col- -->

                                    <div class="col-sm-8 col-12">
                                        <div class="single-input-group">
                                            <label class="title font-fix">Expiry Date</label>
                                            <input name="date" type="date">
                                        </div> <!-- /.single-input-group -->
                                    </div> <!-- /.col- -->
                                </div> <!-- /.row -->
                            </div> <!-- /.single-input-group -->
                            <button class="theme-button"><span></span>Save</button>
                        </form>
                    @endif




                    @if($kyccount > 0)
                        <form action="#" class="left-space-fix">
                            <div class="block-title font-fix">ID Details</div>
                            <ul>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="new-mail">
                                    <label for="new-mail">ID Type: {{$kyc->type}}</label>
                                </li>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="deposit-withdraw">
                                    <label for="deposit-withdraw">Expiry Date: {{$kyc->date}}</label>
                                </li>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="payout">
                                    <label for="payout">ID Number: {{$kyc->number}}</label>
                                </li>

                            </ul>
                        </form>
                    @endif
                </div> <!-- /.tab-pane -->


                <div class="tab-pane fade show active" id="edit-profile2" role="tabpanel">

                    <form action="#" class="left-space-fix bottom-border-style">
                        <div class="block-title font-fix">Email Verification</div>
                        <ul class="user-phone-list">
                            @if(Auth::user()->email_verify == 1)
                                <li class="single-number-input verified-success">
                                    <div class="number">{{Auth::user()->email}}</div>
                                    <button class="verify-status">Verified</button>
                                </li>
                            @else
                                <li class="single-number-input verified-pending">
                                    <div class="number">{{Auth::user()->email}}</div>
                                    <button class="verify-status">Unverified</button>
                                </li>
                            @endif
                            <div class="block-title font-fix">Phone Verification</div>
                            @if(Auth::user()->phone_verify == 1)
                                <li class="single-number-input verified-success">
                                    <div class="number">{{Auth::user()->phone}}</div>
                                    <button class="verify-status">Verified</button>
                                </li>
                            @else
                                <li class="single-number-input verified-pending">
                                    <div class="number">{{Auth::user()->phone}}</div>
                                    <button class="verify-status">Unverified</button>
                                </li>
                            @endif
                            <div class="block-title font-fix">BVN Verification</div>
                            @if(Auth::user()->bvn_verify == 1)
                                <li class="single-number-input verified-success">
                                    <div class="number">**********</div>
                                    <button class="verify-status">Verified</button>
                                </li>
                            @else
                                <li class="single-number-input verified-pending">
                                    <div class="number">**********</div>
                                    <button class="verify-status">Unverified</button>
                                </li>
                            @endif

                        </ul>

                    </form>
                    @if(Auth::user()->phone_verify != 1)
                        <form action="#" class="left-space-fix bottom-border-style">
                            <div class="block-title font-fix">Phone Verification <span class="status-alert disabled">Unverified</span>
                            </div>
                            <div class="sub-text">Proceeding with this means we'll send you a security code to verify
                                your phone number with us.
                            </div>
                            <button type="button" class="theme-button authenticator-enable-button" data-toggle="modal"
                                    data-target="#mobile-verification"><span></span>Verify Phone
                            </button>
                        </form>
                    @endif

                    @if(Auth::user()->email_verify != 1)
                        <form action="#" class="left-space-fix bottom-border-style">
                            <div class="block-title font-fix">Email Verification <span class="status-alert disabled">Unverified</span>
                            </div>
                            <div class="sub-text">Turning this on means we'll send you a security code to your phone
                                number when you logging in.
                            </div>
                            <button type="button" class="theme-button authenticator-enable-button" data-toggle="modal"
                                    data-target="#email-verification"><span></span>Verify Email
                            </button>
                        </form>
                    @endif

                    @if(Auth::user()->bvn_verify != 1)
                        <form action="#" class="left-space-fix bottom-border-style">
                            <div class="block-title font-fix">BVN Verification <span class="status-alert disabled">Unverified</span>
                            </div>
                            <div class="sub-text">Turning this on means we'll verify your Bank Verification Number
                                (BVN). Please enter a valid BVN. Please note you will be charged <b
                                    class="text-danger">{{$basic->currrency_sym}}{{number_format($basic->bvn,2)}}</b> as
                                bvn verification fee
                            </div>
                            <button type="button" class="theme-button authenticator-enable-button" data-toggle="modal"
                                    data-target="#email-verification"><span></span>Verify BVN
                            </button>
                        </form>
                    @endif
                </div> <!-- /.tab-pane -->

                <div class="tab-pane fade" id="preferences" role="tabpanel">

                    <form action="#" class="left-space-fix bottom-border-style">
                        <div class="block-title font-fix">Bank Account Details</div>
                        <ul class="user-phone-list">
                            @if(Auth::user()->bankyes == 1)
                                <li class="single-number-input verified-success">
                                    <div class="number">{{Auth::user()->bank}}</div>
                                    <button class="verify-status">Verified</button>
                                </li>
                            @else
                                <li class="single-number-input verified-pending">
                                    <div class="number">None</div>
                                    <button class="verify-status">Unverified</button>
                                </li>
                            @endif

                        </ul>

                    </form>

                    @if(Auth::user()->bankyes != 1)
                        <form method="post" class="left-space-fix bottom-border-style"
                              action="{{route('post.banky') }}">
                            @csrf

                            <script>
                                function myFunction() {
                                    var bank = $("#mybank option:selected").attr('data-bank');
                                    var bankname = $("#mybank option:selected").attr('data-bankname');

                                    document.getElementById("bankname").value = bankname;
                                    if (bank == 0) {
                                        document.getElementById("bank").innerHTML = " ";
                                    }
                                    if (bank == 1) {
                                        document.getElementById("bank").innerHTML = "<div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Your " + bankname + " Account Number</label><input name='actnumber'  required  class='form-control' type='number'></div> ";
                                    }
                                    if (bank == 2) {
                                        document.getElementById("bank").innerHTML = " <div class='input-item input-with-label'><label class='input-item-label text-exlight'>Enter Bank Name</label><input required name='bankname' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Number</label><input  required  name='acctname' class='form-control' type='text'></div><div class='input-item input-with-label'><label class='input-item-label text-exlight'>Account Name</label><input name='actnumber'  required  class='form-control' type='number'></div>";
                                    }

                                };
                            </script>
                            <div class="single-input-group small-box">
                                <label for="language" class="title font-fix">Select Bank</label>
                                <select name="bank" class="theme-select-dropdown" id="mybank" onchange="myFunction()">
                                    <? $method = DB::table('localbanks')->get(); ?>
                                    <option value="none">Choose...</option>

													@foreach($list as $data)
													<option data-bank="1" data-bankname="{{$data['bankname']}}" value="{{$data['bankcode']}}">{{$data['bankname']}}</option>
													@endforeach

												<!--	<option data-bank="2" value="other"><b>Other Banks</b></option> !-->
												</select>
											</div> <!-- /.single-input-group -->

                            <div id="bank"></div>
                            <input id="bankname" name="bankname" hidden>

                            <button type="submit" class="theme-button"><span></span>Save</button>
                        </form>
                    @endif
                    @if(Auth::user()->bankyes == 1)
                        <form action="#" class="left-space-fix">
                            <div class="block-title font-fix">Account Details</div>
                            <ul>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="new-mail">
                                    <label for="new-mail">Bank Name: {{Auth::user()->bank}}</label>
                                </li>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="deposit-withdraw">
                                    <label for="deposit-withdraw">Account Name: {{Auth::user()->accountname}}</label>
                                </li>
                                <li class="single-checkbox">
                                    <input type="checkbox" checked id="payout">
                                    <label for="payout">Account Number: {{Auth::user()->accountno}}</label>
                                </li>

                            </ul>
                        </form>
                    @endif
                </div> <!-- /.tab-pane -->


            </div> <!-- /.tab-content -->
        </div> <!-- /.user-settings-content -->

    </div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
    </div> <!-- /#dashboard-main-body -->
    </div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
    </div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->




    <!-- Mobile-Verification  Modal -->
    <div class="modal fade settings-page-modal" id="mobile-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="tabs-wrap">
                    <ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="add-number-tab" data-toggle="tab" href="#add-number"
                               role="tab" aria-controls="add-number" aria-selected="true"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="verification-code-tab" data-toggle="tab" href="#verification-code"
                               role="tab" aria-controls="verification-code" aria-selected="false"></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="add-number" role="tabpanel"
                             aria-labelledby="add-number-tab">
                            <div class="theme-modal-header">
                                <h3 class="title font-fix">Verify your phone number</h3>
                                <div class="header-sub-title">In order to protect the security of your account, please
                                    verify your phone number. We will send you a text message with a verification code
                                    that you'll need to enter on the next screen.
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="#">
                                    <input id="phone" readonly value="{{Auth::user()->phone}}" type="tel"
                                           class="font-fix">
                                    <a class="continue-button theme-button"><span></span>Continue</a>
                                </form>
                            </div> <!-- /.modal-body -->
                        </div> <!-- /.tab-pane -->


                        <div class="tab-pane fade" id="verification-code" role="tabpanel"
                             aria-labelledby="verification-code-tab">
                            <div class="theme-modal-header">
                                <h3 class="title"><a class="back-button"><img src="images/left-arrow.png" alt=""></a> A
                                    verification code was <br> sent to your phone</h3>
                                <div class="header-sub-title given-number">{{Auth::user()->phone}}</div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body verification-code-details">

                                <form class="code-verify" action="{{ route('user.sms-verify')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                    <input type="text" name="sms_code" placeholder="Enter your code" class="font-fix">
                                    <div class="button-group clearfix">
                                        <ul class="clearfix">
                                            <li>
                                                <button type="submit" class="theme-button"><span></span>Verify</button>
                                            </li>
                                </form>
                                <form action="{{route('user.send-vcode') }}" method="post">
                                    @csrf
                                    <li>
                                        <button class="resend-code">Resend Code</button>
                                    </li>
                                    </ul>
                            </div>
                            </form>

                        </div> <!-- /.modal-body -->
                    </div> <!-- /.tab-pane -->


                </div> <!-- /.tab-content -->
            </div> <!-- /.tabs-wrap -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
    </div> <!-- /#mobile-verification -->






    <!-- bvn-Verification  Modal -->
    <div class="modal fade settings-page-modal" id="email-verification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="tabs-wrap">
                    <ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="add-number-tab" data-toggle="tab" href="#add-number"
                               role="tab" aria-controls="add-number" aria-selected="true"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="verification-code-tab" data-toggle="tab" href="#verification-code"
                               role="tab" aria-controls="verification-code" aria-selected="false"></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="add-number" role="tabpanel"
                             aria-labelledby="add-number-tab">
                            <div class="theme-modal-header">
                                <h3 class="title font-fix">Verify BVN</h3>
                                <div class="header-sub-title">In order to prevent Fraud and serve you better, we will
                                    need you to verify your bank verification number..
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <form class="code-verify" action="{{ route('user.bvn-verify')}}" method="post">
                                    @csrf
                                    <input id="phone" name="bvn" placeholder="Enter your code" type="tel"
                                           class="font-fix">
                                    <button type="submit" class="continue-button theme-button"><span></span>Verify
                                    </button>
                                </form>
                            </div> <!-- /.modal-body -->
                        </div> <!-- /.tab-pane -->


                    </div> <!-- /.tab-content -->
                </div> <!-- /.tabs-wrap -->
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /#bvn-verification -->

    <!-- Email Authentication  Modal -->
    <div class="modal fade settings-page-modal" id="authenticator-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="theme-modal-header">
                    <h3 class="title font-fix">Verify your email address</h3>
                    <div class="header-sub-title">In order to protect the security of your account, please verify your
                        email address. We will send you a message with a verification code that you'll need to enter it
                        below.
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body verification-code-details">
                    <form class="code-verify" class="code-verify" action="{{ route('user.email-verify')}}"
                          method="post">
                        @csrf
                        <input type="text" name="sms_code" placeholder="Enter your code" class="font-fix">
                        <div class="button-group clearfix">
                            <ul class="clearfix">

                                <li>
                                    <button class="theme-button"><span></span>Enable</button>
                                </li>
                    </form>
                    <form action="{{route('user.send-emailVcode') }}" method="post">
                        @csrf
                        <li>
                            <button class="resend-code">Resend Code</button>
                        </li>
                        </ul>
                </div>
                </form>
            </div> <!-- /.modal-body -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
    </div> <!-- /#Email-modal -->


    <!-- bvn-success  Modal -->
    <div class="modal fade settings-page-modal" id="bvnpopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center text-center">
                        <div class="col-xl-5 col-md-6">

                            <div class="identity-content">
                                <img src="{{asset('dash-assets/images/success.gif')}}"/>
                                <h4>Identity Verified</h4>
                                <br/>
                                <p>Congrats! your identity has been successfully verified. You are almost there.</p>
                            </div>
                            <br/>

                            <ul class="nav nav-tabs settings-nav mb-5" role="tablist">
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link active" data-toggle="tab" href="#edit-profile2" role="tab"--}}
                                {{--                                       aria-controls="edit-profile2" aria-selected="true">Account Verification</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link " id="targeti" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile"--}}
                                {{--                                       aria-selected="true">KYC Verification</a>--}}
                                {{--                                </li>--}}
                                <li class="nav-item mb-5">
                                    <a class="nav-link" data-toggle="tab" href="#preferences" role="tab"
                                       aria-controls="preferences"
                                       aria-selected="false">
                                        <span id="other" href="#preferences" data-dismiss="modal"
                                              class="btn btn-success pl-5 pr-5">Continue</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /#bvn-success -->

    <!-- bank-success  Modal -->
    <div class="modal fade settings-page-modal" id="bankpopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center text-center">
                        <div class="col-xl-5 col-md-6">

                            <div class="identity-content">
                                <img src="{{asset('dash-assets/images/success.gif')}}"/>
                                <h4>Bank Verified</h4>
                                <br/>
                                <p>Congrats! your bank has been successfully verified. One more click to end.</p>
                            </div>
                            <br/>

                            <ul class="nav nav-tabs settings-nav mb-5" role="tablist">
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link active" data-toggle="tab" href="#edit-profile2" role="tab"--}}
                                {{--                                       aria-controls="edit-profile2" aria-selected="true">Account Verification</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link " id="targeti" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile"--}}
                                {{--                                       aria-selected="true">KYC Verification</a>--}}
                                {{--                                </li>--}}
                                <li class="nav-item mb-5">
                                    <a class="nav-link" data-toggle="tab" href="#edit-profile" role="tab"
                                       aria-controls="edit-profile"
                                       aria-selected="false">
                                        <span id="other" href="#preferences" data-dismiss="modal"
                                              class="btn btn-success pl-5 pr-5">Continue</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /#bank-success-->


    <!-- kyc-success  Modal -->
    <div class="modal fade settings-page-modal" id="kycpopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="container h-100">
                    <div class="row justify-content-center h-100 align-items-center text-center">
                        <div class="col-xl-5 col-md-6">

                            <div class="identity-content">
                                <img src="{{asset('dash-assets/images/success_dribbble_gif.gif')}}"/>
                                <h4>KYC Submited</h4>
                                <br/>
                                <p>Congrats! your kyc has been successfully submit. Go to dashboard while we verify your documents.</p>
                            </div>
                            <br/>

                            <div class="mb-5">
                                        <a href="{{route('home')}}" class="btn btn-success pl-5 pr-5">Goto Dashboard</a>
                            </div>
                            </div>
                    </div>
                </div>
            </div> <!-- /.modal-content -->
        </div> <!-- /.modal-dialog -->
    </div> <!-- /#bank-success-->



@stop
