<?php

namespace App\View\Components\Admin;

use App\Models\Payment;
use Closure;
use Flowframe\Trend\Trend;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RentCollectionsGraphWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $count = Payment::query()
            ->whereBetween('paid_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->approved()
            ->count();
        $sum = Payment::query()
            ->whereBetween('paid_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->approved()
            ->sum('amount');
        $rentCollectedTrends = Trend::query(
            Payment::query()
                ->approved()
        )
            ->dateColumn('paid_at')
            ->between(
                start: now()->subMonth()->startOfMonth(),
                end: now()->subMonth()->endOfMonth()
            )
            ->perDay()
            ->sum('amount');
        return view('components.admin.rent-collections-graph-widget', compact('rentCollectedTrends', 'count', 'sum'));
    }
}
