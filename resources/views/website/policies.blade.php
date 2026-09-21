@extends('layout.website.layout', ['Company' => $Company, 'title' => 'Safer | ' . __('links.policies')])

@section('adds_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/website_assets/css/about.css') }}">
    <style>
        .container__content h2 {
            font-size: calc(1.065rem + .12vw);
        }

        .policy-nav {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin: 1.5rem 0 0;
            padding: 0;
            list-style: none;
        }

        .policy-nav a {
            display: inline-block;
            padding: .5rem 1.1rem;
            border-radius: 30px;
            background: #f4f4f6;
            color: #1b224c;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s ease, color .2s ease;
        }

        .policy-nav a:hover,
        .policy-nav a.active {
            background: #1b224c;
            color: #fff;
        }

        .policy-section {
            scroll-margin-top: 110px;
        }

        .policy-section :where(p, li) {
            text-align: justify;
        }

        @media (max-width: 576px) {
            .policy-nav a {
                padding: .4rem .85rem;
                font-size: .85rem;
            }
        }
    </style>
@endsection

@section('bottom-header')
    <x-website.header.general title="{{ __('links.policies') }}" :breadcrumb="$BreadCrumb" current="" />
@endsection

@section('content')
    <section class="investigtion">
        <section class="container">
            <div class="container__content">

                @if (count($sections))
                    <ul class="policy-nav">
                        @foreach ($sections as $section)
                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/policies/' . $section['slug']) }}#{{ $section['slug'] }}"
                                    class="{{ $activeSlug === $section['slug'] ? 'active' : '' }}">
                                    {{ $section['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    @foreach ($sections as $section)
                        <div class="mt-5 policy-section" id="{{ $section['slug'] }}">
                            <h2 class="d-flex align-items-center line-height-normal mb-4 pb-2"
                                style="border-bottom:1px solid #ddd">
                                <i class="fa-solid fa-circle-arrow-right px-2"></i> <span>{{ $section['title'] }}</span>
                            </h2>
                            <div class="px-2">{!! $section['html'] !!}</div>
                        </div>
                    @endforeach
                @endif

            </div>
        </section>
    </section>
@endsection
