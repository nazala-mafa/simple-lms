<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Lms\Entities\Module;
use Modules\Master\Entities\School;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask(
            'How many modules you want to create, for 1 school?',
            3
        );

        School::all()->map(function (School $school) use ($count) {
            Module::factory((int) $count)->create([
                'school_id' => $school->id
            ]);
        });
    }
}