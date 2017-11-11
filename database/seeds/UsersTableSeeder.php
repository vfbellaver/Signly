<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Token;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $this->createSupportUser();
        if (app()->environment('local')) {
            $this->setTeamOwners();
            $this->createUserUsers();
            $this->subscribeTeamOwners();
        }
    }

    private function resolvePlan($planId = null)
    {
        $plans = ['basic', 'standard', 'master'];

        if (!$planId) {
            $planId = $plans[rand(0, 2)];
        }

        $plan = null;
        try {
            $plan = Plan::retrieve($planId);
        } catch (Exception $e) {
            $plan = Plan::create(array(
                "id" => $planId,
                "name" => $planId,
                "amount" => 250,
                "interval" => "month",
                "currency" => "usd",
            ));
        }

        return $plan;
    }

    private function stripeToken($card = null)
    {
        $cards = [
            '4242424242424242',
            '4000056655665556',
            '5555555555554444',
            '5200828282828210',
            '378282246310005',
            '6011111111111117',
            '30569309025904',
            '3530111333300000',
        ];

        if (!$card) {
            $card = $cards[rand(0, (count($cards) - 1))];
        }

        $token = Token::create(array(
            "card" => array(
                "number" => $card,
                "exp_month" => rand(1, 12),
                "exp_year" => Carbon::now()->addYears(rand(1, 5))->format('Y'),
                "cvc" => rand(100, 999),
            )
        ));

        return $token;
    }

    private function createSupportUser()
    {
        $role = Defender::findRole('slc');

        /** @var User $user */
        $user = factory(\App\Models\User::class)->create([
            'name' => 'Support SLC DevShop',
            'email' => 'support@slcdevshop.com',
            'card_expiration' => Carbon::createFromFormat('m/Y', '11/2017')->endOfMonth(),
            'password' => bcrypt('slcdev##'),
            'team_id' => 1
        ]);

        $user->attachRole($role);
    }

    private function setTeamOwners()
    {
        $role = Defender::findRole('admin');

        \App\Models\Team::all()->each(function (\App\Models\Team $team) use ($role) {
            if ($team->id == 1) {
                $team->owner_id = 1;
                $team->save();
                return;
            }

            $owner = factory(\App\Models\User::class)
                ->create([
                    'team_id' => $team->id
                ]);
            $team->owner_id = $owner->id;
            $team->save();
        });
    }

    private function createUserUsers()
    {
        $role = Defender::findRole('user');
        \App\Models\Team::all()->each(function (\App\Models\Team $team) use ($role) {
            factory(\App\Models\User::class, 2)
                ->create([
                    'team_id' => $team->id
                ]);
        });
    }

    private function subscribeTeamOwners()
    {
        User::all()->each(function (User $user) {
            if (!$user->is_team_owner) return;
            $plan = $this->resolvePlan();
            $token = $this->stripeToken();
            $user->newSubscription('main', $plan->id)
                ->trialDays(30)
                ->create($token->id, ['email' => $user->email]);

            $dateStr = "{$token->card->exp_year}-{$token->card->exp_month}-01";
            $user->card_expiration = Carbon::createFromFormat("Y-m-d", $dateStr)->endOfMonth();
            $user->save();
        });
    }
}
