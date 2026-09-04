<?php

return [
    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],
    'table_names' => [
        'roles' => 'roles', 'permissions' => 'permissions', 'model_has_permissions' => 'model_has_permissions', 'model_has_roles' => 'model_has_roles', 'role_has_permissions' => 'role_has_permissions',
    ],
    'column_names' => ['role_pivot_key' => null, 'permission_pivot_key' => null, 'model_morph_key' => 'model_id', 'team_foreign_key' => 'team_id'],
    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'events' => ['permission_attached' => Spatie\Permission\Events\PermissionAttached::class, 'permission_detached' => Spatie\Permission\Events\PermissionDetached::class, 'role_attached' => Spatie\Permission\Events\RoleAttached::class, 'role_detached' => Spatie\Permission\Events\RoleDetached::class, 'role_permissions_sync' => Spatie\Permission\Events\RolePermissionsSynced::class, 'permissions_synced' => Spatie\Permission\Events\PermissionsSynced::class, 'role_given' => Spatie\Permission\Events\RoleGiven::class, 'role_removed' => Spatie\Permission\Events\RoleRemoved::class],
    'teams' => false,
    'team_foreign_key' => 'team_id',
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => ['expiration_time' => DateInterval::createFromDateString('24 hours'), 'key' => 'spatie.permission.cache', 'store' => 'default'],
];
