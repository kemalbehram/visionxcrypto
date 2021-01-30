@extends('include.admindashboard') @section('body')
<div class="page-header">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-xl-7 text-center">
				<h2 class="page-title">
					Create Staff
				</h2>
			</div>
		</div>
	</div>

<!-- .container -->
</div>
<div class="page-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="content-area card">
					<div class="card-innr card-innr-fix">
						<div class="card-head">
							<h6 class="card-title">
								Update Administrative Staff
							</h6>
						</div>
						<div class="gaps-1x">
						</div>

<!-- .gaps -->
						<form role="form" method="POST" enctype="multipart/form-data" action="{{route('updateadmin')}}">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="input-item input-with-label">
										<label class="input-item-label text-exlight">Staff Full Name</label>
										<input class="input-bordered" value="{{$user->name}}" type="text" name="name">
										<span class="input-note">Please enter staff name</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-item input-with-label">
										<label class="input-item-label text-exlight">Staff Username</label>
										<input name="username" value="{{$user->username}}"  class="input-bordered" type="text">
										<span class="input-note">Staff Login Username</span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="input-item input-with-label">
										<label class="input-item-label text-exlight">Staff Login Email</label>
										<div class="relative">
											</span>
											<input value="{{$user->email}}"  name="email" class="input-bordered" type="text">
										</div>
										 
									</div>
								</div>
								
                                <input name="id" value="{{$user->id}}" hidden>
								<div class="col-md-6">
									<div class="input-item input-with-label">
										<label class="input-item-label text-exlight">Staff Mobile Phone</label>
										<input value="{{$user->mobile}}"  name="mobile" class="input-bordered" type="text">
										<span class="input-note">Staff Mobile Phone Number. </span>
									</div>
								</div>
							 
								<div class="col-md-12">
								    <label class="input-item-label text-exlight">Staff Password</label><small>Leaveempty if you are not changing password</small>
								<input name="password"  class="input-bordered">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label class="input-item-label ucap text-exlight">ADMIN PERMISSION</label>
									 <select name="role" id="cat_id" class=" input-bordered">
                                    <option value="{{$user->role}}">@if($user->role == 1)
Accounting / Finance

@elseif($user->role == 2)
Customers Rep 

@elseif($user->role == 3)
Marketing

@elseif($user->role == 4)
Engineering
                                        
@elseif($user->role == 5)
General Manager                     
@elseif($user->role == 0)
Super Admin
@endif </option>
                                    <option value="1">Accounting / Finance </option>
                                    <option value="2">Customers Rep </option>
                                    <option value="3">Marketing </option>
                                    <option value="4">Engineering </option>
                                    <option value="5">General Manager</option>
                                  
                                </select>
								</div>
								 
							</div>
							<div class="gaps-1x">
							</div>
							<button class="btn btn-primary" type="submit">Update Staff</button>
						</form>
					</div>

<!-- .card-innr -->
				</div>
<!-- .card -->
			</div>
<!-- .card -->
		</div>
	</div>
</div>
<!-- .container -->
</div>
<!-- .page-content -->
@endsection @section('script') @stop
