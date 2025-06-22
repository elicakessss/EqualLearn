<?php

use App\Models\User;
use App\Models\Role;

// Get the first user (or create one if none exists)
$user = User::first();
if (!$user) {
    $user = User::create([
        'name' => 'Test Creator',
        'email' => 'creator@test.com',
        'password' => bcrypt('password'),
    ]);
}

// Get the creator role
$creatorRole = Role::where('name', 'creator')->first();

// Assign the creator role to the user
if ($creatorRole && $user) {
    $user->roles()->sync([$creatorRole->id]);
    echo "User {$user->email} has been assigned the creator role.\n";
} else {
    echo "Error: Could not find creator role or user.\n";
}

// Verify the assignment
$userRoles = $user->roles()->pluck('name')->toArray();
echo "User roles: " . implode(', ', $userRoles) . "\n";
