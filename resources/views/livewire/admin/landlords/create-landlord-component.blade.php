<div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner-group">
                <div class="card-inner">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="title nk-block-title">{{ __('Personal Info')}}</h5>
                            <p>{{ __('Add common information like Name, Email etc')}} </p>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="full-name">{{ __('Full Name')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="full-name" wire:model="name">
                                        @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="email">{{ __('Email Address')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" wire:model="email">
                                        @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="phone">{{ __('Phone Number')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" wire:model="phone">
                                        @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="phone">{{ __('Password')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" wire:model="password">
                                        @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="identity_no">{{ __('Identity Number')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                               class="form-control @error('identity_no') is-invalid @enderror"
                                               id="identity_no" wire:model="identity_no">
                                        @error('identity_no')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Identity Document')}}</label>
                                    <div class="form-control-wrap">

                                        <input type="file"
                                               class="form-control @error('identity_document') is-invalid @enderror"
                                               id="nid" wire:model="identity_document">

                                        @error('identity_document')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-xxl-5 col-md-8">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Address')}}</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                               class="form-control @error('address') is-invalid @enderror"
                                               id="nid" wire:model="address">
                                        @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
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
                            <h5 class="title nk-block-title">{{ __('Next Of Kin')}}</h5>
                            <p>{{ __('Details of landlord\'s next of kin.')}} </p>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row gy-4">
                            <!--col-->
                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Kin Name')}}</label>
                                    <input type="text" class="form-control" id="kin_name"
                                           wire:model="kin_name">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Kin Phone Number')}}</label>
                                    <input type="tel" class="form-control" id="weight"
                                           wire:model="kin_phone">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-xxl-3 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Kin Identity Number')}}</label>
                                    <input type="text" class="form-control" id="bp"
                                           wire:model="kin_identity">
                                </div>
                            </div>
                            <!--col-->
                            <div class="col-xxl-6 col-md-8">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Relationship With Tenant')}}</label>
                                    <input type="text" class="form-control" id="pulse"
                                           wire:model="kin_relationship">
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
                            <h5 class="title nk-block-title">{{ __('Landlord Logo')}}</h5>
                            <p>{{ __('If provided,it will be displayed on all rental invoices whose properties/houses are owned by this landlord')}} </p>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row gy-4">
                            <!--col-->
                            <div class="col-xxl-12 col-md-12">
                                <div class="form-group">
                                    <x-filepond wire:model="logo"/>
                                </div>
                            </div>
                        </div>
                        <!--row-->
                    </div>
                </div><!-- .card-inner -->


                <div class="card-inner">
                    <div class="nk-block-head">
                        {{--                        <div class="nk-block-head-content">--}}
                        {{--                            <h5 class="title nk-block-title">{{ __('Welcome Email Notification')}}</h5>--}}
                        {{--                            <p>{{ __('Define whether landlords should receive welcome notification to set up their password')}} </p>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="nk-block">
                        <div class="row">
                            {{--                            <div class="col-md-12">--}}
                            {{--                                <div class="custom-control custom-checkbox ml-3">--}}
                            {{--                                    <input type="checkbox" value="true" class="custom-control-input" id="customCheck1"--}}
                            {{--                                           wire:model="shouldSendWelcomeEmail">--}}
                            {{--                                    <label class="custom-control-label" for="customCheck1">--}}
                            {{--                                        {{ __('Send welcome emails to landlord to set up password ?')}}--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <!--Show all error messages if there is any validation errors in livewire component-->
                            @if ($errors->any())
                                <div class="alert alert-danger mt-2 mb-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session()->has('error'))
                                <div class="alert alert-error mt-2 mb-2">
                                    {{ session('error') }}
                                </div>

                            @endif


                            <div class="col-12 mt-4">
                                <div class="float-end">
                                    <x-button wire:click="submit" loading="{{__('Creating...')}}" class="btn-primary">
                                        {{ __('Create Landlord') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card-inner -->
            </div>
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
