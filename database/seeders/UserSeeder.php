<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = [
            [
                'name' => 'Dadang', 
                'username' => 'dadang',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'level' => 'member'
            ],
            [
                'name' => 'Alfansyah', 
                'username' => 'admin',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'level' => 'admin'
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
