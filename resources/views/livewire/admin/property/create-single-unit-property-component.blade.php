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
                        <div class="col-xxl-3 col-md-4">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label">{{ __('Property Type')}}<span
                                            class="text-danger">*</span></label>
                                </div>
                                <div class="form-control-wrap">
                                    <div class="form-control-select">
                                        <select class="form-control @error('type') is-invalid @enderror"
                                                id="propertyType" wire:model="type"
                                                data-placeholder="{{ __('Select property type')}}">
                                            <option label="Select type"></option>
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
                        <div class="col-xxl-3 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="default-06">{{ __('Select Landlord')}}</label>
                                <div class="form-control-wrap ">

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
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-xxl-3 col-md-4">
                            <div class="form-group">

                                <label class="form-label" for="pname">{{ __('Property Rent')}}</label>


                                <input type="number"
                                       class="form-control @error('rent') is-invalid @enderror "
                                       id="pname" wire:model="rent">


                                @error('rent')
                                <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-xxl-3 col-md-4">

                            <div class="form-group">
                                <label class="form-label" for="commission">{{ __('Agency Commission')}}</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="number" wire:model="commission"
                                               class="form-control @error('commission') is-invalid @enderror">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="commission">%</span>
                                        </div>
                                    </div>

                                    <div class="form-text">
                                        <span>{{ __('Enter the commission you will charge the landlord')}}</span>
                                    </div>

                                    @error('commission')
                                    <span class="invalid-feedback">
                                                        {{ $message }}
                                                    </span>
                                    @enderror


                                </div>
                            </div>
                        </div>


                        <div class="col-xxl-12 col-md-12">
                            <div class="form-group">
                                <label class="form-label"
                                       for="cp1-profile-description">{{__('Property Description')}}</label>
                                <div class="form-control-wrap">
                                    <textarea type="text" class="form-control" id="pname" wire:model="description">
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


            <div class="card-inner">
                <div class="nk-block">
                    <div class="row gy-4">

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

                        <!--col-->
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
