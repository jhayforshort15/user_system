<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function list()
    {
        $users = User::with('roles')->orderBy('created_at','desc')->get();
        foreach ($users as $user)
        {
            $user->created_at_s = Carbon::parse($user->created_at)->toDayDateTimeString();
            $user->role_name = $user->roles->roleName();
        }
        return array("success" => true, "message" => "", "data" => $users);
    }

    public function createUser(Request $request)
    {
        
        $validation_rules = [
            'full_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'role_id' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];

        $request->validate($validation_rules);

        $input = $request->all();

        $user = new User();
        $user->full_name = $input['full_name'];
        $user->email = $input['email'];
        $user->role_id = $input['role_id'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return array("success" => true, "message" => "Added User Succesfully!", "data" => $user);
    }

    public function delete($id)
    {   
        $user = User::findOrFail($id);
        $user->delete();

        return array("success" => true, "message" => "User Deleted", "data" => $user);
    }

    public function update(Request $request, $id)
    {
        $validation_rules = [
            'full_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ];

        $request->validate($validation_rules);

        $data = $request->all();

        $user = User::find($id);
        $user->full_name = $data['full_name'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];
        $user->save();

        return array("success" => true, "message" => "User Updated!", "data" => $user);
    }
}
