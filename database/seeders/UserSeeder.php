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
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.com'
        ]);
        User::create([
            'username' => 'ahmad',
            'name' => 'ahmad',
            'email' => 'ahmad@google.com'
        ]);
    }
}
