<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::query()->delete();

        //create permissions
        $permissions = config('permission.permissions');
        foreach ($permissions as $key => $permission) {

            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }


    }
}
