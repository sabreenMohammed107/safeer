<!--begin::Aside-->
<div id="kt_aside" class="aside aside-default aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto pt-9 pb-5" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="#">
            <img alt="Logo" src="{{ asset('img/logo.jpg') }}" class="max-h-50px logo-default "
                style="height: 120px" />
            <img alt="Logo" src="{{ asset('img/logo.jpg') }}" class="max-h-50px logo-minimize "
                style="height: 120px" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <!--begin::Menu-->
        <div class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 my-5 mt-lg-2 mb-lg-0"
            id="kt_aside_menu" data-kt-menu="true">
            <div class="menu-fit hover-scroll-y me-lg-n5 pe-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">
                <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="black" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="black" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="black" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboards</span>
                        <span class="menu-arrow"></span>
                    </span>
                    {{-- <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <div class="menu-item">
                                    <a class="menu-link active" href="../dist/index.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Multipurpose</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="../dist/dashboards/store-analytics.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Store Analytics</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="../dist/dashboards/logistics.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Logistics</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" href="../dist/dashboards/projects.html">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Projects</span>
                                    </a>
                                </div>
                            </div> --}}
                </div>




                <div class="menu-item pt-5">
                    <div class="menu-content">
                        <span class="fw-bold text-muted text-uppercase fs-7">Settings</span>
                    </div>
                </div>
                <!-- start basics -->
                @if (Auth::user()->hasRole('admin'))

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen002.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M4.05424 15.1982C8.34524 7.76818 13.5782 3.26318 20.9282 2.01418C21.0729 1.98837 21.2216 1.99789 21.3618 2.04193C21.502 2.08597 21.6294 2.16323 21.7333 2.26712C21.8372 2.37101 21.9144 2.49846 21.9585 2.63863C22.0025 2.7788 22.012 2.92754 21.9862 3.07218C20.7372 10.4222 16.2322 15.6552 8.80224 19.9462L4.05424 15.1982ZM3.81924 17.3372L2.63324 20.4482C2.58427 20.5765 2.5735 20.7163 2.6022 20.8507C2.63091 20.9851 2.69788 21.1082 2.79503 21.2054C2.89218 21.3025 3.01536 21.3695 3.14972 21.3982C3.28408 21.4269 3.42387 21.4161 3.55224 21.3672L6.66524 20.1802L3.81924 17.3372ZM16.5002 5.99818C16.2036 5.99818 15.9136 6.08615 15.6669 6.25097C15.4202 6.41579 15.228 6.65006 15.1144 6.92415C15.0009 7.19824 14.9712 7.49984 15.0291 7.79081C15.0869 8.08178 15.2298 8.34906 15.4396 8.55884C15.6494 8.76862 15.9166 8.91148 16.2076 8.96935C16.4986 9.02723 16.8002 8.99753 17.0743 8.884C17.3484 8.77046 17.5826 8.5782 17.7474 8.33153C17.9123 8.08486 18.0002 7.79485 18.0002 7.49818C18.0002 7.10035 17.8422 6.71882 17.5609 6.43752C17.2796 6.15621 16.8981 5.99818 16.5002 5.99818Z"
                                        fill="black" />
                                    <path
                                        d="M4.05423 15.1982L2.24723 13.3912C2.15505 13.299 2.08547 13.1867 2.04395 13.0632C2.00243 12.9396 1.9901 12.8081 2.00793 12.679C2.02575 12.5498 2.07325 12.4266 2.14669 12.3189C2.22013 12.2112 2.31752 12.1219 2.43123 12.0582L9.15323 8.28918C7.17353 10.3717 5.4607 12.6926 4.05423 15.1982ZM8.80023 19.9442L10.6072 21.7512C10.6994 21.8434 10.8117 21.9129 10.9352 21.9545C11.0588 21.996 11.1903 22.0083 11.3195 21.9905C11.4486 21.9727 11.5718 21.9252 11.6795 21.8517C11.7872 21.7783 11.8765 21.6809 11.9402 21.5672L15.7092 14.8442C13.6269 16.8245 11.3061 18.5377 8.80023 19.9442ZM7.04023 18.1832L12.5832 12.6402C12.7381 12.4759 12.8228 12.2577 12.8195 12.032C12.8161 11.8063 12.725 11.5907 12.5653 11.4311C12.4057 11.2714 12.1901 11.1803 11.9644 11.1769C11.7387 11.1736 11.5205 11.2583 11.3562 11.4132L5.81323 16.9562L7.04023 18.1832Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">General Setup</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <?php
                            $company = App\Models\Company::first();
                            ?>


                            @if ($company)
                                <a class="menu-link" href="{{ route('company.edit', $company->id) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Company</span>
                                </a>
                            @endif
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('why-us.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Why Us</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('site-countries.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Countries</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('cities.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Cities</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('hotelTag.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tags</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('features.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title"> Features</span>
                            </a>
                        </div>
                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{route('room-types.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Room Types</span>
                                    </a>
                                </div> --}}
                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{route('tours.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Tours</span>
                                    </a>
                                </div> --}}

                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{ route('countries.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Countries</span>
                                    </a>
                                </div> --}}

                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{ route('features.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Features</span>
                                    </a>
                                </div> --}}
                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{ route('galleries.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Galleries</span>
                                    </a>
                                </div> --}}

                        {{-- <div class="menu-item">
                                    <a class="menu-link" href="{{ route('blog-categories.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Blog Category</span>
                                    </a>
                                </div> --}}



                    </div>
                </div>
                @endif
                <!-- End basics -->
                <!-- organizers -->
                {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Business Pages</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Business Pages list</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Business Page</span>
                                </a>
                            </div>


                        </div>
                    </div> --}}




                <!-- end organizers -->
                @if (Auth::user()->hasRole('admin'))
                    <!-- start blog -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Home Page</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('explore.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Explore City</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('offers.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Offers</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('best-hotel.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Best Hotels</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('counter.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Counter</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('company.edit', 1) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">About Us</span>
                                </a>
                            </div>


                        </div>
                    </div>
                    <!-- end blog -->
                @endif

                @if (Auth::user()->hasRole('admin'))
                <!-- start Event -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Users Roles</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('user-role.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Users List</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('user-role.create') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Add User</span>
                            </a>
                        </div>


                    </div>
                </div>
                <!-- end Event -->
            @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start Event -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Tours</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('tours.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Tours List</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('tours.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Tour</span>
                                </a>
                            </div>

                            {{-- new --}}
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('tour-galleries.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Tour Gallery</span>
                                </a>
                            </div>
                            {{--  --}}
                            {{-- <div class="menu-item">
                            <a class="menu-link" href="{{ route('tourTag.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tour Tags</span>
                            </a>
                        </div> --}}


                        </div>
                    </div>
                    <!-- end Event -->
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start Event -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Hotels</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hotels.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Hotels list</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hotels.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Hotel</span>
                                </a>
                            </div>

                            {{-- new --}}
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('galleries.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Hotel Gallery</span>
                                </a>
                            </div>
                            {{-- <div class="menu-item">
                            <a class="menu-link" href="{{ route('features.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title"> Features</span>
                            </a>
                        </div> --}}

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('room-types.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Room Types</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('hotel-price.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Hotel Pricing</span>
                                </a>
                            </div>

                            {{-- <div class="menu-item">
                            <a class="menu-link" href="{{ route('hotelTag.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Hotel Tags</span>
                            </a>
                        </div> --}}
                            {{-- end new --}}


                        </div>
                    </div>
                    <!-- end Event -->
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start transportation -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Transfer </span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('transfer.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Transfer list</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('car-navigate.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Car Navigate</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('car-models.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Car Models</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('transfer-location.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Tranfser Locations</span>
                                </a>
                            </div>

                            {{-- <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tranfser Pricing</span>
                            </a>
                        </div> --}}

                            {{-- <div class="menu-item">
                            <a class="menu-link" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tranfser Reserving</span>
                            </a>
                        </div> --}}
                        </div>
                    </div>
                    <!-- end transportation -->
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start Visa -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Visa</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('nationalities.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Nationalities</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('visaType.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Visa Type</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('countries.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Country List</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('visa.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Visa list</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('visa.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Visa</span>
                                </a>
                            </div>


                        </div>
                    </div>
                    <!-- end Visa -->
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start blog -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Blogs</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('blogs.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blog list</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('blogs.create') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Add Blog</span>
                                </a>
                            </div>

                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('blog-categories.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Blog Category</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end blog -->
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <!-- start user data -->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">User Data</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('site-users.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Site Users list</span>
                                </a>
                            </div>



                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('fav-hotels.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Favourties Hotels</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- end user data  dd($user->roles) -->
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('seller'))
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('users-orders.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Order Data</span>
                        </a>
                    </div>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('company.edit', 1) }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">About Us</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('contact') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Contact Us</span>
                        </a>
                    </div>
                @endif
                <div class="menu-item">
                    <div class="menu-content">
                        <div class="separator mx-1 my-4"></div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pb-5 d-none" id="kt_aside_footer">
        <a href="#" class="btn btn-light-primary w-100">Button</a>
    </div>
    <!--end::Footer-->
</div>
<!--end::Aside-->
