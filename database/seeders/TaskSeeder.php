<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::exists()) {
            $this->call([UserSeeder::class]);
        }

        Task::factory()
            ->count(100)
            ->create();
    }
}
