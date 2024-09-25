@extends('layouts.main')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Update Property')}}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Update property details,including status,owner,rent among others')}}</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <livewire:admin.property.update-property-component :property-id="$id"/>
                </div>
            </div>
        </div>
    </div>

@endsection


