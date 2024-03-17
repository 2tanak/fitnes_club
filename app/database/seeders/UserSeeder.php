<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->whereIn('first_name', [
            'admin',
            'operator', 'user'
        ])->get();
        $roles = Role::query()->whereIn('name', ['admin', 'operator', 'user'])->get();
        if (count($users) > 0) {
            User::destroy($users->pluck('id'));
        }
        if (count($roles) > 0) {
            Role::destroy($roles->pluck('id'));
        }
        User::factory()->has(Role::factory(['name' => 'admin'])->count(1), 'roles')->create([
            'first_name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => 12345678,
        ]);
        User::factory()->has(Role::factory(['name' => 'operator'])->count(1), 'roles')->create([
            'first_name' => 'operator',
            'email' => 'operator@mail.ru',
            'password' => 12345678,
        ]);
        User::factory()->has(Role::factory(['name' => 'user'])->count(1), 'roles')->create([
            'first_name' => 'user',
            'email' => 'user@mail.ru',
            'password' => 12345678,
        ]);
    }
}
