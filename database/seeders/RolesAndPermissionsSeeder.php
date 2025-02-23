<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full access to all features'
        ]);

        $moderatorRole = Role::create([
            'name' => 'moderator',
            'display_name' => 'Moderator',
            'description' => 'Moderate user content'
        ]);

        $editorRole = Role::create([
            'name' => 'editor',
            'display_name' => 'Editor',
            'description' => 'Create and edit content'
        ]);

        // Create permissions
        $manageUsers = Permission::create([
            'name' => 'manage_users',
            'display_name' => 'Manage Users',
            'description' => 'Create, edit, and delete users'
        ]);

        $manageRoles = Permission::create([
            'name' => 'manage_roles',
            'display_name' => 'Manage Roles',
            'description' => 'Create, edit, and delete roles'
        ]);

        $manageContent = Permission::create([
            'name' => 'manage_content',
            'display_name' => 'Manage Content',
            'description' => 'Create, edit, and delete all content'
        ]);

        // Assign permissions to roles
        $adminRole->permissions()->attach([
            $manageUsers->id,
            $manageRoles->id,
            $manageContent->id
        ]);

        $moderatorRole->permissions()->attach([
            $manageContent->id
        ]);

        $editorRole->permissions()->attach([
            $manageContent->id
        ]);

        // Create admin user if it doesn't exist
        $adminUser = User::where('email', 'admin@example.com')->first();
        
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now()
            ]);
        }

        // Assign admin role to admin user
        $adminUser->roles()->sync([$adminRole->id]);
    }
}