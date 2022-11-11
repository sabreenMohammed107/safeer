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
      break;
}
@endphp
  <!-- offers section -->
<section class="offers">
<div class="titles">
<h3>LIMITED TIME OFFERS </h3>
<p>{!! $title!!}
</p>
</div>
<div class="offers_details container">
<div class="row mx-0">
  <div class="col-sm-12 col-md-12 col-xl-{{$Map[0]}} p-0 text-center">
    <div class="card-content ">
      <div class=" card">
        <div class="card-body explore_card adventure_mind justify-content-evenly">
          <div class="header_info">
            <h5>HAVE AN ADVENTURE
              IN MIND?</h5>
           <p>
            Dummy text ever since the 1500s,
              when an unknown printer took.
              A galley of type and scrambled it to make.
           </p>
          <div class="start">
            <span></span>
            <h6>start from</h6>
            <span></span>
          </div>
            <span>699 L.E</span>
            <button class="btn">
              <a href="#"> start trip</a>
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
            <div class="card-content">
              <div class=" card">
                <div class="card-body offers_card offer_place_1" style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/offers') }}/{{ $Offer->image }});">
                  <div class="header_info">
                    <h5><a href="#" class="stretched-link">{{$Offer->city->en_city ?? ""}}</a>
                    </h5>
                    <span>{{$Offer->subtitle_en}}
                    </span>
                    <span>
                      220 L.E
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
