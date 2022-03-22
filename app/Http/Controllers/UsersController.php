<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    public function index() 
    {
        $users = User::with('roles')->get();
        return view('users.index',compact('users'));
    }
}
