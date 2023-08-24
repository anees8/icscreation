<?php

namespace App\Http\Controllers;

use App\Models\{User,Role};
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles','roles.permissions')->get();
        return $this->sendResponse($users, 'Users return Successfully.', Response::HTTP_OK);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->sendResponse($user, 'User return Successfully.', Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function assignRoleToUser(Request $request, User $user){

        $validator = Validator::make($request->all(), [
             'role_id' => 'required|exists:roles,id',
    
        ]);

        if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $user->roles()->sync($request->role_id);
        $user->load('roles');

        return $this->sendResponse($user, 'Role assigned to user.', Response::HTTP_OK);

}

public function revokeRoleFromUser(Request $request, User $user){
    $validator = Validator::make($request->all(), [
        'role_id' => 'required|exists:roles,id',
    ]);

    if ($validator->fails()) {
    return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
    }

    $user->roles()->detach($request->role_id);
    $user->load('roles');

    return $this->sendResponse($user, 'Role assigned to user.', Response::HTTP_OK);
}



  
}
