@extends('layouts.main')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Houses')}}</h3>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                       data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                                <div>
                                                    <livewire:exports.houses-export-component/>

                                                </div>
                                            </li>

                                            @can(config('permission.permissions.read_house'))
                                                <li class="nk-block-tools-opt">
                                                    <a href="{{ route('admin.houses.create') }}"
                                                       class="btn btn-primary">
                                                        <em class="icon ni ni-plus"></em>
                                                        <span>{{ __('Add Houses')}}</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->


                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->


                    @if(session()->has('success'))
                        <div class="alert alert-pro alert-success alert-icon alert-dismissible">
                            <em class="icon ni ni-check-circle"></em>
                            <strong>{{ session('success') }}</strong>
                            <button class="close" data-bs-dismiss="alert"></button>
                        </div>

                    @endif
                    <div class="nk-block">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">

                                <div class="row g-1 mb-2">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select class="form-control" id="house-status-filter">
                                                        <option value="">{{ __('Filter Status')}}</option>
                                                        <option
                                                            value="{{ \App\Enums\HouseStatusEnum::VACANT->value }}">
                                                            {{ __('Vacant')}}
                                                        </option>

                                                        <option
                                                            value="{{ \App\Enums\HouseStatusEnum::OCCUPIED->value }}">
                                                            {{ __('Rented')}}
                                                        </option>
                                                        <option
                                                            value="{{ \App\Enums\HouseStatusEnum::UNDER_MAINTENANCE->value }}">
                                                            {{ __('Under Maintenance')}}
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select class="form-control" id="property-filter">
                                                        <option value="">{{ __('Filter By Building')}}</option>
                                                        @foreach($properties as $key => $name)
                                                            <option value="{{ $key}}">
                                                                {{ $name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-3 ms-auto">
                                        <div class="form-group">

                                            <div class="form-control-wrap ">
                                                <input type="search" class="form-control" id="search-input"
                                                       placeholder="{{ __('Type in to search')}}">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <table class="datatable table dt-responsive nowrap nk-tb-list nk-tb-ulist is-compact"
                                       id="tenants-list">

                                    {{--                                <table class="datatable nowrap" id="tenants-list">--}}
                                    <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th data-priority="2" class="nk-tb-col nk-tb-col-check">
                                            #
                                        </th>
                                        <th data-priority="1" class="nk-tb-col">
                                            <span class="sub-text">{{ __('Unit Name')}}</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">{{ __('Property')}}</span>
                                        </th>
                                        <th class="nk-tb-col">
                                            <span class="sub-text">{{ __('Type')}}</span>
                                        </th>
                                        <th data-priority="3" class="nk-tb-col">
                                            <span
                                                class="sub-text">{{ __('Status')}}</span>
                                        </th>

                                        <th class="nk-tb-col">
                                            {{ __('Rent Details')}}
                                        </th>
                                        <th class="nk-tb-col">
                                            {{ __('Landlord')}}
                                        </th>

                                        <th class="nk-tb-col">
                                            {{ __('Tenant')}}
                                        </th>

                                        <th data-priority="1" class="nk-tb-col nk-tb-col-tools text-end">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modalDeleteHouse" wire:ignore.self>
        <livewire:admin.house.delete-house-component/>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            const dom_normal = '<"row justify-between g-2"<"col-7 col-sm-4 text-start"><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"l>>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';

            let oTable = $("#tenants-list").DataTable(
                {
                    processing: true,
                    serverSide: true,
                    dom: dom_normal,
                    "bInfo": true,
                    "bLengthChange": false,
                    {{--ajax: '{!! route('admin.houses.index') !!}',--}}
                    ajax: {
                        url: '{!! route('admin.houses.index') !!}',
                        data: function (d) {
                            d.status_filter = $("#house-status-filter").val();
                            d.property_filter = $("#property-filter").val();
                        }
                    },
                    autoWidth: false,
                    responsive: {
                        details: {
                            renderer: function (api, rowIdx) {

                                var data = api.cells(rowIdx, ':hidden').eq(0).map(function (cell) {
                                    var header = $(api.column(cell.column).header());

                                    return '<tr>' +
                                        '<td class="fw-bold">' +
                                        header.text() + ':' +
                                        '</td> ' +
                                        '<td>' +
                                        api.cell(cell).data() +
                                        '</td>' +
                                        '</tr>';
                                }).toArray().join('');

                                return data ?
                                    $('<table/>').append(data) :
                                    false;
                            },

                        }
                    },

                    language: {
                        search: "",
                        searchPlaceholder: "Type in to Search",
                        lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                        info: "_START_ -_END_ of _TOTAL_",
                        infoEmpty: "0",
                        infoFiltered: "( Total _MAX_  )",
                        paginate: {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Prev"
                        }
                    },

                    createdRow: function (row, data, dataIndex) {
                        $(row).find('td:eq(0)').addClass('nk-tb-col');
                        $(row).find('td:eq(1)').addClass('nk-tb-col');
                        $(row).find('td:eq(2)').addClass('nk-tb-col');
                        $(row).find('td:eq(3)').addClass('nk-tb-col');
                        $(row).find('td:eq(4)').addClass('nk-tb-col');
                        $(row).find('td:eq(5)').addClass('nk-tb-col');
                        $(row).find('td:eq(6)').addClass('nk-tb-col');
                        $(row).find('td:eq(7)').addClass('nk-tb-col');
                        $(row).find('td:eq(8)').addClass('nk-tb-col nk-tb-col-tools');
                        // $(row).find('td:eq(5)').addClass('nk-tb-col');
                        // $(row).find('td:eq(6)').addClass('nk-tb-col');
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name', name: 'name', searchable: true},
                        {data: 'property', name: 'property.name', searchable: true},
                        {data: 'type', name: 'type', searchable: true},
                        {data: 'status', name: 'status', searchable: false, orderable: false},
                        {data: 'rent_status', name: 'rent_status', searchable: false, orderable: false},
                        {data: 'landlord', name: 'landlord.name', searchable: true},
                        {data: 'tenant', name: 'lease.tenant.name', searchable: true},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false},
                    ],
                    drawCallback: function () {
                        $(".dataTables_paginate > .pagination").addClass("mt-3")
                    }
                });

            $('#search-input').on('input', function () {
                oTable.search($(this).val()).draw();
            });

            $('#house-status-filter').on('change', function () {
                oTable.ajax.reload(null, false);
            });

            $('#property-filter').on('change', function () {
                oTable.ajax.reload(null, false);
            });

            //livewire on showDeleteModal event ,open the modal
            window.Livewire.on('showDeleteModal', () => {
                $('#modalDeleteHouse').modal('show');
            });


            //livewire on hideDeleteModal event ,close the modal
            window.Livewire.on('refreshTable', () => {
                $('#modalDeleteHouse').modal('hide');
                oTable.ajax.reload(null, false);
            });


        });
    </script>

@endpush
