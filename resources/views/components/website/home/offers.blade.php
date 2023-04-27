@php

switch ($offers->count()) {
  case 0:
      $Map = [12,0,0,0,0,0];
      break;

  case 1:
      $Map = [6,6,12,0,0,0];
      break;
  case 2:
      $Map = [6,6,6,6,0,0];
      break;
  case 3:
      $Map = [5,7,12,6,6,0];
      break;
  case 4:
      $Map = [5,7,6,6,6,6];
      break;
  default:
  $Map = [12,0,0,0,0,0];
      break;
}
@endphp
  <!-- offers section -->
<section class="offers">
<div class="titles">
<h3>
    @if (LaravelLocalization::getCurrentLocale() === 'en')
    LIMITED TIME OFFERS

    @else
    عروض لفترة محدودة
    @endif
</h3>
<p>
    {{-- {!! $title!!} --}}
    @if (LaravelLocalization::getCurrentLocale() === 'en')
    Limit Offer When it comes to exploring exotic places, the choices are numerous. Whether you like peaceful destinations or vibrant landscapes, we have offers for you.



    @else
    عرض محدود عندما يتعلق الأمر باستكشاف أماكن غريبة ، فإن الخيارات عديدة. سواء كنت تحب الوجهات الهادئة أو المناظر الطبيعية النابضة بالحياة ، لدينا عروض لك.
    @endif
</p>
</div>
<div class="offers_details container">
<div class="row mx-0">
  <div class="col-sm-12 col-md-12 col-xl-{{$Map[0]}} p-0 text-center">
    <div class="card-content ">
      <div class=" card">
        <div class="card-body explore_card adventure_mind justify-content-evenly">
          <div class="header_info">
            <h5>
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                HAVE AN ADVENTURE
                IN MIND?

                @else
                استمتع بمغامرة
                في خيالك؟
                @endif
               </h5>
           <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
            Dummy text ever since the 1500s,
            when an unknown printer took.
            A galley of type and scrambled it to make.

            @else
            نص وهمي منذ القرن الخامس عشر الميلادي ،
            عندما أخذت طابعة غير معروفة.
            لوح من النوع واندفع لصنعه.
            @endif

           </p>
          <div class="start">
            <span></span>
            <h6> @if (LaravelLocalization::getCurrentLocale() === 'en')

                start from
                @else
                يبدأ من
                @endif</h6>
            <span></span>
          </div>
            <span>699 $</span>
            <button class="btn">
              <a href="#"> @if (LaravelLocalization::getCurrentLocale() === 'en')

                start trip
                @else
                ابدأ الرحلة
                @endif </a>
            </button>
          </div>
      </div>
    </div>
    </div>
  </div>
  @if ($Map[1])
  <div class="col-sm-12 col-md-12 col-xl-{{$Map[1]}} p-0">
      <div class="row mx-0">
          @foreach ($offers as $key => $Offer)
          @if ($Map[$key + 2])
          <div class="col-md-{{$Map[$key + 2]}} col-sm-12  p-0">
            <div class="card-content" >

              <div class=" card">
                <div class="card-body offers_card offer_place_1"
                onmouseenter="darkBG(this)"
                onmouseleave="rmvDarkBG(this)"

                 style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/offers') }}/{{ $Offer->image }});">
                  <div class="header_info">
                    <h5><a href="#" class="stretched-link"> @if (LaravelLocalization::getCurrentLocale() === 'en')
                        {{$Offer->city->en_city ?? ""}}

                        @else
                        {{$Offer->city->ar_city ?? ""}}
                        @endif</a>
                    </h5>
                    <span> @if (LaravelLocalization::getCurrentLocale() === 'en')
                      .................  {{$Offer->subtitle_en}}

                        @else
                      {{$Offer->subtitle_ar}}
                        @endif
                    </span>
                    <span>
                      220 $
                    </span>
                  </div>

              </div>
              </div>
            </div>

          </div>
          @endif
          @endforeach


      </div>
    </div>
  @endif

</div>
</div>
</section>



<script>

  function darkBG(elm){
    let allourImg = elm.style.backgroundImage.split(',');
    ourURL = allourImg[allourImg.length - 1];
    var newStyleBG = `linear-gradient(hsla(0, 0%, 0%, 0.733),hsla(0, 0%, 0%, 0.733)) , ${ourURL} `
    elm.style.backgroundImage = newStyleBG;
  }
  function rmvDarkBG(elm){
    var newStyleBG = `linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , ${ourURL} `
    elm.style.backgroundImage = newStyleBG;
  }
</script>

