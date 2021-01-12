@extends('include.front')
@section('content')

		 <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="demo_2 demo_3 banner_section">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6">
                <div class="banner_title">
                  <div>
                    <!--<span class="c-white">Crypto</span>
                    <span class="c-green">On The Go</span>-->
                  </div>
                  <h1 class="c-white">Built For Convenience!</h1>
                  <p>
                    Easy User Experience and Responsive payment. <br />

                  </p>
                  <div class="form-row">
                    <div class="col-md-8 form-group input_subscribe dark mb-0">
                      <div class="item_input">
                        <input type="email" class="form-control rounded-8" id="exampleInputEmail1"
                          placeholder="Enter email address" aria-describedby="emailHelp" />
                        <button type="button" class="btn scale c-white btn_md_primary rounded-8 btn_subscribe">
                          Sign Up
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="app_smartphone margin-t-15">
                    <div class="btn--app mb-3 mb-lg-0">
                      <a class="media" href="#" target="_blank">
                        <div class="icon">
                          <i class="tio apple"></i>
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span>Available on</span>
                          </div>
                          <h4>App Store</h4>
                        </div>
                      </a>
                    </div>
                    <div class="btn--app">
                      <a class="media" href="#" target="_blank">
                        <div class="icon">
                          <i class="tio google_play"></i>
                        </div>
                        <div class="media-body txt">
                          <div>
                            <span>Get it on</span>
                          </div>
                          <h4>Play Store</h4>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-lg-6">
                <div class="img--elements">
                  <img src="{{asset('front/img/elements1.png')}}" />
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->

        <!-- start Crypto -->
       <!-- <section class="crypto_section padding-py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="item-coin" data-aos="fade-up" data-aos-delay="0">
                  <div class="media">
                    <div class="icon bit transform-r-15">
                      <i class="tio bitcoin"></i>
                    </div>
                    <div class="media-body mt-1 ml-3">
                      <div class="title float-left">
                        <span>Bitcoin</span>
                        <p>BTC/USD</p>
                      </div>
                      <div class="price float-right">
                        <span>$6,1504.54</span>
                        <p class="c-red">-$474.40 (-6.5%)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="item-coin" data-aos="fade-up" data-aos-delay="100">
                  <div class="media">
                    <div class="icon eth">
                      <i class="tio ethereum"></i>
                    </div>
                    <div class="media-body mt-1 ml-3">
                      <div class="title float-left">
                        <span>Ethereum</span>
                        <p>ETH/USD</p>
                      </div>
                      <div class="price float-right">
                        <span>$128.59</span>
                        <p class="c-green">+$7.95 (3.82%)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                <div class="item-coin" data-aos="fade-up" data-aos-delay="200">
                  <div class="media">
                    <div class="icon bch">
                      <i class="tio bitcoin"></i>
                    </div>
                    <div class="media-body mt-1 ml-3">
                      <div class="title float-left">
                        <span>Bitcoin Cash</span>
                        <p>BCH/USD</p>
                      </div>
                      <div class="price float-right">
                        <span>$208.35</span>
                        <p class="c-red">-$18.68 (7.27%)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <div class="item-coin" data-aos="fade-up" data-aos-delay="300">
                  <div class="media">
                    <div class="icon ltc">
                      <i class="tio litecoin"></i>
                    </div>
                    <div class="media-body mt-1 ml-3">
                      <div class="title float-left">
                        <span>Litecoin</span>
                        <p>LTC/USD</p>
                      </div>
                      <div class="price float-right">
                        <span>$37.81</span>
                        <p class="c-red">-$2.10 (3.82%)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>-->
        <!-- End. Crypto -->

        <!-- Start Section Products -->
        <section class="products_section product_demo3 padding-t-12" id="Services">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-5 margin-b-3">
                <div class="title_sections margin-b-4">
                  <div class="before_title">
                    <span>Welcome to the family</span>
                      <!--<span class="c-green">with us</span>-->
                  </div>
                  <h2 class="c-dark">
                    Let's get you started within minutes.
                  </h2>
                </div>
                <a href="register" class="btn btn_md_primary z-index-2 c-white scale bg-orange-red effect-letter rounded-8">
                  Sign up
                </a>
                <img class="illustration d-sm-none d-lg-block" src="{{asset('front/img/tecno.png')}}"  class="img img-thumbnail" style="border:none" />
              </div>
              <div class="col-lg-6 ml-sm-auto">
                <div class="row">
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="0">
                      <img src="{{asset('front/img/icons/verify.svg')}}" />
                      <h3>Verify your account</h3>
                      <p>
                        Immediately After your Account registration verify your account to enable access to our services.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="100">
                      <img src="{{asset('front/img/icons/Top_Up.svg')}}" />
                      <h3>Top-up your wallet</h3>
                      <p>
                        top-up your wallet to enjoy seamless product services.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6 margin-b-5">
                    <div class="item_pro" data-aos="fade-up" data-aos-delay="200">
                      <img src="{{asset('front/img/icons/purchase.svg')}}" />
                      <h3>Initiate your prefered service</h3>
                      <p>
                        Select your prefered service that suit your needs.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .container -->
        </section>
        <!-- End Section Products -->

        <!-- Start feature_app -->
        <section class="feature_app margin-t-12 padding-t-12" id="Features">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-10 col-lg-8 text-center">
                <div class="title_sections">
                  <div class="before_title">
                     <!--<span>Development</span>
                    <span class="c-green">timeline</span> -->
                  </div>
                  <h2>
                    One application infinite possibilities.
                  </h2>
                </div>
              </div>
            </div>
            <div class="row d-flex">
              <div class="col-lg-3 order-1 order-lg-1 my-auto">
                <div class="item-feat" data-aos="fade-up" data-aos-delay="0">
                  <div class="icon-iim transform-r-15">
                    <img src="{{asset('front/img/icons/discount.svg')}}" />
                  </div>
                  <h3>VX Vault</h3>
                  <p>
                    Structured investment system.
                  </p>
                </div>
                <div class="item-feat" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon-iim">
                    <img src="{{asset('front/img/icons/cryptocurrency.svg')}}" />
                  </div>
                  <h3>Digital Assets</h3>
                  <p>
                    Bitcoin | Ethereum | Perfect Money.
                  </p>
                </div>
              </div>
              <div class="col-md-8 col-lg-4 order-3 order-lg-2 mx-auto" data-aos="fade-up" data-aos-delay="0">
                <img class="app--crypto" src="{{asset('front/img/app-crypto.png')}}"  class="img img-thumbnail" style="border:none"/>
              </div>
              <div class="col-lg-3 order-2 order-lg-3 my-auto">
                <div class="item-feat text-lg-right" dir="rtl" data-aos="fade-up" data-aos-delay="0">
                  <div class="icon-iim">
                    <img src="{{asset('front/img/icons/note.svg')}}" />
                  </div>
                  <h3>Bill Payments</h3>
                  <p>
				  Cable Subscription, Utility bills, Airtime to cash, Instant sms, and many more
                  </p>
                </div>
                <div class="item-feat text-lg-right" dir="rtl" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon-iim">
                    <img src="{{asset('front/img/icons/phone.svg')}}" />
                  </div>
                  <h3>Airtime Top-up</h3>
                  <p>Stay Connected anytime
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. feature_app -->



        <!-- VX Debit card Service -->
        <section class="tabs_works tabs_service padding-t-12" id="Prodcts">
          <div class="container">
            <!-- Start Tabs -->
            <div class="row">
              <div class="col-md-10 col-lg-4">
                <div class="title_sections margin-b-6">
                  <div class="before_title">
                    <span>  </span>
                    <!--<span class="c-green">Portfolio</span>-->
                  </div>
                  <h2 class="c-dark">
                    Virtual Card.
                  </h2>
                  <p class="c-gray">
                    Our virtual card gives you unlimited access.
                  </p>
                </div>

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">
                    <h4 class="margin-b-2 font-s-18">Freedom</h4>
                    <p>
                       Make transactions anywhere anytime instantly, through Ecommerce or Online Stores around the globe.
                    </p>
                  </a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                    aria-controls="v-pills-profile" aria-selected="false">
                    <h4 class="margin-b-2 font-s-18">Card protection</h4>
                    <p>
                      Our Virtual card will be only available to verified account holders.
                    </p>
                  </a>
                  <!--<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                    aria-controls="v-pills-messages" aria-selected="false">
                    <h4 class="margin-b-2 font-s-18">Mobile apps</h4>
                    <p>
                      Stay on top of the markets with the Coinbase app for
                      <span class="c-blue">Android</span> or
                      <span class="c-blue">iOS</span>.
                    </p>
                  </a>-->
                </div>
              </div>
              <div class="col-md-10 col-lg-7 ml-auto mt-md-auto">
                <div class="tab-content img--tabs slide_bottom" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                      <img src="{{asset('front/img/cardhome.png')}}"  class="img img-thumbnail" style="border:none"/>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs -->
          </div>
        </section>
        <!-- End. Tabs Service -->



        <!-- Start Features -->
        <section class="features_section upgrade_item padding-t-12 bg-white position-relative z-index-1">
          <div class="container">
            <div class="row">
              <!-- img -->
              <div class="col-md-8 col-lg-6 mx-auto">
                <div class="images" data-aos="fade-up" data-aos-delay="0">
                  <img src="{{asset('front/img/securelock.png')}}"  class="img img-thumbnail" style="border:none"/>
                </div>
              </div>
              <!-- text -->
              <div class="col-md-10 col-lg-6 ml-auto">
                <div class="title_sections">
                  <div class="before_title">
                   <!--  <span>Upgrade ðŸ‘Œ</span>-->
                  </div>
                  <h2>Your security is our highest priority</h2>
                  <p>
                    Transact faster, safer, and more convenient with no point of failure.
                  </p>
                  <ul class="list-group">
                    <li class="list-group-item media border-0">
                      <i class="tio checkmark_circle_outlined c-green mr-2"></i>
                      <div class="media-body">
                        100% Wallet Protection
                      </div>
                    </li>
                    <li class="list-group-item media border-0">
                      <i class="tio checkmark_circle_outlined c-green mr-2"></i>
                      <div class="media-body">
                        Data Protection
                      </div>
                    </li>
                    <li class="list-group-item media border-0">
                      <i class="tio checkmark_circle_outlined c-green mr-2"></i>
                      <div class="media-body">
                        Multi-factor authentication
                      </div>
                    </li>
                    <li class="list-group-item media border-0">
                      <i class="tio checkmark_circle_outlined c-green mr-2"></i>
                      <div class="media-body">
                        Secure Transaction Delivery
                      </div>
                    </li>
                  </ul>
                  <a href="privacy-policy" class="btn link-more pl-0">
                    Learn more
                    <i class="tio chevron_right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Features -->



		<!-- Bill payment Service -->
        <section class="tabs_works tabs_service padding-t-12" id="Prodcts">
          <div class="container">
            <!-- Start Tabs -->
            <div class="row">
              <div class="col-md-10 col-lg-4">
                <div class="title_sections margin-b-6">
                  <div class="before_title">
                    <!--<span>COMING SOON</span>-->
                    <!--<span class="c-green">Portfolio</span>-->
                  </div>
                  <h2 class="c-dark">
                    Bill Payment.
                  </h2>
                  <p class="c-gray">
                    Stay Connected anytime, anywhere.
                  </p>
                </div>

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">
                    <h4 class="margin-b-2 font-s-18">Featured Services</h4>
                    <p>
                       Cable Subscription, Utility bills, Airtime to cash, Instant sms, and many more...
                    </p>
                  </a>
                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                    aria-controls="v-pills-profile" aria-selected="false">
                    <h4 class="margin-b-2 font-s-18">Instant Top-Up</h4>
                    <p>
                      Instant Virtual Top Up on your virtual card to make online transactions faster and more convenient.
                    </p>
                  </a>
                  <!--<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                    aria-controls="v-pills-messages" aria-selected="false">
                    <h4 class="margin-b-2 font-s-18">Mobile apps</h4>
                    <p>
                      Stay on top of the markets with the Coinbase app for
                      <span class="c-blue">Android</span> or
                      <span class="c-blue">iOS</span>.
                    </p>
                  </a>-->
                </div>
              </div>
              <div class="col-md-10 col-lg-7 ml-auto mt-md-auto">
                <div class="tab-content img--tabs slide_bottom" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">
                    <img class="--img" src="{{asset('front/img/tv.png')}}"  class="img img-thumbnail" style="border:none" />
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <img class="--img" src="{{asset('front/img/tv.png')}}" class="img img-thumbnail" style="border:none"/>
                  </div>
                  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                    aria-labelledby="v-pills-messages-tab">
                    <img class="--img" src="{{asset('front/img/tv.png')}}"  class="img img-thumbnail" style="border:none" />
                  </div>
                </div>
              </div>
            </div>
            <!-- End Tabs -->
          </div>
        </section>
        <!-- End. Tabs Service -->



        <!-- Start Support Service  -->
        <section class="services_section support_item padding-t-12" id="Support">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-md-10 col-lg-6 text-center">
                <div class="title_sections">
                  <!--<div class="before_title">
                    <span>Always By</span>
                    <span class="c-green">Your Side</span>
                  </div>-->
                  <h2>We are here for you alone!</h2>
                  <p>
                    Become part of our ever growing community.
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-4 mb-3 mb-lg-0 padding-r-5">
                <div class="items_serv sevice_block" data-aos="fade-up" data-aos-delay="0">
                  <div class="icon--top transform-r-15">
                    <img src="{{asset('front/img/icons/travel.svg')}}" alt="" />
                  </div>
                  <div class="txt">
                    <h3>24/7 Support</h3>
                    <p>
                      Need help? Get your requests solved<br />
                      quickly via our support team.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
                <div class="items_serv sevice_block" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon--top">
                    <img src="{{asset('front/img/icons/writing02.svg')}}" alt="" />
                  </div>
                  <div class="txt">
                    <h3>Community</h3>
                    <p>
                      Join the conversations on our Social Media.
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="items_serv sevice_block" data-aos="fade-up" data-aos-delay="200">
                  <div class="icon--top">
                    <img src="{{asset('front/img/icons/book.svg')}}" alt="" />
                  </div>
                  <div class="txt">
                    <h3>Blog</h3>
                    <p>
                      Learn from experts.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. Support Service  -->





        <!-- Start test_monials__workspace -->
        <section class="test_monials__workspace margin-t-2 padding-t-10" id="Testimonial">
          <div class="container-fluid">
            <div class="box__others">
              <div class="row">
                <div class="col-lg-5 pl-lg-0">
                  <div class="img__people">
                      <img src="{{asset('front/img/workspace/others.png')}}"  class="img img-thumbnail" style="border:none"/>
                    <div class="col-lg-5 item_title">
                      <div class="title_sections">
                        <div class="before_title">
                          <span class="c-orange-red">Testimonial</span>
                        </div>
                        <h2>What Our Clients Say</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 my-lg-auto mx-auto">
                  <div class="people__say">
                    <div class="swiper-container gallery-top swipe_circle">
                      <!-- item Users -->
                      <div class="person_thumbs">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <img class="pagination rounded-circle" src="../../front/img/persons/debbie.png" />
                          </div>
                          <div class="swiper-slide">
                            <img class="pagination rounded-circle" src="../../front/img/persons/tola.png" />
                          </div>
                          <div class="swiper-slide">
                            <img class="pagination rounded-circle" src="../../front/img/persons/omolare.png" />
                          </div>
                          <div class="swiper-slide">
                            <img class="pagination rounded-circle" src="../../front/img/persons/david.png" />
                          </div>
                          <div class="swiper-slide">
                            <img class="pagination rounded-circle" src="../../front/img/persons/john.png" />
                          </div>
                        </div>
                      </div>
                      <!-- item content -->
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          <div class="img__user">
                            <img src="../../front/img/persons/debbie.png" alt="">
                          </div>
                          <div class="username👨">
                            <h4>Debbi Amanda</h4>
                            <span>Business Owner</span>
                          </div>
                          <div class="content col-md-8 mx-auto text-center">
                            "since I started using Vision-X Crypto services  i have  witnessed  a tremendous  growth  in my business ..I was really wowed by this !!"
                          </div>
                          <div class="stars__rate">
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="img__user">
                            <img src="../../front/img/persons/tola.png" alt="">
                          </div>
                          <div class="username👨">
                            <h4>Tola Jacbos</h4>
                            <span>Student</span>
                          </div>
                          <div class="content col-md-8 mx-auto text-center">
                            "paying my school bills is just with a click I don't need to go back to the lengthy queues"
                          </div>
                          <div class="stars__rate">
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="img__user">
                            <img src="../../front/img/persons/omolare.png" alt="">
                          </div>
                          <div class="username👨">
                            <h4>Omolara Makinde</h4>
                            <span>Business Woman</span>
                          </div>
                          <div class="content col-md-8 mx-auto text-center">
                            " i receive  all my business  payments  through Vision-X  because  it makes payment  fast and easy especially  with the simple  layout of the app"
                          </div>
                          <div class="stars__rate">
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="img__user">
                            <img src="../../front/img/persons/david.png" alt="">
                          </div>
                          <div class="username👨">
                            <h4>David Amare</h4>
                            <span>Crypto Trader</span>
                          </div>
                          <div class="content col-md-8 mx-auto text-center">
                            "Really happy with the support team and enjoyed every trade of my bitcoin with this platform, they are the best"
                          </div>
                          <div class="stars__rate">
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                          </div>
                        </div>
                        <div class="swiper-slide">
                          <div class="img__user">
                            <img src="../../front/img/persons/john.png" alt="">
                          </div>
                          <div class="username👨">
                            <h4>John Omokafe</h4>
                            <span>Landlord</span>
                          </div>
                          <div class="content col-md-8 mx-auto text-center">
                            "they have revolutionized payments now i can get my rents faster without  any delay from my tenants"
                          </div>
                          <div class="stars__rate">
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                            <i class="tio star"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="simple__particles">
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                      <div></div>
                    </div>
                    <!-- End Swiper -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End. test_monials__workspace -->





		<!-- Comodo Secured --><br></br><br></br><br></br><br></br>
        <section class="simplecontact_section tryit_now padding-py-6">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-7">
                <div class="title_sections mb-1 mb-lg-auto">
                  <h2 class="c-white">Secured by Sectigo SSL</h2>
                  <p>
                    Your security is our highest priority
                  </p>
                </div>
              </div>
              <div class="col-md-3 col-lg-5 my-auto ml-auto text-sm-right">
                <img src="{{asset('front/img/comodo.png')}}" />
              </div>
            </div>
          </div>
        </section>




      </main>
      <!-- end main -->
    </div>
    <!-- [id] content -->

@endsection


