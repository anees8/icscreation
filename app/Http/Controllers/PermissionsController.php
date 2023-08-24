<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::all();
        return $this->sendResponse($permissions,'Permission Return Successfully.',Response::HTTP_OK);
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
                'unique:permissions,name,','min:3','max:50'
            ],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->slug = Str::slug($request->name,'_');

        $permission->save();
        return $this->sendResponse($permission, 'Permission Created Successfully.', Response::HTTP_CREATED);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
        return $this->sendResponse($permission, 'Permission Return Successfully.', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
        return $this->sendResponse($permission, 'Permission Return Successfully.', Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'unique:permissions,name,' . $permission->id,'min:3','max:50'
            ],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $permissions->name = $request->name;
        $permissions->slug = Str::slug($request->name,'_');
        $permissions->update();
        return $this->sendResponse($permissions, 'Permission Updated Successfully.', Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->sendResponse([], 'Permission Deleted Successfully.', Response::HTTP_OK);
    }

    
}
