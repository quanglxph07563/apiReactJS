<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'quang',
            'email' => 'quang@gmail.com',
            'password' => Hash::make(123456),
        ]);
    }
}
