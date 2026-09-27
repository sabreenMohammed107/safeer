@extends('layout.main')

@section('breadcrumb')
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder my-1 fs-2">Team</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-bold fs-base my-1">
                    <li class="breadcrumb-item text-muted">Team</li>
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
            <!--begin::Category-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <input type="text" data-kt-ecommerce-category-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Field" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <a href="{{ route('teams.create') }}" class="btn btn-primary">Add Team Member</a>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="w-25px" title="Drag to reorder"></th>
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_category_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-100px">Photo</th>
                                <th class="min-w-150px">En Name</th>
                                <th class="min-w-150px">Ar Name</th>
                                <th class="min-w-150px">Job Title</th>
                                <th class="min-w-70px">Order</th>
                                <th class="min-w-100px text-end">Featured</th>
                                <th class="min-w-100px text-end">Active</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($rows as $row)
                                <tr data-team-id="{{ $row->id }}">
                                    <!--begin::Drag handle-->
                                    <td class="text-center">
                                        <span class="team-drag-handle" title="Drag to reorder">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="2" cy="2" r="1.5" />
                                                <circle cx="8" cy="2" r="1.5" />
                                                <circle cx="2" cy="8" r="1.5" />
                                                <circle cx="8" cy="8" r="1.5" />
                                                <circle cx="2" cy="14" r="1.5" />
                                                <circle cx="8" cy="14" r="1.5" />
                                            </svg>
                                        </span>
                                    </td>
                                    <!--end::Drag handle-->
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <td>
                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <span class="symbol-label"
                                                style="background-image:url({{ asset('uploads/teams') }}/{{ $row->image }});"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-bolder">{{ $row->en_name }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bolder">{{ $row->ar_name }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $row->en_job }}</span>
                                    </td>
                                    <td>
                                        <span class="team-order-value">{{ $row->order }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($row->featured)
                                            <div class="badge badge-light-primary">Featured</div>
                                        @else
                                            <div class="badge badge-light">Standard</div>
                                        @endif
                                    </td>
                                    <td class="text-end pe-0">
                                        @if ($row->active)
                                            <div class="badge badge-light-success">active</div>
                                        @else
                                            <div class="badge badge-light-danger">Not active</div>
                                        @endif
                                    </td>
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('teams.edit', $row->id) }}"
                                                    class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3"
                                                    data-kt-ecommerce-category-filter="delete_row">Delete</a>

                                                <form id="delete_{{ $row->id }}"
                                                    action="{{ route('teams.destroy', $row->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" value=""></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <!--end::Action=-->
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

    <style>
        .team-drag-handle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            color: #a1a5b7;
            cursor: grab;
            touch-action: none;
        }
        .team-drag-handle:active {
            cursor: grabbing;
        }
        #kt_ecommerce_category_table tbody tr.team-row-chosen {
            background-color: #f1faff;
        }
        #kt_ecommerce_category_table tbody tr.team-row-ghost {
            opacity: 0.4;
        }
        #kt_ecommerce_category_table tbody tr.team-row-disabled .team-drag-handle {
            cursor: not-allowed;
            opacity: 0.4;
        }
        .team-reorder-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
            min-width: 260px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        // Same deferred-init pattern as the Tours admin page: categories.js
        // (shared by nearly every admin index page) builds its DataTable via
        // KTUtil.onDOMContentLoaded, not inline, so this code must use the
        // same hook to run *after* that DataTable actually exists.
        KTUtil.onDOMContentLoaded(function () {
            var csrfToken = "{{ csrf_token() }}";
            var reorderUrl = "{{ route('teams.reorder') }}";
            var tableEl = document.getElementById('kt_ecommerce_category_table');
            if (!tableEl) {
                return;
            }
            var tbody = tableEl.querySelector('tbody');

            function showReorderToast(message, isError) {
                var wrapper = document.createElement('div');
                wrapper.className = 'toast show team-reorder-toast';
                wrapper.setAttribute('role', 'alert');
                wrapper.innerHTML =
                    '<div class="toast-header">' +
                        '<strong class="me-auto">' + (isError ? 'Error' : 'Success') + '</strong>' +
                        '<button type="button" class="btn-close" aria-label="Close"></button>' +
                    '</div>' +
                    '<div class="toast-body' + (isError ? ' text-danger' : '') + '">' + message + '</div>';

                document.body.appendChild(wrapper);
                wrapper.querySelector('.btn-close').addEventListener('click', function () {
                    wrapper.remove();
                });
                window.setTimeout(function () {
                    wrapper.remove();
                }, 4000);
            }

            function renumberOrderColumn() {
                tbody.querySelectorAll('tr').forEach(function (row, index) {
                    var span = row.querySelector('.team-order-value');
                    if (span) {
                        span.textContent = index + 1;
                    }
                });
            }

            function currentRowOrder() {
                return Array.prototype.map.call(tbody.querySelectorAll('tr'), function (row) {
                    return parseInt(row.getAttribute('data-team-id'), 10);
                });
            }

            function setSaving(isSaving) {
                sortable.option('disabled', isSaving || searchIsActive());
                tbody.classList.toggle('team-row-disabled', isSaving);
            }

            function searchIsActive() {
                var searchInput = document.querySelector('[data-kt-ecommerce-category-filter="search"]');
                return !!(searchInput && searchInput.value.trim().length > 0);
            }

            // Show every team member on one page — dragging across
            // DataTables' own pagination isn't supported, so pagination is
            // turned off instead of trying to reorder a partially-hidden list.
            if (window.jQuery && jQuery.fn.DataTable && jQuery.fn.DataTable.isDataTable(tableEl)) {
                var dt = jQuery(tableEl).DataTable();
                dt.page.len(-1).draw(false);
            }

            var sortable = Sortable.create(tbody, {
                handle: '.team-drag-handle',
                animation: 150,
                ghostClass: 'team-row-ghost',
                chosenClass: 'team-row-chosen',
                onEnd: function (evt) {
                    if (evt.oldIndex === evt.newIndex) {
                        return;
                    }

                    var previousOrder = currentRowOrder().slice();
                    var movedId = previousOrder.splice(evt.newIndex, 1)[0];
                    previousOrder.splice(evt.oldIndex, 0, movedId);

                    renumberOrderColumn();
                    setSaving(true);

                    var newOrder = currentRowOrder();

                    fetch(reorderUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ order: newOrder })
                    })
                        .then(function (response) {
                            return response.json().then(function (data) {
                                return { ok: response.ok, data: data || {} };
                            });
                        })
                        .then(function (result) {
                            if (result.ok && result.data.status === 'success') {
                                showReorderToast(result.data.message || 'Team order updated successfully', false);
                                window.setTimeout(function () {
                                    window.location.reload();
                                }, 700);
                            } else {
                                throw new Error(result.data.message || 'Could not save the new order.');
                            }
                        })
                        .catch(function (error) {
                            var rows = Array.prototype.slice.call(tbody.querySelectorAll('tr'));
                            var rowsById = {};
                            rows.forEach(function (row) {
                                rowsById[row.getAttribute('data-team-id')] = row;
                            });
                            previousOrder.forEach(function (id) {
                                tbody.appendChild(rowsById[id]);
                            });
                            renumberOrderColumn();
                            showReorderToast(error.message || 'Could not save the new order. Please try again.', true);
                            setSaving(false);
                        });
                }
            });

            var searchInput = document.querySelector('[data-kt-ecommerce-category-filter="search"]');
            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    sortable.option('disabled', searchIsActive());
                });
            }
        });
    </script>
@endsection
