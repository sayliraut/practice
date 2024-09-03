<?php

namespace Database\Seeders;

use App\Models\IamPrincipal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IamPrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        IamPrincipal::factory()->count(1)->create();
    }
}
