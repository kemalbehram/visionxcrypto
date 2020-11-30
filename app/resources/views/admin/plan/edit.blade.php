@extends('include.admindashboard')

@section('body') 


  <div class="page-header"><div class="container"><div class="row justify-content-center"><div class="col-lg-8 col-xl-7 text-center"><h2 class="page-title">Update {{$plan->name}} Plan</h2></div></div></div><!-- .container --></div><div class="page-content"><div class="container"><div class="row"> <div class="col-lg-12"><div class="content-area card"><div class="card-innr card-innr-fix2"><div class="card-head"><h6 class="card-title">Update Plan</h6></div><div class="gaps-1x"></div><!-- .gaps -->

 
                    <form method="post" class="form-horizontal" action="{{route('plan-update', $plan->id)}}">
                        @csrf
                        @method('put')

                        <div class="form-body">

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <strong>Plan Name</strong>
                                    <input type="text" class="form-control" name="name" value="{{$plan->name}}" required>
                                </div>


                               
                                  

                               
								
														
<script>
function myFunction2() {
  

  var type = $("#mySelect1 option:selected").attr('data-type'); 
 
 if(type ==  1)
 {
 document.getElementById("type").innerHTML = "<div class='form-group return  '><div class='form-group'><strong>Fixed Amount</strong><input type='number' class='form-control' value='{{$plan->fixed_amount}}' name='amount''></div></div> ";}
 if(type ==  0)
 {
 document.getElementById("type").innerHTML = "  <div class='form-group   col-12'> <strong>Minimum Amount</strong> <div class='input-group'> <input type='number' class='form-control' value='{{$plan->minimum}}' name='minimum'> </div>  </div> <div class='form-group   col-12' ><strong>Maximum Amount</strong><div class='input-group'>  <input type='number' class='form-control' value='{{$plan->maximum}}' name='maximum'> </div>  </div>";}

 };
</script>

                                <div class="form-group col-md-3">
                                    <strong>Amount Type</strong>
									 <select name="amount_type"  id="mySelect1" onchange="myFunction2()"  class="form-control" style="height: 35px !important;"> 
													<option selected disabled  >Select Type</option>
													<option  data-type="1"  value="on" >Fixed</option>
                                                    <option   data-type="0"  value="off" >Min - Max</option>
													
                                                </select>
									 
                                </div> 
								 
								 <div class="form-group onman col-md-3" id="type" style="display: nsone">
                                    <strong>Amount</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="Select Amount Type First"  disabled >
                                        
                                    </div>
                                </div>
								 

                                <div class="form-group col-md-3">
                                    <strong>Return Cycle</strong>
                                    <select class="form-control" name="times">
                                        @foreach($time as $data)
                                            <option {{$plan->times == $data->time? 'selected': ''}} value="{{$data->time}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <strong>Return /Interest</strong>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="interest"  value="{{$plan->interest}}" required>
                                        <div class="input-group-append" style="height: 45px">
                                            <div class="input-group-text">
                                                <select name="interest_status" class="form-control" style="height: 35px !important;">
                                                    <option {{$plan->interest_status == '1'? 'selected': ''}} value="%">%</option>
                                                    <option {{$plan->interest_status == '0'? 'selected': ''}} value="{{$basic->currency_sym}}">{{$basic->currency_sym}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
<script>
function myFunction() {
  

  var expire = $("#mySelect option:selected").attr('data-expire'); 
 
 if(expire ==  1)
 {
 document.getElementById("expire").innerHTML = "<div class='form-group return  '><div class='form-group'><strong>Return Times</strong><input type='number' class='form-control' value='{{$plan->repeat_time}}' name='repeat_time'></div></div> ";}
 if(expire ==  0)
 {
 document.getElementById("expire").innerHTML = " ";}

 };
</script>

                                <div class="form-group col-md-3">
                                    <strong>Lifetime Status</strong>
									 <select name="lifetime_status"  id="mySelect" onchange="myFunction()"  class="form-control" style="height: 35px !important;">
													<option   disabled  selected >@if($plan->lifetime_status == 0) Plan Can Expire
													@else Plan Wont Expire @endif</option>
                                                   
													<option  data-expire="0"  value="off" >Dont Expire</option>
                                                    <option   data-expire="1"  value="on" >Can Expire</option>
													
                                                </select>
									 
                                </div>
								<p id="expire"></p>

                               

                                <div class="form-group col-md-3" id="capitalBack">
                                    <strong>Capital Back</strong>
                                   		   
										   
										    <select name="capital_back_status" class="form-control" style="height: 35px !important;">
													<option value="{{$plan->capital_back_status}}" >@if($plan->capital_back_status == 1) "Yes"
													@else No @endif</option>
                                                   
													<option value="1" >Yes</option>
                                                    <option  value="0" >No</option>
													
                                                </select>
										   
										   
                                </div>

                                <div class="form-group col-md-3" >
                                    <strong>Status</strong>
                                    <select name="status" class="form-control" style="height: 35px !important;">
													<option value="{{$plan->status}}" >@if($plan->status == 1) Active
													@else Inactive @endif</option>
                                                   
													<option value="1" >Active</option>
                                                    <option  value="0" >Inactive</option>
													
                                                </select>
                                </div>

                               
                                    <input data-toggle="toggle" hidden data-onstyle="success" {{$plan->featured == 1? 'checked':''}} data-offstyle="danger"
                                           data-on="Yes" data-off="No" data-width="100%" type="checkbox" name="featured" >
                                


                            </div>

                        </div>

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-success btn-block">Update</button>

                        </div>
                    </form>
                                    </div>
</div><!-- .card -->

                                                   </div> </div><!-- .card-innr --></div><!-- .card --></div></div></div><!-- .container --></div>
												   
												   
												   @push('script')
    <script>
        $(document).ready(function () {


            if ($('#amount').prop('checked') == false){
                $('.offman').css('display', 'block');
                $('.onman').css('display', 'none');
            }else {
                $('.offman').css('display', 'none');
                $('.onman').css('display', 'block');
            }

            if ($('#lifetime').prop('checked') == true){
                $('.return').css('display', 'block');
            }else {
                $('.return').css('display', 'none');
            }


            $('#amount').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == false)
                {
                    $('.offman').css('display', 'block');
                    $('.onman').css('display', 'none');
                }else {
                    $('.offman').css('display', 'none');
                    $('.onman').css('display', 'block');
                }
            });

            $('#lifetime').on('change', function () {
                var isCheck = $(this).prop('checked');
                if (isCheck == true)
                {
                    $('.return').css('display', 'block');

                }else {

                    $('.return').css('display', 'none');

                }
            });




        })
    </script>
@endpush

@stop
