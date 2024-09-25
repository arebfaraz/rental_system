<?php

namespace App\Livewire\Admin\WaterReadings;

use App\Models\House;
use App\Models\Property;
use App\Models\WaterReading;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class CreateWaterReadingComponent extends Component
{

    public $properties = [];
    public $houses = [];
    public $previousReading = 0;
    public $currentReading = 0;
    public $unitsConsumed = 0;
    public $readingDate;
    public $costPerUnit = 0;
    public $totalCost = 0;
    public $currentTenant;

    public $propertyId;
    public $houseId;

    public $invoiceDate, $dueDate, $invoiceNotes;

    public function mount(): void
    {
        $this->currentTenant = null;
        $this->properties = Property::select(['name', 'id', 'is_multi_unit'])->get();

    }

    public function updatedPropertyId($value): void
    {
        if (empty($value) || $value == '') {
            $this->houses = [];
            $this->currentTenant = null;
            $this->previousReading = 0;
            return;
        }
        $property = Property::with(['houses', 'lease.tenant:id,name'])->find($value);

        if (!$property) {
            $this->houses = [];
            $this->currentTenant = null;
            $this->previousReading = 0;

            return;
        }

        if ($property->is_multi_unit) {
            $this->houses = $property->houses;
            $this->previousReading = 0;
            $this->currentTenant = null;
            $this->houseId = null;

        } else {
            $this->houses = [];
            $this->previousReading = WaterReading::query()
                ->where('property_id', $property->id)
                ->whereNull('house_id')
                ->latest('reading_date')
                ->first()
                ->current_reading ?? 0;

            $this->currentTenant = $property?->lease?->tenant;
        }
    }

    public function updatedHouseId($value): void
    {
        if (empty($value) || $value == '') {
            $this->currentTenant = null;
            $this->previousReading = 0;
            return;
        }
        $house = House::with(['latestWaterReading', 'lease'])->find($value);
        if (!$house) {
            $this->currentTenant = null;
            $this->previousReading = 0;
            return;
        }
        $this->currentTenant = $house->lease?->tenant;
        $this->previousReading = $house->latestWaterReading?->current_reading ?? 0;

    }

    public function updatedPreviousReading(): void
    {
        $this->calculateCost();

    }

    public function updatedCurrentReading(): void
    {
        $this->calculateCost();

    }

    public function updatedCostPerUnit(): void
    {
        $this->calculateCost();

    }


    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.water-readings.create-water-reading-component');
    }

    private function calculateCost(): void
    {
        $_previousReading = $this->previousReading ?? 0;
        $_currentReading = $this->currentReading ?? 0;
        $_costPerUnit = $this->costPerUnit ?? 1;

        $this->unitsConsumed = max(0, $_currentReading - $_previousReading);

        $this->totalCost = $this->unitsConsumed * $_costPerUnit;


    }

    public function submit(): void
    {
        //validate
        $this->validate([

            'propertyId' => 'required',
            'houseId' => 'nullable',
            'previousReading' => 'required|numeric|min:0',
            'currentReading' => 'required|numeric|min:0|gte:previousReading',
            'costPerUnit' => 'required',
            'totalCost' => 'required',
            'readingDate' => 'required|date',
            'invoiceDate' => 'required|date',
            'dueDate' => 'nullable|date',
        ]);

        DB::transaction(function () {
            $reading = WaterReading::create([
                'reading_date' => $this->readingDate,
                'house_id' => $this->houseId,
                'property_id' => $this->propertyId,
                'current_reading' => $this->currentReading,
                'previous_reading' => $this->previousReading,
                'tenant_id' => $this->currentTenant?->id,
                'consumption' => $this->unitsConsumed,
                'cost_per_unit' => $this->costPerUnit,
                'total_cost' => $this->totalCost,
                'recorded_by' => auth()->user()->id,
            ]);

            $reading->invoice()->create([
                'invoice_date' => $this->invoiceDate,
//                'due_date' => $this->dueDate ?? Carbon::now()->addDays(30),
                'notes' => $this->invoiceNotes,
                'amount' => $this->totalCost,
                'tenant_id' => $this->currentTenant?->id,
                'house_id' => $this->houseId,
                'property_id' => $this->propertyId,
            ]);
        });

        $this->dispatch('closeModal');

    }

    public function resetFields(): void
    {
        $this->currentTenant = null;
        $this->propertyId = null;
        $this->houseId = null;
        $this->previousReading = 0;
        $this->currentReading = 0;
        $this->unitsConsumed = 0;
        $this->costPerUnit = 0;
        $this->totalCost = 0;
        $this->readingDate = '';
        $this->invoiceNotes = '';
        $this->invoiceDate = '';
        $this->dueDate = '';

    }
}
