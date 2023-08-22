<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return $this->sendResponse($roles, 'Role Return Successfully.', Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//
    }

/**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:roles,name','min:3','max:50'
            ],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $role = new Role();
        $role->name = $request->name;
        $role->slug = Str::slug($request->name,'_');

        $role->save();
      
        return $this->sendResponse($role, 'Role Created Successfully.', Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */

    public function show(Role $role)
    {
        return $this->sendResponse($role, 'Role Return Successfully.', Response::HTTP_OK);
    }

/**
 * Show the form for editing the specified resource.
 */
    public function edit(Role $role)
    {
        return $this->sendResponse($role, 'Role Return Successfully.', Response::HTTP_OK);
    }

/**
 * Update the specified resource in storage.
 */

    public function update(Request $request, Role $role)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:roles,name,' . $role->id,'min:3','max:50'
            ],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $role->name = $request->name;
        $role->slug = Str::slug($request->name,'_');
        $role->update();
        return $this->sendResponse($role, 'Role Updated Successfully.', Response::HTTP_OK);
    }

/**
 * Remove the specified resource from storage.
 */
    public function destroy(Role $role)
    {

        $role->delete();
        $role->permissions()->detach();
        return $this->sendResponse([], 'Role Deleted Successfully.', Response::HTTP_OK);
    }

}
