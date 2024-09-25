<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaterReading;
use Illuminate\Http\Request;

class WaterReadingController extends Controller
{
    public function __invoke(Request $request)
    {
        abort_unless(auth()->user()->can(config('permission.permissions.read_water_reading')), 403);
        if (request()->ajax()) {
            $readings = WaterReading::latest();
            return \DataTables::of($readings)
                ->addIndexColumn()
                ->addColumn('actions', function ($reading) {
                    return view()->make('admin.water_readings.actions', compact('reading'))->render();
                })
                ->editColumn('reading_date', function ($reading) {
                    return $reading->reading_date->toDateString();
                })
                ->addColumn('property', function ($reading) {
                    return $reading->property?->name ?? '';
                })
                ->addColumn('house', function ($reading) {
                    return $reading->house?->name ?? '';
                })
                ->addColumn('tenant', function ($reading) {
                    return $reading->tenant?->name ?? '';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.water_readings.index');
    }
}
