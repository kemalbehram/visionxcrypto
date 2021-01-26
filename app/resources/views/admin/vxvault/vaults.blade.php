@extends('include.admindashboard')

@section('body') 

    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head "><h4 class="card-title">{{$page_title}}</h4></div>  <div class="table-responsive table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"></th>
								<th scope="col">@lang('Customer')</th>
								<th scope="col">@lang('Vault ID Name')</th>
                                <th scope="col">@lang('USD Locked')</th>
                                <th scope="col">@lang('BTC Locked')</th>
                                <th scope="col">@lang('Expected Naira')</th> 
                                <th scope="col">@lang('Invoice ID')</th> 
                                <th scope="col">@lang('Status')</th>
                                <th scope="col" style="width :20%">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($vault)==0)
                                <tr>
                                    <td colspan="8" class="text-center">@lang('No Data Available')</td>
                                </tr>
                            @endif

                            @foreach($vault as $data)
                                <tr>
									<td>  &nbsp;  &nbsp;  &nbsp;</td>
                                    <td data-label="@lang('Plan Name')">{{isset($data->user->username ) ? $data->user->username  : 'N/A'}} </td>
                                    <td data-label="@lang('Plan Name')">{{$data->code}}</td>
                                    <td data-label="@lang('Payable Interest')">${{number_format($data->usd,2)}}</td>
                                    <td data-label="@lang('Period')">{{$data->btc}}BTC</td>
                                    <td data-label="@lang('Payable Interest')">{{$basic->currency_sym}}{{number_format($data->amount,2)}}</td>
                                    <td data-label="@lang('Payable Interest')">{{$data->invoiceid}}</td>
                                     <td data-label="@lang('Capital Back')">@if($data->status == '3') <span class="badge badge-success">Paidout</span>  @elseif($data->status == '1')  <span class="badge badge-warning">Running</span>  @elseif($data->status == '0')  <span class="badge badge-danger">Incomplete</span>  @else  <span class="badge badge-danger">Unknown</span> @endif</td>
                                   <td data-label="@lang('Next Payment')" scope="row" style="font-weight:bold;"><ul class="dropdown-list"><li><a href="{{route('viewvault',$data->code)}}"><em class="ti ti-eye"></em> View</a></li>  </ul> </td>
                                </tr>

                                
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$vault->links()}}</div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->




 
@endsection
