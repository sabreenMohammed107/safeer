<!-- statistics -->
<section class="statistics">
    <div class="deatils container">
        <div class="row mx-0">
            @foreach ($counters as $key => $Counter)
            <div class=" col-md-3 col-sm-12">
                <div class="info">
                  <img src="{{ asset("/website_assets/images/homePage/$Counter->image") }}" alt="plane image">
                  <span>
                    {{$Counter->vlaue}}+
                  </span>
                  <span>

                  </span>
                  <span>
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                    {{$Counter->title_en}}

                    @else
                    {{$Counter->title_ar}}
                    @endif

                  </span>
                  @if($key != 3)
                  @if($key % 2 == 0)
                  <img src="{{ asset('/website_assets/images/homePage/line_up.webp') }}" alt="line ">
                  @else
                  <img src="{{ asset('/website_assets/images/homePage/line_down.webp') }}" class="line_down" alt="line ">
                  @endif
                  @endif
                </div>
            </div>
            @endforeach


        </div>
    </div>
    <img src="{{ asset("/website_assets/images/homePage/slider-mask.webp") }}" alt=" slider mask">
  </section>
