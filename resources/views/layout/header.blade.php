 <!--begin::Wrapper-->
 <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <!--begin::Logo bar-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <!--begin::Aside Toggle-->
                <div class="d-flex align-items-center d-lg-none">
                    <div class="btn btn-icon btn-active-color-primary ms-n2 me-1" id="kt_aside_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::Aside Toggle-->
                <!--begin::Logo-->
                <a href="../dist/index.html" class="d-lg-none">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo-compact.svg')}}" class="mh-40px" />
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div class="btn btn-icon w-auto ps-0 btn-active-color-primary d-none d-lg-inline-flex me-2 me-lg-5" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr060.svg-->
                    <span class="svg-icon svg-icon-2 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="black" />
                            <path d="M6.2238 13.2561C5.54282 12.5572 5.54281 11.4429 6.22379 10.7439L10.377 6.48107C10.8779 5.96697 11.75 6.32158 11.75 7.03934V16.9607C11.75 17.6785 10.8779 18.0331 10.377 17.519L6.2238 13.2561Z" fill="black" />
                            <rect opacity="0.3" x="2" y="4" width="2" height="16" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside toggler-->
            </div>
            <!--end::Logo bar-->
            <!--begin::Topbar-->
            <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                <!--begin::Search-->
                <div class="d-flex align-items-stretch me-1">
                    <!--begin::Search-->
                    {{-- <div id="kt_header_search" class="d-flex align-items-center w-100 w-lg-300px" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-search-responsive="lg" data-kt-menu-trigger="auto" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-start">
                        <!--begin::Tablet and mobile search toggle-->
                        <div data-kt-search-element="toggle" class="d-flex d-lg-none align-items-center">
                            <div class="">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Tablet and mobile search toggle-->
                        <!--begin::Form(use d-none d-lg-block classes for responsive search)-->
                        <form data-kt-search-element="form" class="d-none d-lg-block w-100 mb-5 mb-lg-0" autocomplete="off">
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Hidden input(Added to disable form autocomplete)-->
                                <input type="hidden" />
                                <!--end::Hidden input-->
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-2 svg-icon-lg-3 svg-icon-gray-700 position-absolute top-50 translate-middle-y ms-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Input-->
                                <input type="text" class="search-input form-control form-control-transparent ps-8" name="search" value="" placeholder="Search..." data-kt-search-element="input" />
                                <!--end::Input-->
                                <!--begin::Spinner-->
                                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-1" data-kt-search-element="spinner">
                                    <span class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                </span>
                                <!--end::Spinner-->
                                <!--begin::Reset-->
                                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-0" data-kt-search-element="clear">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--end::Reset-->
                            </div>
                            <!--begin::Separator-->
                            <div class="separator mt-1 d-block d-lg-none"></div>
                            <!--end::Separator-->
                        </form>
                        <!--end::Form-->
                        <!--begin::Menu-->
                        <div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown w-300px w-md-350px py-7 px-7 overflow-hidden">
                            <!--begin::Wrapper-->
                            <div data-kt-search-element="wrapper">
                                <!--begin::Recently viewed-->
                                <div data-kt-search-element="results" class="d-none">
                                    <!--begin::Items-->
                                    <div class="scroll-y mh-200px mh-lg-350px">
                                        <!--begin::Category title-->
                                        <h3 class="fs-5 text-muted m-0 pb-5" data-kt-search-element="category-title">Users</h3>
                                        <!--end::Category title-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-6.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Karina Clark</span>
                                                <span class="fs-7 fw-bold text-muted">Marketing Manager</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-2.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Olivia Bold</span>
                                                <span class="fs-7 fw-bold text-muted">Software Engineer</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-9.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Ana Clark</span>
                                                <span class="fs-7 fw-bold text-muted">UI/UX Designer</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-14.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Nick Pitola</span>
                                                <span class="fs-7 fw-bold text-muted">Art Director</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <img src="assets/media/avatars/300-11.jpg" alt="" />
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Edward Kulnic</span>
                                                <span class="fs-7 fw-bold text-muted">System Administrator</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Category title-->
                                        <h3 class="fs-5 text-muted m-0 pt-5 pb-5" data-kt-search-element="category-title">Customers</h3>
                                        <!--end::Category title-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px" src="assets/media/svg/brand-logos/volicity-9.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Company Rbranding</span>
                                                <span class="fs-7 fw-bold text-muted">UI Design</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px" src="assets/media/svg/brand-logos/tvit.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Company Re-branding</span>
                                                <span class="fs-7 fw-bold text-muted">Web Development</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px" src="assets/media/svg/misc/infography.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Business Analytics App</span>
                                                <span class="fs-7 fw-bold text-muted">Administration</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px" src="assets/media/svg/brand-logos/leaf.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">EcoLeaf App Launch</span>
                                                <span class="fs-7 fw-bold text-muted">Marketing</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <img class="w-20px h-20px" src="assets/media/svg/brand-logos/tower.svg" alt="" />
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column justify-content-start fw-bold">
                                                <span class="fs-6 fw-bold">Tower Group Website</span>
                                                <span class="fs-7 fw-bold text-muted">Google Adwords</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Category title-->
                                        <h3 class="fs-5 text-muted m-0 pt-5 pb-5" data-kt-search-element="category-title">Projects</h3>
                                        <!--end::Category title-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black" />
                                                            <rect x="7" y="17" width="6" height="2" rx="1" fill="black" />
                                                            <rect x="7" y="12" width="10" height="2" rx="1" fill="black" />
                                                            <rect x="7" y="7" width="6" height="2" rx="1" fill="black" />
                                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">Si-Fi Project by AU Themes</span>
                                                <span class="fs-7 fw-bold text-muted">#45670</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">Shopix Mobile App Planning</span>
                                                <span class="fs-7 fw-bold text-muted">#45690</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black" />
                                                            <rect x="6" y="12" width="7" height="2" rx="1" fill="black" />
                                                            <rect x="6" y="7" width="12" height="2" rx="1" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">Finance Monitoring SAAS Discussion</span>
                                                <span class="fs-7 fw-bold text-muted">#21090</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <a href="#" class="d-flex text-dark text-hover-primary align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <span class="fs-6 fw-bold">Dashboard Analitics Launch</span>
                                                <span class="fs-7 fw-bold text-muted">#34560</span>
                                            </div>
                                            <!--end::Title-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Recently viewed-->
                                <!--begin::Recently viewed-->
                                <div class="" data-kt-search-element="main">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-stack fw-bold mb-4">
                                        <!--begin::Label-->
                                        <span class="text-muted fs-6 me-2">Recently Searched:</span>
                                        <!--end::Label-->
                                        <!--begin::Toolbar-->
                                        <div class="d-flex" data-kt-search-element="toolbar">
                                            <!--begin::Preferences toggle-->
                                            <div data-kt-search-element="preferences-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-2 data-bs-toggle=" title="Show search preferences">
                                                <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="black" />
                                                        <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Preferences toggle-->
                                            <!--begin::Advanced search toggle-->
                                            <div data-kt-search-element="advanced-options-form-show" class="btn btn-icon w-20px btn-sm btn-active-color-primary me-n1" data-bs-toggle="tooltip" title="Show more search options">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Advanced search toggle-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Items-->
                                    <div class="scroll-y mh-200px mh-lg-325px">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc004.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z" fill="black" />
                                                            <path opacity="0.3" d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z" fill="black" />
                                                            <path opacity="0.3" d="M15 17H9V20H15V17Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">BoomApp by Keenthemes</a>
                                                <span class="fs-7 text-muted fw-bold">#45789</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra001.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="black" />
                                                            <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">"Kept API Project Meeting</a>
                                                <span class="fs-7 text-muted fw-bold">#84050</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra006.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M13 5.91517C15.8 6.41517 18 8.81519 18 11.8152C18 12.5152 17.9 13.2152 17.6 13.9152L20.1 15.3152C20.6 15.6152 21.4 15.4152 21.6 14.8152C21.9 13.9152 22.1 12.9152 22.1 11.8152C22.1 7.01519 18.8 3.11521 14.3 2.01521C13.7 1.91521 13.1 2.31521 13.1 3.01521V5.91517H13Z" fill="black" />
                                                            <path opacity="0.3" d="M19.1 17.0152C19.7 17.3152 19.8 18.1152 19.3 18.5152C17.5 20.5152 14.9 21.7152 12 21.7152C9.1 21.7152 6.50001 20.5152 4.70001 18.5152C4.30001 18.0152 4.39999 17.3152 4.89999 17.0152L7.39999 15.6152C8.49999 16.9152 10.2 17.8152 12 17.8152C13.8 17.8152 15.5 17.0152 16.6 15.6152L19.1 17.0152ZM6.39999 13.9151C6.19999 13.2151 6 12.5152 6 11.8152C6 8.81517 8.2 6.41515 11 5.91515V3.01519C11 2.41519 10.4 1.91519 9.79999 2.01519C5.29999 3.01519 2 7.01517 2 11.8152C2 12.8152 2.2 13.8152 2.5 14.8152C2.7 15.4152 3.4 15.7152 4 15.3152L6.39999 13.9151Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">"KPI Monitoring App Launch</a>
                                                <span class="fs-7 text-muted fw-bold">#84250</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra002.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z" fill="black" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Project Reference FAQ</a>
                                                <span class="fs-7 text-muted fw-bold">#67945</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                            <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">"FitPro App Development</a>
                                                <span class="fs-7 text-muted fw-bold">#84250</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin001.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="black" />
                                                            <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">Shopix Mobile App</a>
                                                <span class="fs-7 text-muted fw-bold">#45690</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-5">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-light">
                                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra002.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z" fill="black" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold">"Landing UI Design" Launch</a>
                                                <span class="fs-7 text-muted fw-bold">#24005</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Recently viewed-->
                                <!--begin::Empty-->
                                <div data-kt-search-element="empty" class="text-center d-none">
                                    <!--begin::Icon-->
                                    <div class="pt-10 pb-10">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil024.svg-->
                                        <span class="svg-icon svg-icon-4x opacity-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" fill="black" />
                                                <path d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z" fill="black" />
                                                <rect x="13.6993" y="13.6656" width="4.42828" height="1.73089" rx="0.865447" transform="rotate(45 13.6993 13.6656)" fill="black" />
                                                <path d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Message-->
                                    <div class="pb-15 fw-bold">
                                        <h3 class="text-gray-600 fs-5 mb-2">No result found</h3>
                                        <div class="text-muted fs-7">Please try again with a different query</div>
                                    </div>
                                    <!--end::Message-->
                                </div>
                                <!--end::Empty-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Preferences-->
                            <form data-kt-search-element="advanced-options-form" class="pt-1 d-none">
                                <!--begin::Heading-->
                                <h3 class="fw-bold text-dark mb-7">Advanced Search</h3>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-sm form-control-solid" placeholder="Contains the word" name="query" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <!--begin::Radio group-->
                                    <div class="nav-group nav-group-fluid">
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="has" checked="checked" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">All</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="users" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Users</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="orders" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Orders</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="type" value="projects" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Projects</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Radio group-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" name="assignedto" class="form-control form-control-sm form-control-solid" placeholder="Assigned to" value="" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <input type="text" name="collaborators" class="form-control form-control-sm form-control-solid" placeholder="Collaborators" value="" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <!--begin::Radio group-->
                                    <div class="nav-group nav-group-fluid">
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="attachment" value="has" checked="checked" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary">Has attachment</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" name="attachment" value="any" />
                                            <span class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Any</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Radio group-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <select name="timezone" aria-label="Select a Timezone" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                        <option value="next">Within the next</option>
                                        <option value="last">Within the last</option>
                                        <option value="between">Between</option>
                                        <option value="on">On</option>
                                    </select>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-8">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <input type="number" name="date_number" class="form-control form-control-sm form-control-solid" placeholder="Lenght" value="" />
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <select name="date_typer" aria-label="Select a Timezone" data-control="select2" data-placeholder="Period" class="form-select form-select-sm form-select-solid">
                                            <option value="days">Days</option>
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="years">Years</option>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                    <a href="../dist/pages/search/horizontal.html" class="btn btn-sm fw-bolder btn-primary" data-kt-search-element="advanced-options-form-search">Search</a>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Preferences-->
                            <!--begin::Preferences-->
                            <form data-kt-search-element="preferences" class="pt-1 d-none">
                                <!--begin::Heading-->
                                <h3 class="fw-bold text-dark mb-7">Search Preferences</h3>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="pb-4 border-bottom">
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Projects</span>
                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Targets</span>
                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Affiliate Programs</span>
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Referrals</span>
                                        <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="py-4 border-bottom">
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                        <span class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Users</span>
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </label>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end pt-7">
                                    <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2" data-kt-search-element="preferences-dismiss">Cancel</button>
                                    <button type="submit" class="btn btn-sm fw-bolder btn-primary">Save Changes</button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Preferences-->
                        </div>
                        <!--end::Menu-->
                    </div> --}}
                    <!--end::Search-->
                </div>
                <!--end::Search-->
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-stretch flex-shrink-0">

                    {{-- <div class="d-flex align-items-center ms-2 ms-lg-3" >


                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if (LaravelLocalization::getCurrentLocale() != 'de' && $localeCode == 'de')
                                <a class="btn btn-sm fw-bolder btn-primary" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                    <!--{{ $properties['native'] }}-->

                                    {{ __('links.de') }}
                                </a>
                            @endif
                            @if (LaravelLocalization::getCurrentLocale() != 'en' && $localeCode == 'en')
                                <a class="btn btn-sm fw-bolder btn-primary" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                                    {{ __('links.en') }}
                                </a>
                            @endif
                        @endforeach

                </div> --}}
                    <!--begin::User-->
                    <div class="d-flex align-items-center ms-2 ms-lg-3" id="kt_header_user_menu_toggle">
                        <!--begin::Menu wrapper-->
                        <div class="cursor-pointer symbol symbol-35px symbol-lg-35px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img alt="Pic" src="{{asset('dist/assets/media/avatars/300-1.jpg')}}" />
                        </div>
                        <!--begin::User account menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="{{asset('dist/assets/media/avatars/300-1.jpg')}}" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Username-->
                                    <div class="d-flex flex-column">
                                        <div class="fw-bolder d-flex align-items-center fs-5">{{Auth::user()->name}}
                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">{{Auth::user()->phone}}</span></div>
                                        <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{Auth::user()->email}}</a>
                                    </div>
                                    <!--end::Username-->
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator changePassword-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a href="{{ route('changePassword') }}" class="menu-link px-5">Change Password</a>
                            </div>
                            <!--begin::Menu separator-->
                            {{-- <div class="separator my-2"></div>

                            <div class="menu-item px-5">
                                <a href="#" class="menu-link px-5">My Profile</a>
                            </div> --}}
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            {{-- <div class="menu-item px-5">
                                <a href="../dist/apps/projects/list.html" class="menu-link px-5">
                                    <span class="menu-text">My Projects</span>
                                    <span class="menu-badge">
                                        <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                                    </span>
                                </a>
                            </div> --}}
                            <!--end::Menu item-->
                            <!--begin::Menu item-->

                            <!--end::Menu item-->
                            <!--begin::Menu item-->

                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->

                            <!--begin::Menu item-->

                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-5">
                                <a  href="{{ route('logout') }}" class="menu-link px-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                    Sign Out
                                 </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                     @csrf
                                 </form>
                                {{-- <a href="../dist/authentication/flows/basic/sign-in.html" class="menu-link px-5">Sign Out</a> --}}
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator my-2"></div>
                            <!--end::Menu separator-->

                        </div>
                        <!--end::User account menu-->
                        <!--end::Menu wrapper-->
                    </div>
                    <!--end::User -->

                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
    @yield('breadcrumb')

        <!--begin::Post-->
        {{-- <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container-xxl">
                <!--begin::Row-->
                <div class="row g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xxl-8">
                        <!--begin::Row-->
                        <div class="row g-xl-8">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Chart Widget 1-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body p-0 d-flex justify-content-between flex-column">
                                        <div class="d-flex flex-stack card-p flex-grow-1">
                                            <!--begin::Icon-->
                                            <div class="symbol symbol-45px">
                                                <div class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                                    <span class="svg-icon svg-icon-2x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column text-end">
                                                <span class="fw-boldest text-gray-800 fs-2">Orders</span>
                                                <span class="text-gray-400 fw-bold fs-6">Sep 1 - Sep 16 2020</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--begin::Chart-->
                                        <div class="pt-1">
                                            <div id="kt_chart_widget_1_chart" class="card-rounded-bottom h-125px"></div>
                                        </div>
                                        <!--end::Chart-->
                                    </div>
                                </div>
                                <!--end::Chart Widget 1-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Slider Widget 1-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <div id="kt_stats_widget_8_carousel" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-interval="8000">
                                            <!--begin::Heading-->
                                            <div class="d-flex flex-stack flex-wrap">
                                                <span class="fs-4 text-gray-400 fw-boldest pe-2">Announcements</span>
                                                <!--begin::Carousel Indicators-->
                                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                                    <li data-bs-target="#kt_stats_widget_8_carousel" data-bs-slide-to="0" class="ms-1 active"></li>
                                                    <li data-bs-target="#kt_stats_widget_8_carousel" data-bs-slide-to="1" class="ms-1"></li>
                                                    <li data-bs-target="#kt_stats_widget_8_carousel" data-bs-slide-to="2" class="ms-1"></li>
                                                    <li data-bs-target="#kt_stats_widget_8_carousel" data-bs-slide-to="3" class="ms-1"></li>
                                                </ol>
                                                <!--end::Carousel Indicators-->
                                            </div>
                                            <!--end::Heading-->
                                            <!--begin::Carousel-->
                                            <div class="carousel-inner pt-6">
                                                <!--begin::Item-->
                                                <div class="carousel-item active">
                                                    <div class="carousel-wrapper">
                                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">Craft Admin Launch Day</a>
                                                            <p class="text-gray-600 fs-6 fw-bold pt-4 mb-0">To start a blog, think of a topic about and first brainstorm ways to write details</p>
                                                        </div>
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-8">
                                                            <span class="badge badge-light-primary fs-7 fw-boldest me-2">OCT 05, 10</span>
                                                            <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">Craft Dashboard Launch</a>
                                                            <p class="text-gray-600 fs-6 fw-bold pt-4 mb-0">To start a blog, think of a topic about and first brainstorm ways to write details</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-8">
                                                            <span class="badge badge-light-primary fs-7 fw-boldest me-2">DEC 03, 20</span>
                                                            <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">Reached 50,000 Sales</a>
                                                            <p class="text-gray-600 fs-6 fw-bold pt-4 mb-0">To start a blog, think of a topic about and first brainstorm ways to write details</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-8">
                                                            <span class="badge badge-light-primary fs-7 fw-boldest me-2">NOV 06, 23</span>
                                                            <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="d-flex flex-column justify-content-between flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">Reached 50,000 Sales</a>
                                                            <p class="text-gray-600 fs-6 fw-bold pt-4 mb-0">To start a blog, think of a topic about and first brainstorm ways to write details</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-8">
                                                            <span class="badge badge-light-primary fs-7 fw-boldest me-2">AUG 01, 13</span>
                                                            <a href="#" class="btn btn-light btn-sm btn-color-muted fs-7 fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Carousel-->
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Slider Widget 1-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-xl-8">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Chart Widget 2-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
                                        <div class="d-flex flex-stack flex-grow-1 px-9 pt-9 pb-3">
                                            <!--begin::Icon-->
                                            <div class="symbol symbol-45px">
                                                <div class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                                    <span class="svg-icon svg-icon-2x">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                                            <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                            </div>
                                            <!--end::Icon-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column text-end">
                                                <span class="fw-boldest text-gray-800 fs-2">Earnings</span>
                                                <span class="text-gray-400 fw-bold fs-6">Oct 8 - Oct 26 2020</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--begin::Chart-->
                                        <div id="kt_charts_widget_2_chart" class="mb-n10" style="height: 165px"></div>
                                        <!--end::Chart-->
                                    </div>
                                </div>
                                <!--end::Chart Widget 2-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Slider widget 2-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <!--begin::Carousel-->
                                        <div id="kt_stats_widget_9_carousel" class="carousel carousel-custom carousel-stretch slide" data-bs-ride="carousel" data-bs-interval="8000">
                                            <!--begin::Nav-->
                                            <div class="d-flex flex-stack flex-wrap">
                                                <span class="text-gray-400 fw-boldest fs-4 pe-2">Today’s Schedule</span>
                                                <!--begin::Carousel Indicators-->
                                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-dots">
                                                    <li data-bs-target="#kt_stats_widget_9_carousel" data-bs-slide-to="0" class="ml-1 active"></li>
                                                    <li data-bs-target="#kt_stats_widget_9_carousel" data-bs-slide-to="1" class="ml-1"></li>
                                                    <li data-bs-target="#kt_stats_widget_9_carousel" data-bs-slide-to="2" class="ml-1"></li>
                                                    <li data-bs-target="#kt_stats_widget_9_carousel" data-bs-slide-to="3" class="ml-1"></li>
                                                </ol>
                                                <!--end::Carousel Indicators-->
                                            </div>
                                            <!--end::Nav-->
                                            <!--begin::Items-->
                                            <div class="carousel-inner pt-8">
                                                <!--begin::Item-->
                                                <div class="carousel-item active">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">UI/UX Design Updates</a>
                                                            <p class="text-primary fs-1 fw-boldest pt-5 mb-0">11:15AM - 12:30PM</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-7">
                                                            <span class="text-gray-400 fs-6 fw-bold pe-2">234 E St. Broadwey NY..</span>
                                                            <a href="#" class="btn btn-light btn-sm fs-7 btn-color-muted fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_select_location">Map</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">UI/UX Design Updates</a>
                                                            <p class="text-primary fs-1 fw-boldest pt-5 mb-0">11:15AM - 12:30PM</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-7">
                                                            <span class="text-gray-400 fs-6 fw-bold pe-2">256 R St. Manhattan NY..</span>
                                                            <a href="#" class="btn btn-light btn-sm fs-7 btn-color-muted fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_select_location">Map</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">UI/UX Design Updates</a>
                                                            <p class="text-primary fs-1 fw-boldest pt-5 mb-0">16:15AM - 11:20PM</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-7">
                                                            <span class="text-gray-400 fs-6 fw-bold pe-2">745 R St. Romance DR..</span>
                                                            <a href="#" class="btn btn-light btn-sm fs-7 btn-color-muted fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_select_location">Map</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="carousel-item">
                                                    <div class="carousel-wrapper">
                                                        <!--begin::Title-->
                                                        <div class="flex-grow-1">
                                                            <a href="" class="fs-2 text-gray-800 text-hover-primary fw-boldest">UI/UX Design Updates</a>
                                                            <p class="text-primary fs-1 fw-boldest pt-5 mb-0">13:15AM - 14:30PM</p>
                                                        </div>
                                                        <!--end::Title-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-stack pt-7">
                                                            <span class="text-gray-400 fs-6 fw-bold pe-2">123 R St. Soulard NY..</span>
                                                            <a href="#" class="btn btn-light btn-sm fs-7 btn-color-muted fw-boldest px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_select_location">Map</a>
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Carousel-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Slider widget 2-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-4 gy-0 gy-xxl-8">
                        <!--begin::Engage Widget 1-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body pb-0">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <!--begin::Section-->
                                    <div class="pt-12">
                                        <!--begin::Title-->
                                        <h3 class="text-dark text-center fs-1 fw-boldest line-height-lg">Kickstart
                                        <br />Mobile Application</h3>
                                        <!--end::Title-->
                                        <!--begin::Text-->
                                        <div class="text-center text-gray-600 fs-5 fw-bold pt-4 pb-1">Outlines keep you honest. They stoping you from amazing poorly about drive</div>
                                        <!--end::Text-->
                                        <!--begin::Action-->
                                        <div class="text-center py-7">
                                            <a href="#" class="btn btn-primary fs-6 px-6" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create App</a>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Image-->
                                    <div class="flex-grow-1 bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom card-rounded-bottom max-h-175px min-h-175px" style="background-image:url('assets/media/illustrations/sigma-1/7.png')"></div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Engage Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 gx-xxl-8 mb-xxl-3">
                    <!--begin::Col-->
                    <div class="col-xxl-8">
                        <!--begin::Table widget 1-->
                        <div class="card card-xxl-stretch mb-xl-3">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5 pb-3">
                                <!--begin::Heading-->
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-boldest text-gray-800 fs-2">Teams Progress</span>
                                    <span class="text-gray-400 fw-bold mt-2 fs-6">890,344 Sales</span>
                                </h3>
                                <!--end::Heading-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Select-->
                                    <div class="pe-6 my-1">
                                        <select class="form-select form-select-sm form-select-solid w-125px" data-control="select2" data-placeholder="All Users" data-hide-search="true">
                                            <option value="1" selected="selected">All Users</option>
                                            <option value="2">Active users</option>
                                            <option value="3">Pending users</option>
                                        </select>
                                    </div>
                                    <!--end::Select-->
                                    <!--begin::Search-->
                                    <div class="w-125px position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" class="form-control form-control-sm form-control-solid ps-10" name="search" value="" placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-0">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered table-row-dashed gy-5" id="kt_table_widget_1">
                                        <tbody>
                                            <tr class="text-start text-gray-400 fw-boldest fs-7 text-uppercase">
                                                <th class="w-20px ps-0">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_widget_1 .form-check-input" value="1" />
                                                    </div>
                                                </th>
                                                <th class="min-w-200px px-0">Authors</th>
                                                <th class="min-w-125px">Company</th>
                                                <th class="min-w-125px">Progress</th>
                                                <th class="text-end pe-2 min-w-70px">Action</th>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img alt="" class="w-25px" src="assets/media/svg/brand-logos/aven.svg" />
                                                            </span>
                                                        </div>
                                                        <div class="ps-3">
                                                            <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Brad Simmons</a>
                                                            <span class="text-gray-400 fw-bold d-block">HTML, JS, ReactJS</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800 fw-boldest fs-5 d-block">Intertico</span>
                                                    <span class="text-gray-400 fw-bold">Web, UI/UX Design</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column w-100 me-2 mt-2">
                                                        <span class="text-gray-400 me-2 fw-boldest mb-2">65%</span>
                                                        <div class="progress bg-light-danger w-100 h-5px">
                                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 65%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pe-0 text-end">
                                                    <a href="../dist/pages/projects/project.html" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img alt="" class="w-25px" src="assets/media/svg/brand-logos/leaf.svg" />
                                                            </span>
                                                        </div>
                                                        <div class="ps-3">
                                                            <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Jessie Clarcson</a>
                                                            <span class="text-gray-400 fw-bold d-block">C#, ASP.NET, MS SQL</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800 fw-boldest fs-5 d-block">Agoda</span>
                                                    <span class="text-gray-400 fw-bold">Houses &amp; Hotels</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column w-100 me-2">
                                                        <span class="text-gray-400 me-2 fw-boldest mb-2">85%</span>
                                                        <div class="progress bg-light-primary w-100 h-5px">
                                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pe-0 text-end">
                                                    <a href="../dist/pages/projects/project.html" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div class="d-flex align-items-center text-start">
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img class="w-25px" alt="" src="assets/media/svg/brand-logos/atica.svg" />
                                                            </span>
                                                        </div>
                                                        <div class="ps-3">
                                                            <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Lebron Wayde</a>
                                                            <span class="text-gray-400 fw-bold d-block">PHP, Laravel, VueJS</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800 fw-boldest fs-5 d-block">RoadGee</span>
                                                    <span class="text-gray-400 fw-bold">Transportation</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column w-100 me-2">
                                                        <span class="text-gray-400 me-2 fw-boldest mb-2">4%</span>
                                                        <div class="progress bg-light-success w-100 h-5px">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 47%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pe-0 text-end">
                                                    <a href="../dist/pages/projects/project.html" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-0">
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                    </div>
                                                </td>
                                                <td class="p-0">
                                                    <div class="d-flex align-items-center text-start">
                                                        <div class="symbol symbol-50px me-2">
                                                            <span class="symbol-label">
                                                                <img class="w-25px" alt="" src="assets/media/svg/brand-logos/volicity-9.svg" />
                                                            </span>
                                                        </div>
                                                        <div class="ps-3">
                                                            <a href="#" class="text-gray-800 fw-boldest fs-5 text-hover-primary mb-1">Natali Trump</a>
                                                            <span class="text-gray-400 fw-bold d-block">Python, ReactJS</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800 fw-boldest fs-5 d-block">The Hill</span>
                                                    <span class="text-gray-400 fw-bold">Insurance</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column w-100 me-2">
                                                        <span class="text-gray-400 me-2 fw-boldest mb-2">71%</span>
                                                        <div class="progress bg-light-info w-100 h-5px">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: 71%;"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pe-0 text-end">
                                                    <a href="../dist/pages/projects/project.html" class="btn btn-light text-muted fw-boldest btn-sm px-5">View</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Table widget 1-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-4">
                        <!--begin::Chart Widget 4-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Beader-->
                            <div class="card-header border-0 py-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-boldest text-dark fs-2">Achievements</span>
                                    <span class="text-gray-400 mt-2 fw-bold fs-6">100k+ sales templates sales</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column pt-0">
                                <!--begin::Chart-->
                                <div class="d-flex flex-center position-relative">
                                    <div id="kt_chart_widget_4_chart" style="height: 250px"></div>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Items-->
                                <div class="mt-n20 pb-5 position-relative zindex-1">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-6">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45px me-5">
                                                <span class="symbol-label bg-light-success">
                                                    <!--begin::Svg Icon | path: /icons/duotune/maps/map004.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black" />
                                                            <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div>
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Global Stars</a>
                                                <div class="fs-7 text-gray-400 fw-bold mt-1">12 Hours, 4 Commits</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-icon btn-light btn-sm">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 svg-icon-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-6">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45px me-5">
                                                <span class="symbol-label bg-light-danger">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                                            <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div>
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Focus Keeper</a>
                                                <div class="fs-7 text-gray-400 fw-bold mt-1">6 Hours, 3 Commits</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-icon btn-light btn-sm">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 svg-icon-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack mb-">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45px me-5">
                                                <span class="symbol-label bg-light-info">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs019.svg-->
                                                    <span class="svg-icon svg-icon-2 svg-icon-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M18.0002 22H6.00019C5.20019 22 4.8002 21.1 5.2002 20.4L12.0002 12L18.8002 20.4C19.3002 21.1 18.8002 22 18.0002 22Z" fill="black" />
                                                            <path opacity="0.3" d="M18.8002 3.6L12.0002 12L5.20019 3.6C4.70019 3 5.20018 2 6.00018 2H18.0002C18.8002 2 19.3002 2.9 18.8002 3.6Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div>
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">High Tower</a>
                                                <div class="fs-7 text-gray-400 fw-bold mt-1">34 Hours, 15 Commits</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-icon btn-light btn-sm">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                            <span class="svg-icon svg-icon-4 svg-icon-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Chart Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::List Widget 2-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-boldest text-dark fs-2">My Competitors</span>
                                    <span class="text-gray-400 mt-2 fw-bold fs-6">More than 400+ new members</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex mb-6">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="assets/media/stock/600x400/img-17.jpg" class="mw-100" alt="" />
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Cup &amp; Green</a>
                                            <span class="text-gray-400 fw-bold fs-7 my-1">Study highway types</span>
                                            <span class="text-gray-400 fw-bold fs-7">By:
                                            <a href="#" class="text-primary fw-bold">CoreAd</a></span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Info-->
                                        <div class="text-end py-lg-0 py-2">
                                            <span class="text-gray-800 fw-boldest fs-3">24,900</span>
                                            <span class="text-gray-400 fs-7 fw-bold d-block">Sales</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex mb-6">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="assets/media/stock/600x400/img-10.jpg" class="mw-100" alt="" />
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Yellow Hearts</a>
                                            <span class="text-gray-400 fw-bold fs-7 my-1">Study highway types</span>
                                            <span class="text-gray-400 fw-bold fs-7">By:
                                            <a href="#" class="text-primary fw-bold">KeenThemes</a></span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Info-->
                                        <div class="text-end py-lg-0 py-2">
                                            <span class="text-gray-800 fw-boldest fs-3">70,380</span>
                                            <span class="text-gray-400 fs-7 fw-bold d-block">Sales</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex mb-6">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="assets/media/stock/600x400/img-1.jpg" class="mw-100" alt="" />
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Nike &amp; Blue</a>
                                            <span class="text-gray-400 fw-bold fs-7 my-1">Study highway types</span>
                                            <span class="text-gray-400 fw-bold fs-7">By:
                                            <a href="#" class="text-primary fw-bold">Invision Inc.</a></span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Info-->
                                        <div class="text-end py-lg-0 py-2">
                                            <span class="text-gray-800 fw-boldest fs-3">7,200</span>
                                            <span class="text-gray-400 fs-7 fw-bold d-block">Sales</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex mb-">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                        <img src="assets/media/stock/600x400/img-9.jpg" class="mw-100" alt="" />
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                                        <!--begin::Title-->
                                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Red Boots</a>
                                            <span class="text-gray-400 fw-bold fs-7 my-1">Study highway types</span>
                                            <span class="text-gray-400 fw-bold fs-7">By:
                                            <a href="#" class="text-primary fw-bold">Figma Studio</a></span>
                                        </div>
                                        <!--end::Title-->
                                        <!--begin::Info-->
                                        <div class="text-end py-lg-0 py-2">
                                            <span class="text-gray-800 fw-boldest fs-3">36,450</span>
                                            <span class="text-gray-400 fs-7 fw-bold d-block">Sales</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 2-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::List Widget 3-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-boldest text-dark fs-2">My Agents</span>
                                    <span class="text-gray-400 mt-2 fw-bold fs-6">More than 400+ new members</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-active-light-primary btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_620f4415223d2">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_620f4415223d2" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-7">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <img src="assets/media/avatars/300-2.jpg" alt="" />
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="ps-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-boldest">Anne Clarc</a>
                                            <div class="fs-7 text-gray-400 fw-bold mt-1">HTML, CSS, Laravel</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Details-->
                                    <a href="../dist/pages/user-profile/overview.html" class="btn btn-light btn-color-muted fw-boldest btn-sm px-5">Details</a>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-7">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <img src="assets/media/avatars/300-1.jpg" alt="" />
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="ps-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-boldest">Brad Simmons</a>
                                            <div class="fs-7 text-gray-400 fw-bold mt-1">HTML, JS, ReactJS</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Details-->
                                    <a href="../dist/pages/user-profile/overview.html" class="btn btn-light btn-color-muted fw-boldest btn-sm px-5">Details</a>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-7">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <img src="assets/media/avatars/300-5.jpg" alt="" />
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="ps-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-boldest">Randy Trent</a>
                                            <div class="fs-7 text-gray-400 fw-bold mt-1">C#, ASP.NET, MS SQL</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Details-->
                                    <a href="../dist/pages/user-profile/overview.html" class="btn btn-light btn-color-muted fw-boldest btn-sm px-5">Details</a>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-7">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <img src="assets/media/avatars/300-20.jpg" alt="" />
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="ps-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-boldest">Ricky Hunt</a>
                                            <div class="fs-7 text-gray-400 fw-bold mt-1">PHP, Laravel, VueJS</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Details-->
                                    <a href="../dist/pages/user-profile/overview.html" class="btn btn-light btn-color-muted fw-boldest btn-sm px-5">Details</a>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack mb-">
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-35px me-4">
                                            <img src="assets/media/avatars/300-23.jpg" alt="" />
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Title-->
                                        <div class="ps-1">
                                            <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-boldest">Jessie Clarcson</a>
                                            <div class="fs-7 text-gray-400 fw-bold mt-1">ReactJS</div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Section-->
                                    <!--begin::Details-->
                                    <a href="../dist/pages/user-profile/overview.html" class="btn btn-light btn-color-muted fw-boldest btn-sm px-5">Details</a>
                                    <!--end::Details-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 3-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xl-4">
                        <!--begin::List Widget 4-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0 mt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-boldest text-dark fs-2">Timeline</span>
                                    <span class="text-gray-400 mt-2 fw-bold fs-6">890,344 Sales</span>
                                </h3>
                                <div class="card-toolbar">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 2-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mb-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                            <!--begin::Menu item-->
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--end::Menu item-->
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator mt-3 opacity-75"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 2-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-4">
                                <div class="position-relative">
                                    <!--begin::Border-->
                                    <div class="w-35px d-flex justify-content-center">
                                        <div class="border-start border-1 border-dashed border-gray-300 top-0 bottom-0 mb-5 mt-5 position-absolute"></div>
                                    </div>
                                    <!--end::Border-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack pb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-5 mt-2">
                                                <span class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
                                                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="pe-3">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Developer Library Added</a>
                                                <div class="text-gray-400 fw-bold mt-1">New
                                                <a href="#" class="link-primary p-1">Author Account</a>with Affiliate</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="fw-boldest fs-7 text-gray-400">2HR</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack pb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-5 mt-2">
                                                <span class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin002.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M22 7H2V11H22V7Z" fill="black" />
                                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="pe-3">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">Payments Methods Added</a>
                                                <div class="text-gray-400 fw-bold mt-1">Added
                                                <span class="text-gray-700 pe-1">Payoneer</span>&amp;
                                                <span class="text-gray-700">Transferwise</span></div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="fw-boldest fs-7 text-gray-400">6HR</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack pb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-5 mt-2">
                                                <span class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                                            <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="pe-3">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">New Order Placed</a>
                                                <div class="text-gray-400 fw-bold mt-1">
                                                <a href="#" class="link-primary pe-1">#XDT-034</a>order received</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="fw-boldest fs-7 text-gray-400">4DY</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack pb-10">
                                        <!--begin::Section-->
                                        <div class="d-flex">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-5 mt-2">
                                                <span class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="black" />
                                                            <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="pr-3">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">New User Library Added</a>
                                                <div class="fs-7 text-gray-400 fw-bold mt-2">New
                                                <a href="#" class="link-primary pe-1">Author Account</a>created</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="fw-boldest fs-7 text-gray-400">27DY</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-35px me-5 mt-2">
                                                <span class="symbol-label">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                                    <span class="svg-icon svg-icon-3 svg-icon-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black" />
                                                            <rect x="7" y="17" width="6" height="2" rx="1" fill="black" />
                                                            <rect x="7" y="12" width="10" height="2" rx="1" fill="black" />
                                                            <rect x="7" y="7" width="6" height="2" rx="1" fill="black" />
                                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Title-->
                                            <div class="pe-3">
                                                <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-boldest">New Story Created</a>
                                                <div class="text-gray-400 fw-bold mt-1">
                                                <a href="#" class="link-primary pe-1">#XDT-034</a>order received</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Label-->
                                        <span class="fw-boldest fs-7 text-gray-400">2MO</span>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Item-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::List Widget 4-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div> --}}

        @yield('content')


        <!--end::Post-->
    </div>
    <!--end::Content-->
    @include('layout.footer')
</div>
<!--end::Wrapper-->
