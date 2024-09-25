<?php

namespace App\Livewire\Settings;

use App\Models\Location;
use App\Models\PaymentMethod;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LocationDetailsComponent extends Component
{
    use LivewireAlert;

    public $typeId, $name;
    public $is_new = true;


    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];

    }

    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        $names = Location::all();
        return view('livewire.settings.location-details-component', compact('names'));
    }

    public function deleteLocation($id): void
    {
        Location::destroy($id);
    }

    public function updateLocation($id): void
    {
        $this->is_new = false;
        $this->typeId = $id;
        $type = Location::findOrFail($id);
        $this->name = $type->name;

        $this->dispatch('showNameModal');

    }

    public function submit(): void
    {
        $this->validate();

        Location::updateOrCreate(['id' => $this->typeId], ['name' => $this->name]);

        $this->reset(['name']);
        $this->is_new = true;
        $this->alert('success', __('Location has been added.'));

        $this->dispatch('closeModal');
    }

    public function resetFields(): void
    {
        $this->reset('name', 'typeId');
        $this->is_new = true;
    }

}
