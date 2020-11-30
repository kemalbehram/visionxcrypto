@extends('include.dashboard')
@section('content')
 <!-- ***************** User Content **************** -->
						<div class="dashboard-user-content payout-panel">
							
			<!-- Investment  Modal -->
			<div class="modsal fadse" id="investment-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog" role="document">
			    	<div class="modal-content">
				    	<div class="tabs-wrap"> 
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="invest-name" role="tabpanel" aria-labelledby="invest-name-tab">
									<div class="theme-modal-header">
								      	<h3 class="title font-fix">Preview Bank Transfer</h3>
								       <br>				
								    </div>

								    <div class="modal-body">
				        				<form action="#">
										
										<div class="tab-pane fades" id="new-invest-amount" role="tabpanel" aria-labelledby="new-invest-amount-tab">
									 
								   
								        				<div class="total-return-figure">
															<h4 class="title">Amount</h4>
															<span class="return-value">{{$basic->currency_sym}}<strong class="total-return-value usd-return">{{number_format($amount,2)}}</strong></span>
														</div>

													 
								</div> <!-- /.tab-pane -->
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Bank Name</h6>
					        					<input type="text" disabled="" placeholder="{{$bank}}">
					        				</div> <!-- /.single-input-wrapper -->
				        					<div class="single-input-wrapper">
					        					<h6 class="title">Account Number</h6>
					        					<input type="text" disabled="" placeholder="{{$number}}">
					        				</div> <!-- /.single-input-wrapper -->
					        				 
					        				<div class="single-input-wrapper">
					        					<h6 class="title">Account Name   <button type="button" class="help-button" data-toggle="tooltip" data-placement="top" title="Account Name Of Beneficiary."><img src="{{url('assets/images/info.png')}}" alt=""></button></h6>
					        					<input type="text" placeholder="{{$name}}" class="end-date" disabled="">
					        					 
					        				</div> <!-- /.single-input-wrapper -->

					        				<a href="#" class="add-funds-button continue-button" data-toggle="modal" data-target="#myModal">PROCEED WITH TRANSFER</a>

					        				 
				        				</form>
				      				</div> <!-- /.modal-body -->
									
										
								</div> <!-- /.tab-pane -->



							 
							</div> <!-- /.tab-content -->
						</div> <!-- /.tabs-wrap -->
			    	</div> <!-- /.modal-content -->
			  	</div> <!-- /.modal-dialog -->
			</div> <!-- /#investment-modal -->

			</div> <!-- /#investment-modal -->
 
			<div class="tab-pane modal fade card" id="myModal" role="dialog" >
			           
								    <div class="theme-modal-header">
								      	<h3 class="title font-fix"><a href="" class="back-button-two"><img src="{{url('assets/images/left-arrow.png')}}" alt=""> &nbsp;</a></h3>
								     
								    </div>					

							
								<div class="row"> 
								<div class="col-12 "> 
								    <div class="modal-body "> 
										<div  class="withdraw-pin-form" >
										 <form method="post"  action="{{route('completebanktransfer') }}">
										 @csrf 
							        		<h3 class="title font-fix">Enter Transaction PIN</h3>
							        		<input type="tel" placeholder="****" maxlength="4" name="password" class="font-fix"><br>
							        		<h3 class="title font-fix">Enter Transfer Narration</h3>
							        		<input type="text" placeholder="Please Enter Narration" name="naration" class="font-fix">
							        		 <br>
											 <b class="text-info">Please note you will be charged {{$basic->currency_sym}} {{number_format($basic->transcharge,2)}} transfer fee for this transfer</b>
							        		<br><br><button class="theme-button"><span></span>Confirm</button>
											</div>
							        	</form>
							      	</div> <!-- /.modal-body -->
								</div></div></div> <!-- /.tab-pane -->

@stop
