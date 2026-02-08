<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@gkka.id');
        $password = env('ADMIN_PASSWORD', 'GKKA12345!');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin GKKA',
                'password' => Hash::make($password),
            ]
        );
    }
}
