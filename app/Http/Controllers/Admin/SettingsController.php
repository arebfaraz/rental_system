<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    public function __construct()
    {
        //abort


    }

    public function index()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);

        return view('admin.settings.global');

    }

    public function appearance()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.appearance');

    }

    public function locations()
    {
//        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
//        return view('admin.settings.locations');

    }

    public function house_types()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.house_types');

    }

    public function property_types()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.property_types');
    }

    public function payment_methods()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.payment_methods');
    }

    public function company_settings()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.company_settings');
    }

    public function expense_types()
    {
        abort_unless(auth()->user()->can(config('permission.permissions.access_settings')), 403);
        return view('admin.settings.expense_types');
    }
}
