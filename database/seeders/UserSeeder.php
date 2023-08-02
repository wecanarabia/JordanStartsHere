<?php

namespace Database\Seeders;

use App\Imports\UserImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Maatwebsite\Excel\Facades\Excel;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'name' => 'aya',
        //     'last_name' => 'matroud',
        //     'phone' => '+963937158233',
        //     'profile_image_id' => '1',
        //     'email' => 'aya@gmail.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        Excel::import(new UserImport(), base_path('../users.xlsx'));
    }
}
