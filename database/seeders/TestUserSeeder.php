<?php

namespace Database\Seeders;

use App\Enums\UserRoleTypes;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'email' => 'test_user@test.com',
            'password' => Hash::make('123'),
            'name' => 'test',
            'role' => UserRoleTypes::Client->value
        ]);
    }
}
