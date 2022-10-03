<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=> 'admin',
            'email'=>'admin@yahoo.com',
            'is_admin'=>true,
            'email_verified_at' => now(),
            'password' => '$2y$10$trd8CUw9Bd7efgpaQs.ZUOZOvkH0gSLZs5peVDg0Hu3exdlefSLVG',
            'remember_token'=> Str::random(10),
        ]);
        User::create([
            'name'=> 'ahmed',
            'email'=>'ahmedgamaldakhly@yahoo.com',
            'is_admin'=>true,
            'email_verified_at' => now(),
            'password' => '$2y$10$trd8CUw9Bd7efgpaQs.ZUOZOvkH0gSLZs5peVDg0Hu3exdlefSLVG',
            'remember_token'=> Str::random(10),
        ]);
    }
}
