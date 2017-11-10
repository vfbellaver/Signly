<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateAddressRequest;
use App\Http\Requests\UserUpdateCardRequest;
use App\Http\Requests\UserUpdateLocationRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Http\Requests\UserUpdatePhotoRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdatePlanRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UsersController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return User::query()->where('id', Auth::id())->get()->toArray();
    }

    public function store(UserCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'User created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $obj = $this->service->update($request->form(), $user);
        $response = [
            'message' => 'User updated.',
            'data' => $obj,
        ];
        return $response;
    }

    public function updatePhoto(UserUpdatePhotoRequest $request, User $user)
    {
        $data = $request->all();
        $user->photo_url = $data['photo_url'];
        $user->save();
        $response = [
            'message' => 'User photo updated.',
            'data' => $user->toArray(),
        ];
        return $response;
    }

    public function updatePassword(UserUpdatePasswordRequest $request, User $user)
    {
        $data = $request->all();
        $user->password = bcrypt($data['new_password']);
        $user->save();
        $response = [
            'message' => 'Password updated.',
            'data' => $user,
        ];
        return $response;
    }

    public function updateAddress(UserUpdateAddressRequest $request, User $user)
    {
        $data = $request->all();
        $user->address = $data['address'];
        $user->lat = $data['lat'];
        $user->lng = $data['lng'];
        $user->save();

        $response = [
            'message' => 'User plan updated.',
            'data' => $user,
        ];
        return $response;
    }

    public function updateLocation(UserUpdateLocationRequest $request, User $user)
    {
        $data = $request->all();
        $user->lat = $data['lat'];
        $user->lng = $data['lng'];
        //$date = Carbon::now($data['timezone'])->toDateTimeString();
        //$user->timezone = $date;
        $user->timezone = $data['timezone'];
        $user->save();

        $response = [
            'message' => 'Your Location updated.',
            'data' => $user,
        ];
        return $response;
    }

    public function updatePlan(UserUpdatePlanRequest $request, User $user)
    {
        $response = [
            'message' => 'User plan updated.',
            'data' => $user,
        ];
        return $response;
    }

    public function updateCard(UserUpdateCardRequest $request, User $user)
    {
        $response = [
            'message' => 'User card updated.',
            'data' => $user,
        ];
        return $response;
    }

    public function cancelSubscription(User $user)
    {
        $response = [
            'message' => 'User subscription canceled.',
            'data' => $user,
        ];
        return $response;
    }

    public function getTimeZone($lat, $lng, $time)
    {

        $json = $this->urlFormat($lat, $lng, $time);

        return [
          'data' =>  $json,
        ];

    }

    public function destroy(User $user)
    {
        $this->service->delete($user);
        return [
            'message' => 'User deleted.'
        ];
    }

    private function urlFormat ($lat, $lng, $time) {

        $lat = number_format($lat,7);
        $lng = number_format($lng,7);

        $location = 'location=' . $lat . ',' . $lng;
        $timestamp = '&timestamp=' . $time;
        $googleUrl = 'https://maps.googleapis.com/maps/api/timezone/json?';
        $uri = $googleUrl.$location.$timestamp.'&key='.env('TIMEZONE');
        $client = new Client();
        $res = $client->request('GET', $uri);
        return \GuzzleHttp\json_decode($res->getBody(),true);
    }
}
