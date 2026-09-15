@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Careers'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/careers-agents.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.careers') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
    <section class="investigtion">
        <div class="chosing container">

            <!-- Heading / Introduction -->
            <div class="page-intro">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    <h5>Job Openings at Safer Tourism Company</h5>
                    <p>
                        Are you looking for an opportunity to join an exceptional team in the tourism sector? Do you
                        have a passion for travel and providing extraordinary experiences to customers? Then Safer
                        Tourism Company is the perfect place for you!
                    </p>
                @else
                    <h5>وظائف شاغرة في شركة سافر السياحية</h5>
                    <p>
                        هل تبحث عن فرصة للانضمام إلى فريق متميز في قطاع السياحة؟ هل لديك شغف بالسفر وتقديم تجارب
                        استثنائية للعملاء؟ إذاً، شركة سافر السياحية هي المكان المثالي لك!
                    </p>
                @endif
            </div>

            <!-- About Us -->
            <h6 class="section-heading">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    About Us
                @else
                    معلومات عنا
                @endif
            </h6>
            <p class="section-text">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Safer Tourism Company was established with the goal of providing exceptional travel services to
                    clients. We believe that every trip should be an unforgettable experience, which is why we
                    constantly strive to offer the best deals and services that exceed our customers' expectations.
                @else
                    تأسست شركة سافر السياحية بهدف تقديم خدمات سياحية متميزة للعملاء. نحن نؤمن بأن كل رحلة يجب أن تكون
                    تجربة لا تُنسى، ولذلك نسعى دائمًا لتقديم أفضل العروض والخدمات التي تتجاوز توقعات عملائنا.
                @endif
            </p>

            <!-- Why Join Us -->
            <h6 class="section-heading">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Why Join Us?
                @else
                    لماذا تنضم إلينا؟
                @endif
            </h6>

            <div class="benefits">
                <div class="row mx-0">
                    @php
                        $perks = [
                            [
                                'icon' => 'fa-lightbulb',
                                'en_title' => 'Stimulating Work Environment',
                                'en_text' => 'We work in an environment that encourages innovation and creativity, where you can express your ideas and contribute to improving our services.',
                                'ar_title' => 'بيئة عمل محفزة',
                                'ar_text' => 'نحن نعمل في بيئة تشجع على الابتكار والإبداع، حيث يمكنك أن تعبر عن أفكارك وتساهم في تحسين خدماتنا.',
                            ],
                            [
                                'icon' => 'fa-graduation-cap',
                                'en_title' => 'Professional Development',
                                'en_text' => 'We believe in the importance of developing our employees\' skills, and we offer training programs and educational courses to help you achieve your career goals.',
                                'ar_title' => 'فرص تطوير مهني',
                                'ar_text' => 'نؤمن بأهمية تطوير مهارات موظفينا، ونوفر برامج تدريبية ودورات تعليمية تساعدك في تحقيق أهدافك المهنية.',
                            ],
                            [
                                'icon' => 'fa-plane',
                                'en_title' => 'Travel Opportunities',
                                'en_text' => 'Join us and enjoy travel opportunities and discovering new destinations as part of your work.',
                                'ar_title' => 'فرصة للسفر ضمن العمل',
                                'ar_text' => 'انضم إلينا واستمتع بفرص السفر والتعرف على وجهات جديدة كجزء من عملك.',
                            ],
                            [
                                'icon' => 'fa-money-bill-wave',
                                'en_title' => 'Good Salary with Commissions',
                                'en_text' => 'We offer competitive salaries along with attractive commissions, ensuring a rewarding financial return.',
                                'ar_title' => 'راتب جيد مع عمولات',
                                'ar_text' => 'نقدم رواتب تنافسية بالإضافة إلى عمولات مغرية، مما يضمن لك عائدًا ماديًا مجزيًا.',
                            ],
                            [
                                'icon' => 'fa-shield-alt',
                                'en_title' => 'Stable Job, Renowned Company',
                                'en_text' => 'We consider Safer Tourism Company to be one of the leading companies in the market, offering job stability and over 15 years of experience in the field.',
                                'ar_title' => 'وظيفة ثابتة في مكان مرموق',
                                'ar_text' => 'نحن نعتبر شركة سافر واحدة من الشركات الرائدة في السوق، مما يوفر لك استقرارًا وظيفيًا وخبرة تمتد لأكثر من 15 سنة في هذا المجال.',
                            ],
                        ];
                    @endphp

                    @foreach ($perks as $perk)
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

            <!-- How to Apply / Call to Action -->
            <div class="cta-banner">
                <div class="cta-banner__text">
                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                        <h4>How to Apply?</h4>
                        <p>
                            If you are excited to join the Safer team, submit your details through our application
                            form. We welcome all applicants and look forward to adding new members to our team!
                        </p>
                    @else
                        <h4>كيف تتقدم؟</h4>
                        <p>
                            إذا كنت متحمسًا للانضمام إلى فريق سافر، قدّم بياناتك من خلال استمارة التقديم الخاصة بنا.
                            نحن نرحب بجميع المتقدمين ونتطلع إلى إضافة أعضاء جدد لفريقنا!
                        </p>
                    @endif
                </div>
                <a class="cta-btn"
                    href="https://docs.google.com/forms/d/e/1FAIpQLSewJw1uH46dxMVV5l65UIWduhhDVcADDqH1_Qhunfd33dWIpQ/viewform"
                    target="_blank" rel="noopener noreferrer">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    {{ __('links.applyNow') }}
                </a>
            </div>

            <p class="closing-note">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Join Safer Tourism Company, where we work together to create exceptional travel experiences and
                    make travelers' dreams come true!
                @else
                    انضم إلى شركة سافر السياحية، حيث نعمل معًا لنخلق تجارب سفر استثنائية ونحقق أحلام المسافرين!
                @endif
            </p>
        </div>
    </section>
@endsection

@section('adds_js')
@endsection
