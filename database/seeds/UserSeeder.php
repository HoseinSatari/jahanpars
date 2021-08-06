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
            'name' => 'حسین ستاری',
            'email' => 'hosein@gmail.com',
            'phone' => '0930525745',
            'is_superuser' => 1,
            'password' => Hash::make('123456789'),

        ]);
    }
}
