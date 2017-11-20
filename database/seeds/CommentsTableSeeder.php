<?php

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use App\Models\Comment;
use App\Models\BillboardFace;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        BillboardFace::all()->each(function ($billboardFace) {
            $user = User::whereHas('team', function ($query) use ($billboardFace) {
                $query->where('id', $billboardFace->team->id);
            })->inRandomOrder()->get()->first();

            for ($i = 0; $i <= rand(1, 10) ; $i++) {
                factory(Comment::class, rand(1, 10))->create([
                    'user_id' => rand(0, 1) ? $user->id : null,
                    'billboard_face_id' => $billboardFace->id,
                    'team_id' => $billboardFace->team->id
                ]);
            }
        });
    }
}
