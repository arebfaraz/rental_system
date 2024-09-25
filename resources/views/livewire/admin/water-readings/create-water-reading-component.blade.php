<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross-sm"></em>
        </a>
        <div class="modal-body modal-body-md">
            <h5 class="modal-title">
                Record Water Reading
            </h5>
            <form action="#" class="mt-2">
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="add-name">Property</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="add-display-name" wire:model.live="propertyId">
                                    <option value="">Select Property</option>
                                    @foreach($properties as $property)
                                        <option value="{{$property->id}}">{{ $property->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="add-display-name">House</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="house-select" wire:model.live="houseId">
                                    <option value="">Select House</option>
                                    @foreach($houses as $house)
                                        <option value="{{ $house->id }}">{{ $house->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('Current Reading Date')}}
                                <x-form.required/>

                            </label>
                            <x-form.form-date wire:model="readingDate" id="readingDate"/>
                            @error('readingDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="current-tenant">Current Tenant</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="current-tenant"
                                       value="{{ $currentTenant?->name }}"
                                       readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="previous-reading">Previous Reading</label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="form-control" id="previous-reading"
                                       wire:model.live="previousReading">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="current-reading">Current Reading</label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="form-control" id="current-reading"
                                       wire:model.live="currentReading">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="cost-per-unit">Cost Per Unit</label>
                            <div class="form-control-wrap">
                                <input type="number" min="0" class="form-control" id="cost-per-unit"
                                       wire:model.live="costPerUnit">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="units-consumed">Units Consumed</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="units-consumed"
                                       value="{{ $unitsConsumed }}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="total-cost">Total Cost For Units</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="total-cost"
                                       value="{{ $totalCost }}"
                                       readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h5 class="modal-title">
                            Record Water Reading
                        </h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">{{ __('Invoice Date')}}
                                <x-form.required/>
                            </label>
                            <x-form.form-date wire:model="invoiceDate" id="invoice_date"/>
                            @error('invoiceDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                {{ __('Due Date')}}
                            </label>
                            <x-form.form-date wire:model="dueDate" id="dueDate"/>
                            @error('dueDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">{{ __('Invoice Notes')}}                            </label>
                            <textarea class="form-control" rows="3" wire:model="invoiceNotes"></textarea>
                        </div>
                    </div>


                    @if($errors->any())
                      <div class="col-12">
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>

                    @endif

                    <div class="col-12">
                        <div class="form-group">
                            <x-button wire:click="submit" type="button" class="btn btn-primary">
                                {{ __('Record Water Reading') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@script
<script>
    $('#addReadingModal').on('hidden.bs.modal', function () {
        $wire.resetFields();
    });
</script>
@endscript
