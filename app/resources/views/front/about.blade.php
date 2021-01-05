@extends('include.front')
@section('content') 
 <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start banner_about -->
        <section class="pt_banner_inner banner_px_image" id="Discover">
          <div class="parallax_cover">
            <img class="cover-parallax" src="{{asset('front/img/inner/about.jpg')}}" alt="image">
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6">
                <div class="banner_title_inner">
                  <h1 data-aos="fade-up" data-aos-delay="0">
                    About Us
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    Know about the family.
                  </p>
                  

                </div>
              </div>

            </div>
          </div>
        </section>
        <!-- End banner_about -->

        <!-- Start about_cc_grid -->
        <section class="about_cc_grid padding-py-12" id="About">
          <div class="container">
            <div class="row">
              <div class="col-lg-5">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">About Us</span>
                  </div>
                  <h2>We're Vision-X Crypto, a financial service provider.</h2>
                </div>
              </div>
              <div class="col-lg-6 ml-auto">
                <div class="title_sections_inner mb-0">
                  <p>We're Vision-X Crypto Service Limited , a financial service provider.<br>
The Company is Involved in the exchange of Digital Assets such as cryptocurrencies.<br>Founded in 2015, the Company is a franchise of Vision-X limited which aims to deliver the new World of Digital Currencies to the African Digital Economy through exchange of Cryptocurrencies.
Vision-X Crypto also aims to create reliable and convenient e-payment platform for digital assets and other bill payments using our secured, seamless, cost effective integration models.
We work to achieve strict and uncompromised levels of security to enhance safety and trust in the utilization of our solutions. 
                    <br>
                    <br>
                    The Company is Inspired from the Legendary Covenant Vision Digital Prints LTD, Covenant Vision Palm Plantations LTD and
				  Amare Dynasty Records to deliver the new World of Digital Currencies to the world through Buying and Selling of Cryptocurrencies.</p>
                </div>
              </div>
            </div>

          
          </div>
        </section>
        <!-- End. about_cc_grid -->

        <!-- Start group_logo_list -->
        <section class="group_logo_list margin-b-12" data-aos="fade-up" data-aos-delay="0">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 my-auto">
                <div class="title_section mb-0">
                  <p>Partners -</p>
                </div>
              </div>
              <div class="col-lg-9 ml-auto my-auto">
                <div class="item_tto">
                  <img src="{{asset('front/img/logos/uber.png')}}" alt="">
                  <img src="{{asset('front/img/logos/netflix.png')}}" alt="">
                  <img src="{{asset('front/img/logos/rubies.png')}}" alt="">
                  <img src="{{asset('front/img/logos/flutter.png')}}" alt="">
                  <!--<img src="{{asset('front/img/logos/google.png')}}" alt="">
                  <img src="{{asset('front/img/logos/aust.png')}}" alt="">-->
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. group_logo_list -->

        <!-- Start features__workspace -->
        <section class="service__workspace features__workspace padding-py-12" id="Services">
          <div class="container">

            <div class="row">
              <div class="col-md-8 col-lg-4">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">Mission</span>
                  </div>
                  <h2>Reliable and convenient guiding principles</h2>
                  <p> To create reliable and convenient e-payment platform for digital assets and other bill payments using our secured, seamless, cost effective integration models.
                  </p>
                  
                </div>
              </div>
              <div class="col-lg-6 ml-auto mt-4 mt-lg-0">
                <div class="row">
                  <div class="col-md-6 fa_item">
                    <div class="inside__zoop" data-aos="fade-up" data-aos-delay="0">
                      <div class="media">
                        <div class="ico">
                          <i class="tio dashboard_outlined"></i>
                        </div>
                        <div class="media-body">
                          <div class="t_xt">
                            <h4>We Commit to Our Customers.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 fa_item">
                    <div class="inside__zoop" data-aos="fade-up" data-aos-delay="100">
                      <div class="media">
                        <div class="ico">
                          <i class="tio face_id"></i>
                        </div>
                        <div class="media-body">
                          <div class="t_xt">
                            <h4>We Dig Deeper In technology</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 fa_item">
                    <div class="inside__zoop" data-aos="fade-up" data-aos-delay="200">
                      <div class="media">
                        <div class="ico">
                          <i class="tio account_square_outlined"></i>
                        </div>
                        <div class="media-body">
                          <div class="t_xt">
                            <h4>We Minimize Waste.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 fa_item">
                    <div class="inside__zoop" data-aos="fade-up" data-aos-delay="300">
                      <div class="media">
                        <div class="ico">
                          <i class="tio file_text_outlined"></i>
                        </div>
                        <div class="media-body">
                          <div class="t_xt">
                            <h4>We Lead With Optimism.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 fa_item">
                    <div class="inside__zoop" data-aos="fade-up" data-aos-delay="400">
                      <div class="media">
                        <div class="ico">
                          <i class="tio credit_card_outlined"></i>
                        </div>
                        <div class="media-body">
                          <div class="t_xt">
                            <h4>We Embrace Differences.</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </section>
        <!-- End. features__workspace -->

        <!-- Start faq_one_inner -->
        <section class="faq_one_inner mt-0 w-100">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4">
                <div class="features_points mb-4 mb-lg-0">
                  <div class="title_sections_inner">
                    <h2>CORE VALUES</h2>
                  </div>
                  <ul class="list-group list_feat">
                    <li class="list-group-item border-0" data-aos="fade-up" data-aos-delay="0">
                      <i class="tio checkmark_circle_outlined"></i>
                      <p>
                        Security: We work to achieve strict and uncompromised levels of security to enhance safety and trust in the utilization of our solutions
                      </p>
                    </li>
                    <li class="list-group-item border-0" data-aos="fade-up" data-aos-delay="100">
                      <i class="tio checkmark_circle_outlined"></i>
                      <p>
                        Integrity: We maintain a principled and honest relationship with our highly esteemed customers to produce best results
                      </p>
                    </li>
                    <li class="list-group-item border-0" data-aos="fade-up" data-aos-delay="200">
                      <i class="tio checkmark_circle_outlined"></i>
                      <p>
                        Innovation: We are always on the look-out for better ways to achieve our mission; providing our highly esteemed customers with optimum satisfaction
                      </p>
                    </li>
					 <li class="list-group-item border-0" data-aos="fade-up" data-aos-delay="200">
                      <i class="tio checkmark_circle_outlined"></i>
                      <p>
                        Reliability: We are committed to providing reliable and trustworthy solutions and professional customer care services to our highly esteemed customers at any time
                      </p>
                    </li>
                  </ul>
                </div>
                
        </section>
        <!-- End. faq_one_inner -->

        <!-- Start team_overlay_style 
        <section class="team_overlay_style margin-b-7">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="title_sections_inner margin-b-5">
                  <h2>Meet the team.</h2>
                </div>
              </div>
            </div>-->
            <!--<div class="row">
              <div class="col-lg-3">
                <div class="item_group" data-aos="fade-up" data-aos-delay="0">
                  <div class="image_ps">
                    <img src="{{asset('front/img/persons/Mrnelson.png')}}" alt="">
                  </div>
                  
                  <div class="content_txt">
                    <h3>Mr John Nelson Amare</h3>
                    <p>Founder & CEO</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="item_group" data-aos="fade-up" data-aos-delay="100">
                  <div class="image_ps">
                    <img src="{{asset('front/img/persons/Mrjoseph.png')}}" alt="">
                  </div>
                  
                  <div class="content_txt">
                    <h3>Akanji.A.Joseph</h3>
                    <p>Chief Technology Officer</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="item_group" data-aos="fade-up" data-aos-delay="200">
                  <div class="image_ps">
                    <img src="{{asset('front/img/persons/19.jpg')}}" alt="">
                  </div>
                 
                  <div class="content_txt">
                    <h3>Mary Merrill </h3>
                    <p>General Manager</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="item_group" data-aos="fade-up" data-aos-delay="300">
                  <div class="image_ps">
                    <img src="{{asset('front/img/persons/22.jpg')}}" alt="">
                  </div>
                  
                  <div class="content_txt">
                    <h3>John Myers </h3>
                    <p>Head, Finance</p>
                  </div>
                </div>
              </div>-->
               
              <div class="col-lg-2 my-auto mx-auto" data-aos="fade-up" data-aos-delay="200">
                <p class="font-s-20 c-dark font-w-600">Join the family!.</p>
                <a href="career" class="btn btn_md_primary sweep_top sweep_letter bg-orange-red c-white rounded-8">
                  <div class="inside_item">
                    <span data-hover="Welcome !">Join us now</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <!-- End. team_overlay_style -->

      </main>
    </div>
    <!-- [id] content -->

    <!-- Start footer -->

@endsection


