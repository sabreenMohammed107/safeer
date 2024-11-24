@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Our Agents'])

@section('adds_css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
@endsection

@section('bottom-header')
<x-website.header.general title="Agents" :breadcrumb="$BreadCrumb" current="" />
@endsection
@section('content')
<!-- explore turkey -->
<section class="investigtion">
    <div class="chosing container">
        <div class="choosing_title">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            <h5>Be Our Agent</h5>
            <p class="px-5">
                Join the Tourism Agents Program at Safar Tourism Company
            </p>
            @else
            <h5>كن وكيلنا</h5>
            <p class="px-5">
                انضم إلى برنامج الوكلاء السياحيين في شركة سافر السياحية </p>
            @endif

        </div>

    </div>
    <div class="adventure container">
        <div class="row mx-0">
            <div class=" col-xl-5 col- md-5 col-sm-12">
                <img src="{{ asset("website_assets/images/homePage/$Company->image") }}" alt="why us image">
            </div>

            <div class=" col-xl-7 col- md-7 col-sm-12">
                <div class="adventure_info">
                    <div class="heading">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        <h2>
                            Safer Agents Program
                        </h2>
                        <p>
                            Safer Agent Program is an innovative and exclusive platform dedicated to global travel and
                            tourism agencies and travel professionals. The program allows you to benefit from the
                            booking services of your customers and achieve financial gains through your partnership with
                            Safar. We offer you the possibility of booking hotels, airline tickets, and tourist programs
                            at competitive prices, enabling you to offer attractive offers and integrated tourism
                            products remotely, with continuous support from a professional and specialized team.

                        </p>
                        @else
                        <h2>
                            برنامج الوكلاء سافر

                        </h2>
                        <p>
                            يُعتبر برنامج الوكلاء سافر منصة مبتكرة وحصرية مخصصة لوكالات السياحة والسفر العالمية ومحترفي
                            السفر. يتيح لك البرنامج الاستفادة من خدمات الحجز لعملائك وتحقيق مكاسب مالية من خلال شراكتك
                            مع شركة سافر. نحن نقدم لك إمكانية حجز فنادق، تذاكر طيران، وبرامج سياحية بأسعار تنافسية، مما
                            يمكّنك من تقديم عروض جذابة ومنتجات سياحية متكاملة عن بُعد، مع دعم مستمر من فريق محترف
                            ومتخصص.

                        </p>
                        @endif

                        {{-- <div class="read">
                            <a href="#">Read more
                                <i class="fa-solid fa-angle-right"></i>
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
        <img src="{{ asset('website_assets/images/homePage/birds (2).webp') }}" alt="birds image">
    </div>
</section>

<section class="investigtion">
    <div class="chosing container">
        <div class="choosing_title text-center">
            <div class="row mx-0">
                <div class="col-sm-12">
                    <div class="left  text-center">
                        <div class="obj_title justify-content-center">

                            <img class="vission_img"
                                src="{{ asset('website_assets/images/about/objectives/target.webp') }}"
                                alt="target icon">
                            <h6 class=" text-center"> @if (LaravelLocalization::getCurrentLocale() === 'en')

                                Vision
                                @else

                                رؤيتنا
                                @endif</h6>
                        </div>
                        <p>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                            At Safar, we seek to build strategic partnerships with tourism agencies and travel
                            professionals by
                            providing high-quality tourism services that meet the needs of Arab tourists. We believe in
                            the
                            importance of providing an outstanding travel experience, while preserving the cultural
                            values and
                            privacy that the Arab community cherishes.


                            @else
                            نسعى في شركة سافر لبناء شراكات استراتيجية مع الوكالات السياحية ومحترفي السفر من خلال تقديم
                            خدمات
                            سياحية عالية الجودة تلبي احتياجات السائح العربي. نحن نؤمن بأهمية تقديم تجربة سفر متميزة، مع
                            الحفاظ
                            على القيم الثقافية والخصوصية التي يعتز بها المجتمع العربي.

                            @endif

                        </p>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>

<section class="investigtion">
    <div class="chosing container">
        <div class="choosing_title text-center">
            @if (LaravelLocalization::getCurrentLocale() === 'en')

            <h5>Be Our Agent</h5>
            <p class="px-5">
                Join the Tourism Agents Program at Safar Tourism Company
            </p>
            @else
            <h5>كن وكيلنا</h5>
            <p class="px-5">
                انضم إلى برنامج الوكلاء السياحيين في شركة سافر السياحية </p>
            @endif

        </div>

    </div>
    <div class="adventure container">
        <div class="row mx-0">
            <div class=" col-xl-5 col- md-5 col-sm-12">
                <img src="{{ asset("website_assets/images/homePage/$Company->image") }}" alt="why us image">
            </div>

            <div class=" col-xl-7 col- md-7 col-sm-12">
                <div class="adventure_info">
                    <div class="heading">
                        @if (LaravelLocalization::getCurrentLocale() === 'en')

                        <h2>
                            Benefits of joining the Safar Agents Program:
                        </h2>
                        <p>
                            1. Distinctive tourism returns: You can achieve the highest percentage of tourism returns
                            thanks to the competitive prices we offer.
                            <br>

                            2. Diversity of accommodation options: We provide you with a wide range of distinctive
                            hotels, allowing you to offer multiple options to your customers at the best prices.
                            <br>

                            3. Exclusive discounts: Guaranteeing the highest level of discounts on tourism programs,
                            making it easier for you to compete in the market.
                            <br>

                            4. Renewable tourism programs: We offer a variety of tourism programs that suit tourist
                            seasons, holidays and official holidays, giving you the flexibility to present offers to
                            your customers.
                            <br>

                            5. Continuous professional support: You will receive advice and guidance from our
                            specialized team, which contributes to enhancing your planning expertise and increasing
                            productivity and operational efficiency.
                            <br>

                            6. Training and workshops: We provide periodic workshops and specialized training to ensure
                            the development of your skills and knowledge in the field of tourism, which raises the level
                            of your services.
                            <br>

                            Join the Safer Tourism Agency Program via the following link:
                            https://bit.ly/SaferOfficialPartners
                            and start your journey towards achieving success in the world of tourism through our strong
                            partnership! We welcome you to our family and promise you an exceptional work experience
                            that will allow you to excel in this dynamic field.

                        </p>
                        @else
                        <h2>
                            مزايا الانضمام إلى برنامج الوكلاء سافر:

                        </h2>
                        <p>
                            1. عوائد سياحية متميزة: يمكنك تحقيق أعلى نسبة من العوائد السياحية بفضل الأسعار التنافسية
                            التي نقدمها.
                            <br>
                            2. تنوع خيارات الإقامة: نوفر لك مجموعة واسعة من الفنادق المميزة، مما يتيح لك تقديم خيارات
                            متعددة لعملائك بأفضل الأسعار.
                            <br>

                            3. تخفيضات حصرية: ضمان الحصول على أقصى مستوى من التخفيضات على البرامج السياحية، مما يسهل
                            عليك المنافسة في السوق.
                            <br>

                            4. برامج سياحية متجددة: نقدم مجموعة متنوعة من البرامج السياحية التي تتناسب مع المواسم
                            السياحية والإجازات والعطل الرسمية، مما يمنحك المرونة في تقديم العروض لعملائك.
                            <br>

                            5. دعم احترافي مستمر: ستحصل على نصائح وتوجيهات من فريقنا المتخصص، مما يسهم في تعزيز خبراتك
                            في التخطيط وزيادة الإنتاجية وكفاءة العمليات.
                            <br>

                            6. تدريب وورش عمل: نقدم ورش عمل دورية وتدريبات متخصصة لضمان تطوير مهاراتك ومعرفتك في مجال
                            السياحة، مما يرفع من مستوى خدماتك.
                            <br>

                            انضم إلى برنامج الوكلاء السياحيين في شركة سافر للسياحة عبر الرابط التالي:
                            https://bit.ly/SaferOfficialPartners
                            وابدأ رحلتك نحو تحقيق النجاح في عالم السياحة من خلال شراكتنا القوية! نرحب بك في عائلتنا
                            ونعدك بتجربة عمل استثنائية تتيح لك التميز في هذا المجال الديناميكي.

                        </p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <img src="{{ asset('website_assets/images/homePage/birds (2).webp') }}" alt="birds image">
    </div>
</section>
<!--  ending page  -->

<style>
    .benefits_info img {
        max-width: 95px !important;
    }
</style>
@endsection
