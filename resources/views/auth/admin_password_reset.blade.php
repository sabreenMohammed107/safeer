<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Safer | Reset Password</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('dist/assets/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="{{ asset('dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-column flex-lg-row-auto bg-primary w-xl-600px positon-xl-relative">
                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                    <div class="w-50"
                        style=" position: absolute; left: 50%; top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
                        <div style="background-image: url({{ asset('img/logo.webp') }});background-repeat: no-repeat;background-size: cover;height:300px "></div>
                    </div>
                    <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px"
                        style="background-image: url(assets/media/illustrations/sigma-1/17.webp)"></div>
                </div>
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">Reset Password</h1>
                                <div class="text-gray-400 fw-bold fs-4">Choose a new password for your account</div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p class="mb-1">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <input class="form-control form-control-lg form-control-solid" type="email"
                                    name="email" value="{{ $email ?? old('email') }}" autocomplete="off" required autofocus />
                            </div>

                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">New Password</label>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password" autocomplete="new-password" required minlength="8" />
                            </div>

                            <div class="fv-row mb-10">
                                <label class="form-label fs-6 fw-bolder text-dark">Confirm New Password</label>
                                <input class="form-control form-control-lg form-control-solid" type="password"
                                    name="password_confirmation" autocomplete="new-password" required minlength="8" />
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">Reset Password</span>
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Main-->
    <script src="{{ asset('dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dist/assets/js/scripts.bundle.js') }}"></script>
</body>
<!--end::Body-->

</html>
