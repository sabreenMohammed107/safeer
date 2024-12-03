@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | Contact Us'])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/contacts-1.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.careers') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
    <!-- Social channels -->
    <section class="socail_channels container">

        <!-- Heading -->
        <h5>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Job Openings at Safer Tourism Company
            @else
                وظائف شاغرة في شركة سافر السياحية
            @endif
        </h5>

        <!-- Introduction -->
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Are you looking for an opportunity to join an exceptional team in the tourism sector? Do you have a passion for travel and providing extraordinary experiences to customers? Then Safer Tourism Company is the perfect place for you!
            @else
                هل تبحث عن فرصة للانضمام إلى فريق متميز في قطاع السياحة؟ هل لديك شغف بالسفر وتقديم تجارب استثنائية للعملاء؟ إذاً، شركة سافر السياحية هي المكان المثالي لك!
            @endif
        </p>

        <!-- About Us -->
        <h6>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                About Us
            @else
                معلومات عنا
            @endif
        </h6>
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Safer Tourism Company was established with the goal of providing exceptional travel services to clients. We believe that every trip should be an unforgettable experience, which is why we constantly strive to offer the best deals and services that exceed our customers' expectations.
            @else
                تأسست شركة سافر السياحية بهدف تقديم خدمات سياحية متميزة للعملاء. نحن نؤمن بأن كل رحلة يجب أن تكون تجربة لا تُنسى، ولذلك نسعى دائمًا لتقديم أفضل العروض والخدمات التي تتجاوز توقعات عملائنا.
            @endif
        </p>

        <!-- Why Join Us -->
        <h6>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Why Join Us?
            @else
                لماذا تنضم إلينا؟
            @endif
        </h6>
        <ul>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                <li>Stimulating Work Environment: We work in an environment that encourages innovation and creativity, where you can express your ideas and contribute to improving our services.</li>
                <li>Professional Development Opportunities: We believe in the importance of developing our employees' skills, and we offer training programs and educational courses to help you achieve your career goals.</li>
                <li>Travel Opportunities: Join us and enjoy travel opportunities and discovering new destinations as part of your work.</li>
                <li>Good Salary with Commissions: We offer competitive salaries along with attractive commissions, ensuring a rewarding financial return.</li>
                <li>Stable Job at a Renowned Company: We consider Safer Tourism Company to be one of the leading companies in the market, offering job stability and over 15 years of experience in the field.</li>
            @else
                <li>بيئة عمل محفزة: نحن نعمل في بيئة تشجع على الابتكار والإبداع، حيث يمكنك أن تعبر عن أفكارك وتساهم في تحسين خدماتنا.</li>
                <li>فرص تطوير مهني: نؤمن بأهمية تطوير مهارات موظفينا، ونوفر برامج تدريبية ودورات تعليمية تساعدك في تحقيق أهدافك المهنية.</li>
                <li>فرصة للسفر ضمن العمل: انضم إلينا واستمتع بفرص السفر والتعرف على وجهات جديدة كجزء من عملك.</li>
                <li>راتب جيد مع عمولات: نقدم رواتب تنافسية بالإضافة إلى عمولات مغرية، مما يضمن لك عائدًا ماديًا مجزيًا.</li>
                <li>وظيفة ثابتة في مكان مرموق: نحن نعتبر شركة سافر واحدة من الشركات الرائدة في السوق، مما يوفر لك استقرارًا وظيفيًا وخبرة تمتد لأكثر من 15 سنة في هذا المجال.</li>
            @endif
        </ul>

        <!-- How to Apply -->
        <h6>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                How to Apply?
            @else
                كيف تتقدم؟
            @endif
        </h6>
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                If you are excited to join the Safer team, please submit your details here: https://bit.ly/SaferJobs. We welcome all applicants and look forward to adding new members to our team!
            @else
                إذا كنت متحمسًا للانضمام إلى فريق سافر، يرجى كتابة كل بياناتك هنا https://bit.ly/SaferJobs. نحن نرحب بجميع المتقدمين ونتطلع إلى إضافة أعضاء جدد لفريقنا!
            @endif
        </p>

        <!-- Call to Action -->
        <p>
            @if (LaravelLocalization::getCurrentLocale() === 'en')
                Join Safer Tourism Company, where we work together to create exceptional travel experiences and make travelers' dreams come true!
            @else
                انضم إلى شركة سافر السياحية، حيث نعمل معًا لنخلق تجارب سفر استثنائية ونحقق أحلام المسافرين!
            @endif
        </p>

    </section>
@endsection

@section('adds_js')
@endsection
