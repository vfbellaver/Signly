<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    function __construct()
    {
    }

    public function index()
    {
        $this->middleware('needsRole:' . User::ADMIN);
        return view('user.index');
    }

    public function settings()
    {
        $this->middleware('needsRole:' . User::ACCOUNT_OWNER);
        return view('user.settings');
    }
}
