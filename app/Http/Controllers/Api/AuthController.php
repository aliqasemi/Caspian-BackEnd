<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $accessToken = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $accessToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->all();

        if (!auth()->attempt($data)) {
            if (Arr::get($data, 'phoneNumber')){
                return response()->json('شماره تلفن همراه یا رمز عبور اشتباه است.', 422);
            }
            else{
                return response()->json('ایمیل یا رمز عبور اشتباه است.', 422);
            }
        }

        $user = auth()->user();
        $tokenResult = $user->createToken('userToken');
        $tokenModel = $tokenResult->token;

        if ($request->remember_me) {
            $tokenModel->expires_at = Carbon::now()->addWeeks(1);
        }


        $tokenModel->save();

        return response()->json([
            'user' => new UserResource($user),
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer'
        ]);

    }

    public function logout(Request $request)
    {
        /** @var User $user
         */
        $request->user()->token()->revoke();
        return response()->json('شما با موفقیت خارج شدید.');
    }

    public function changePassword(){

    }

    public function userAuthorize(User $user, Request $ability): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', User::class);
        $this->validate($ability, [
            'ability' => 'required|string|in:user,admin',
        ]);

        $user->role = $ability->ability;

        $user->save();

        return response()->json('عملیات با موفقیت انجام شد.');
    }
}
