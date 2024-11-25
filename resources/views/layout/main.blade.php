<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Craft - Bootstrap 5 HTML Admin Dashboard Theme
Purchase: https://themes.getbootstrap.com/product/craft-bootstrap-5-admin-dashboard-theme
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<title>Safer</title>
		<meta charset="utf-8" />
		<meta name="description" content="Craft admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="keywords" content="Craft, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Craft - Bootstrap 5 HTML Admin Dashboard Theme" />
		<meta property="og:url" content="https://themes.getbootstrap.com/product/craft-bootstrap-5-admin-dashboard-theme" />
		<meta property="og:site_name" content="Keenthemes | Craft" />

        @include('layout.style')

    </head>
	<!--end::Head-->

    	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled aside-fixed aside-default-enabled">
       <!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
         @if(Session::has('flash_del'))

         <div class="position-fixed top-0 end-0 p-3 z-index-3">
        <div class="toast show "  role="alert" aria-live="assertive" aria-atomic="true">
         <div class="toast-header">
             <span class="svg-icon svg-icon-2 svg-icon-primary me-3"></span>
             <strong class="me-auto">Good job!</strong>

             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
         </div>
         <div class="toast-body">

             {{Session::get('flash_del')}}
         </div>
      </div>
         </div>
       @endif
       @if(Session::has('flash_danger'))

       <div class="position-fixed top-0 end-0 p-3 z-index-3">
       <div class="toast show "  role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="svg-icon svg-icon-2 svg-icon-primary me-3"></span>
            <strong class="me-auto">Error Deleting data !</strong>
            {{-- <small>11 mins ago</small> --}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{-- Hello, world! This is a toast message. --}}
            {{Session::get('flash_danger')}}
        </div>
     </div>
       </div>
      @endif
    <div class="page d-flex flex-row flex-column-fluid">
        @section('breadcrumb')
        <div class="toolbar" id="kt_toolbar">
            <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder my-1 fs-2">Dashboard</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-bold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted">dashboard</li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

            </div>
        </div>
   @endsection

        @include('layout.aside')
        @include('layout.header')

    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
        @include('layout.footerscripts')
