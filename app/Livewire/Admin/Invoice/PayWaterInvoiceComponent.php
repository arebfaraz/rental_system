<?php

namespace App\Livewire\Admin\Invoice;

use App\Enums\PaymentStatusEnum;
use App\Models\PaymentMethod;
use App\Models\WaterBillInvoice;
use App\Models\WaterPayment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PayWaterInvoiceComponent extends Component
{
    use LivewireAlert;

    use WithFileUploads;

    public ?WaterBillInvoice $invoice;


    public $amount;
    public $paid_at;
    public $payment_method = 'CASH';
    public $reference_number;
    public $recorded_by;
    public $receipt;

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
        return view('livewire.admin.invoice.pay-water-invoice-component', compact('paymentMethods'));
    }

    #[On('payInvoice')]
    public function payInvoice($id): void
    {

        $this->invoice = WaterBillInvoice::findOrFail($id);
        $this->amount = $this->invoice->amount;
        $this->dispatch('showPayInvoiceModal');
    }

    public function submit()
    {
        $this->validate();

        if ($this->receipt) {
            $receipt = Storage::url(Storage::putFile('public/receipts', $this->receipt));
        } else {
            $receipt = null;
        }
        DB::transaction(function () use ($receipt) {


            WaterPayment::create([
                'amount' => $this->amount,
                'paid_at' => $this->paid_at,
                'payment_method' => $this->payment_method,
                'reference_number' => $this->reference_number,
                'tenant_id' => $this->invoice->tenant_id,
                'payment_receipt' => $receipt,
                'water_bill_invoice_id' => $this->invoice->id,
            ]);

            $this->invoice->update([
                'status' => PaymentStatusEnum::PAID->value,
            ]);


        });

        $message = 'Payment for water invoice #' . $this->invoice->id . ' recorded successfully!';

        return redirect()->route('admin.water-invoice.index')
            ->with('success', $message);

    }
}
