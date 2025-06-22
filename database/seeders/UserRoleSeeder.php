<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create a test user
        $user = User::firstOrCreate([
            'email' => 'creator@test.com'
        ], [
            'name' => 'Test Creator',
            'password' => bcrypt('password'),
        ]);

        // Get the creator role
        $creatorRole = Role::where('name', 'creator')->first();

        // Assign the creator role to the user
        if ($creatorRole && $user) {
            $user->roles()->sync([$creatorRole->id]);
            echo "User {$user->email} has been assigned the creator role.\n";
        }

        // Also create an admin user
        $adminUser = User::firstOrCreate([
            'email' => 'admin@test.com'
        ], [
            'name' => 'Test Admin',
            'password' => bcrypt('password'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole && $adminUser) {
            $adminUser->roles()->sync([$adminRole->id]);
            echo "User {$adminUser->email} has been assigned the admin role.\n";
        }
    }
}
