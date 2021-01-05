@extends('include.userdashboard')

@section('content')
<<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Settings</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Settings</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<div class="row square">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="panel profile-cover">
											
												 @if( file_exists(Auth::User()->image))
												<img src="{{asset(Auth::user()->image)}}" alt="" width="50" class="img-sm">
												@else
												<img src="{{url('assets/user/images/user-default.png')}}" alt="" width="50" class="img-sm">
											    @endif
												<br><br><br>
												
												<h3 class="h3">{{$user->fname}} {{$user->lname}}</h3>
											    <br>
											
												 
										</div>
										<div class="profile-tab tab-menu-heading">
											<nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
												
												<a class="nav-link active" data-toggle="tab" href="#edit">Profile</a>
												<a class="nav-link" data-toggle="tab" href="#timeline">Password</a>
												<a class="nav-link" data-toggle="tab" href="#gallery">Security</a> 
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card main-content-body-profile">
									<div class="tab-content">
										
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
											<div class="card-body border">
												<div class="mb-4 main-content-label">Personal Information</div>
												 
												{!! Form::open(['method'=>'post','role'=>'form', 'class'=>'form-horizontal' ,'name' =>'editForm', 'files'=>true]) !!}
										
													<div class="mb-4 main-content-label">Name</div>
													
													 
												
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">User Name</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" readonly placeholder="User Name" value="{{$user->username}}">
															</div>
														</div>
													</div>
													

													
													
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">First Name</label>
															</div>
															<div class="col-md-9">
																<input   class="form-control" placeholder="First Name" name="fname"    type="text" value="{{$user->fname}}" >
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">last Name</label>
															</div>
															<div class="col-md-9">
																<input type="text" class="form-control" placeholder="Last Name" name="lname"    type="text" value="{{$user->lname}}" >
															</div>
														</div>
													</div>
													
													<div class="mb-4 main-content-label">Contact Info</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Email<i>(required)</i></label>
															</div>
															<div class="col-md-9">
																<input type="email" class="form-control" name="email" placeholder="Email" readonly value="{{$user->email}}">
															</div>
														</div>
													</div>
													
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Phone</label>
															</div>
															<div class="col-md-9">
																<input type="tel" value="{{$user->phone}}"  name="phone"  class="form-control" placeholder="phone number" value="+234 804 6544 4755">
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Address</label>
															</div>
															<div class="col-md-9">
																<textarea class="form-control" value="{{$user->address}}"  name="address" rows="2" placeholder="Address">{{$user->address}}</textarea>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">City</label>
															</div>
															<div class="col-md-9">
																<textarea class="form-control" value="{{$user->city}}"  name="city" rows="2" placeholder="Address">{{$user->city}}</textarea>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Zip Code</label>
															</div>
															<div class="col-md-9">
																<textarea class="form-control" value="{{$user->zip_code}}"  name="zip_code"  rows="2" placeholder="Zip Code">{{$user->zip_code}}</textarea>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Country</label>
															</div>
															<div class="col-md-9">
																<textarea class="form-control" value="Nigeria" disabled  name="country" rows="2" placeholder="Address">Nigeria</textarea>
															</div>
														</div>
													</div>
													<div class="mb-4 main-content-label">ABOUT YOURSELF</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Gender</label>
															</div>
															<div class="col-md-9">
																<select class="form-control select2" name="gender">
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
															</div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Date of Birth</label>
															</div>
															<div class="col-md-9">
																<input type="date" class="form-control" placeholder="date" value="{{$user->dob}}" name="dob" >
															</div>
														</div>
													</div>
													
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">Profile Picture</label>
															</div>
															<div class="col-md-9">
																<div class="input-group file-browser">
													<input type="text" class="form-control border-right-0 browse-file" placeholder="Upload Avatar" readonly>
													<label class="input-group-btn">
														<span class="btn btn-primary">
															Browse <input type="file"  name="image" accept="image/png, image/jpeg" style="display: none;" multiple>
														</span>
													</label>
												</div>
															</div>
														</div>
													</div>
													
													<div class="form-group mb-0">
														<div class="row row-sm">
															<div class="col-md-3">
																
															</div>
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button type="submit" class="btn btn-primary ml-auto">Update Profile</button><br><br>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
										
										<div class="main-content-body  tab-pane border-top-0" id="timeline">
										
											<div class="border p-4">
												<div class="main-content-body main-content-body-profile">
													
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
										<div class="mb-4 main-content-label">Change Password</div>
											<div class="card-body border">
												<div class="mb-4 main-content-label">Old Password</div>
											 
												<form method="post" class="form-horizontal" action="{{route('user.change-password') }}">
												@csrf
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input   class="form-control" placeholder="Currenct PAssowrd" name="current_password" type="password">
															</div>
														</div>
													</div>
													
													
													<div class="mb-4 main-content-label">New Password</div>
												<form class="form-horizontal">
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input name="password" type="password" class="form-control" placeholder="Enter New Password">
															</div>
														</div>
													</div>
													
													<div class="mb-4 main-content-label">Confirm New Password</div>
												<form class="form-horizontal">
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input name="password_confirmation"  type="password" class="form-control" placeholder="Confirm Password">
															</div>
														</div>
													</div>
													
													<div class="form-group mb-0">
														<div class="row row-sm">
															
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button type="submit" class="btn btn-primary ml-auto">Change Password</button><br><br>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
													<!-- main-profile-body -->
												</div>
											</div>
										</div>
										
										
										<div class="main-content-body p-4 border tab-pane border-top-0" id="gallery">
											
										<div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
										<div class="mb-4 main-content-label">Update your transaction PIN</div>
											<div class="card-body border">
												  
												<form method="post" class="form-horizontal" action="{{route('user.change-pin') }}">
							@csrf
													 
													
													
													<div class="mb-4 main-content-label">Current Pin</div>
												 
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input type="number" name="currentpin" placeholder="Current Pin"  maxlength="4" class="form-control" placeholder="****" >
															</div>
														</div>
													</div>
													<br>
													
													
													<div class="mb-4 main-content-label">New Pin</div>
												 
													<div class="form-group ">
														<div class="row row-sm">
														<div class="col-md-9">
																<input type="number" name="newpin"  maxlength="4" class="form-control" placeholder="****" >
															</div>
														</div>
													</div>
													
													 
													<div class="form-group mb-0">
														<div class="row row-sm">
															
															<div class="col-md-9">
																<div class="custom-controls-stacked">
																	<br><button type="submit" class="btn btn-primary ml-auto">Change Pin</button><br><br>
																</div>
															</div>
														</div>
														</form>
                                                            <br><br><div class="mb-4 main-content-label">Close Account</div>
															<p>Closing your Vision-X Crypto account deletes all the investment data associated with it. This cannot be undone.</p>
														<div class="form-group ">
															<div class="col-md-9"> </div>
															<br><a class="btn btn-primary ml-auto">Close Account</a><br><br>
														</div>
													</div>
														
													</div>
												</form>
											</div>
										</div>
													<!-- main-profile-body -->
												</div>
											</div>
										</div>	
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
@endsection
