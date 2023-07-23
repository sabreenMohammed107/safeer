@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Order</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ url('/dashboard/admin/home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('users-orders.index') }}" class="text-muted text-hover-primary">Order</a>
                    </li>

                    <li class="breadcrumb-item text-dark">All</li>
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


            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#kt_ecommerce_add_product_advanced">Tours Details</a>
                    </li>
                    <!--end:::Tab item-->




                </ul>

                <div class="tab-content">
                    <!--begin::Tab pane-->

                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_advanced" role="tab-panel">

                        <!--begin::Input group-->
                        <div class="card-body pt-0 mb-5" style="background: #FFF">
                            <div class="fv-row w-100 flex-md-root">
                                <input type="hidden" value="{{ $order->id }}" id="order_id" name="order_id">
                                <label class="fs-6 fw-bold form-label mt-3">
                                    <option value="">Select Status..</option>
                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                </label>
                                <!--end::Label-->
                                <select required class="form-select form-select-solid " id="status_id" name="status_id"
                                    data-control="select2" data-placeholder="Select an option" required
                                    data-show-subtext="true" data-live-search="true">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ $order->status_id == $status->id ? 'selected' : '' }}>{{ $status->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--begin::Input group-->
                        </div>
                        @include('admin.users-orders.editTDetails')

                    </div>

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('users-orders.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->

                    </div>
                </div>
                <!--end::Main column-->

            </div>
            <!--end::Container-->
        </div>

        <!--end::Post-->
    @endsection
    @section('scripts')
        <script>
            $(document).ready(function() {

                $('#status_id').change(function() {
                    if ($(this).val() != '') {
                        var select = $(this).attr("id");
                        var value = $(this).val();

                        var trigger = $(this);
                        var _token = $('input[name="_token"]').val();
                        // alert("Second");
                        var order = $('#order_id').val();

                        $.ajax({
                            url: "{{ route('updateStatus') }}",
                            method: "post",
                            data: {
                                select: select,
                                value: value,
                                _token: _token,
                                order: order
                            },
                            success: function(result) {

                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                alert("xhr.responseText");
                                var err = eval("(" + xhr.responseText + ")");

                            }

                        })
                    }
                });
            });
            </script>
        @endsection
