<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Flowframe\Trend\Trend;

class HomeController extends Controller
{
    public function index()
    {
        $rentCollectedTrends = Trend::query(
            Payment::query()
        )
            ->dateColumn('paid_at')
            ->between(
                start: now()->subMonth()->startOfMonth(),
                end: now()->subMonth()->endOfMonth()
            )
            ->perDay()
            ->sum('amount');
        return view('admin.home.index', compact('rentCollectedTrends'));
    }

    public function notifications()
    {
        return view('admin.home.notifications');
    }

}
