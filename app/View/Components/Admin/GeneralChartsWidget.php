<?php

namespace App\View\Components\Admin;

use App\Models\Lease;
use App\Models\User;
use Closure;
use Flowframe\Trend\Trend;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GeneralChartsWidget extends Component
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
        $expensesThisWeek = \App\Models\Expense::query()
            ->whereBetween('incurred_on', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('amount');
        $expensesThisMonth = \App\Models\Expense::query()
            ->whereBetween('incurred_on', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');

        $usersCount = \App\Models\User::count();
        $terminatedLeasesCount = \App\Models\Lease::onlyTrashed()->count();

        //trends
        $usersRegistrationTrends = Trend::model(User::class)
            ->between(
                start: now()->subMonths(6),
                end: now(),
            )
            ->perMonth()
            ->count();

        $expensesTrends = Trend::model(\App\Models\Expense::class)
            ->dateColumn('incurred_on')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('amount');

        $terminatedLeaseTrends = Trend::query(
            Lease::onlyTrashed()
        )
            ->dateColumn('deleted_at')
            ->between(
                start: now()->subMonths(6),
                end: now(),
            )
            ->perMonth()
            ->count();


        return view('components.admin.general-charts-widget', [
            'expensesThisWeek' => $expensesThisWeek,
            'expensesThisMonth' => $expensesThisMonth,
            'usersCount' => $usersCount,
            'terminatedLeasesCount' => $terminatedLeasesCount,
            'usersRegistrationTrends' => $usersRegistrationTrends,
            'expensesTrends' => $expensesTrends,
            'terminatedLeaseTrends' => $terminatedLeaseTrends
        ]);
    }
}
