<?php

namespace App\Livewire\Admin\House;

use App\Enums\HouseStatusEnum;
use App\Models\House;
use App\Models\HouseType;
use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateHouseComponent extends Component
{
    use WithFileUploads;

    public $name, $rent, $type, $property_id, $description, $landlord, $electricity_id, $commission;
    public $house_status;
    public array $landlords = [];

    public function getRules(): array
    {
        return [
            'name' => 'required',
            'rent' => 'required|numeric|min:0',
            'type' => 'nullable|string',
            'property_id' => 'required',
            'description' => 'nullable|string',
            'landlord' => 'required',
            'commission' => 'required|numeric|min:0,max:100',
            'house_status' => ['required', Rule::in([0, 2])],
        ];
    }

    public function mount(): void
    {
        $this->house_status = HouseStatusEnum::VACANT->value;
        $this->landlords = User::role('landlord')
            ->select(['id', 'name', 'email'])
            ->get()
            ->map(function ($landlord) {
                return [
                    'text' => $landlord->name,
                    'value' => $landlord->id
                ];
            })->toArray();
    }

    public function render(): Factory|View|Application
    {
        $types = HouseType::pluck('name');
        $properties = Property::where('is_multi_unit', 1)->pluck('name', 'id');

        return view('livewire.admin.house.create-house-component', compact('types', 'properties'));
    }

    //when property_id changes, get the landlord of the property
    public function updatedPropertyId($value): void
    {
        $property = Property::find($value);
        $this->landlord = $property->landlord_id ?? null;
        $this->commission = $property->commission ?? null;
        $this->electricity_id = $property->electricity_id ?? null;
    }

    public function submit()
    {
        $this->validate();

        House::create([
            'name' => $this->name,
            'rent' => $this->rent,
            'type' => $this->type,
            'property_id' => $this->property_id,
            'description' => $this->description,
            'landlord_id' => $this->landlord,
            'electricity_id' => $this->electricity_id,
            'commission' => $this->commission,
        ]);

        return redirect()->route('admin.houses.index')
            ->with('success', __('House created successfully'));
    }
}
