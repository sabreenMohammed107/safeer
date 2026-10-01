@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | ' . __('links.team')])

@section('adds_css')
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/team.css') }}">
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.team') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
    <section class="team_page container">

        @if ($FeaturedTeam->count() || $GeneralTeam->count())
            <div class="team_layout {{ $FeaturedTeam->count() ? '' : 'team_layout--single' }}">

                @if ($FeaturedTeam->count())
                    <div class="team_featured_col">
                        <div class="team_featured_sticky">
                            @foreach ($FeaturedTeam as $member)
                                <div class="team_featured_card">
                                    <div class="team_featured_photo">
                                        <img src="{{ asset('uploads/teams') }}/{{ $member->image }}"
                                            alt="{{ LaravelLocalization::getCurrentLocale() === 'en' ? $member->en_name : $member->ar_name }}"
                                            loading="lazy" onerror="this.style.display='none';this.parentNode.classList.add('is-missing')">
                                    </div>
                                    <div class="team_featured_info">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            <h3>{{ $member->en_name }}</h3>
                                            @if ($member->en_job)
                                                <span class="team_job">{{ $member->en_job }}</span>
                                            @endif
                                            @if ($member->en_description)
                                                <p>{{ $member->en_description }}</p>
                                            @endif
                                        @else
                                            <h3>{{ $member->ar_name }}</h3>
                                            @if ($member->ar_job)
                                                <span class="team_job">{{ $member->ar_job }}</span>
                                            @endif
                                            @if ($member->ar_description)
                                                <p>{{ $member->ar_description }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($GeneralTeam->count())
                    <div class="team_general_col">
                        <div class="section_heading">
                            <h4>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    Meet Our Team
                                @else
                                    تعرف على أعضاء فريقنا
                                @endif
                            </h4>
                        </div>

                        <div class="team_grid">
                            @foreach ($GeneralTeam as $member)
                                <div class="team_card">
                                    <div class="team_card_photo">
                                        <img src="{{ asset('uploads/teams') }}/{{ $member->image }}"
                                            alt="{{ LaravelLocalization::getCurrentLocale() === 'en' ? $member->en_name : $member->ar_name }}"
                                            loading="lazy" onerror="this.style.visibility='hidden'">
                                    </div>
                                    <div class="team_card_body">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            <h6>{{ $member->en_name }}</h6>
                                            @if ($member->en_job)
                                                <span>{{ $member->en_job }}</span>
                                            @endif
                                        @else
                                            <h6>{{ $member->ar_name }}</h6>
                                            @if ($member->ar_job)
                                                <span>{{ $member->ar_job }}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        @else
            <div class="team_empty">
                @if (LaravelLocalization::getCurrentLocale() === 'en')
                    Our team page is being updated. Please check back soon.
                @else
                    يتم تحديث صفحة الفريق حاليًا، يرجى المحاولة لاحقًا.
                @endif
            </div>
        @endif

    </section>
@endsection
