<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth()->user()->type==='SuperAdmin'){
            return User::query()->where('type','!=','SuperAdmin')->paginate(5);
        }else{
            return response('you dont have access to this information', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth()->user()->type==='SuperAdmin'){
            $validator=Validator::make(request()->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
                'type'=>'required'
            ]);
            $validator->after(function($validator){
                if ($this->validateType()){
                    $validator->errors()->add('type','the type is incorrect');
                }
            });
            if ($validator->fails()){
                return response()->json([
                    'message' => $validator->errors(),
                    'errors' => $validator->errors()->all()
                ], 400);
            }
            $validated_data=$validator->validated();
            User::query()->create(request()->all());
            return response()->json([
                'message'=>'User created successfully',
            ],201);

        }else{
            return response('you dont have access to do this action', 401);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //we don't need this right now
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (Auth()->user()->type==='SuperAdmin'){
            $validator=Validator::make(request()->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required',
                'type'=>'required'
            ]);
            $validator->after(function($validator){
                if ($this->validateType()){
                    $validator->errors()->add('type','the type is incorrect');
                }
            });
            if ($validator->fails()){
                return response()->json([
                    'message' => $validator->errors(),
                    'errors' => $validator->errors()->all()
                ], 400);
            }
            $validated_data=$validator->validated();
            $user->update(request()->all());
            return response()->json([
                'message'=>'User created successfully',
            ],201);

        }else{
            return response('you dont have access to do this action', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Auth()->user()->type==='SuperAdmin'){
           $user->delete();
           return response()->json([
               'message'=>'User deleted successfully',
           ],201);
        }else{
            return response('you dont have access to do this action', 401);
        }
    }

    public function validateType()
    {
        if (request('type') == 'SuperAdmin' || request('type') == 'Admin' || request('type') == 'User') {
            return false;
        }else{
            return true;
        }
    }
}
