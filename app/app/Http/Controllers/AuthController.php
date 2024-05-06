<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string'

        ]);
        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])

        ]);
        $token=$user->createToken('myapptoken')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response()->json([
            'response'=>$response
            ],200);
    }
    public function logout(Request $request){
     $user=$request->user();
     $user->tokens()->delete();
        return response()->json([
            'message'=>'Logged out Success'
        ],200); 
    }
    public function Create(CreateRequest $request){
        $this->authorize('create-delete-users');
        $usercreate=User::create($request->validated());

        return response()->json([
            'user'=>$usercreate
        ],200); 
    }

    public function login(LoginRequest $request){
        $credentials = request(['email', 'password']);
        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken(Auth()->user()->createToken('myapptoken')->plainTextToken);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
