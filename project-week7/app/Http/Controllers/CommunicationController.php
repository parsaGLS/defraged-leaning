<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Communication::select('type','created_at')->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator=null ;
        if (request('type')=='email') {
            $validator=Validator::make($request->all([
                'name',
                'email',
                'host',
                'username',
                'password'
            ]),[
                'name'=>'required',
                'email'=>'required',
                'host'=>'required',
                'username'=>'required',
                'password'=>'required',
            ]);
        }else if (request('type')=='sms') {
            $validator=Validator::make($request->all([
                'name',
                'token'
            ]),[
                'name'=>'required',
                'token'=>'required',
            ]);
        }else{
            return response()->json([
                'error'=>'type not found',
            ],401);
        }

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $validatedData = $validator->validated();
        $created_by=auth()->user()->id;

        $objectConfig=Communication::query()->create(array_merge($validatedData,['created_by'=>$created_by]));
        return response()->json([
            'message' => 'Object Config Created Successfully',
            'data' => $objectConfig,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Communication $communication)
    {
        return $communication;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Communication $communication)
    {
        $validator=null ;
        if (request('type')=='email') {
            $validator=Validator::make($request->all([
                'name',
                'email',
                'host',
                'username',
                'password'
            ]),[
                'name'=>'required',
                'email'=>'required',
                'host'=>'required',
                'username'=>'required',
                'password'=>'required',
            ]);
        }else if (request('type')=='sms') {
            $validator=Validator::make($request->all([
                'name',
                'token'
            ]),[
                'name'=>'required',
                'token'=>'required',
            ]);
        }else{
            return response()->json([
                'error'=>'type not found',
            ],401);
        }

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $validatedData = $validator->validated();
        $objectConfig=$communication->update($validatedData);
        return response()->json([
            'message' => 'Object Config Updated Successfully',
            'data' => $objectConfig,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Communication $communication)
    {
        $communication->delete();
        return response()->json([
            'message' => 'Object Config Deleted Successfully',
        ],201);
    }
}
