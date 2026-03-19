<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [
            'view customers', 'create customers', 'edit customers', 'delete customers',
            'view leads', 'create leads', 'edit leads', 'delete leads',
            'view tasks', 'create tasks', 'edit tasks', 'delete tasks'
        ];

        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $sales = Role::create(['name' => 'sales']);

        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['view customers','create customers','edit customers','view leads','create leads','edit leads','view tasks','create tasks']);
        $sales->givePermissionTo(['view tasks','create tasks','view leads']);
    }
}
