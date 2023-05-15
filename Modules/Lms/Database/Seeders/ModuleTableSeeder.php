<?php

namespace Modules\Lms\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Lms\Entities\Module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        for ($i = 0; $i < 10; $i++) {
            Module::create([
                'user_id' => 2,
                'title' => 'judul ' . $i,
                'description' => 'description ' . $i,
                'body' => 'body ' . $i
            ]);
        }
    }
}