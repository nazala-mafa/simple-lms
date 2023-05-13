<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Quiz
        Permission::create(['name' => 'create quizzes']);
        Permission::create(['name' => 'read quizzes']);
        Permission::create(['name' => 'update quizzes']);
        Permission::create(['name' => 'delete quizzes']);

        Permission::create(['name' => 'create questions']);
        Permission::create(['name' => 'read questions']);
        Permission::create(['name' => 'update questions']);
        Permission::create(['name' => 'delete questions']);

        Permission::create(['name' => 'create answers']);
        Permission::create(['name' => 'read answers']);
        Permission::create(['name' => 'update answers']);
        Permission::create(['name' => 'delete answers']);
    }
}