<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Task::exists()) {
            $this->call([TaskSeeder::class]);
        }

        Task::factory()
            ->count(500)
            ->create();
    }
}
