<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterInvitationRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\CardService;
use Defender;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Stripe\Stripe;

class RegisterController extends Controller
{
    private $key;
    private $service;
    private $role;

    public function __construct(CardService $service)
    {
        $this->service = $service;
        $this->key = config('services.stripe.secret');
        $this->role = Defender::findRole('admin');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(RegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $trialDays = 30;

            $team = new  Team();
            $team->name = $request->input('company');
            $team->email = $request->input('email');
            $team->slug = str_slug($request->input('company'), '-');
            $team->save();

            $user = new  User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->remember_token = str_random(10);
            $user->team_id = $team->id;
            $user->trial_ends_at = Carbon::now()->addDays($trialDays);

            //TODO[daniel]: remove this part
            $user->lat = '40.7767168';
            $user->lng = '-111.9905246';
            $user->save();

            $team->owner_id = $user->id;
            $team->save();

            $user->attachRole($this->role);
            $plan = $request->input('plan')['id'];
            $email = $request->input('email');
            $owner = $request->input('owner');
            $cardToken = request('card');

            Stripe::setApiKey($this->key);

            $user->newSubscription('main', $plan)
                ->trialDays($trialDays)
                ->create($cardToken, [
                    'email' => $email,
                ]);

            $this->service->store($user, $request);
            auth()->login($user);
            return ['message' => 'Register Complete!'];
        });
    }

    public function invitation($token)
    {
        $isValid = false;
        $user = User::query()->where('invitation_token', $token)->first();
        if ($user) {
            $isValid = true;
        }
        return view('auth.invitation', compact('isValid', 'token'));
    }

    public function registerInvitation(RegisterInvitationRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::where('invitation_token', $request->input('invitation_token'))->first();

            $user->name = $request->input('name');
            $user->invitation_token = null;
            $user->password = bcrypt($request->input('password'));
            $user->remember_token = str_random(10);
            $user->save();
            $role = Defender::findRole('user');
            $user->attachRole($role);

            return redirect()->route('home');
        });
    }

    public function termsOfService()
    {
        return view('auth.terms-of-service');
    }

}
