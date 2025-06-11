<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);
    }
}
