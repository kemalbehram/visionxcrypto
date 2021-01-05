@extends('include.front')
@section('content') 
               
      <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start banner_cotact_one -->
        <section class="demo__charity banner_cotact_one banner_cotact_three">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5">
                <div class="banner_title_inner margin-b-4">
                  <h1 class="c-white" data-aos="fade-up" data-aos-delay="0">
                    Have an issue?
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    Any questions or remarks? Just write us a message!
                  </p>
                </div>
                <div class="row">
                  <div class="col-lg-10">
                    <div class="information_content">
                      <div class="link_item" data-aos="fade-up" data-aos-delay="200">
                        <a href="tel:+234 9067 444 445">
                          <i class="tio call"></i>
                          +234 9067 444 445
                        </a>
                      </div>

                      <div class="link_item selecr_mark" data-aos="fade-up" data-aos-delay="300">
                        <a href="mailto:support@visionxcrypto.com">
                          <i class="tio email"></i>
                          support@visionxcrypto.com
                        </a>
                      </div>

                      <div class="link_item" data-aos="fade-up" data-aos-delay="400">
                        <p class="d-flex">
                          <i class="tio poi"></i>
                          MJ’s Plaza, Besides Lawfab Hotels, Osubi/Eku Expressway, Osubi-Warri, Delta State.
                        </p>
                      </div>
					  
					  <div class="link_item" data-aos="fade-up" data-aos-delay="400">
                        <p class="d-flex">
                          <i class="tio poi"></i>
                          Ikoyi,Lagos State.
                        </p>
                      </div>

                    </div>
                    <div class="cc_socialmedia">
                      <a href="https://twitter.com/visionxcrypto">
                        <i class="tio twitter"></i>
                      </a>
                      <a href="https://www.facebook.com/Vision-X-Crypto-Services-Ltd-105417581108721/">
                        <i class="tio facebook_square"></i>
                      </a>
                      <a href="https://www.instagram.com/visionxcryptoservicesltd/">
                        <i class="tio instagram"></i>
                      </a>
                      <a href="#">
                        <i class="tio youtube"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 ml-md-auto my-auto"> 
                    <form class="row form_contact_two" action="{{route('contact.submit')}}" method="post">
{!! csrf_field() !!}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Email address</label>
                      <div class="input_group">
                        <input type="email" name="email" class="form-control" placeholder="ex. Adewale@mail.com">
                        <i class="tio online"></i>
                      </div>
                    </div>
                  </div>
                  
                   <div class="col-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <div class="input_group">
                        <input type="tel" name="phone" class="form-control" placeholder="080********">
                        <i class="tio online"></i>
                      </div>
                    </div>
                  </div>
                 </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Full Name</label>
                      <div class="input_group">
                        <input type="text" name="name" class="form-control" placeholder="ex. John Ade">
                        <i class="tio account_square_outlined"></i>
                      </div>

                    </div>
                  </div>
 <div class="col-12">
                    <div class="form-group">
                      <label>Subject</label>
                      <div class="input_group">
                        <input type="text" name="subjec" class="form-control" placeholder="Message Subject"> 
                        <i class="tio account_square_outlined"></i>
                      </div>

                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Message</label>
                      <textarea class="form-control" name="message" rows="5" placeholder="Type Message Here..."></textarea>
                    </div>
                  </div>

                  <div class="col-12 d-md-flex justify-content-end margin-t-2">
                    <button type="submit" class="btn btn_md_primary btn_send rounded-8 sweep_top sweep_letter">
                      <div class="inside_item">
                        <span data-hover="Say Hello 🖐">Send Message</span>
                      </div>

                    </button>
                  </div>
                </form>
              </div>

            </div>

            <div class="shape_circle">
              <div></div>
              <div></div>
            </div>

          </div>

        </section>
        <!-- End. Banner -->

      </main>
    </div>
    <!-- [id] content -->
@endsection


