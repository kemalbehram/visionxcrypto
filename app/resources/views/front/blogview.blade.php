@extends('include.front')
@section('content')

 <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start Banner Section -->
        <section class="pt_banner_inner banner_Sblog_default">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-8 col-lg-7 my-auto">
                <div class="banner_title_inner margin-b-8">
                  <div class="icon_c six">
                    <svg id="Stockholm-icons-_-Home-_-Deer" data-name="Stockholm-icons-/-Home-/-Deer"
                      xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                      <rect id="bound" width="24" height="24" fill="none" />
                      <path id="Combined-Shape"
                        d="M21.982,8.189a.993.993,0,0,1-.467.668l-5,3A1,1,0,0,1,16,12H8a1,1,0,0,1-.514-.143l-5-3a.993.993,0,0,1-.467-.668l-1-4.993A1,1,0,0,1,2.981,2.8l.634,3.168L6.293,3.293A1,1,0,0,1,7.707,4.707L4.613,7.8,8.277,10h7.446l3.664-2.2L16.293,4.707a1,1,0,0,1,1.414-1.414l2.679,2.679L21.019,2.8a1,1,0,0,1,1.961.392Zm-6.929.705a1,1,0,1,1,.894-1.789l3,1.5a1,1,0,0,1,.067,1.752l-2.5,1.5A1,1,0,0,1,16,12H8a1,1,0,0,1-.514-.143l-2.5-1.5a1,1,0,0,1,0-1.715l2.5-1.5A1,1,0,1,1,8.514,8.857L7.444,9.5l.833.5h7.446l.7-.42Z"
                        fill="#fff" opacity="0.3" />
                      <path id="Rectangle-192"
                        d="M9.855,10h4.289a2,2,0,0,1,1.88,2.683L13.342,20.06A1.428,1.428,0,0,1,12,21h0a1.428,1.428,0,0,1-1.342-.94L7.976,12.683A2,2,0,0,1,9.855,10Z"
                        fill="#fff" fill-rule="evenodd" />
                    </svg>
                  </div>
                  <h1>
                   {{$blog->title}}
                  </h1>
                </div>
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb default justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$blog->title}}</li>
                  </ol>
                </nav>

              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="cover_Sblog">
                    @if( file_exists($blog->image))
                  <img class="cover-parallax" src="{{asset($blog->image)}}" alt="">
                  @else
                  
                  <img class="cover-parallax" src="{{url('/')}}/front/img/blog2.png" alt="">
                  @endif
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Banner -->

        <section class="content-Sblog" data-sticky-container>
          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <div class="fixSide_scroll" data-sticky-for="1023" data-margin-top="100">
                  <div class="item">
                    <div class="profile_user">
                      <img src="{{asset('front/img/favicon.png')}}" alt="">
                      <div class="txt">
                        <h4>
                         VisionX
                        </h4>
                        <time>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</time>
                      </div>
                      <a href="#" class="btn btn_profile c-white sweep_top sweep_letter rounded-pill bg-lightgreen">
                        <div class="inside_item">
                          <span data-hover="Profile">Profile</span>
                          <span></span>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="share_socail">
                    <div class="title">Share</div>

                    <button class="btn icon" data-toggle="tooltip" data-placement="right" title="Facebook"
                      data-sharer="facebook" data-hashtag="hashtag" data-url="{{url()->current()}}">
                      <i class="tio facebook"></i>
                    </button>

                    <button class="btn icon" data-toggle="tooltip" data-placement="right" title="Twitter"
                      data-sharer="twitter" data-title="Checkout Sharer.js!" data-hashtags="awesome, sharer.js"
                      data-url="{{url()->current()}}">
                      <i class="tio twitter"></i>
                    </button>

                    <button class="btn icon" data-toggle="tooltip" data-placement="right" title="Whatsapp"
                      data-sharer="whatsapp" data-title="Checkout Sharer.js!"
                      data-url="{{url()->current()}}">
                      <i class="tio whatsapp_outlined"></i>
                    </button>

                    

                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="body_content">
                  <p class="margin-b-3">{!! $blog->details !!}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!-- Start section__stories -->
        <section class="section__stories blog_slider padding-t-12">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-12">
                <div class="swip__stories">
                  <!-- Swiper -->
                  <div class="swiper-container blog-slider">
                    <div class="title_sections_inner">
                      <h2>Other articles</h2>
                    </div>
                    <div class="swiper-wrapper">
                    @foreach($blogs as $data)
                      <div class="swiper-slide">
                        <div class="grid_blog_avatar">
                          <div class="cover_blog">
                               @if( file_exists($data->image))
                            <img src="{{asset($data->image)}}" alt="">
                            @else
                            
                            <img src="{{url('/')}}/front/img/blog.jpg" alt="">
                            @endif
                          </div>
                          <div class="body_blog">
                            <a href="#">
                              <div class="person media">
                                <img src="{{asset('front/img/favicon.png')}}" alt="">
                                <div class="media-body">
                                  <div class="txt">
                                    <h3>{{$data->category->name ?? "VisionX"}}</h3>
                                    <time>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</time>
                                  </div>
                                </div>
                              </div>
                            </a>
                            <a href="{{route('blogview',$data->id)}}" class="link_blog">
                            <h4 class="title_blog">
                                {{$data->title}}
                              </h4>
                             <!-- <h4 class="title_blog">
                                As climate warms, Ecuador fights fires with forecasts
                              </h4>
                              <p class="short_desc">
                                Vitae semper quis lectus nulla at volutpat diam. Sed viverra ipsum
                                nunc aliquet .
                              </p> -->
                            </a>
                          </div>
                        </div>
                        <!-- End grid_blog_avatar -->
                      </div>
                    @endforeach
                     


                    </div>

                    <!-- Add Arrows -->
                    <div class="swiper-button-next">
                      <i class="tio chevron_right"></i>
                    </div>
                    <div class="swiper-button-prev">
                      <i class="tio chevron_left"></i>
                    </div>

                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
        <!-- End. section__stories -->

@endsection


