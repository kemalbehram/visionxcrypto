 @extends('include.front')
@section('content')
 <!-- Stat main -->
      <main data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <!-- Start banner_about -->
        <!-- Start tb_features_pricing -->
         <section class="pt_banner_inner banner_bg_pricging">
          <div class="container">
            <div class="row justify-content-center text-center">
              <div class="col-md-10 col-lg-6">
                <div class="banner_title_inner margin-b-3">
                  <h1 data-aos="fade-up" data-aos-delay="0">
                   Our Crypto Rates
                  </h1>
                  <p data-aos="fade-up" data-aos-delay="100">
                    Make mouth watering gain by trading your crypto assets with us
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><span>Coin</span></th>
                        <th scope="col"><span>Symbol</span></th>
                        <th scope="col"><span>We Buy At</span></th>
                        <th scope="col"><span>We Sell At</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($currency as $key => $data)
                      <tr>
                        <td><span>{{$data->name}}</span></td>
                        <td><span>{{$data->symbol}}</span></td>
                        <td><span>₦{{number_format($data->buy, $basic->decimal)}} <small>/ USD</small></span></td>
                        <td><span>₦{{number_format($data->sell, $basic->decimal)}} <small>/ USD</small></span></td>
                      </tr>
                      @endforeach
                     
                     
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </section>
        <!-- End banner_about -->
          
        <!-- Start creative_box_contact -->
        <section class="creative_box_contact padding-t-12">
          <div class="container">
            <div class="content">
              <div class="row justify-content-center text-center">
                <div class="col-lg-5">
                  <div class="title_sections_inner margin-b-4">
                    <h2 class="c-white" data-aos="fade-up" data-aos-delay="0">Cryptocurrency Calculator</h2>
                    <p class="c-light" data-aos="fade-up" data-aos-delay="100">
                        <script>

function myFunction() {
 var amount = $('#mySelect2').val() ;

 var price = $("#mySelect option:selected").attr('data-price');
 var name = $("#mySelect option:selected").attr('data-name');
 var sell = $("#mySelect option:selected").attr('data-sell');
 var buy = $("#mySelect option:selected").attr('data-buy');
 var cur = $("#mySelect option:selected").attr('data-cur');
 var rate = Math.round(price).toFixed(2);

 var sellcharge = amount * sell /100;
 var buycharge = amount * buy /100;
 var paybuy = amount *buy;
 var paysell = amount*sell;
 var rate = parseFloat(1*amount/price).toFixed(8);

 //document.getElementById("unit").innerHTML = "What you get: " + rate + cur;

 document.getElementById("buy").innerHTML = "We buy at: USD " + paybuy;
 document.getElementById("sell").innerHTML = "We sell at: USD " + paysell;
 var unit = parseFloat(amount / price).toFixed(8);
 document.getElementById("price").innerHTML = "USD " +      Math.round(rate).toFixed(2);

 };
</script>


<section class=" "><div class="container "><br>

<div class="field-item"><label class="field-label text-white">Select Cryptocurrency</label><div class="field-wrap">
<select onchange="myFunction()" class="selec form-control"  id="mySelect"><option value="">Please select</option>
@foreach($currency as $key => $data)
<option data-cur="{{$data->symbol}}" data-sell="{{$data->sell}}"  data-name="{{$data->name}}"  data-price="{{$data->price}}" data-buy="{{$data->buy}}">{{$data->name}} </option>
@endforeach
</select></div> </div>
<br>

<div class="field-item"><label class="field-label text-white">Enter amount in <code> USD </code> </label> <div class="field-wrap"><input  id="mySelect2" onkeyup="myFunction()"  type="number" class="form-control" required></div></div>
<br>

<p id="buy"></p>
<p id="sell"></p>
<!--<p id="unit"></p> -->


</div></section>
                        
                        
                    </p>
                  </div>
                   
              </div>
            </div>

          </div>
        </section>
        <!-- End. creative_box_contact -->


      </main>
    </div>
    <!-- [id] content -->

@endsection
