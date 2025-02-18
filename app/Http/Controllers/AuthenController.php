<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Actions\RegisterAction;
use App\Http\Actions\LoginAction;
use Illuminate\Http\Request;
class AuthenController extends Controller
{
    protected $registerAction;
    protected $loginAction;

    public function __construct(RegisterAction $registerAction,LoginAction $loginAction)
    {
        $this->registerAction = $registerAction;
        $this->loginAction = $loginAction;
    }


    public function register(RegisterRequest $request)
    {
        $user = $this->registerAction->execute($request->validated());
        $token = $user->createToken($user->id)->plainTextToken;
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = $this->loginAction->execute($data);

        if ($user) {
            $token = $user->createToken($user->id)->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'access_token' => $token,
            ], 200);
        }


        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}