<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Thanh Admin',
                'email' => 'thanhadmin@gmail.com',
                'password' => Hash::make('Thanh1234'),
                'role' => 'admin',
            ],
            [
                'name' => 'Thanh Nguyen',
                'email' => 'thanhuser@gmail.com',
                'password' => Hash::make('Thanh1234'),
                'role' => 'user',
            ]
            ]);
    }
}
