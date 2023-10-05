<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'usuario administrador',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'type' => User::USER_TYPE_ADMIN,
            'status' => User::USER_STATUS_ACTIVE
        ]);

        Admin::factory()->state(['user_id' => $admin->id])->create();
    }
}
