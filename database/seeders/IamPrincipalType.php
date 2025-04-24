<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IamPrincipalType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => '1', 'principal_type_title' => 'Admin', 'is_active' => 1],
            ['id' => '2', 'principal_type_title' => 'SubAdmin', 'is_active' => 1],
            ['id' => '3', 'principal_type_title' => 'User', 'is_active' => 1],
        ];

        DB::table('iam_principal_type')->insert($types);
    }
}
