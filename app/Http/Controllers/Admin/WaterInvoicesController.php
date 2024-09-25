<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaterBillInvoice;
use Yajra\DataTables\DataTables;

class WaterInvoicesController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.read_water_invoice')), 403);
        if (\request()->ajax()) {
            $invoices = WaterBillInvoice::query()
                ->with(['tenant:id,name', 'property:id,name', 'house:id,name', 'waterReading:id,consumption'])
                ->latest('id');


            return DataTables::of($invoices)
                ->addColumn('actions', function ($invoice) {
                    return view('admin.invoice.water.actions', compact('invoice'));
                })
                ->editColumn('created_at', function ($invoice) {
                    return $invoice->invoice_date?->format('d M, Y');
                })
                ->addColumn('total_amount', function ($invoice) {
                    return @setting('currency_symbol') . ' ' . number_format($invoice->amount, 2);
                })
                ->editColumn('status', function ($invoice) {
                    return view('admin.invoice.rent.partials.status', compact('invoice'));
                })
                ->addColumn('property', function ($invoice) {
                    return $invoice->property?->name;
                })
                ->addColumn('house', function ($invoice) {
                    return $invoice->house?->name;
                })
                ->addColumn('units_consumed', function (WaterBillInvoice $invoice) {
                    return $invoice->waterReading?->consumption . ' units';
                })
                ->addColumn('tenant', function ($invoice) {
                    return $invoice->tenant->name;
                })
                ->rawColumns(['actions', 'status', 'units_consumed'])
//                ->setRowClass('nk-tb-item')
                ->make(true);

        }
        return view('admin.invoice.water.index');

    }

    public function show($id)
    {
        abort_unless(auth()->user()->can(config('permission.permissions.read_water_invoice')), 403);
        $invoice = WaterBillInvoice::with('waterReading')
            ->findOrFail($id);
        return view('admin.invoice.water.show', compact('invoice'));

    }

    public function print($id)
    {

    }

    public function edit($id)
    {

    }
}
