<?php

use Illuminate\Database\Seeder;

class ProposalTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Client::all()->each(function ($client) {
            $users = \App\Models\User::query()
                ->where('team_id', $client->team_id)
                ->get()
                ->toArray();
            $user = $users[rand(0, (count($users) - 1))];
            factory(\App\Models\Proposal::class, rand(1, 3))->create([
                'team_id' => $client->team_id,
                'client_id' => $client->id,
                'user_id' => $user['id'],
            ]);
        });

        \App\Models\Proposal::all()->each(function (\App\Models\Proposal $proposal) {
            $faces = \App\Models\BillboardFace::query()->where('team_id', $proposal->team_id)->get()->toArray();
            $facesToAdd = [];
            $order = 1;
            for ($i = 0; $i < rand(1, 5); $i++) {
                $face = $faces[rand(0, (count($faces) - 1))];
                if (isset($facesToAdd[$face['id']])) continue;
                $facesToAdd[$face['id']] = ['order' => $order++, 'price' => $face['rate_card']];
            }
            $proposal->billboardFaces()->sync($facesToAdd);
        });
    }
}
