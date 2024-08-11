<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;


class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => '田中',
            'password' =>Hash::make('password'),
            'email' => 'tanaka1@example.com',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'deleted_at' => null,
        ]);
    }
}