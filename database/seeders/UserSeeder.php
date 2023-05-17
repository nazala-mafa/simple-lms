<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Master\Entities\School;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('1234'),
            'school_id' => 1
        ]);
        $superadmin->assignRole('Super Admin');

        $roles = Role::where('name', '!=', 'Super Admin')->get();
        School::all()->map(function (School $school) use ($roles) {

            foreach ($roles as $role) {
                $user = User::factory()->create([
                    'name' => strtolower($role->name),
                    'email' => strtolower($role->name) . (($school->id == 1) ? '' : $school->id) . '@example.com',
                    'password' => bcrypt('1234'),
                    'school_id' => $school->id
                ]);
                $user->assignRole($role->name);
            }

        });

    }
}