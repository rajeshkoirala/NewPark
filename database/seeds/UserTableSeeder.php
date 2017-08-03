<?php


use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'full_name'     => 'Super Admin',
            'username'     => 'admin',
            'user_type'     => '1',
            'email'    => 'admin@admin.admin',
            'password' => Hash::make('admin'),
        ));
    }
}