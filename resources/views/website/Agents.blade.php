@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Our Agents'])

@section('adds_css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
<link rel="stylesheet" href="{{ asset('/website_assets/css/careers-agents.css') }}">
@endsection

@section('bottom-header')
<x-website.header.general title="{{ __('links.agents') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
{{-- Single flowing section, same skeleton as careers.blade.php:
     hero intro -> text section -> text section -> perk cards -> CTA banner -> closing note.
     "agents-page" scopes the gold/partner accent for the benefit cards in
     careers-agents.css, so Careers keeps its own blue accent untouched. --}}
<section class="investigtion agents-page">
    <div class="chosing container">

        <!-- Heading / Introduction -->
        <div class="page-intro">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                <h5>Be Our Agent</h5>
                <p>Join the Tourism Agents Program at Safer Tourism Company</p>
            @else
                <h5>كن وكيلنا</h5>
                <p>انضم إلى برنامج الوكلاء السياحيين في شركة سافر السياحية</p>
            @endif
        </div>

        <!-- Program Overview -->
        <h6 class="section-heading">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Safer Agents Program
            @else
                برنامج الوكلاء سافر
            @endif
        </h6>
        <p class="section-text">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Safer Agent Program is an innovative and exclusive platform dedicated to global travel and tourism
                agencies and travel professionals. The program allows you to benefit from the booking services of
                your customers and achieve financial gains through your partnership with Safer. We offer you the
                possibility of booking hotels, airline tickets, and tourist programs at competitive prices, enabling
                you to offer attractive offers and integrated tourism products remotely, with continuous support
                from a professional and specialized team.
            @else
                يُعتبر برنامج الوكلاء سافر منصة مبتكرة وحصرية مخصصة لوكالات السياحة والسفر العالمية ومحترفي السفر.
                يتيح لك البرنامج الاستفادة من خدمات الحجز لعملائك وتحقيق مكاسب مالية من خلال شراكتك مع شركة سافر. نحن
                نقدم لك إمكانية حجز فنادق، تذاكر طيران، وبرامج سياحية بأسعار تنافسية، مما يمكّنك من تقديم عروض جذابة
                ومنتجات سياحية متكاملة عن بُعد، مع دعم مستمر من فريق محترف ومتخصص.
            @endif
        </p>

        <!-- Vision -->
        <h6 class="section-heading">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Our Vision
            @else
                رؤيتنا
            @endif
        </h6>
        <p class="section-text">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                At Safer, we seek to build strategic partnerships with tourism agencies and travel professionals by
                providing high-quality tourism services that meet the needs of Arab tourists. We believe in the
                importance of providing an outstanding travel experience, while preserving the cultural values and
                privacy that the Arab community cherishes.
            @else
                نسعى في شركة سافر لبناء شراكات استراتيجية مع الوكالات السياحية ومحترفي السفر من خلال تقديم خدمات
                سياحية عالية الجودة تلبي احتياجات السائح العربي. نحن نؤمن بأهمية تقديم تجربة سفر متميزة، مع الحفاظ على
                القيم الثقافية والخصوصية التي يعتز بها المجتمع العربي.
            @endif
        </p>

        <!-- Benefits -->
        <h6 class="section-heading">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Benefits of Joining the Safer Agents Program
            @else
                مزايا الانضمام إلى برنامج الوكلاء سافر
            @endif
        </h6>

        <div class="benefits">
            <div class="row mx-0">
                @php
                    $agentPerks = [
                        [
                            'icon' => 'fa-chart-line',
                            'en_title' => 'Distinctive Tourism Returns',
                            'en_text' => 'Achieve the highest percentage of tourism returns thanks to the competitive prices we offer.',
                            'ar_title' => 'عوائد سياحية متميزة',
                            'ar_text' => 'يمكنك تحقيق أعلى نسبة من العوائد السياحية بفضل الأسعار التنافسية التي نقدمها.',
                        ],
                        [
                            'icon' => 'fa-hotel',
                            'en_title' => 'Diverse Accommodation Options',
                            'en_text' => 'A wide range of distinctive hotels, allowing you to offer multiple options to your customers at the best prices.',
                            'ar_title' => 'تنوع خيارات الإقامة',
                            'ar_text' => 'نوفر لك مجموعة واسعة من الفنادق المميزة، مما يتيح لك تقديم خيارات متعددة لعملائك بأفضل الأسعار.',
                        ],
                        [
                            'icon' => 'fa-percent',
                            'en_title' => 'Exclusive Discounts',
                            'en_text' => 'The highest level of discounts on tourism programs, making it easier for you to compete in the market.',
                            'ar_title' => 'تخفيضات حصرية',
                            'ar_text' => 'ضمان الحصول على أقصى مستوى من التخفيضات على البرامج السياحية، مما يسهل عليك المنافسة في السوق.',
                        ],
                        [
                            'icon' => 'fa-calendar-days',
                            'en_title' => 'Renewable Tourism Programs',
                            'en_text' => 'A variety of tourism programs that suit tourist seasons, holidays and official holidays.',
                            'ar_title' => 'برامج سياحية متجددة',
                            'ar_text' => 'نقدم مجموعة متنوعة من البرامج السياحية التي تتناسب مع المواسم السياحية والإجازات والعطل الرسمية.',
                        ],
                        [
                            'icon' => 'fa-headset',
                            'en_title' => 'Continuous Professional Support',
                            'en_text' => 'Advice and guidance from our specialized team, enhancing your planning expertise and operational efficiency.',
                            'ar_title' => 'دعم احترافي مستمر',
                            'ar_text' => 'ستحصل على نصائح وتوجيهات من فريقنا المتخصص، مما يسهم في تعزيز خبراتك في التخطيط وزيادة الإنتاجية وكفاءة العمليات.',
                        ],
                        [
                            'icon' => 'fa-chalkboard-user',
                            'en_title' => 'Training & Workshops',
                            'en_text' => 'Periodic workshops and specialized training to develop your skills and knowledge in the field of tourism.',
                            'ar_title' => 'تدريب وورش عمل',
                            'ar_text' => 'نقدم ورش عمل دورية وتدريبات متخصصة لضمان تطوير مهاراتك ومعرفتك في مجال السياحة، مما يرفع من مستوى خدماتك.',
                        ],
                    ];
                @endphp

                @foreach ($agentPerks as $perk)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="benefits_info">
                            <div class="perk-icon"><i class="fa-solid {{ $perk['icon'] }}"></i></div>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                <h6>{{ $perk['en_title'] }}</h6>
                                <p>{{ $perk['en_text'] }}</p>
                            @else
                                <h6>{{ $perk['ar_title'] }}</h6>
                                <p>{{ $perk['ar_text'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-banner">
            <div class="cta-banner__text">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    <h4>Join the Safer Agents Program</h4>
                    <p>
                        Start your journey towards success in the world of tourism through our strong partnership!
                        We welcome you to our family and promise you an exceptional work experience.
                    </p>
                @else
                    <h4>انضم إلى برنامج الوكلاء سافر</h4>
                    <p>
                        وابدأ رحلتك نحو تحقيق النجاح في عالم السياحة من خلال شراكتنا القوية! نرحب بك في عائلتنا ونعدك
                        بتجربة عمل استثنائية تتيح لك التميز في هذا المجال الديناميكي.
                    </p>
                @endif
            </div>
            <a class="cta-btn" href="https://bit.ly/SaferOfficialPartners" target="_blank" rel="noopener noreferrer">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                {{ __('links.joinNow') }}
            </a>
        </div>

        <p class="closing-note">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Welcome to the Safer family — where strong partnerships turn into exceptional journeys for travelers
                everywhere!
            @else
                نرحب بك في عائلة سافر، حيث تتحوّل الشراكات القوية إلى رحلات استثنائية للمسافرين في كل مكان!
            @endif
        </p>
    </div>
</section>
@endsection
