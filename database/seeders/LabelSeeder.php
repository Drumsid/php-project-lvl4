<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'bug', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'documentation', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'question', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'enhancement', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        DB::table('labels')->insert($statuses);
    }
}
