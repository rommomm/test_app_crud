<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $adminRole = Role::create(['name' => Role::ADMIN,]);
        $managerRole = Role::create(['name' => Role::MANAGER,]);

        $managerPermissions = [
            'create manager', 'read manager', 'update manager', 'delete manager'
        ];

        $testPermissions = [
            'create test', 'read test', 'update test', 'delete test', 'rate test'
        ];

        foreach ($managerPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        foreach ($testPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->syncPermissions($managerPermissions, $testPermissions);

        $managerRole->syncPermissions('rate test');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
