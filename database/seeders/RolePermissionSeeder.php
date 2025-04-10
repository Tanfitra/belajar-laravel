<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Reset cached roles and permissions
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // // Create permissions
        // Permission::create(['name' => 'create articles']);
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'delete articles']);
        // Permission::create(['name' => 'handle category']);
        // Permission::create(['name' => 'approve articles']);

        // // Create roles and assign permissions
        // $authorRole = Role::create(['name' => 'author']);
        // $authorRole->givePermissionTo(['create articles', 'edit articles', 'delete articles']);

        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo(['create articles', 'edit articles', 'delete articles', 'handle category', 'approve articles']);

        // $user = User::findOrFail(2);
        // $user->assignRole('author');

        $users = User::whereIn('id', [2, 3, 4])->get();
        foreach ($users as $user) {
            $user->assignRole('author');
        }
    }
}
