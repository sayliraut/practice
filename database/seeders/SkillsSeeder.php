<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Laravel', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'JavaScript', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'React', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'MySQL', 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
        ];

        DB::table('skills')->insert($skills);
    }
}
