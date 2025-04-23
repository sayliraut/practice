<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Los Angeles', 'state_xid' => 1, 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Houston', 'state_xid' => 2, 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'New York City', 'state_xid' => 3, 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Miami', 'state_xid' => 4, 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
            ['name' => 'Chicago', 'state_xid' => 5, 'is_active' => 1, 'created_by' => null, 'modified_by' => null],
        ];

        DB::table('cities')->insert($cities);
    }
}
