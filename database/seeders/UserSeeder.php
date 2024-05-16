<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Van Thang',
            'email' => 'hovanthang1201@gmail.com',
            'password' => bcrypt('123456'),
            'thumbnail' => '',
            'is_admin' => "1"
        ]);

        // Chạy php artisan db:seed --class=UserSeeder
    }
}
