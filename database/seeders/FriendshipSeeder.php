<?php

namespace Database\Seeders;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->count() < 2) {
            return; // Not enough users to create friendships
        }

        $users->each(function ($user) use ($users) {
            $potientialFriends = $users->where('id', '!=', $user->id)->shuffle()->take(10);

            foreach ($potientialFriends as $friend) {
                // Avoid duplicate friendships
                $exists = Friendship::where(function ($query) use ($user, $friend) {
                    $query->where('user_id', $user->id)->where('friend_id', $friend->id);
                })->orWhere(function ($query) use ($user, $friend) {
                    $query->where('user_id', $friend->id)->where('friend_id', $user->id);
                })->exists();

                if (! $exists) {
                    Friendship::factory()->create([
                        'user_id' => $user->id,
                        'friend_id' => $friend->id,
                    ]);
                }
            }
        });
    }
}
