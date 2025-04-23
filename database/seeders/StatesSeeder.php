<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'California', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Texas', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'New York', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Florida', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Illinois', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
        ];

        DB::table('states')->insert($states);
    }
}
