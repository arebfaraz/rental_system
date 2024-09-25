<?php

namespace App\View\Components\Admin;

use App\Models\SupportTicket;
use Illuminate\View\Component;

class LatestSupportTicketsWidget extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string|\Illuminate\View\View
    {
        $latestSupportTickets = \App\Models\SupportTicket::query()
            ->with('user:id,name')
            ->latest()
            ->take(3)
            ->get();
        return view('components.admin.latest-support-tickets-widget', compact('latestSupportTickets'));
    }

    public function shouldRender(): bool
    {
        return SupportTicket::query()->count() > 0;

    }
}
