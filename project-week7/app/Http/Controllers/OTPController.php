<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteCodeJob;
use App\Mail\LoginMail;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OTPController extends Controller
{
    public function sendCode(Request $request)
    {
        //TODO search the code of the email for accept the login
        //TODO after login delete the OPT



        $validator=Validator::make(request()->all(),[
            'email'=>'required|email|exists:users,email',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        $code=rand(0,999999);
        $user=User::query()->where('email',$validated_data['email'])->get()->first();
        $exist=$user->otp()->exists();
        if (!$exist) {
            $otp=$user->otp()->create([
                'code'=>$code,
            ]);
            Mail::to($validated_data['email'])->send(new LoginMail($code));
            DeleteCodeJob::dispatch($otp->id)->delay(now()->addMinutes(5));
            return response()->json([
                'message'=>'code sent to your email',
            ],201);
        }else{
            return response()->json([
                'message'=>'code already exist and you did not use the code or the does not finished '  ,
            ],401);
        }
    }
}
