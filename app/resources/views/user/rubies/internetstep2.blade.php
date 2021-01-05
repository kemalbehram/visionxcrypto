@extends('include.userdashboard')
@section('content')
 <!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Internet Data</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Internet Data</li>
								</ol>
							</div>
							 
						</div>
						<!-- End Page Header -->

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="row row-sm">
											<div class="col-sm-12">
											

<script>
function myFunction() { 
 var name = $("#mySelect option:selected").attr('data-name');
 var price = $("#mySelect option:selected").attr('data-price'); 
 var plan = $("#mySelect option:selected").attr('data-plan'); 
 var amount = $("#mySelect option:selected").attr('data-amount'); 
 document.getElementById("name").value = name;
 document.getElementById("pname").value = name;
 document.getElementById("package").value = plan;
 document.getElementById("price").innerHTML = price;
 document.getElementById("total").value = amount;
  
 };
</script>

												<div class="input-group">
												<label class="form-label">Select Data Plan</label>
													<select  id="mySelect" onchange="myFunction()"  namee="plan" class="form-control select2">
														<option label="Select Plan"></option>
														@foreach($plan as $k=>$data)
														<option data-name="{{$data->name}}" data-plan="{{$data->code}}"  data-price="{{$basic->currency_sym}}{{$data->amount}}"   data-amount="{{$data->amount}}" value="{{$data->code}}">{{$data->name}} </option>
														@endforeach
													</select>
													 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row row-sm">
									<div class="col-md-12 col-lg-12">
										<div class="card custom-card">
											<div class="card-header custom-card-header">
												<h6 class="main-content-label mb-0">Details</h6>
											</div>
											<div class="card-body">
												<div class="form-group">
													<label class="form-label">Phone Number</label>
													<input readonly value="{{$number}}" class="form-control select2-no-search">
													
												</div>
												<div class="form-group">
													<label class="form-label">Network</label>
													<input readonly value="{{$network->name}}" class="form-control select2-no-search">
													
												</div>
												 <div class="form-group">
													<label class="form-label">Plan</label>
													<input readonly id="name" class="form-control select2-no-search">
													
												</div>
												 
												 
												<div class="form-group">
													<p class="form-label">Data Price</p> 
														<b><span id="price">{{$basic->currency_sym}}0.00</span></b>
													 
													 
												</div>
												<form method="post"  class="withdraw-action-form" action="{{route('payinternet') }}">
												@csrf
												 <div class="form-group">
													<label class="form-label">Enter Transaction Password</label>
													<input type="tel" name="password" placeholder="****" maxlength="4" class="form-control">
													
												</div>
												 
												<input hidden name="network" value="{{$network->code}}">
												<input hidden name="name" id="pname">
												<input hidden name="number" value="{{$number}}">
												<input  name="plan" hidden id="package">
												<input  name="amount" hidden id="total">
							        		
												<button class="btn ripple btn-primary" type="submit">Buy Data</button>
												</form>
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


@stop
