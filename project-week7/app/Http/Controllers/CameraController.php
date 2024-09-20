<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Camera::paginate(4);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'ip'=>'required|ip',
            'port'=>'required',
            'description'=>'required',
            'camera_code'=>'required|unique:cameras',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'validation error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        Camera::query()->create($validated_data);
        return response()->json([
            'message'=>'camera added successfully'
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Camera $camera)
    {
        return $camera;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camera $camera)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'ip'=>'required|ip',
            'port'=>'required',
            'description'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'validation error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        $camera->update($validated_data);
        return response()->json([
            'message'=>'camera updated successfully'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(camera $camera)
    {
        $camera->delete();
        return response()->json([
            'message'=>'camera deleted successfully'
        ],201);
    }
}
