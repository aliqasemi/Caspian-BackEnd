<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
            'phoneNumber' => 'required|regex:/(09)[0-9]{9}/|digits:11|unique:users',
            'email' => 'required|email|unique:users',
            'address' => 'nullable|string|max:150|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $accessToken = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $accessToken,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'email|required_without_all:phoneNumber',
            'phoneNumber' => 'regex:/(09)[0-9]{9}/|digits:11|required_without_all:email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 422);
        }

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

}
