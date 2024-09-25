<?php

namespace App\Livewire\Admin\Invoice;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePaymentComponent extends Component
{
    public ?Payment $payment = null;

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.invoice.delete-payment-component');
    }

    #[On('deletePayment')]
    public function deletePayment($id): void
    {
        $this->payment = Payment::findOrFail($id);
        $this->dispatch('openDeletePaymentModal');
    }

    public function resetAll(): void
    {
        $this->payment = null;
    }

    public function submit(): void
    {
        DB::transaction(function () {
            //check if the payment has been paid
            if ($this->payment->status == PaymentStatusEnum::PAID) {
                $amount = $this->payment->amount;
                $this->payment->invoice->pay(amount: -$amount);

            }

            $this->payment->delete();

            $this->payment->invoice->updateStatus();
        });

        $this->dispatch('refreshTable');

    }
}
