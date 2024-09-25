<?php

namespace App\Livewire\Admin\WaterReadings;

use App\Models\WaterReading;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteWaterReadingComponent extends Component
{
    #[Locked]
    public $waterReadingId;

    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.admin.water-readings.delete-water-reading-component');
    }

    #[On('confirmDeletion')]
    public function confirm($id): void
    {

        $this->waterReadingId = $id;
        $this->dispatch('openModal');

    }

    public function deleteReading(): void
    {
        $waterReading = WaterReading::with('invoice.payments')->find($this->waterReadingId);

        DB::transaction(function () use ($waterReading) {
            $waterReading->invoice->payments()->delete();
            $waterReading->invoice()->delete();
            $waterReading->delete();
        });

        $this->dispatch('closeModal');


    }
}
