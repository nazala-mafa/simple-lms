<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Master\Entities\SchoolStatus;

class SchoolStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolStatus::insert([
            ['name' => 'Verified'],
            ['name' => 'Unverified'],
            ['name' => 'Suspended'],
            ['name' => 'Banned'],
        ]);
    }
}