@extends('include.dashboard')

@section('content')

<style>
body{
    background: #edf1f5; 
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: 0;
}
.mailbox-widget .custom-tab .nav-item .nav-link {
    border: 0;
    color: #fff;
    border-bottom: 3px solid transparent;
}
.mailbox-widget .custom-tab .nav-item .nav-link.active {
    background: 0 0;
    color: #fff;
    border-bottom: 3px solid #2cd07e;
}
.no-wrap td, .no-wrap th {
    white-space: nowrap;
}
.table td, .table th {
    padding: .9375rem .4rem; 
    border-top: 1px solid rgba(120,130,140,.13);
}
.font-light {
    font-weight: 300;
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="dashboard-user-content investment-panel">
 
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body bg-primary text-white mailbox-widget pb-0">
                    <h2 class="text-white pb-3">Your Mailbox</h2>
                    <ul class="nav nav-tabs custom-tab border-bottom-0 mt-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="inbox-tab" data-toggle="tab" aria-controls="inbox" href="#inbox" role="tab" aria-selected="true">
                                <span class="d-block d-md-none"><i class="ti-email"></i></span>
                                <span class="d-nosne d-md-block"> INBOX</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sent-tab" data-toggle="tab" aria-controls="sent" href="#sent" role="tab" aria-selected="false">
                                <span class="d-block d-md-none"><i class="ti-export"></i></span>
                                <span class="d-nonse d-md-block">SENT</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="inbox" aria-labelledby="inbox-tab" role="tabpanel">
                        <div>
                            <div class="row p-4 no-gutters align-items-center">
                                <div class="col-sm-12 col-md-6">
                                    <h3 class="font-light mb-0"><i class="ti-email mr-2"></i>{{$count}} Unread emails</h3>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <ul class="list-inline dl mb-0 float-left float-md-right">
                                        <li class="list-inline-item text-info mr-3">
                                            <a href="#" data-toggle="modal" data-target="#investment-modal">
                                                <button class="btn btn-circle btn-success text-white" href="javascript:void(0)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                                <span class="ml-2 font-normal text-dark">Compose</span>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </div>
                            </div>
                            <!-- Mail list-->
                            <div class="table-responsive">
                                <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                                    <tbody>
                                        <!-- row -->
										@if(count($inbox)  < 1)
											<center><h4>You dont have any message in the inbox yet</h4></center>
										@endif
										 @foreach($inbox as $k=>$data)
                                        <tr>
                                            <!-- label -->
                                            
                                            <!-- star -->
                                            <td><i class="fa fa-star text-warning"></i></td>
                                            <td>
                                                <span class="mb-0 text-muted">{{$basic->sitename}}</span>
                                            </td>
                                            <!-- Message -->
                                            <td>
                                                <a class="link" href="{{route('inbox-view',$data->id)}}">
                                                  @if($data->status == 0)  <span class="badge badge-pill text-white font-medium badge-info mr-2">New</span> @endif
                                                    <span class="text-dark">{{$data->title}}-</span>
                                                </a>
                                            </td>
                                            <!-- Attachment -->
                                            <td><a href="{{route('inbox-delete',$data->id)}}"><i class="text-danger fa fa-trash "></i></a></td>
                                            <!-- Time -->
                                            <td class="text-muted">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
											
                                        </tr>
                                        <!-- row -->
										@endforeach
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
						{{$inbox->links() }}
                    </div>
                    <div class="tab-pane fade" id="sent" aria-labelledby="sent-tab" role="tabpanel">
                        <div class="table-responsive">
                                <table class="table email-table no-wrap table-hover v-middle mb-0 font-14">
                                    <tbody>
                                        <!-- row -->
										@if(count($sent)  < 1)
										<center><h4>You dont have any message in the outbox yet</h4></center>
										@endif
										 @foreach($sent as $k=>$data)
                                        <tr>
                                            <!-- label -->
                                            
                                            <!-- star -->
                                            <td><i class="fa fa-star text-warning"></i></td>
                                            <td>
                                                <span class="mb-0 text-muted">{{$basic->sitename}}</span>
                                            </td>
                                            <!-- Message -->
                                            <td>
                                                <a class="link" href="{{route('inbox-view',$data->id)}}">
                                                   <span class="badge badge-pill text-white font-medium badge-success mr-2">Sent</span> 
                                                    <span class="text-dark">{{$data->title}}-</span>
                                                </a>
                                            </td>
                                            <!-- Attachment -->
                                            <td><a href="{{route('inbox-delete',$data->id)}}"><i class="text-danger fa fa-trash "></i></a></td>
                                            <!-- Time -->
                                            <td class="text-muted">{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</td>
											
                                        </tr>
                                        <!-- row -->
										@endforeach
                                         <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                    </tbody>
                                </table>
                            </div>
                    </div> 
                </div>
            </div>
		 
        </div>
    </div>
</div>
 


<!-- Investment  Modal -->
			<div class="modal fade" id="investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap">
							<ul class="nav nav-tabs modal-navs" id="myTab" role="tablist">
								<li class="nav-item">
								  <a class="nav-link active" id="invest-name-tab" data-toggle="tab" href="#invest-name" role="tab" aria-controls="invest-name" aria-selected="true"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-amount-tab" data-toggle="tab" href="#invest-amount" role="tab" aria-controls="invest-amount" aria-selected="false"></a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" id="invest-return-tab" data-toggle="tab" href="#invest-return" role="tab" aria-controls="invest-return" aria-selected="false"></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix">Send Message</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>					
								    </div>

								    <div class="modal-body">
				        				
											<form action="{{route('post.message')}}" method="post" enctype="multipart/form-data">
											@csrf
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Enter Subject</h6>
					        					<input type="text" name="subject"  placeholder="Subject">
					        				</div> <!-- /.single-input-wrapper -->
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Enter Message <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Enter the content onf your message."><img src="{{asset('assets/images/info.png')}}" alt=""></button></h6>
					        					<input type="text" placeholder="Message" name="body">
					        				</div> <!-- /.single-input-wrapper -->
					        				 
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Upload Image <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Upload an image to support your message if applicable."><img src="{{asset('assets/images/info.png')}}" alt=""></button></h6>
					        					<input type="file" name="image">
					        				</div> <!-- /.single-input-wrapper -->
					        				 

					        				<button type="submit" class="add-funds-button continue-button">Send Message</button>

					        				<div class="bottom-button-group clearfix">
					        					<ul class="clearfix"> 
  
					        						<li><button class="cancel-action" data-dismiss="modal" aria-label="Close">Cancel</button></li>
					        					</ul>
					        				</div>
				        				</form>
				      				</div> <!-- /.modal-body -->
								</div> <!-- /.tab-pane -->


							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->
@endsection
