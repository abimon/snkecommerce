<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@snkwellness.co.ke'],
            [
                'name' => 'Super Admin User',
                'email' => 'superadmin@snkwellness.co.ke',
                'phone' => '0701583807',
                'password' => bcrypt('Admin@!2026#$'),
                'role' => 'super_admin',
            ]
        );
    }
}
