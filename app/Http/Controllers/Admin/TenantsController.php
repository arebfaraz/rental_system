<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\DataTables;

class TenantsController extends Controller
{

    public function index()
    {

        abort_unless(auth()->user()->can(config('permission.permissions.read_tenant')), 403);

        //get users with role tenant

        if (\request()->ajax()) {
            $tenants = User::query()
                ->withoutTrashed()
                ->role('tenant')
                ->with('leases.property', 'leases.house')
                ->latest('id');

            return DataTables::of($tenants)
                ->addIndexColumn()
                ->addColumn('actions', function ($tenant) {
                    return view('admin.tenants.partials.actions', compact('tenant'))->render();
//                    return '<a href="' . route('admin.tenants.show', $tenant->id) . '" class="btn btn-sm btn-primary">View</a>';
                })
                ->editColumn('created_at', function ($tenant) {
                    return $tenant->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($tenant) {
                    return $tenant->updated_at->diffForHumans();
                })
                ->addColumn('leased_houses', function ($tenant) {
                    //get all houses leased by tenant,if house is not leased,return property name,else return property name and house name
                    $leased_houses = $tenant->leases->map(function ($lease) {
                        return $lease->house ? $lease->property->name . ' - ' . $lease->house->name : $lease->property->name;
                    });
                    return view('admin.tenants.partials.assigned_rooms', compact('leased_houses'));

                })
                ->rawColumns(['actions', 'leased_houses'])
                ->setRowClass('nk-tb-item')
                ->make(true);
        }
        return view('admin.tenants.index');
    }

    public function create()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.create_tenant')), 403);
        return view('admin.tenants.create');
    }

    public function show($id)
    {
        abort_unless(auth()->user()->can(config('permission.permissions.read_tenant')), 403);
        $tenant = User::query()
            ->withTrashed()
            ->role('tenant')
            ->with('all_leases.property', 'all_leases.house')
            ->findOrFail($id);
        return view('admin.tenants.show', compact('tenant'));
    }

    public function edit($id)
    {
        abort_unless(auth()->user()->can(config('permission.permissions.update_tenant')), 403);
        $tenant = User::withoutTrashed()
            ->role('tenant')
            ->findOrFail($id);
        return view('admin.tenants.edit', compact('tenant'));
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()->can(config('permission.permissions.delete_tenant')), 403);
        $tenant = User::findOrFail($id);
        $tenant->forceDelete();
        return redirect()->back()->with('success', 'Tenant has been deleted successfully');
    }

    public function export()
    {
        abort_unless(auth()->user()->can('view tenant'), 403);
    }
}
