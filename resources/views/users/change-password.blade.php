@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Change Password</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Change Password</li>


                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection

@section('content')
    <!--begin::Post-->
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Category-->
            <div class="card card-flush">
                <div class="col-md-6 offset-3 pt-4">
                    <h3 class="text-center">Change Password</h3>
                    @if($errors->any())
                    {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                    @endif
                    @if(Session::get('error') && Session::get('error') != null)
                    <div style="color:red">{{ Session::get('error') }}</div>
                    @php
                    Session::put('error', null)
                    @endphp
                    @endif
                    @if(Session::get('success') && Session::get('success') != null)
                    <div style="color:green">{{ Session::get('success') }}</div>
                    @php
                    Session::put('success', null)
                    @endphp
                    @endif
                    <form class="form" action="{{ route('postChangePassword') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
