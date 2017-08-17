<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;

class UsersController extends Controller
{
    public function getUsers()
    {
        return User::all();
    }

    public function searchUser(Request $request)
    {

    }

}
