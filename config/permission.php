<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false, if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true the package implements teams using the 'team_foreign_key'. If you want
     * the migrations to register the 'team_foreign_key', you must set this to true
     * before doing the migration. If you already did the migration then you must make a new
     * migration to also add 'team_foreign_key' to 'roles', 'model_has_roles', and
     * 'model_has_permissions'(view the latest version of package's migration file)
     */

    'teams' => false,

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],

    /*
     * Define all permissions here. Same pattern as the routes provided in the web.php file.
     * /
     *
     */
    'permissions' => [
        'create_tenant' => 'create tenant',
        'read_tenant' => 'read tenant',
        'update_tenant' => 'update tenant',
        'delete_tenant' => 'delete tenant',

        'create_property' => 'create property',
        'read_property' => 'read property',
        'update_property' => 'update property',
        'delete_property' => 'delete property',

        'create_house' => 'create house',
        'read_house' => 'read house',
        'update_house' => 'update house',
        'delete_house' => 'delete house',

        'create_landlord' => 'create landlord',
        'read_landlord' => 'read landlord',
        'update_landlord' => 'update landlord',
        'delete_landlord' => 'delete landlord',

        'create_lease' => 'create lease',
        'read_lease' => 'read lease',
        'read_lease_history' => 'read lease history',
        'update_lease' => 'update lease',
        'delete_lease' => 'delete lease',

        'create_water_reading' => 'create water reading',
        'read_water_reading' => 'read water reading',
        'update_water_reading' => 'update water reading',
        'delete_water_reading' => 'delete water reading',
        'pay_water_reading' => 'pay water reading',

        'read_rent_invoice' => 'read rent invoice',
        'update_rent_invoice' => 'update rent invoice',
        'delete_rent_invoice' => 'delete rent invoice',
        'pay_rent_invoice' => 'pay rent invoice',
        'notify_rent_invoice' => 'notify rent invoice',

        'read_water_invoice' => 'read water invoice',
        'update_water_invoice' => 'update water invoice',
        'delete_water_invoice' => 'delete water invoice',
        'pay_water_invoice' => 'pay water invoice',
        'notify_water_invoice' => 'notify water invoice',

        'create_expenses' => 'create expenses',
        'read_expenses' => 'read expenses',
        'update_expenses' => 'update expenses',
        'delete_expenses' => 'delete expenses',

        'read_payments' => 'read payments',
        'update_payments' => 'update payments',
        'delete_payments' => 'delete payments',
        'approve_payments' => 'approve payments',
        'reject_payments' => 'reject payments',

        'create_support_tickets' => 'create support tickets',
        'read_support_tickets' => 'read support tickets',
        'update_support_tickets' => 'update support tickets',
        'delete_support_tickets' => 'delete support tickets',
        'reply_support_tickets' => 'reply support tickets',

        'access_settings' => 'access settings',
        'access_activity_log' => 'access activity log',
        'access_user_management' => 'access user management',
        'access_reports' => 'access reports',

        //custom invoice
        'create_custom_invoice' => 'create custom invoice',
        'read_custom_invoice' => 'read custom invoice',
        'update_custom_invoice' => 'update custom invoice',
        'delete_custom_invoice' => 'delete custom invoice',

        //overpayment
        'create_overpayment' => 'create overpayment',
        'read_overpayment' => 'read overpayment',
        'update_overpayment' => 'update overpayment',
        'delete_overpayment' => 'delete overpayment',

        //Deposit
        'refund_deposit' => 'refund deposit',
        'read_deposit' => 'read deposit',
        'update_deposit' => 'update deposit',
        'delete_deposit' => 'delete deposit',

        //Landlord remittance
        'read_landlord_remittance' => 'read landlord remittance',
        'create_landlord_remittance' => 'create landlord remittance',
        'update_landlord_remittance' => 'update landlord remittance',
        'delete_landlord_remittance' => 'delete landlord remittance',
    ],
];
