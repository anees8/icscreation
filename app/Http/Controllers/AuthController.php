<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Alsufiyan')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User register successfully.', Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->sendError('Invalid Credential.', ['error' => 'Invalid Credential'], Response::HTTP_BAD_REQUEST);
        }
        $data['user'] = User::where('email', $request['email'])->firstOrFail();
        $data['token'] = $data['user']->createToken('Alsufiyan')->accessToken;
        $data['token_type'] = 'Bearer';

        return $this->sendResponse($data, 'Login Successfully.', Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendResponse([], 'User Successfully logged out.', Response::HTTP_OK);
    }



  }
