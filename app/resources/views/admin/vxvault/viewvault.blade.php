@extends('include.admindashboard')

@section('body') 
<!-- .topbar-wrap -->
        <div class="page-content">
            <div class="container">
                <div class="card content-area">
                    <div class="card-innr">
                        <div class="card-head d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">{{$page_title}}</h4>
                            <a href="#" onclick="goBack()" class="btn btn-sm btn-auto btn-primary d-sm-block d-none"><em class="fas fa-arrow-left mr-3"></em>Back</a>
                            <a href="#" onclick="goBack()" class="btn btn-icon btn-sm btn-primary d-sm-none"><em class="fas fa-arrow-left"></em></a>
                        </div>
                        <div class="gaps-1-5x"></div>
                        <div class="data-details d-md-flex">
                            <div class="fake-class"><span class="data-details-title">Tranx Date</span><span class="data-details-info">{!! date(' D, d/M/Y', strtotime($vault->created_at)) !!}</span></div>
                            <div class="fake-class"><span class="data-details-title">Vault Status</span>
                            @if($vault->status == 0)
                            <span class="badge badge-danger ucap">BTC Not Sent</span></div> 
                            @elseif($vault->status == 1)
                            <span class="badge badge-warning ucap">BTC Locked</span></div>
                             @elseif($vault->status == 2)
                            <span class="badge badge-info ucap">Pending Withdrawal</span></div>
                             @elseif($vault->status == 3)
                            <span class="badge badge-success ucap">Withdrawn</span></div>
                            @endif
                            <div class="fake-class">
                                <span class="data-details-title">Vault Maturity Date</span><span class="data-details-info"><strong>Available </strong>by: {!! date(' D, d/M/Y', strtotime($vault->expire)) !!}</span>
                            </div>
                        </div>
                        <div class="gaps-3x"></div>
                        <h6 class="card-sub-title">Transaction Info</h6>
                        <ul class="data-details-list">
                            <li>
                                <div class="data-details-head">Transaction Type</div>
                                <div class="data-details-des"><strong>VX Vault</strong></div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Vault Code</div>
                                <div class="data-details-des">
                                    <strong>{{$vault->code}} <small></small></strong>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Amount Locked</div>
                                <div class="data-details-des"><strong>${{number_format($vault->usd,2)}}</strong></div>
                            </li>
                            <!-- li -->
                             
                        </ul>
                        
                        
                        
                        <!-- .data-details -->
                        <div class="gaps-3x"></div>
                        <h6 class="card-sub-title">API Response</h6>
                        <ul class="data-details-list">
                            <li>
                                <div class="data-details-head">Invoice ID</div>
                                <div class="data-details-des"><strong>{{$vault->invoiceid}}</strong></div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Payment Status</div>
                                <div class="data-details-des">
                                    <span><strong>{{$api['data']['status'] ?? "Unknown"}}</strong> </span>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Invoice ID</div>
                                <div class="data-details-des">
                                    <strong>{{$api['data']['invoice_id']  ?? "Unknown"}}</strong>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Transaction ID</div>
                                <div class="data-details-des">
                                    <strong>{{$api['data']['name']  ?? "Unknown"}}</strong>
                                </div>
                            </li>
                            <!-- li -->
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Amount USD</div>
                                <div class="data-details-des">
                                    <strong>{{number_format($api['data']['usd_amount'],2)  ?? "Unknown"}}BTC</strong>
                                </div>
                            </li>
                            <!-- li -->
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Amount BTC</div>
                                <div class="data-details-des">
                                    <strong>${{$api['data']['total_amount']['BTC'] ?? "Unknown"}}</strong>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Invoice Dtae</div>
                                <div class="data-details-des"><span>{{$api['data']['invoice_date']  ?? "Unknown"}}</span></div>
                            </li>
                            <!-- li -->
                           
                        </ul>
                        <!-- .data-details -->
                    
                          <!-- .data-details -->
                        <div class="gaps-3x"></div>
                        <h6 class="card-sub-title">Vault Details</h6>
                        <ul class="data-details-list">
                            <li>
                                <div class="data-details-head">Amount Locked</div>
                                <div class="data-details-des"><strong>${{number_format($vault->usd,2)}}</strong></div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Amount in BTC</div>
                                <div class="data-details-des">
                                    <span><strong>{{$vault->btc}} BTC</strong> </span>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Amount in {{$basic->currency}}</div>
                                <div class="data-details-des">
                                    <strong>{{$basic->currency_sym}}{{number_format($vault->amount,2)}} </strong>
                                </div>
                            </li>
                            <!-- li -->
                            <li>
                                <div class="data-details-head">Vault Code</div>
                                <div class="data-details-des"><span>{{$vault->code}}</span></div>
                            </li>
                            <!-- li -->
                           
                        </ul>
                        <!-- .data-details -->
                    </div>
                </div>
                <!-- .card -->
            </div>
            <!-- .container -->
        </div>
        
 
@endsection
