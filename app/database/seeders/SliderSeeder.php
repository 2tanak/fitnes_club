<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class SliderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('sql/slider.sql');
	    \DB::unprepared(file_get_contents($path));
        $this->command->info('slider table seeded!');
    }
}
