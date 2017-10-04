<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $user;

    function __construct()
    {
        $this->middleware('needsRole:admin');
    }

    public function index()
    {
        $this->user = Auth::user();
        return view('user.index',['user' => $this->user]);
    }
}
