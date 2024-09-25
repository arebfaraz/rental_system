<?php

namespace App\Livewire\Settings;

use App\Models\PaymentMethod;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentMethodsSettingComponent extends Component
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

    public function render()
    {
        $names = PaymentMethod::all();
        return view('livewire.settings.payment-methods-setting-component', compact('names'));
    }

    public function deleteMethod($id)
    {
        PaymentMethod::destroy($id);

    }

    public function updateMethod($id)
    {

        $this->is_new = false;
        $this->typeId = $id;
        $type = PaymentMethod::findOrFail($id);
        $this->name = $type->name;

        $this->dispatch('showNameModal');

    }

    public function submit()
    {
        $this->validate();

        PaymentMethod::updateOrCreate(['id' => $this->typeId], ['name' => $this->name]);

        $this->reset(['name']);
        $this->is_new = true;
        $this->alert('success', __('New payment method has been added'));

        $this->dispatch('closeModal');
    }

    #[On('resetFields')]
    public function resetFields(): void
    {
        $this->reset('name', 'typeId');
        $this->is_new = true;
    }
}
