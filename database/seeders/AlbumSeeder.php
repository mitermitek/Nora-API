<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return; // No users to associate albums with
        }

        $users->each(function ($user) {
            $userPhotos = Photo::where('user_id', $user->id)->get();

            if ($userPhotos->isEmpty()) {
                return; // No photos for this user to create albums
            }

            Album::factory()
                ->count(rand(1, 10))
                ->create([
                    'user_id' => $user->id,
                ])
                ->each(function ($album) use ($userPhotos) {
                    $photosToAttach = $userPhotos->random(rand(1, min(5, $userPhotos->count())));
                    $album->photos()->attach($photosToAttach->pluck('id')->toArray());
                });
        });
    }
}
