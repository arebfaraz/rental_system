<?php

namespace App\Livewire\Admin\Invoice;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPaymentComponent extends Component
{
    use WithFileUploads;

    public ?Payment $payment = null;

    public $amount;
    public $paid_at;
    public $payment_method = 'CASH';
    public $reference_number;
    public $recorded_by;
    public $receipt;
    public $payment_status = PaymentStatusEnum::PENDING;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
        'paid_at' => 'required|date',
        'payment_method' => 'required|string',
        'reference_number' => 'nullable|string',
        'receipt' => 'nullable|file|max:4096|mimes:jpeg,png,jpg,pdf',
    ];


    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        $paymentMethods = PaymentMethod::pluck('name');
        return view('livewire.admin.invoice.edit-payment-component', compact('paymentMethods'));
    }


    #[On('editPayment')]
    public function editPayment($id): void
    {
        $this->payment = Payment::findOrFail($id);
        $this->amount = $this->payment->amount;
        $this->paid_at = $this->payment->paid_at->toDateString();
        $this->payment_method = $this->payment->payment_method;
        $this->reference_number = $this->payment->reference_number;
        $this->payment_status = $this->payment->status;

        $this->dispatch('openEditPaymentModal');

    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $initial_amount = $this->payment->amount;

            $this->payment->amount = $this->amount;
            $this->payment->paid_at = $this->paid_at;
            $this->payment->payment_method = $this->payment_method;
            $this->payment->reference_number = $this->reference_number;
            //update receipt if exists
            if ($this->receipt) {
                $this->payment->receipt = Storage::url(Storage::putFile('public/receipts', $this->receipt));
            }
            $this->payment->save();


            if ($initial_amount != $this->amount && $this->payment->status == PaymentStatusEnum::PAID) {
                $paymentDiff = $this->amount - $initial_amount;
                $tenantOverpayment = $this->payment->invoice?->tenant?->overpayment;

                if ($tenantOverpayment?->amount > 0) {

                    $amountToUpdate = max(0, $tenantOverpayment->amount + $paymentDiff);

                    $tenantOverpayment->update(['amount' => $amountToUpdate]);

                }

                $this->payment->invoice->update(
                    [
                        'paid_amount' => $this->payment->invoice->paid_amount + $paymentDiff
                    ]
                );


                $this->payment->invoice->pay($paymentDiff);
            }


            $this->payment->invoice->updateStatus();
        });

        $this->dispatch('refreshTable');

    }

    public function resetAll(): void
    {
        $this->payment = null;
        $this->reset(['amount', 'paid_at', 'payment_method', 'reference_number', 'receipt', 'payment_status']);

    }


}
