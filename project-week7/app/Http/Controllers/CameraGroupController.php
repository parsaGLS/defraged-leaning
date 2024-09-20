<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\CameraGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CameraGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CameraGroup::with('cameras')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        CameraGroup::query()->create($validated_data);
        return response()->json([
            'message'=>'camera group created successfully'
        ],201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CameraGroup $cameraGroup)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        $cameraGroup->update($validated_data);
        return response()->json([
            'message'=>'camera group updated successfully'
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CameraGroup $cameraGroup)
    {
        $cameraGroup->delete();
        return response()->json([
            'message'=>'camera group deleted successfully'
        ],201);
    }

    public function assignCamera(CameraGroup $cameraGroup ,Request $request)
    {
        $validator=Validator::make($request->all(),[
            'camera_id'=>'required|exists:cameras,id',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Validation Error',
                'errors'=>$validator->errors()
            ],400);
        }
        $validated_data=$validator->validated();
        $camera=Camera::find(request('camera_id'));
        $cameraGroup->cameras()->save($camera);
        return response()->json([
            'message'=>'camera assigned to camera-group successfully',
            'camera'=>$camera,
            'group'=>$cameraGroup
        ],201);
    }

    public function unassignCamera(CameraGroup $cameraGroup,Camera $camera)
    {
        $camera->camera_group_id=null;
        $camera->save();
        return response()->json([
            'message'=>'camera designed to camera-group successfully'
        ],201);
    }
}
