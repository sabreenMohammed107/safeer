@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Hotel Pricing</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Hotel Pricing</li>

                    <li class="breadcrumb-item text-dark">Prices</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->

        </div>
    </div>
@endsection

@section('content')
    <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('hotel-price.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Aside column-->

                <!--begin::Repeater-->
                <div id="kt_docs_repeater_advanced">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_advanced"
                            style="  min-width: 1000px; overflow-x: scroll; border: solid 1px #ccc">
                            @if ($roomCosts->count() > 0)
                            @foreach ($roomCosts as $index => $roomCost)
                            <div data-repeater-item>
                                <input type="hidden" name="room_type_costs_id" value="{{$roomCost->id}}" >
                                <div class="form-group mb-5" style="display:flex;">
                                    <div class="col-md-2">
                                        <label class="form-label"> Hotels:</label>
                                        <select class="form-select" name="hotel_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            <option value="">Select Hotel..</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}"  {{ $roomCost->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->hotel_enname }}</option>
                                            @endforeach


                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label"> Room Type:</label>
                                        <select class="form-select" name="room_type_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            <option value="">Select Room..</option>
                                            @foreach ($roomTypes as $type)
                                                <option value="{{ $type->id }}" {{ $roomCost->room_type_id == $type->id ? 'selected' : '' }} >{{ $type->en_room_type ?? '' }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label"> Basic Type:</label>
                                        <select class="form-select" name="food_beverage_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            @foreach ($foods as $food)
                                                <option value="{{ $food->id }}" {{ $roomCost->food_beverage_id == $food->id ? 'selected' : '' }} >{{ $food->food_bev_type ?? '' }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">From:</label>
                                        <input class="form-control" value="{{$roomCost->from_date}}" name="from_date" data-kt-repeater="datepicker"
                                            placeholder="Pick a date" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">to:</label>
                                        <input class="form-control" value="{{$roomCost->end_date}}" name="end_date" data-kt-repeater="datepicker"
                                            placeholder="Pick a date" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">single:</label>
                                        <input type="text" value="{{$roomCost->single_cost}}" name="single_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">double:</label>
                                        <input type="text" value="{{$roomCost->double_cost}}" name="double_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">triple:</label>
                                        <input type="text" value="{{$roomCost->triple_cost}}" name="triple_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Extra bed:</label>
                                        <input type="text" value="{{$roomCost->extra_bed_cost}}" name="extra_bed_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Free Child Age From:</label>
                                        <input type="text" value="{{$roomCost->child_free_age_from}}" name="child_free_age_from" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Free Child Age To:</label>
                                        <input type="text" value="{{$roomCost->child_free_age_to}}" name="child_free_age_to" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Age From:</label>
                                        <input type="text" value="{{$roomCost->child_age_from}}" name="child_age_from" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Age To:</label>
                                        <input type="text" value="{{$roomCost->child_age_to}}" name="child_age_to" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Cost:</label>
                                        <input type="text" value="{{$roomCost->child_age_cost}}" name="child_age_cost" class="form-control" />

                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                            <i class="la la-trash-o fs-3"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div data-repeater-item>
                                <div class="form-group mb-5" style="display:flex;">
                                    <div class="col-md-2">
                                        <label class="form-label"> Hotels:</label>
                                        <select class="form-select" name="hotel_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            <option value="">Select Hotel..</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}">{{ $hotel->hotel_enname }}</option>
                                            @endforeach


                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label"> Room Type:</label>
                                        <select class="form-select" name="room_type_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            <option value="">Select Room..</option>
                                            @foreach ($roomTypes as $type)
                                                <option value="{{$type->id}}">{{ $type->en_room_type ?? '' }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label"> Basic Type:</label>
                                        <select class="form-select" name="food_beverage_id" data-kt-repeater="select2"
                                            data-placeholder="Select an option">
                                            @foreach ($foods as $food)
                                                <option value="{{ $food->id }}">{{ $food->food_bev_type ?? '' }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">From:</label>
                                        <input class="form-control" name="from_date" data-kt-repeater="datepicker"
                                            placeholder="Pick a date" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">to:</label>
                                        <input class="form-control" name="end_date" data-kt-repeater="datepicker"
                                            placeholder="Pick a date" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">single:</label>
                                        <input type="text" name="single_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">double:</label>
                                        <input type="text" name="double_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">triple:</label>
                                        <input type="text" name="triple_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Extra bed:</label>
                                        <input type="text" name="extra_bed_cost" class="form-control" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Free Child Age From:</label>
                                        <input type="text" name="child_free_age_from" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Free Child Age To:</label>
                                        <input type="text" name="child_free_age_to" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Age From:</label>
                                        <input type="text" name="child_age_from" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Age To:</label>
                                        <input type="text" name="child_age_to" class="form-control" />

                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Paid Child Cost:</label>
                                        <input type="text" name="child_age_cost" class="form-control" />

                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                            <i class="la la-trash-o fs-3"></i>Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group pt-4">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            <i class="la la-plus"></i>Add
                        </a>
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-light-primary">
                            <span class="indicator-label">Save Data</span>

                        </button>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $('#kt_docs_repeater_advanced').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();

                // Re-init select2
                $(this).find('[data-kt-repeater="select2"]').select2();

                // Re-init flatpickr
                $(this).find('[data-kt-repeater="datepicker"]').flatpickr();

                // Re-init tagify
                new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                // Init select2
                $('[data-kt-repeater="select2"]').select2();

                // Init flatpickr
                $('[data-kt-repeater="datepicker"]').flatpickr();

                // Init Tagify
                new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
            }
        });
    </script>
@endsection
