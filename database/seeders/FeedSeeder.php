<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Forum\Entities\Feed;

class FeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->map(function ($user) {
            Feed::factory(3)->create([
                'user_id' => $user->id,
                'school_id' => $user->school_id
            ]);
        });
    }
}