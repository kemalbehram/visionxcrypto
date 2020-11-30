@extends('include.admindashboard')

@section('body') 
    <div class="page-content"><div class="container"><div class="card content-area"><div class="card-innr"><div class="card-head "><h4 class="card-title">Customers Trade Plan</h4></div>  <div class="table-responsive table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"></th>
								<th scope="col">@lang('Plan Name')</th>
                                <th scope="col">@lang('Payable Interest')</th>
                                <th scope="col">@lang('Expected Interest')</th>
                                <th scope="col">@lang('Received')</th>
                                <th scope="col">@lang('Capital Back')</th>
                                <th scope="col">@lang('Invest Amount')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col" style="width :20%">@lang('Next Payment')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($plan)==0)
                                <tr>
                                    <td colspan="8" class="text-center">@lang('No Data Available')</td>
                                </tr>
                            @endif

                            @foreach($plan as $data)
                                <tr>
									<td>  &nbsp;  &nbsp;  &nbsp;</td>
                                    <td data-label="@lang('Plan Name')">{{__($data->plan->name)}}</td>
                                    <td data-label="@lang('Payable Interest')">{{__($basic->currency_sym)}} {{__($data->interest)}} / {{__($data->time_name)}} </td>
                                    <td data-label="@lang('Period')">@if($data->period == '-1') <span class="badge badge-success">@lang('Life-time')</span>  @else {{__($basic->currency_sym)}}  {{($data->interest * $data->period)}}  @endif</td>
                                    <td data-label="@lang('Received')">  {{__($basic->currency_sym)}}  {{($data->interest * $data->return_rec_time)}}   </td>
                                    <td data-label="@lang('Capital Back')">@if($data->capital_status == '1') <span class="badge badge-success">@lang('Yes')</span>  @else <span class="badge badge-warning">@lang('No')</span> @endif</td>
                                    <td data-label="@lang('Invest Amount')">  {{__($basic->currency_sym)}} {{__($data->amount)}} </td>
                                    <td data-label="@lang('Status')" style="padding-top:20px">  @if($data->status == '1')  <span class="badge badge-warning"><i class="fas fa-spinner fa-spin"></i> @lang('Running')</span>  @else <span class="badge badge-primary">@lang('Complete')</span> @endif </td>
                                    <td data-label="@lang('Next Payment')" scope="row" style="font-weight:bold;"> @if($data->status == '1')  {{ Carbon\Carbon::parse($data->next_time)->diffForHumans() }} @else Completed @endif </td>
                                </tr>

                                
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$plan->links()}}</div><!-- .card-innr --></div><!-- .card --></div><!-- .container --></div><!-- .page-content -->





<!-- .modal-dialog --></div><!-- Modal End --><div class="modal fade" id="createcoin" tabindex="-1"><div class="modal-dialog modal-dialog-md modal-dialog-centered"><div class="modal-content"><div class="popup-body"><h4 class="popup-title">Create New Currency</h4> <p>Fill the form below to create a new cryptocurrency for the system. Please note that the currency symbol has to conform with the standart blockchain currency symbol. Please check <a href="https://min-api.cryptocompare.com">Here</a> to see list of supported currency symbols.</p>

<div class="input-item input-with-label">

<form role="form" method="POST" action="{{route('currency.store')}}" name="editForm" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight">Currency  Name:</label>
                                        <div class="input-group">
                                            <input type="text" class="input-bordered" placeholder="Currency  Name" value="{{old('name')}}"
                                                   name="name">

                                        </div>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Currency 	Symbol:</label>
                                        <input type="text"class="input-bordered"  placeholder="Currency Symbol" value="{{old('symbol')}}"
                                               name="symbol">


                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight">Price:</label>
                                        <div class="input-group">

                                            <input type="text" name="price"  value="{{old('price')}}" class="input-bordered"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                        </div>

                                    </div>





                                    <div class="form-group col-md-12">
                                        <label class="input-item-label text-exlight"> Payment Wallet</label>
                                            <input type="text" name="payment_id"  value="{{old('payment_id')}}" class="input-bordered"
                                                   placeholder="Payment Wallet Address" >

                                    </div>





                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Buying Rate</label>
                                        <div class="input-group">
                                            <input type="text" name="buy" value="{{old('buy')}}" class="input-bordered"
                                                   placeholder="0.00" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">

                                        </div>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="input-item-label text-exlight"> Selling Rate</label>
                                        <div class="input-group">
                                            <input type="text" name="sell"  value="{{old('sell')}}" class="input-bordered"
                                                   placeholder="0.00" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">


                                        </div>

                                    </div>
                                </div>




                            </div><!-- .input-item --><ul class="d-flex flex-wrap align-items-center guttar-30px"><li><button type="submit" class="btn btn-primary">Create Currency</button></form></li><li class="pdt-1x pdb-1x"><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#pay-online" class="link link-primary">Cancel</a></li></ul><div class="gaps-2x"></div><div class="gaps-1x d-none d-sm-block"></div></div></div><!-- .modal-content --></div><!-- .modal-dialog --></div><!-- Modal End -->
@endsection
