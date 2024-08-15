<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MembersTableSeeder extends Seeder
{
    public function run()
    {
        // Insert sample members with hashed passwords
        User::create([
            'name' => 'Kun Faris',
            'email' => 'admin@admin.admin',
            'password' => Hash::make('kalendergamer'),
            'IsAdmin' => 1,
        ]);
    }
}
