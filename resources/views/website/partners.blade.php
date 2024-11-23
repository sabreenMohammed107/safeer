@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Contact Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contacts-1.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.become_agent') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
    <!-- Social channels -->
    <section class="socail_channels container">

        <!-- Heading -->
        <h5>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Join the Travel Agents Program at Safer Tourism Company
            @else
                انضم إلى برنامج الوكلاء السياحيين في شركة سافر السياحية
            @endif
        </h5>

        <!-- Paragraph for Program Details -->
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                The Safer Travel Agents Program is an innovative and exclusive platform designed for global travel agencies and travel professionals. This program allows you to benefit from booking services for your clients and earn financial gains through your partnership with Safer. We provide the ability to book hotels, flights, and travel packages at competitive prices, enabling you to offer attractive deals and comprehensive travel products remotely, with continuous support from a professional and specialized team.
            @else
                يُعتبر برنامج الوكلاء سافر منصة مبتكرة وحصرية مخصصة لوكالات السياحة والسفر العالمية ومحترفي السفر. يتيح لك البرنامج الاستفادة من خدمات الحجز لعملائك وتحقيق مكاسب مالية من خلال شراكتك مع شركة سافر. نحن نقدم لك إمكانية حجز فنادق، تذاكر طيران، وبرامج سياحية بأسعار تنافسية، مما يمكّنك من تقديم عروض جذابة ومنتجات سياحية متكاملة عن بُعد، مع دعم مستمر من فريق محترف ومتخصص.
            @endif
        </p>

        <!-- Vision Section -->
        <h6>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Our Vision
            @else
                رؤيتنا
            @endif
        </h6>
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                At Safer, we aim to build strategic partnerships with travel agencies and travel professionals by offering high-quality travel services that meet the needs of the Arab traveler. We believe in the importance of providing an exceptional travel experience while maintaining the cultural values and privacy cherished by the Arab community.
            @else
                نسعى في شركة سافر لبناء شراكات استراتيجية مع الوكالات السياحية ومحترفي السفر من خلال تقديم خدمات سياحية عالية الجودة تلبي احتياجات السائح العربي. نحن نؤمن بأهمية تقديم تجربة سفر متميزة، مع الحفاظ على القيم الثقافية والخصوصية التي يعتز بها المجتمع العربي.
            @endif
        </p>

        <!-- Benefits Section -->
        <h6>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Benefits of Joining the Safer Travel Agents Program
            @else
                مزايا الانضمام إلى برنامج الوكلاء سافر
            @endif
        </h6>

        <ul>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                <li>Premium Tourism Returns: Achieve the highest tourism returns with our competitive pricing.</li>
                <li>Diverse Accommodation Options: A wide range of hotels available, offering multiple options for your clients at the best prices.</li>
                <li>Exclusive Discounts: Get the maximum level of discounts on travel packages, making it easier to compete in the market.</li>
                <li>Renewable Travel Programs: A variety of travel programs that match the travel seasons, holidays, and official vacations, giving you flexibility in offering packages to your clients.</li>
                <li>Continuous Professional Support: Receive advice and guidance from our specialized team, contributing to your planning expertise, productivity, and operational efficiency.</li>
                <li>Training and Workshops: Regular workshops and specialized training to enhance your skills and knowledge in the travel field, raising the level of your services.</li>
            @else
                <li>عوائد سياحية متميزة: يمكنك تحقيق أعلى نسبة من العوائد السياحية بفضل الأسعار التنافسية التي نقدمها.</li>
                <li>تنوع خيارات الإقامة: نوفر لك مجموعة واسعة من الفنادق المميزة، مما يتيح لك تقديم خيارات متعددة لعملائك بأفضل الأسعار.</li>
                <li>تخفيضات حصرية: ضمان الحصول على أقصى مستوى من التخفيضات على البرامج السياحية، مما يسهل عليك المنافسة في السوق.</li>
                <li>برامج سياحية متجددة: نقدم مجموعة متنوعة من البرامج السياحية التي تتناسب مع المواسم السياحية والإجازات والعطل الرسمية، مما يمنحك المرونة في تقديم العروض لعملائك.</li>
                <li>دعم احترافي مستمر: ستحصل على نصائح وتوجيهات من فريقنا المتخصص، مما يسهم في تعزيز خبراتك في التخطيط وزيادة الإنتاجية وكفاءة العمليات.</li>
                <li>تدريب وورش عمل: نقدم ورش عمل دورية وتدريبات متخصصة لضمان تطوير مهاراتك ومعرفتك في مجال السياحة، مما يرفع من مستوى خدماتك.</li>
            @endif
        </ul>

        <!-- Call to Action -->
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Join the Safer Tourism Agent Program today by clicking the link below and start your journey to success in the world of tourism through our strong partnership!
            @else
                انضم إلى برنامج الوكلاء السياحيين في شركة سافر للسياحة عبر الرابط التالي وابدأ رحلتك نحو تحقيق النجاح في عالم السياحة من خلال شراكتنا القوية!
            @endif
        </p>

        <a href="https://bit.ly/SaferOfficialPartners" target="_blank">
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Click here to join the program
            @else
                اضغط هنا للانضمام إلى البرنامج
            @endif
        </a>
    </section>
@endsection

@section('adds_js')
@endsection
