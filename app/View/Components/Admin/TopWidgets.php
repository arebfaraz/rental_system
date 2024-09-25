<?php

namespace App\View\Components\Admin;

use App\Enums\HouseStatusEnum;
use App\Enums\PropertyStatusEnum;
use App\Models\Lease;
use App\Models\Payment;
use App\Models\Property;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopWidgets extends Component
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
        $totalProperties = \App\Models\Property::count();
        $totalPropertiesForMoveIn = Property::where('is_multi_unit', false)
            ->where('status', PropertyStatusEnum::VACANT->value)
            ->count();
        $totalHouses = \App\Models\House::count();
        $vacantHouses = \App\Models\House::where('status', HouseStatusEnum::VACANT->value)->count();
        $totalLeases = Lease::count();
        $terminatedLeases = Lease::onlyTrashed()->count();
        $paymentsThisMonth = Payment::query()
            ->approved()
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $approvedPayments = Payment::query()
            ->approved()
            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');

        return view('components.admin.top-widgets', compact('totalProperties', 'totalPropertiesForMoveIn', 'totalHouses', 'vacantHouses', 'totalLeases', 'terminatedLeases', 'paymentsThisMonth', 'approvedPayments'));
    }

    public function shouldRender(): true
    {
        //Do the auth check here
        //for now just return true
        return true;

    }
}
