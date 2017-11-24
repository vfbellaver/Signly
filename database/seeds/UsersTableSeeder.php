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
        $this->createAdminUser();

        if (!app()->environment('production')) {
            $this->createTeams();
        }
    }

    private function resolveStripePlan($plan = null)
    {
        $plans = [\App\Slc::PLAN_1, \App\Slc::PLAN_2, \App\Slc::PLAN_3, \App\Slc::PLAN_4];

        if (!$plan) {
            $plan = $plans[rand(0, 3)];
        }

        $stripePlan = null;
        try {
            $stripePlan = Plan::retrieve($plan['id']);
        } catch (Exception $e) {
            $stripePlan = Plan::create(array(
                "id" => $plan['id'],
                "name" => $plan['name'],
                "amount" => 250,
                "interval" => "month",
                "currency" => "usd",
            ));
        }

        return $stripePlan;
    }

    private function stripeToken(User $user, $card = null)
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

        $data = [
            "card" => [
                "name" => $user->name,
                "number" => $card,
                "exp_month" => rand(1, 12),
                "exp_year" => Carbon::now()->addYears(rand(1, 5))->format('Y'),
                "cvc" => rand(100, 999),
            ]
        ];

        $token = Token::create($data);

        return $token;
    }

    private function createSupportUser()
    {
        $team = \App\Models\Team::query()->where('slug', 'devsquad')->first();
        /** @var User $user */
        $user = factory(\App\Models\User::class)->create([
            'name' => 'DevSquad',
            'email' => 'team@devsquad.com',
            'password' => bcrypt('devsquad##'),
            'team_id' => $team->id,
        ]);
        $this->subscribeTeamOwners($user);

        $team->owner_id = $user->id;
        $team->save();

        $user->attachRole(Defender::findRole(User::ADMIN));
        $user->attachRole(Defender::findRole(User::SUPER_ADMIN));
        $user->attachRole(Defender::findRole(User::ACCOUNT_OWNER));
    }

    private function createAdminUser()
    {
        $team = \App\Models\Team::query()->where('slug', 'signly')->first();

        /** @var User $user */
        $user = factory(\App\Models\User::class)->create([
            'name' => 'Mike Admin',
            'email' => 'mike@signly.com',
            'card_expiration' => Carbon::createFromFormat('m/Y', '11/2017')->endOfMonth(),
            'password' => bcrypt('signly##'),
            'team_id' => $team->id
        ]);
        $this->subscribeTeamOwners($user);
        $team->owner_id = $user->id;
        $team->save();

        $user->attachRole(Defender::findRole(User::ADMIN));
        $user->attachRole(Defender::findRole(User::ACCOUNT_OWNER));
    }

    private function createTeams()
    {
        \App\Models\Team::all()->each(function (\App\Models\Team $team) {
            if ($team->owner_id) {
                return;
            }

            $owner = factory(\App\Models\User::class)
                ->create([
                    'team_id' => $team->id
                ]);
            $owner->attachRole(Defender::findRole(User::ACCOUNT_OWNER));
            $team->owner_id = $owner->id;
            $team->save();

            $this->subscribeTeamOwners($owner);

            factory(\App\Models\User::class, 2)
                ->create([
                    'team_id' => $team->id
                ])->each(function (User $user) {
                    $user->attachRole(Defender::findRole(User::ACCOUNT_MEMBER));
                });
        });
    }

    private function subscribeTeamOwners(User $user)
    {
        $plan = $this->resolveStripePlan();
        $token = $this->stripeToken($user);
        $subscription = $user->newSubscription($plan->name, $plan->id)
            ->trialDays(30)
            ->create($token->id, ['email' => $user->email]);
        $user = User::query()->find($user->id);

        $user->trial_ends_at = $subscription->trial_ends_at;
        $dateStr = "{$token->card->exp_year}-{$token->card->exp_month}-01";
        $user->card_expiration = Carbon::createFromFormat("Y-m-d", $dateStr)->endOfMonth();
        $user->save();
    }
}
