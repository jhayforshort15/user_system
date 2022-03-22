<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{

    public function list(Request $request)
    {
        $roles = Role::orderBy('created_at','desc')->get();
        return array("success" => true, "message" => "", "data" => $roles);
    }

    public function createRoles(Request $request)
    {
        $validation_rules = [
            'role_name' => 'required',
            'description' => 'required',
        ];

        $request->validate($validation_rules);

        $input = $request->all();

        $role = New Role();
        $role->role_name = $input['role_name'];
        $role->description = $input['description'];
        $role->save();

        return array("success" => true, "message" => "Role created", "data" => $role);
        
    }

    public function findIdRole(Request $request, $id)
    {
        
        $data = $request->all();

        $roles = Role::find($data['id']);

        return $roles;

    }

    public function editRoles(Request $request, $id)
    {
        $validation_rules = [
            'role_name' => 'required',
            'description' => 'required',
        ];

        $request = validate($validation_rules);

        $data = $request->all();

        $role = Role::findOrFail($data['id']);
        $role->update($data);

        return array("success" => true, "message" => "Role updated!", "data" => $role);
    }

    public function delete($id)
    {
    $role = Role::findOrFail($id);

    $role->delete();

    return array("success" => true, "message" => "Role Deleted!", "data" => $role);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::find($id);
        $role->role_name = $request->role_name;
        $role->description = $request->description;

        $role->save();

        return array("success" => true, "message" => "Role Updated!", "data" => $role);
    }
}
