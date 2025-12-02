<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return; // No users to associate photos with
        }

        $users->each(function ($user) {
            Photo::factory()->count(rand(3, 15))->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
