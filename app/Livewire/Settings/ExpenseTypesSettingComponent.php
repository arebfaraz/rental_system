<?php

namespace App\Livewire\Settings;

use App\Models\ExpenseType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ExpenseTypesSettingComponent extends Component
{
    use LivewireAlert;

    public $typeId, $name;
    public $is_new = true;


    protected $rules = [
        'name' => 'required',
    ];


    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        $names = ExpenseType::all();
        return view('livewire.settings.expense-types-setting-component', compact('names'));
    }

    public function deleteMethod($id): void
    {
        ExpenseType::destroy($id);
    }

    public function updateMethod($id): void
    {

        $this->is_new = false;
        $this->typeId = $id;
        $type = ExpenseType::findOrFail($id);
        $this->name = $type->name;

        $this->dispatch('showNameModal');

    }

    public function submit(): void
    {
        $this->validate();

        ExpenseType::updateOrCreate(['id' => $this->typeId], ['name' => $this->name]);

        $this->reset(['name']);
        $this->is_new = true;
        $this->alert('success', __('Expense category has been added'));

        $this->dispatch('closeModal');
    }

    #[On('resetFields')]
    public function resetFields(): void
    {
        $this->reset('name', 'typeId');
        $this->is_new = true;
    }


}
