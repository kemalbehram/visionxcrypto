@extends('include.front')
@section('content')

	<!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start banner_about -->
        <section class="pt_banner_inner banner_px_image" id="Discover">
          <div class="parallax_cover">
            <img class="cover-parallax" src="{{asset('front/img/inner/about3.jpg')}}" alt="image">
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6">
                <div class="banner_title_inner">
                  <h1 data-aos="fade-up" data-aos-delay="0">
                    Our Products
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    Product & services.
                  </p>


                </div>
              </div>

            </div>
          </div>
        </section>
        <!-- End banner_about -->



        <!-- Start features__workspace -->
        <section class="service__workspace features__workspace padding-py-12" id="Services">
          <div class="container" id="vxcard">

            <div class="row">
              <div class="col-md-8 col-lg-4">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">  </span>
                  </div>
                  <h2>VIRTUAL CARD</h2>
                  <p> Make transactions anywhere anytime instantly, through Ecommerce or Online Stores around the globe.
                  </p>

                </div>
              </div>
              <div class="col-lg-6 ml-auto mt-4 mt-lg-0">
                <div class="row">
                  <img class="logo" src="{{asset('front/img/pic-3.png')}}" alt="logo" style="width:334px;height:300px;" />
                </div>
              </div>
            </div>
          </div>


		  <br><br><br><br><br><br>


		  <div class="container" id="dgassets">

            <div class="row">
              <div class="col-md-8 col-lg-4">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">   </span>
                  </div>
                  <h2>DIGITAL ASSETS</h2>
                  <p> Bitcoin, Ethereum, Perfect money.
                  </p>

                </div>
              </div>
              <div class="col-lg-6 ml-auto mt-4 mt-lg-0">
                <div class="row">
                  <img class="logo" src="{{asset('front/img/coin1.png')}}" alt="logo" style="width:500px;height:118px;" />
                </div>
              </div>
            </div>
          </div>


		  <br><br><br><br><br><br>


		  <div class="container">

            <div class="row">
              <div class="col-md-8 col-lg-4">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">   </span>
                  </div>
                  <h2>BILL PAYMENTS</h2>
                  <p> Instant Virtual Top Up, DSTV subscription, GOtv Subscription, Electricity bills, Hotel Bookings, Airtime to cash, Instant sms.
                  </p>

                </div>
              </div>
              <div class="col-lg-6 ml-auto mt-4 mt-lg-0">
                <div class="row">
                  <img class="logo" src="{{asset('front/img/currency.png')}}" alt="logo" style="width:500px;height:118px;" />
                </div>
              </div>
            </div>
          </div>

		  <br><br><br><br><br><br>


		  <div class="container">

            <div class="row">
              <div class="col-md-8 col-lg-4">
                <div class="title_sections_inner mb-0">
                  <div class="before_title">
                    <span class="c-orange-red">  </span>
                  </div>
                  <h2>VX VAULT</h2>
                  <p> Build your investment and earn countless reward.
                  </p>

                </div>
              </div>
              <div class="col-lg-6 ml-auto mt-4 mt-lg-0">
                <div class="row">
                  <img class="logo" src="{{asset('front/img/vault.png')}}" alt="logo" style="width:600px;height:280px;" />
                </div>
              </div>
            </div>
          </div>


        </section>
        <!-- End. features__workspace -->




      </main>
    </div>
    <!-- [id] content -->

@endsection


