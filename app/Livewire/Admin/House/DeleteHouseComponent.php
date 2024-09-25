<?php

namespace App\Livewire\Admin\House;

use App\Models\House;
use App\Models\Lease;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteHouseComponent extends Component
{

    use LivewireAlert;

    public $house_id;


    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.house.delete-house-component');
    }

    #[On('deleteHouse')]
    public function deleteHouse($id): void
    {
        $this->house_id = $id;
        //emit event to show modal
        $this->dispatch('showDeleteModal');
    }

    public function submit(): void
    {

        //get lease associated with house and delete them
        $lease = Lease::where('house_id', $this->house_id)->first();
        $house = House::findOrFail($this->house_id);


        DB::transaction(
            function () use ($lease, $house) {
                $lease?->delete();
                $house->delete();
            }
        );

        $this->alert('success', __('House deleted successfully'));
        $this->dispatch('refreshTable');
        $this->reset('house_id');

    }
}
