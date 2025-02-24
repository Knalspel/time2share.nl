<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@8055'],
            [
                'name' => 'Admin',
                'email' => 'admin@8055',
                'password' => Hash::make('Eq2):6K4XS)p'),
                'admin' => true,
            ]
        );
    }
}
