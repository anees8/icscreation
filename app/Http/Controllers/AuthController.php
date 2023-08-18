<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator,Hash,Auth};
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }
    
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('Alsufiyan')->accessToken;
        $success['name'] =  $user->name;
    
        return $this->sendResponse($success, 'User register successfully.',Response::HTTP_CREATED);
    }
    
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('Invalid Credential.',['error'=>'Invalid Credential'], Response::HTTP_BAD_REQUEST);          
        }
        $data['user'] = User::where('email', $request['email'])->firstOrFail();
        $data['token'] = $data['user']->createToken('Alsufiyan')->accessToken;   
        $data['token_type'] ='Bearer';
    
        return $this->sendResponse($data, 'Login Successfully.',Response::HTTP_OK);
    }
    
    public function logout(Request $request){        
            $request->user()->token()->revoke();
            return $this->sendResponse([],'User Successfully logged out.',Response::HTTP_OK);
    }
    
    public function me(Request $request){
    $user = $request->user();
    return $this->sendResponse($user,'User return Successfully.',Response::HTTP_OK);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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

        print_r($request->all());

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
}