<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    //construct

    public function index()
    {
        abort_unless(auth()->user()->can('manage roles'), 403);
        $roles = Role::query()
            ->whereNotIn('name', ['admin', 'landlord', 'tenant'])
            //with count of permissions
            ->withCount('permissions')
            ->get();

        return view('admin.roles.index', compact('roles'));


    }


    public function create()
    {
        abort_unless(auth()->user()->can('manage roles'), 403);
        $permissions = Permission::where('name', '<>', 'view_landlord_portal')->get();
        return view('admin.roles.create', compact('permissions'));
    }


    public function store(StoreRoleRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
            ]);

            $permissions = $request->input('permission');
            if ($permissions) {
                $permissions = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
                $role->givePermissionTo($permissions);
            }
        });

        return redirect()
            ->route('admin.roles-management.index')
            ->with('success', 'Role has been added');
    }

    public function show($id)
    {
//        abort_unless(auth()->user()->can('users_manage'), 403, __('You dont have necessary permission to access the resource'));

        abort_unless(auth()->user()->can('manage roles'), 403);
        $role = Role::findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }


    public function edit($id)
    {
//        abort_unless(auth()->user()->can('users_manage'), 403, __('You dont have necessary permission to access the resource'));
        abort_unless(auth()->user()->can('manage roles'), 403);
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(UpdateRoleRequest $request, $id)
    {
//        $role = Role::findOrFail($id);
//        $role->update($request->except('permission'));
//        $permissions = $request->input('permission') ? $request->input('permission') : [];
//
//        $role->syncPermissions($permissions);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);

        $permissions = $request->input('permission');
        if ($permissions) {
            $permissions = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles-management.index')->with('success', __('Role and associated permissions updated'));
    }


    public function destroy($id)
    {
        //
    }
}
