<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamMemberInvitationRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Models\Team;
use App\Models\User;
use App\Notifications\UserInvited;
use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class TeamsController extends Controller
{
    private $service;

    public function __construct(TeamService $service)
    {
        $this->middleware('needsRole:admin');
        $this->service = $service;
    }

    public function index()
    {
        return Team::all();
    }

    public function store(TeamCreateRequest $request)
    {
        $data = $this->service->create($request->form());

        $response = [
            'message' => 'Team created.',
            'data' => $data
        ];

        return $response;
    }

    public function update(TeamUpdateRequest $request, Team $team)
    {
        $obj = $this->service->update($request->form(), $team);

        $response = [
            'message' => 'Team updated.',
            'data' => $obj,
        ];

        return $response;
    }

    public function destroy(Team $team)
    {
        $this->service->delete($team);

        return [
            'message' => 'Team deleted.'
        ];
    }

    public function inviteMember (TeamMemberInvitationRequest $request)
    {

        $user = new User();
        $user->email = $request->form()->email();
        $user->team_id = auth()->user()->team_id;
        $user->invitation_token =  str_random(128);
        $user->save();

        $user->notify(new UserInvited($user));

        return [
            'message' => 'Member invited.'
        ];
    }

    public function listMailedInvitationsMembers()
    {
        return User::query()->whereNull('name')
            ->where('team_id','=',auth()->user()->team_id)->get()->toArray();
    }

    public function listInvitedMembers()
    {
        return User::query()->whereNotNull('name')
            ->where('team_id','=',auth()->user()->team_id)->get()->toArray();
    }
}
