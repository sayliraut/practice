<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManageModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['name' => 'CMS', 'slug' => 'cms', 'created_by' => null, 'modified_by' => null],
            ['name' => 'Manage State', 'slug' => 'manage-state', 'created_by' => null, 'modified_by' => null],
        ];

        DB::table('manage_module')->insert($modules);
    }
}
