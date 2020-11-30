@extends('include.dashboard')
@section('content')
    <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel  ">
							<div class="next-payout-box clearfix">
								<div class="title font-fix">Referral System</div>
								<div class="payout-date">{{count($referral)}} Referral</div>
								<img src="images/coins.png" alt="" class="coins">
							</div> <!-- /.next-payout-box -->
							
											<div class="single-input-group small-box">
												<label for="new-password" class="title font-fix">Your Referral Link</label>
												<input value="{{ route('refer.register',auth::user()->username) }}" readonly class="form-control" id="new-password">
											</div> 
							<br>
							 <ul class="share-links"><li>Share with : <br></li> <li><a href="http://www.facebook.com/share.php?u={{ route('refer.register',auth::user()->username) }}&amp;title={{$gnl->title}} Referral Link"><em class="fa fa-facebook-f btn btn-info"> Share Referral Link On Facebook</em></a></li><br><li><a href="whatsapp://send?text={{ route('refer.register',auth::user()->username) }}"><em class="fa fa-whatsapp btn  btn-success"> Share Referral Link On Whatsapp</em></a></li></ul>
							<hr><br>
							<div class="payout-history-wrapper">
								 
								<div class="payout-single-table">
									<div class="table-responsive table-data">
										<table class="table">
											<tbody>
											
											@if(count($referral) >0)
											@foreach($referral as $k=>$data)
											    <tr role="row">
											      	<td>
												      	<div class="title">Status</div>
														@if($data->status == 1)
														<div class="value font-fix payment-status paid">Active</div>
														@else
														<div class="value font-fix payment-status open">Inactive</div>
														@endif
					        							
												    </td>
												    <td>
												    	<div class="title">Date Registered</div>
												      	<div class="value font-fix">{{ date('d M Y',strtotime($data->created_at))}}</div>
												    </td>
												    <td>
												      	<div class="title">Username</div>
												      	<div class="value font-fix"><img src="images/bitcoin2.png" alt="" class="currency-icon"> {{$data->username}}</div>
												    </td>
												    <td>
												      	<div class="title">Last Login</div>
												      	<div class="value font-fix">{{ date('d M Y',strtotime($data->login_time))}}</div>
												    </td>
												    <td>
												    	<div class="title">Country</div>
					        							<div class="value font-fix payout-amount">{{$data->country}}</div>
												    </td>
											    </tr>
												@endforeach
												@else
												<center><b>	No Refered User Yet At The Moment </b></center><br><br><br><br>
											<br><br><br><br><br><br><br><br><br><br><br><br>
												@endif

											   
											</tbody>
										</table>
									</div> <!-- /.table-data -->
								</div> <!-- /.payout-single-table -->
							</div> <!-- /.payout-history-wrapper -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->

			
			
			
			

			
			
@stop
