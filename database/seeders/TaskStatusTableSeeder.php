<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'новый'],
            ['name' => 'в работе'],
            ['name' => 'на тестировании'],
            ['name' => 'завершен'],
        ];
        DB::table('task_statuses')->insert($statuses);

    }
}
