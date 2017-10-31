<?php

Route::resource('team', 'Api\TeamsController', ['except' => ['show', 'create', 'edit']]);
Route::post('team/invite-member','Api\TeamsController@inviteMember')->name('team.invite.member');
Route::get('team/list-mailed-invitations','Api\TeamsController@listMailedInvitationsMembers')->name('team.list.mailed.invitations');
Route::get('team/list-invited-members','Api\TeamsController@listInvitedMembers')->name('team.list.invited.members');