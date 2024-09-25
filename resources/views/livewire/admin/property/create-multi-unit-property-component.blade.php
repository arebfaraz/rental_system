<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-inner-group">
            <div class="card-inner">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="title nk-block-title">{{ __('Property Details')}}</h5>
                        <p>{{ __('Add common information like Name, Type, Electricity ID etc')}} </p>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-4">
                            <div class="form-group">

                                <label class="form-label" for="pname">{{ __('Property Name')}} <span
                                        class="text-danger">*</span></label>


                                <input type="text"
                                       class="form-control @error('propertyName') is-invalid @enderror "
                                       id="pname" wire:model="propertyName">

                                @error('propertyName')
                                <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <!--col-->
                        <div class="col-xxl-3 col-md-3">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('Property Type')}}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="form-control-wrap">
                                    <div class="form-control-select">
                                        <select class="form-control @error('type') is-invalid @enderror"
                                                id="propertyType" wire:model="property_type"
                                                data-placeholder="{{ __('Select property type')}}">
                                            @foreach($propertyTypes as $item=>$index)
                                                <option value="{{ $index }}">{{ $index }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @error('type')
                                <p class="text-danger fs-12px">
                                    {{ $message }}
                                </p>
                                @enderror


                            </div>
                        </div>
                        <!--col-->
                        <div class="col-xxl-3 col-md-5">
                            <div class="form-group">
                                <label class="form-label" for="default-06">{{ __('Select Landlord')}}</label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-wrap">
                                        <x-tom-single-select
                                            wire:model="landlord"
                                            :options="$landlords"
                                            placeholder="Select Landlord"/>
                                        @error('landlord')
                                        <span class="text-danger">
                                             {{ $message }}
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="form-text">
                                        {{ __('Leave blank if units are multi-owned.')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-xxl-3 col-md-4">
                            <div class="form-group">
                                <label class="form-label">{{ __('Electricity ID')}}</label>
                                <input type="text"
                                       class="form-control @error('electricity_id') is-invalid @enderror "
                                       id="electricity_id" wire:model="electricity_id">

                                @error('electricity_id')
                                <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror


                                <div class="form-text">
                                    <span>{{ __('Enter the electricity ID of the property')}}</span>
                                </div>

                            </div>
                        </div>
                        <!--col-->
                        <div class="col-xxl-9 col-md-8">
                            <div class="form-group">
                                <label class="form-label"
                                       for="description">{{__('Property Description')}}</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" wire:model="description" id="description">
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                </div>
            </div><!-- .card-inner -->
            <div class="card-inner">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="title nk-block-title">{{ __('Property Address')}}</h5>
                        <p>{{ __('Add location where property is located')}} </p>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="row gy-4">

                        <div class="col-xxl-3 col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('Address Line 1')}} <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="form-control-group">
                                    <input type="text"
                                           class="form-control @error('address1') is-invalid @enderror "
                                           name="street_address" id="street-address"
                                           autocomplete="address1"
                                           placeholder="{{ __('Street address')}}" wire:model="address1">

                                    @error('address1')
                                    <p class="text-danger fs-12px">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="form-group">

                                <div class="form-label-group">
                                    <label class="form-label">{{ __('Address 2')}} <span
                                            class="text-danger">*</span></label>
                                </div>

                                <div class="form-control-group">
                                    <input type="text" class="form-control" id="address2"
                                           placeholder="{{ __('Address 2,e.g apartment,suite,floor')}}"
                                           autocomplete="address2"
                                           wire:model="address2">
                                </div>
                            </div>
                        </div><!-- .col -->


                        <div class="col-xxl-3 col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('City')}} <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="form-control-group">
                                    <input type="text"
                                           class="form-control @error('city') is-invalid @enderror"
                                           autocomplete="city"
                                           id="locality" name="locality" wire:model="city">
                                    @error('city')
                                    <p class="text-danger fs-12px">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('State')}}</label>
                                </div>
                                <div class="form-control-group">
                                    <input type="text" class="form-control" id="state" name="state"
                                           wire:model="state">
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-xxl-3 col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('Country')}} <span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="form-control-group">
                                    <input type="text"
                                           class="form-control @error('country') is-invalid @enderror"
                                           autocomplete="country"
                                           id="country" name="country" wire:model="country">

                                    @error('country')
                                    <p class="text-danger fs-12px">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                        </div><!-- .col -->


                        <!--col-->
                    </div>
                    <!--row-->
                </div>
            </div><!-- .card-inner -->
            {{--            <div class="card-inner">--}}
            {{--                <div class="nk-block-head nk-block-head-sm">--}}

            {{--                    <div class="nk-block-between">--}}
            {{--                        <div class="nk-block-head-content me-3">--}}
            {{--                            <h5 class="title nk-block-title">{{ __('Add Units')}}</h5>--}}
            {{--                            <p>{{ __('Defines whether to attach multiple house units to this property. This step is optional--}}
            {{--                                and units can be added at a later time by navigating to the Houses section.Note that--}}
            {{--                                below step will only generate houses which has same landlord,same property type and same rent and--}}
            {{--                                agency commission.For more control over units,please add them manually by navigating to the Houses section.')}}--}}
            {{--                            </p>--}}
            {{--                        </div>--}}

            {{--                        <div class="nk-block-head-content">--}}
            {{--                            <div class="custom-control custom-switch">--}}
            {{--                                <input--}}
            {{--                                    type="checkbox"--}}
            {{--                                    wire:model="shouldGenerateUnits"--}}
            {{--                                    class="custom-control-input"--}}
            {{--                                    id="customSwitch1">--}}
            {{--                                <label class="custom-control-label fw-bolder" for="customSwitch1">{{ __('Generate Units')}}</label>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}

            {{--                </div>--}}

            {{--                @if($shouldGenerateUnits)--}}
            {{--                    <div class="nk-block">--}}
            {{--                        <div class="row gy-4">--}}
            {{--                            <div class="col-md-8">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label">{{ __('Select Owner')}}</label>--}}
            {{--                                    <div class="form-control-wrap">--}}
            {{--                                        <div class="form-control-select">--}}
            {{--                                            <select class="form-control @error('property_id') is-invalid @enderror"--}}
            {{--                                                    wire:model="landlord">--}}
            {{--                                                <option value="">{{ __('Select Landlord')}}</option>--}}
            {{--                                                @foreach($landlords as $landlord)--}}
            {{--                                                    <option value="{{ $landlord->id }}">{{ $landlord->name }}--}}
            {{--                                                        ({{ $landlord->email }})--}}
            {{--                                                    </option>--}}
            {{--                                                @endforeach--}}
            {{--                                            </select>--}}
            {{--                                            @error('property_id')--}}
            {{--                                            <span class="invalid-feedback" role="alert">--}}
            {{--                        <strong>{{ $message }}</strong>--}}
            {{--                    </span>--}}
            {{--                                            @enderror--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="email">{{ __('Prefix')}}</label>--}}
            {{--                                    <input type="text" class="form-control @error('prefix') is-invalid @enderror"--}}
            {{--                                           id="email"--}}
            {{--                                           wire:model="prefix">--}}
            {{--                                    <span class="form-text">{{ __('Sets the first part of name')}}</span>--}}
            {{--                                    @error('prefix')--}}
            {{--                                    <span class="invalid-feedback" role="alert">--}}
            {{--                    <strong>{{ $message }}</strong>--}}
            {{--                </span>--}}
            {{--                                    @enderror--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="phone-no">{{ __('Total Houses')}}</label>--}}
            {{--                                    <input type="number" class="form-control" id="phone-no"--}}
            {{--                                           wire:model="numberOfHouses">--}}
            {{--                                    <span class="form-text">{{ __('No of houses to create')}}</span>--}}
            {{--                                    @error('numberOfHouses')--}}
            {{--                                    <span class="invalid-feedback" role="alert">--}}
            {{--                    <strong>{{ $message }}</strong>--}}
            {{--                </span>--}}
            {{--                                    @enderror--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="start-number">{{ __('Numbering From')}}</label>--}}
            {{--                                    <input type="number" class="form-control" id="start-number"--}}
            {{--                                           wire:model="startNumber">--}}
            {{--                                    <span class="form-text">{{ __('Starts from number')}}</span>--}}
            {{--                                    @error('startNumber')--}}
            {{--                                    <span class="invalid-feedback" role="alert">--}}
            {{--                    <strong>{{ $message }}</strong>--}}
            {{--                </span>--}}
            {{--                                    @enderror--}}

            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="suffix">{{ __('Suffix')}}</label>--}}
            {{--                                    <input type="text" class="form-control" id="suffix" wire:model="suffix">--}}
            {{--                                    <span class="form-text">{{ __('Sets the last part of name')}}</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="lead-address">{{ __('Rent')}}</label>--}}
            {{--                                    <input type="text" class="form-control @error('baseRent') is-invalid @enderror"--}}
            {{--                                           id="lead-address"--}}
            {{--                                           wire:model="baseRent">--}}
            {{--                                    <span class="form-text">{{ __('Defines base rent for all units')}}</span>--}}
            {{--                                    @error('baseRent')--}}
            {{--                                    <span class="invalid-feedback" role="alert">--}}
            {{--                    <strong>{{ $message }}</strong>--}}
            {{--                </span>--}}
            {{--                                    @enderror--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label">{{ __('House Type')}}</label>--}}
            {{--                                    <div class="form-control-wrap">--}}
            {{--                                        <div class="form-control-select">--}}
            {{--                                            <select class="form-control @error('type') is-invalid @enderror"--}}
            {{--                                                    wire:model="baseType">--}}
            {{--                                                <option value="">{{ __('House type')}}</option>--}}
            {{--                                                @foreach($types as $houseType)--}}
            {{--                                                    <option value="{{ $houseType }}">{{ $houseType }}</option>--}}
            {{--                                                @endforeach--}}
            {{--                                            </select>--}}

            {{--                                            @error('type')--}}
            {{--                                            <span class="invalid-feedback" role="alert">--}}
            {{--                                <strong>{{ $message }}</strong>--}}
            {{--                            </span>--}}
            {{--                                            @enderror--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="lead-name">{{ __('Commission')}}</label>--}}

            {{--                                    <div class="form-control-wrap">--}}
            {{--                                        <div class="form-text-hint">--}}
            {{--                                            <span class="overline-title">%</span>--}}
            {{--                                        </div>--}}
            {{--                                        <input type="number"--}}
            {{--                                               class="form-control @error('commission') is-invalid @enderror"--}}
            {{--                                               wire:model="commission"--}}
            {{--                                               id="lead-name">--}}
            {{--                                        @error('commission')--}}
            {{--                                        <span class="invalid-feedback" role="alert">--}}
            {{--                        <strong>{{ $message }}</strong>--}}
            {{--                    </span>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}

            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-md-4">--}}
            {{--                                <div class="form-group">--}}
            {{--                                    <label class="form-label" for="lead-name">{{ __('Electricity ID')}}</label>--}}
            {{--                                    <div class="form-control-wrap">--}}
            {{--                                        <input type="text"--}}
            {{--                                               class="form-control @error('electricity_id') is-invalid @enderror"--}}
            {{--                                               wire:model="electricity_id"--}}
            {{--                                               id="lead-name">--}}
            {{--                                        @error('electricity_id')--}}
            {{--                                        <span class="invalid-feedback" role="alert">--}}
            {{--                        <strong>{{ $message }}</strong>--}}
            {{--                    </span>--}}
            {{--                                        @enderror--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-12 bg-white-1 p-3 m-2">--}}
            {{--                                {{ __('Example of house name/no based on parameters provided:')}}--}}
            {{--                                <strong>{{ $prefix .''.$startNumber.''.$suffix }}</strong>--}}
            {{--                            </div>--}}

            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                @endif--}}
            {{--            </div><!-- .card-inner -->--}}

            <div class="card-inner">
                <div class="nk-block">
                    <div class="row gy-4">

                        @if(session()->has('error'))
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            </div>

                        @endif

                        @if($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="col-12">
                            <x-button loading="{{__('Saving...')}}" wire:click="submit" class="btn btn-lg btn-primary">
                                {{__('Add Property')}}
                            </x-button>
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                </div>
            </div><!-- .card-inner -->
        </div>
    </div><!-- .card -->
</div><!-- .nk-block -->
