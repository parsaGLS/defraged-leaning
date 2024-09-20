<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login_SuperAdmin(Request $request)
    {

        $res = auth()->attempt([
            'email'=>request('email'),
            'password'=>request('password'),
        ]);
        if ($res){
            $user=User::query()->where('email','=',request('email'))->first();
            auth()->login($user);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token'=>$token]);
        }
        return response('you are bad',401);
    }

    public function me()
    {
        return auth()->user();
    }

    public function login(Request $request)
    {
        //TODO implement the login with OTP here . it should search the table for inserted email and code and check code with the one in database with unique email
        $user=User::query()->where('email','=',request('email'))->first();
        $otp=OTP::query()->where('user_id',$user->id)->get()->first();

        if ($otp->code==request('code')){
            auth()->login($user);
            $token = $user->createToken('auth_token')->plainTextToken;
            $otp->delete();
            return response()->json(['token'=>$token]);
        }else{
            return response('code is incorrect',401);
        }
    }



}
