<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'sschoeffler@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('volitionhealth123'),
            ]
        );
    }
}
