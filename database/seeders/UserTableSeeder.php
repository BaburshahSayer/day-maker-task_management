<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            ['id' => '1',
            'name' => 'Test',
            'email' => 'test@test.com',
            'email_verified_at' => NULL,
            'password' => '$2y$10$3jtuAvC9IWGxqPrrf1L3JOLHz2IILYRoxg9dXjKVO7FUM6t28it/q',
            'remember_token' => NULL,
            'created_at' => '2021-12-04 04:38:05',
            'updated_at' => '2021-12-04 04:38:05'
        ]
        );
    }
}
