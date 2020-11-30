@extends('include.dashboard')

@section('content')
<!-- ***************** User Content **************** -->
						<div class="dashboard-user-content settings-panel">
							<div class="user-settings-content">
								<ul class="nav nav-tabs settings-nav" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="true">Edit Profile</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
									</li>
									<!--<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#preferences" role="tab" aria-controls="preferences" aria-selected="false">Payment</a>
									</li>
									!-->
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">Security</a>
									</li>
								</ul> <!-- /.settings-nav -->

								<div class="tab-content settings-tab-content">
									<div class="tab-pane fade show active" col="" id="edit-profile" role="tabpanel">



										{!! Form::open(['method'=>'post','role'=>'form', 'class'=>'left-space-fix' ,'name' =>'editForm', 'files'=>true]) !!}
											<div class="single-input-group large-box">
												<div class="member-status clearfix">
													<div class="member-info">
																										 @if( file_exists(Auth::User()->image))
												<img src="{{asset(Auth::user()->image)}}" alt="" class="user-img">
												@else
												<img src="{{url('assets/user/images/user-default.png')}}" alt="" class="user-img">
											    @endif
														<div class="name">
															<h3 class="name-title font-fix">{{$user->fname}} {{$user->Lname}}</h3>
															<div class="profile-photo">
																<button class="font-fix">Edit profile photo</button>
																<input type="file" id="avatar" name="image" accept="image/png, image/jpeg">
															</div>
														</div> <!-- /.name -->
													</div> <!-- /.member-info -->

													<div class="font-fix member-badge basic-badge">{{$user->username}}</div>
												</div> <!-- /.member-status -->
											</div> <!-- /.single-input-group -->

											<div class="single-input-group large-box">
												<label for="name" class="title font-fix">First Name</label>
												<input type="text" name="fname"    type="text" value="{{$user->fname}}"  class="font-fix" id="name">
											</div>

											<div class="single-input-group large-box">
												<label for="lname" class="title font-fix">Last Name</label>
												<input type="text" name="lname"    type="text" value="{{$user->lname}}"  class="font-fix" id="lname">
											</div> <!-- /.single-input-group -->


											<div class="single-input-group large-box">
												<label for="email" class="title font-fix">Email</label>
												<input name="email" type="email"  value="{{$user->email}}"class="font-fix" id="email">
											</div> <!-- /.single-input-group -->


											<div class="single-input-group large-box">
												<label for="email" class="title font-fix">Phone Number</label>
												<input value="{{$user->phone}}"  name="phone"  class="font-fix" id="email">
											</div> <!-- /.single-input-group -->


											<div class="single-input-group large-box">
												<div class="row">
													<div class="col-sm-4 col-12">
														<div class="single-input-group">
															<label for="gender" class="title font-fix">Gender</label>
															<select class="theme-select-dropdown" id="gender">
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
														</div> <!-- /.single-input-group -->
													</div> <!-- /.col- -->

													<div class="col-sm-8 col-12">
														<div class="single-input-group">
															<label for="country" class="title font-fix">Country</label>
															<input id="country" value="Nigeria" disabled  name="country" type="text">
														</div> <!-- /.single-input-group -->
													</div> <!-- /.col- -->

														<div class="col-12">
													<div class=" single-input-group large-box">
												<label for="address" class="title font-fix">Address</label>
												<input value="{{$user->address}}"  name="address" class="font-fix" id="address">
													</div> <!-- /.single-input-group -->


													<div class="single-input-group large-box">
												<label for="city" class="title font-fix">City</label>
												<input value="{{$user->city}}"  name="city" class="font-fix" id="city">
													</div> <!-- /.single-input-group -->


													<div class="single-input-group large-box">
												<label for="city" class="title font-fix">Zip Code</label>
												<input value="{{$user->zip_code}}"  name="zip_code" class="font-fix" id="city">
													</div> <!-- /.single-input-group -->



													<div class="single-input-group large-box">
												<label for="dob" class="title font-fix">Date Of Birth</label>
												<input value="{{$user->dob}}"   name="dob" class="font-fix" id="dob">
													</div> <!-- /.single-input-group -->
													</div>

												<button type="submit" class="theme-button"><span></span>Save</button>
												</div> <!-- /.row -->

											</div> <!-- /.single-input-group -->

										</form>





									</div> <!-- /.tab-pane -->



									<div class="tab-pane fade" id="password" role="tabpanel">
										<form method="post" class="left-space-fix" action="{{route('user.change-password') }}">
										@csrf
											<div class="single-input-group small-box">
												<label for="old-password" class="title font-fix">old password</label>
												<input name="current_password" type="password" class="font-fix" id="old-password">
											</div> <!-- /.single-input-group -->

											<div class="single-input-group small-box">
												<label for="new-password" name="password"class="title font-fix">New Password</label>
												<input  name="password" type="password" class="font-fix" id="new-password">
											</div> <!-- /.single-input-group -->

											<div class="single-input-group small-box">
												<label for="confirm-password" class="title font-fix">Confirm new password</label>
												<input  name="password_confirmation"  type="password" class="font-fix" id="confirm-password">
											</div> <!-- /.single-input-group -->
											<button class="theme-button"><span></span>Change Password</button>
										</form>
									</div> <!-- /.tab-pane -->

									<div class="tab-pane fade" id="preferences" role="tabpanel">

									</div> <!-- /.tab-pane -->

									<div class="tab-pane fade" id="security" role="tabpanel">

										<!--
										<form action="#" class="left-space-fix bottom-border-style">
											<div class="block-title font-fix">Two-Factor Authentication <span class="status-alert disabled">Disabled</span></div>
											<div class="sub-text">Turning this on means we'll send you a security code to your phone number when you logging in.</div>
											<button type="button" class="theme-button authenticator-enable-button" data-toggle="modal" data-target="#authenticator-modal"><span></span>Enable Authenticator</button>
										</form>
										!-->

										<form action="#" class="left-space-fix bottom-border-style">
											<div class="block-title font-fix">Wallet PIN <span class="status-alert enabled">Enabled</span></div>
											<div class="sub-text">For additional security, you can choose a Wallet PIN that is asked whenever you want withdraw funds from your account. (Your Default Pin is 1234)</div>
											<button type="button" class="theme-button wallet-pin-button" data-toggle="modal" data-target="#wallet-pin-modal"><span></span>Update</button>
										</form>

										<div class="left-space-fix">
											<div class="block-title font-fix">Close Account</div>
											<div class="sub-text">Closing your Cryonik account deletes all the investment data associated with it. <span class="warning-text">This cannot be undone. </span> </div>

											<button class="close-acount-button">Close Account</button>
										</div>
									</div> <!-- /.tab-pane -->
								</div> <!-- /.tab-content -->
							</div> <!-- /.user-settings-content -->

						</div> <!-- /.dashboard-user-content --> <!-- ***** End User Content **** -->
					</div> <!-- /#dashboard-main-body -->
				</div> <!-- /.container -->  <!-- ***** End Dashboard Body Wrapper **** -->
			</div> <!-- #dashboard-wrapper --> <!-- ***** End Dashboard Main Container **** -->





			<!-- Two-Factor Authentication  Modal -->
			<div class="modal fade settings-page-modal" id="authenticator-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			    		<div class="theme-modal-header">
					      	<h3 class="title font-fix">Enable Two-Factor Authentication</h3>
					      	<div class="header-sub-title">Enter the code you receive by sms</div>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					    </div>

					    <div class="modal-body verification-code-details">
				        	<form action="#" class="code-verify">
				        		<input type="text" placeholder="Enter your code" class="font-fix">
				        		<div class="button-group clearfix">
				        			<ul class="clearfix">
				        				<li><button class="resend-code">Resend Code</button></li>
				        				<li><button class="theme-button"><span></span>Enable</button></li>
				        			</ul>
				        		</div>
				        	</form>
				      	</div> <!-- /.modal-body -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#authenticator-modal -->


			<!-- Wallet PIN  Modal -->
			<div class="modal fade settings-page-modal" id="wallet-pin-modal" tabindex="-1" role="dialog"  aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			    		<div class="theme-modal-header">
					      	<h3 class="title font-fix">Update your withdraw PIN</h3>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					    </div>

					    <div class="modal-body">
							<form method="post" class="wallet-pin-form" action="{{route('user.change-pin') }}">
							@csrf
				        		<input type="number" name="currentpin" placeholder="Current Pin"  maxlength="4" class="font-fix">
								<br>
				        		<input type="number" name="newpin" placeholder="New Pin"  maxlength="4" class="font-fix">
				        		<button class="theme-button"><span></span>Enable</button>
				        	</form>
				      	</div> <!-- /.modal-body -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#wallet-pin-modal -->
@endsection
