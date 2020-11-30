@extends('include.front')
@section('content')

<!-- .header-banner @e --></header><main data-spy="scroll" data-target="#navbar-example2" data-offset="0">

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
                    {{$blog->category->name ?? 'Blog'}}
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    {{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}
                  </p>
                </div>
              </div>
            </div>
            
          </div>
        </section>
        <!-- End banner_about --><section class="section bg-white"><div class="container"><div class="nk-block nk-block-blog"><div class="row"><div class="col-12"><div class="blog-details"><div class="row justify-content-center"><div class="col-xl-10 col-lg-12"><div class="blog-featured">@if( file_exists($blog->image))
                      <center>  <br><img src="{{asset($blog->image)}}" width="100"
                             alt="Notification Image">
                    </center> @else
                    @endif
</div></div><div class="col-xl-8 col-lg-10"> <div class="blog-content"><h2 class="title"><a href="#">{{$blog->title}}.</a></h2><p>{!! $blog->details !!}.</p></div> </div><!-- .row --></div><!-- .block @e --></div> <!-- .nk-ovm --></section>

 </div><!-- .nk-block --></div><!-- .container --></section><!-- .section --></main>
@endsection


