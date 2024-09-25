<?php

namespace App\Livewire\Admin\Invoice;

use App\Models\Invoice;
use App\Notifications\InvoicePaymentReminderNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class NotifyTenantPaymentComponent extends Component
{
    use LivewireAlert;

    public $invoiceId;

    public $invoice;
    public $tenant_name, $balance, $month_year, $tenant_phone;

    public function render(): Factory|View|Application
    {
        return view('livewire.admin.invoice.notify-tenant-payment-component');
    }

    #[On('notifyTenantPayment')]
    public function notifyTenantPayment($id): void
    {
        $this->invoiceId = $id;

        $this->invoice = Invoice::with('tenant')
            ->findOrFail($this->invoiceId);

        $this->tenant_name = $this->invoice->tenant->name;
        $this->balance = $this->invoice->balance_due;
        $this->tenant_phone = $this->invoice->tenant->phone;
        $this->month_year = $this->invoice->created_at->format('F Y');


        $this->dispatch('showNotifyTenantPaymentModal');

    }

    public function resetDetails(): void
    {
        $this->reset(['invoiceId', 'invoice', 'tenant_name', 'balance', 'month_year']);

    }


    public function submit(): void
    {
        $data = [
            'tenant_name' => $this->tenant_name,
            'balance' => $this->balance,
            'month_year' => $this->month_year,
            'invoice_url' => route('tenant.invoices.show', $this->invoiceId)
        ];

        $this->invoice->tenant->notify(new InvoicePaymentReminderNotification($data));

        $this->alert('success', __('Notification sent successfully to ') . $this->tenant_name);

        $this->dispatch('notificationSent');

    }

    public function notifyViaSms(): void
    {
        $message = 'Dear ' . $this->tenant_name . ', Your rent payment for ' . $this->month_year . ' is due. Kindly pay ' . $this->balance . ' to avoid penalties.';
        \App\Helpers\TextSMSGateway::sendSms($this->tenant_phone, $message);

        $this->alert('success', __('Notification sent via SMS successfully to ') . $this->tenant_name);

        $this->dispatch('notificationSent');

    }
}
