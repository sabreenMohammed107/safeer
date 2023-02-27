@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Tours</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="../dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Tours</li>

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
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('tours.update', $tour->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Aside column-->
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">


                    <!--begin::Thumbnail settings-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Banner</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body text-center pt-0">
                             <!--begin::Image input wrapper-->
                        <div class="card-body text-center pt-0">
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                                style="background-image: url('{{ asset('uploads/tours') }}/{{ $tour->banner }}')">
                                <div class="image-input-wrapper w-150px h-150px"
                                    style="background-image: url(' {{ asset('uploads/tours') }}/{{ $tour->banner }}')">

                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Edit-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="banner" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit-->

                            </div>
                            <!--end::Image input-->
                        </div>
                        <!--end::Image input wrapper-->
                            <!--end::Image input-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Thumbnail settings-->
                </div>
                <!--end::Aside column-->

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        {{-- <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Room Type</a>
                        </li> --}}
                        <!--end:::Tab item-->

                        <!--begin:::Tab item-->
                        {{-- <li class="nav-item">
                           <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                               href="#kt_ecommerce_add_days_advanced">Days</a>
                       </li> --}}
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> En Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" required name="en_name" class="form-control mb-2"
                                                    placeholder=" En name" value="{{ $tour->en_name }}" />


                                            </div>
                                            <!--end::Input-->

                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="required form-label"> Ar Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="ar_name" class="form-control mb-2"
                                                    placeholder=" Ar name" value="{{ $tour->ar_name }}" />


                                            </div>
                                        </div>
                                        <!--end::Input-->

                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select Country..</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid dynamic"
                                                    data-control="select2" data-placeholder="Select an option" required
                                                    data-show-subtext="true" data-live-search="true" id="country"
                                                    data-dependent="sub">
                                                    <option value=""></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            @if ($tour->city) {{ $tour->city->country_id == $country->id ? 'selected' : '' }} @endif >{{ $country->en_country }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <?php

                                            $citiesCat = App\Models\City::where('country_id', $tour->city->country_id)->get();
                                            ?>
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <option value="">Select City..</option>
                                                    {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid" name="city_id"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-show-subtext="true" data-live-search="true" id="sub">
                                                    <option value="">select....</option>
                                                    @foreach ($citiesCat as $city)
                                                        <option value="{{ $city->id }}"
                                                            {{ $tour->city_id == $city->id ? 'selected' : '' }}>
                                                            {{ $city->en_city }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



   <!--begin::Input group-->
   <div class="fv-row w-100 flex-md-root">
    <label class="fs-6 fw-bold form-label mt-3">
        <option value="">Select Type..</option>
        {{-- <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Interviewer who conducts the meeting with the interviewee"></i> --}}
    </label>
    <!--end::Label-->
    <select required class="form-select form-select-solid " name="tour_type_id"
        data-control="select2" data-placeholder="Select an option" required
        data-show-subtext="true" data-live-search="true" id="type"
       >
        @foreach ($types as $type)
            <option value="{{ $type->id }}"
                {{ $tour->tour_type_id  == $type->id ? 'selected' : '' }} >{{ $type->en_name }}
            </option>
        @endforeach
    </select>
</div>
<!--begin::Input group-->

                                            <div class="fv-row w-100 flex-md-root">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Add Features</span>
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="Interviewer who conducts the meeting with the interviewee"></i>
                                                </label>
                                                <!--end::Label-->
                                                <select required class="form-select form-select-solid" name="features[]"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-allow-clear="true" multiple="multiple">
                                                    <option></option>
                                                    @foreach ($features as $feature)
                                                    <option value="{{ $feature->id }}"
                                                        @foreach ($tourFeatures as $sublist) {{ $sublist->pivot->feature_id == $feature->id ? 'selected' : '' }} @endforeach>
                                                        {{ $feature->en_feature }}
                                                    </option>
                                                @endforeach

                                                </select>
                                            </div>
                                            <!--end::Input group-->


                                            <!--rooms -->
                                              <!--begin::Input group-->
                                               <div class="fv-row w-100 flex-md-root">

                                                <label class="fs-6 fw-bold form-label mt-3">
                                                    <span class="required">Add Tags</span>
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="Interviewer who conducts the meeting with the interviewee"></i>
                                                </label>

                                                <select required class="form-select form-select-solid" name="tags[]"
                                                    data-control="select2" data-placeholder="Select an option"
                                                    data-allow-clear="true" multiple="multiple">
                                                    <option></option>

                                                    @foreach ($tags as $tag)

                                                        <option value="{{ $tag->id }}"

                                                            @foreach ($tagsTour as $sublist) {{ $sublist->tour_id  == $tour->id ? 'selected' : '' }} @endforeach>
                                                            {{ $tag->en_tag }}
                                                        </option>

                                                            @endforeach
                                                </select>

                                                </select>
                                            </div>
                                            <!--end::Input group-->

                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="form-label">En Overview</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="tox-target" id="kt_docs_tinymce_basic2" name="en_overview"
                                                placeholder="Type  En Overview">{{ $tour->en_overview }}</textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class="form-label">Ar Overview</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="tox-target" id="kt_docs_tinymce_basic" name="ar_overview"
                                                placeholder="Type  Ar Overview">{{ $tour->ar_overview }}</textarea>
                                            <!--end::Editor-->

                                        </div>
 <!--begin::Input group-->
 <div class="fv-row w-100 flex-md-root">
    <!--begin::Label-->
    <label class="form-label">En details</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="tox-target" id="kt_docs_tinymce_basic3" name="en_tours_details"
        placeholder="Type  En details">{{ $tour->en_tours_details }}</textarea>
    <!--end::Editor-->

</div>
<!--end::Input group-->
<!--begin::Input group-->
<div class="fv-row w-100 flex-md-root">
    <!--begin::Label-->
    <label class="form-label">Ar details</label>
    <!--end::Label-->
    <!--begin::Editor-->
    <textarea class="tox-target" id="kt_docs_tinymce_basic4" name="ar_tours_details"
        placeholder="Type  Ar details">{{ $tour->ar_tours_details }}</textarea>
    <!--end::Editor-->

</div>

<!--begin::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">En brief</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="en_notes"
                                                placeholder=" En brief">{{ $tour->en_notes }}</textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">Ar brief</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="ar_notes"
                                                placeholder="Ar brief">{{ $tour->ar_notes }}</textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">En language</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="tour_en_language"
                                                placeholder=" En language">{{ $tour->tour_en_language }}</textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div>
                                            <!--begin::Label-->
                                            <label class="form-label">Ar language</label>
                                            <!--end::Label-->
                                            <!--begin::Editor-->
                                            <textarea class="form-control form-control-solid" rows="3" name="tour_ar_language"
                                                placeholder=" Ar language">{{ $tour->tour_ar_language }}</textarea>
                                            <!--end::Editor-->

                                        </div>
                                        <!--end::Input group-->

                                                                    <!--begin::Input group-->
                                                                    <div>
                                                                        <!--begin::Label-->
                                                                        <label class="form-label">En Days</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Editor-->
                                                                        <textarea class="form-control form-control-solid" rows="3" name="tour_en_days"
                                                                            placeholder=" En Days">{{ $tour->tour_en_days }}</textarea>
                                                                        <!--end::Editor-->

                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div>
                                                                        <!--begin::Label-->
                                                                        <label class="form-label">Ar Days</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Editor-->
                                                                        <textarea class="form-control form-control-solid" rows="3" name="tour_ar_days"
                                                                            placeholder=" Ar Days">{{ $tour->tour_ar_days }}</textarea>
                                                                        <!--end::Editor-->

                                                                    </div>
                                                                    <!--end::Input group-->


                                        <div class="d-flex flex-wrap gap-5">
                                            <!--begin::Input group-->
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class="required form-label">Person Cost</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input required type="number" min="1"
                                                    name="tour_person_cost" class="form-control mb-2"
                                                    placeholder="tour_person_cost" value="{{ $tour->tour_person_cost }}" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">duration</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="duration" class="form-control mb-2"
                                                    placeholder="duration" value="{{ $tour->duration }}" />
                                                <!--end::Input-->
                                            </div>

                                        </div>



                                        <div class="d-flex flex-wrap gap-5">
                                            <div class="fv-row w-100 flex-md-root">
                                                <label class=" form-label">Url Vedio</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="url" name="tour_vedio" class="form-control mb-2"
                                                    placeholder="tour_vedio" value="{{ $tour->tour_vedio }}" />
                                                <!--end::Input-->
                                            </div>


                                            <!--begin::checkbox-->

                                            <div class="d-flex flex-wrap gap-5 mt-4">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="active[]"
                                                            value="1" id="flexSwitchDefault"
                                                            {{ $tour->active == 1 ? ' checked' : '' }} />
                                                        <label class="form-check-label" for="flexSwitchDefault">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                        </div>
                                        <!--end:checkbox-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                                <!--end::General options-->
                            </div>
                        </div>


                    {{-- end all tabs --}}

                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{ route('tours.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
 </div>
                <!--end::Main column-->
            </form>
        </div>
        </div>
        <!--end::Container-->
    {{-- </div> --}}
    <!--end::Post-->
@endsection
@section('scripts')
<script src="{{ asset('dist/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>

    <script>
          $(".dPick").flatpickr();
        $("#kt_datepicker_1").flatpickr();
        $("#kt_datepicker_2").flatpickr();
        $("#kt_datepicker_8").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        $("#kt_datepicker_7").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });


        $(document).ready(function() {

            $('.dynamic').change(function() {

                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();

                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ route('dynamicdependentCat.fetch') }}",
                        method: "POST",
                        data: {
                            select: select,
                            value: value,
                            _token: _token
                        },
                        success: function(result) {

                            $('#sub').html(result);
                        }

                    })
                }
            });




        });
    </script>
     <script src='https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'></script>


     <script>
        $(function () {
           $('input').on('change', function (event) {

              var $element = $(event.target);
              var $container = $element.closest('.example');

              if (!$element.data('tagsinput'))
                 return;

              var val = $element.val();
              if (val === null)
                 val = "null";
              var items = $element.tagsinput('items');

              $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
              $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));


           }).trigger('change');
        });
    //     $(document).ready(function() {
    //         alert('ll')
    //            var path = "{{ route('autocompleteKeywords') }}";

    // $( "#keywords" ).autocomplete({
    //     source: function( request, response ) {
    //       $.ajax({
    //         url: path,
    //         type: 'GET',
    //         dataType: "json",
    //         data: {
    //            search: request.term
    //         },
    //         success: function( data ) {
    //            response( data );
    //         }
    //       });
    //     },
    //     select: function (event, ui) {
    //        $('#keywords').val(ui.item.label);
    //        console.log(ui.item);
    //        return false;
    //     }
    //   });
    // });


      // tinymce.init(options2);
      tinymce.init({
            selector: '#kt_docs_tinymce_basic',
            menubar: false,

            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });
        tinymce.init({
            selector: '#kt_docs_tinymce_basic2',
            menubar: false,
            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });

        tinymce.init({
            selector: '#kt_docs_tinymce_basic3',
            menubar: false,

            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });

        tinymce.init({
            selector: '#kt_docs_tinymce_basic4',
            menubar: false,

            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            plugins: "advlist autolink link image lists charmap print preview code"
        });
     </script>

@endsection
