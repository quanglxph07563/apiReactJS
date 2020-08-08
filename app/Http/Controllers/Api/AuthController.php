<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\signupRequest;
use App\User;
class AuthController extends Controller
{
    public function signup(signupRequest $signupRequest)
    {
        $user = new User([
            'name' => $signupRequest->name,
            'email' => $signupRequest->email,
            'phone' => $signupRequest->phone,
            'password' => bcrypt($signupRequest->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Tài khoản hoặc mật khẩu không đúng'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function getAllUser()
    {
       return User::all();
    }

    public function changePermission($id)
    {
        $user = User::find($id);
        if($user->permission == 2){
            $user->permission = 1;
        }else{
            $user->permission = 2;
        }
        $user->save();
        return 'thành công';
    }
}
