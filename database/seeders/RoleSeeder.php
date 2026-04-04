<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create the 3 main roles for your platform
        Role::create(['name' => 'Super-Admin']);
        Role::create(['name' => 'Verified-Artist']);
        Role::create(['name' => 'Client']);
    }
}