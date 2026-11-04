<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emails = [
            env('SUPER_ADMIN_EMAIL', 'admin@globalmaitri.com'),
            'admin@nikahconnect.com',
        ];

        foreach ($emails as $email) {
            User::updateOrCreate(
                ['email' => strtolower($email)],
                [
                    'name' => 'Global Maitri Super Admin',
                    'password' => Hash::make('Password123!'),
                    'role' => 'super_admin',
                    'permissions' => [
                        'manage_verifications',
                        'manage_reports',
                        'view_audit_logs',
                        'manage_settings',
                    ],
                    'gender' => 'male',
                    'dob' => '1990-01-01',
                    'marital_status' => 'never_married',
                    'is_verified' => true,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
