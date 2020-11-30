@extends('include.front')
@section('content')
<!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">

        <!-- Start banner_about -->
        <section class="pt_banner_inner banner_px_image blog-banner_with_image">
          <div class="parallax_cover">
            <img class="cover-parallax" src="{{url('/')}}/front/img/blog2.png" alt="image">
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-6">
                <div class="banner_title_inner margin-b-3">
                  <h1 data-aos="fade-up" data-aos-delay="0">
                    News
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    Latest Press Release & Post.
                  </p>
                </div>
              </div>
            </div>
            
          </div>
        </section>
        <!-- End banner_about -->

        <!-- Start box_news_gray -->
        <section class="blog_slider box_news_gray margin-t-8">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="title_sections_inner">
                  <h2>Trending News</h2>
                </div>
              </div>
            </div>
            <div class="row">
                
            @foreach($blogs as $data)
              <div class="col-md-6 col-lg-4">
                <div class="grid_blog_avatar bg-snow" data-aos="fade-up" data-aos-delay="0">
                  <div class="body_blog">
                    <a href="{{route('blogview',$data->id)}}" class="link_blog">
                      <h4 class="title_blog">
                        {{$data->title}}
                      </h4>
                      <p class="short_desc">
                       {!!substr($data->details, 0, 25)!!}....
                      </p>
                    </a>
                    <a href="{{route('blogview',$data->id)}}">
                      <div class="person mb-0 media">
                          @if( file_exists($data->image))
                        <img src="{{asset($data->image)}}" alt="">
                        @else
                        <img src="{{url('/')}}/front/img/blog.jpg" alt="">
                        @endif
                        <div class="media-body">
                          <div class="txt">
                            <h3>{{$data->category->name}}</h3>
                            <time>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</time>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
                <!-- End grid_blog_avatar -->
              </div>

               @endforeach
            </div>
          </div>
        </section>
        <!-- End. box_news_gray -->

        

      </main> 
@endsection


