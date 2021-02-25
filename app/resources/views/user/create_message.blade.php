@extends('include.userdashboard')

@section('content')
<<!-- Main Content-->
			<div class="main-content side-content pt-0">

				<div class="container-fluid">
					<div class="inner-body">

						<!-- Page Header -->
						<div class="page-header">
							<div>
								<h2 class="main-content-title tx-24 mg-b-5">Create Ticket</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Tickets</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						 

						<!-- Row -->
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card main-content-body-profile">
									<div class="tab-content">

										<div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
											<div class="card-body border">
												<div class="mb-4 main-content-label">Create Support Ticket</div>
<form action="{{route('post.message')}}" method="post" enctype="multipart/form-data">
@csrf
 <div class="row"> <div class="col-md-12"><div class="input-item input-with-label"><label class="input-item-label text-exlight">Ticket Code</label><input value="{{$code}}" name="code" class="form-control" readonly type="text"><label class="input-item-label text-exlight"><small> (Please keep this as you may need it to query your message)</small></label></div></div></div>


<div class="input-item input-with-label"><label class="input-item-label text-exlight">Attachment Upload</label><div class="relative"><input type="file" name="image" class="form-control" id="file-01"><label for="file-01">Choose a file</label>
</div>
<small> (Please attach file to your message if there is any or leave empty and proceed)</small>
</div>



<div class="input-item input-with-label"><label class="input-item-label text-exlight">Message Subject</label><input required class="form-control" name="subject" type="text"></div><div class="input-item input-with-label"><label class="input-item-label text-exlight">Your Message</label><textarea name="body" class="form-control input-textarea" required ></textarea></div><div class="gaps-1x"></div><br><button class="btn btn-primary">Send Message</button></form>
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
