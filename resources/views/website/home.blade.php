@extends("layout.website.layout", ["Company" => $Company,"title"=>"Safer | Home"])

@section("bottom-header")
<x-website.header.home :company="$Company" :countries="$Countries" :cities="$cities" />
@endsection
@section("content")
<!-- explore turkey -->
{{-- <livewire:explore-section lazy /> --}}
<section class="investigtion">
    <div class="explore explore_position container">
        @if (LaravelLocalization::getCurrentLocale() === 'en')
        <div class="row mx-0 explore_details">
            <div class=" col-xl-2 col-md-12 col-sm-12">
                <div class="title">
                    <div class="info">
                        <h4>{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
                    </div>
                </div>
            </div>
            <div class=" col-xl-10 col-md-12 col-sm-12">
                <section class="explore_carsoul owl-carousel">
                    @foreach ($ExploreCities as $City)
                    <div class="card-content">
                        <div class=" card explore_main">
                            {{-- <div class="card-body explore_card"
                                style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("
                                /website_assets/images/homePage/places/$City->image")}});"> --}}

                                <div class="card-body explore_card"
                                    style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                                    <div class="header_info">
                                        <h5>
                                            <a href="#">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                {{$City->city->en_city}}
                                                @else
                                                {{$City->city->ar_city}}
                                                @endif

                                            </a>
                                        </h5>
                                        <span>
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')

                                            {{$City->subtitle_en}}
                                            @else
                                            {{$City->subtitle_ar}}
                                            @endif
                                        </span>
                                        <div class="explore_links">
                                            <button class="btn ">
                                                <a
                                                    href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id))}}">
                                                    <i class="fa-solid fa-hotel"></i>
                                                </a>
                                            </button>
                                            <button class="btn ">
                                                <a
                                                    href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id))}}">
                                                    <i class="fa-solid fa-plane"></i>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach


                </section>
            </div>
            @else
            <div class="row mx-0 explore_details ">

                <div class=" col-xl-10 col-md-12 col-sm-12">
                    <section class="explore_carsoul owl-carousel">
                        @foreach ($ExploreCities as $City)
                        <div class="card-content">
                            <div class=" card explore_main">
                                {{-- <div class="card-body explore_card"
                                    style="background-image: linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{asset("
                                    /website_assets/images/homePage/places/$City->image")}});"> --}}

                                    <div class="card-body explore_card"
                                        style="background-image:linear-gradient(hsla(0, 0%, 0%, 0.3),hsla(0, 0%, 0%, 0.3)) , url({{ asset('uploads/explore') }}/{{ $City->image }});">

                                        <div class="header_info">
                                            <h5>
                                                <a href="#">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                    {{$City->city->en_city}}
                                                    @else
                                                    {{$City->city->ar_city}}
                                                    @endif

                                                </a>
                                            </h5>
                                            <span>
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                                {{$City->subtitle_en}}
                                                @else
                                                {{$City->subtitle_ar}}
                                                @endif
                                            </span>
                                            <div class="explore_links">
                                                <button class="btn ">
                                                    <a
                                                        href="{{ LaravelLocalization::getLocalizedURL($localVar, route('hotelByCity', $City->city->id))}}">
                                                        <i class="fa-solid fa-hotel"></i>
                                                    </a>
                                                </button>
                                                <button class="btn ">
                                                    <a
                                                        href="{{ LaravelLocalization::getLocalizedURL($localVar, route('tourByCity', $City->city->id))}}">
                                                        <i class="fa-solid fa-plane"></i>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                    </section>
                </div>

                <div class=" col-xl-2 col-md-12 col-sm-12">
                    <div class="title">
                        <div class="info">
                            <h4>{{ __('links.explore') }} <br>{{ __('links.turkey') }} </h4>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="adventure container">
                <div class="row mx-0">
                    <div class=" col-xl-5 col- md-5 col-sm-12">
                        <img loading="lazy" src="{{ asset("/website_assets/images/homePage/$Company->image") }}"
                        alt="why us image">
                    </div>

                    <div class=" col-xl-7 col- md-7 col-sm-12">
                        <div class="adventure_info">
                            <div class="heading">
                                @if (LaravelLocalization::getCurrentLocale() === 'en')

                                <h2>
                                    {{$Company->oveview_entitle}} <br>
                                    {{$Company->overview_ensubtitle}}
                                </h2>
                                @else
                                <h2>
                                    {{$Company->oveview_artitle}} <br>
                                    {{$Company->overview_arsubtitle}}
                                </h2>
                                @endif

                                <p>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')

                                    {{$Company->overview_en}}
                                    @else
                                    {{$Company->overview_ar}}
                                    @endif

                                </p>
                                <div class="read">
                                    <a href="{{ LaravelLocalization::localizeUrl('/about') }}"> {{
                                        __('links.readMore')
                                        }}
                                        <i class="fa-solid fa-angle-right"></i>
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <img loading="lazy" src="{{ asset('/website_assets/images/homePage/birds (2).webp') }}"
                    alt="birds image">
            </div>
            <!-- <img src="./images/homePage/birds.webp" alt="birds group"> -->
</section>

<div class="lazy-section" data-url="{{ route('load.section', ['name' => 'limit']) }}"></div>
@endsection

@section('adds_js')
<script>
    $(document).ready(function() {


$('.dynamic').change(function() {

    if ($(this).val() != '') {
        var select = $(this).attr("id");
        var value = $(this).val();


        $.ajax({
            url: "{{route('dynamicSearchCity.fetch')}}",
            method: "get",
            data: {
                select: select,
                value: value,

            },
            success: function(result) {

                $('#city_id').html(result);
            }

        })
    }
});
    });


    function getNumberOfDays(start, end) {
    const date1 = new Date(start);
    const date2 = new Date(end);

    // One day in milliseconds
    const oneDay = 1000 * 60 * 60 * 24;

    // Calculating the time difference between two dates
    const diffInTime = date2.getTime() - date1.getTime();

    // Calculating the no. of days between two dates
    const diffInDays = Math.round(diffInTime / oneDay);
$('#nights').val(diffInDays);
    return diffInDays;
}
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.lazy-section');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadSection(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });

    sections.forEach(section => {
        observer.observe(section);
    });

    function loadSection(section) {
        const url = section.dataset.url;
        fetch(url)
            .then(response => response.text())
            .then(html => {
                section.innerHTML = html;
            });
    }
});
</script>
@endsection
