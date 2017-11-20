<?php

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use App\Models\Comment;
use App\Models\Proposal;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        Proposal::all()->each(function ($proposal) {
            $user = User::whereHas('team', function ($query) use ($proposal) {
                $query->where('id', $proposal->team->id);
            })->inRandomOrder()->get()->first();

            for ($i = 0; $i <= rand(1, 10) ; $i++) {
                factory(Comment::class, rand(1, 10))->create([
                    'user_id' => rand(0, 1) ? $user->id : null,
                    'proposal_id' => $proposal->id,
                    'team_id' => $proposal->team->id
                ]);
            }
        });
    }
}
