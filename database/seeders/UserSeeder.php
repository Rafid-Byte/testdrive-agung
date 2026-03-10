<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'  => 'Administrator',
                'email' => 'admin@toyota.com',
                'role'  => 'admin',
            ],
            [
                'name'  => 'Andi Wijaya',
                'email' => 'spv1@toyota.com',
                'role'  => 'spv',
            ],
            [
                'name'  => 'Sari Indah Lestari',
                'email' => 'spv2@toyota.com',
                'role'  => 'spv',
            ],
            [
                'name'  => 'Budi Hartono',
                'email' => 'spv3@toyota.com',
                'role'  => 'spv',
            ],
            [
                'name'  => 'Dewi Kusuma',
                'email'  => 'spv4@toyota.com',
                'role'  => 'spv',
            ],
            [
                'name'  => 'Branch Manager',
                'email' => 'branchmanager@toyota.com',
                'role'  => 'branch_manager',
            ],
            [
                'name'  => 'Security',
                'email' => 'security@toyota.com',
                'role'  => 'security',
            ],
            [
                'name'  => 'Sales Toyota',
                'email' => 'sales@toyota.com',
                'role'  => 'sales',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'role'              => $data['role'],
                    'password'          => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}