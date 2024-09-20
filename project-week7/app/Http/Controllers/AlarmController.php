<?php

namespace App\Http\Controllers;

use App\Models\Alarm;
use App\Models\ObjectConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Alarm::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make([
            'name'=>request('name'),
            'description'=>request('description'),
            'subject'=>request('subject'),
            'treshold'=>request('treshold'),
        ],[
            'name'=>'required',
            'description'=>'required',
            'subject'=>'required',
            'treshold'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $validated_data=$validator->validate();
        $alarm=Alarm::query()->create($validated_data);
        //assign object
        $objectCodes=request('objectCodes');
        foreach ($objectCodes as $objectCode) {
            $object_id=ObjectConfig::query()->where('object_code',$objectCode)->get()->first()->id;
            $alarm->objectConfigs()->syncWithoutDetaching($object_id);
        }
        //assign communication
        //communication send as the ids of them
        $communications=request('communications');
        foreach ($communications as $communication) {
            $alarm->communications()->syncWithoutDetaching($communication);
        }
        //assign cameraGroup
        //cameraGroups send as the ids of them
        $cameraGroups=request('cameraGroups');
        foreach ($cameraGroups as $cameraGroup) {
            $alarm->cameraGroups()->syncWithoutDetaching($cameraGroup);
        }
        //assign users
        //users send as the ids of them
        $users=request('users');
        foreach ($users as $user) {
            $alarm->users()->syncWithoutDetaching($user);
        }












        return "success";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alarm $alarm)
    {
        $validator=Validator::make([
            'name'=>request('name'),
            'description'=>request('description'),
            'subject'=>request('subject'),
            'treshold'=>request('treshold'),
        ],[
            'name'=>'required',
            'description'=>'required',
            'subject'=>'required',
            'treshold'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $validated_data=$validator->validate();
        $alarm=Alarm::query()->create($validated_data);
        //assign object
        $objectCodes=request('objectCodes');
        foreach ($objectCodes as $objectCode) {
            $object_id=ObjectConfig::query()->where('object_code',$objectCode)->get()->first()->id;
            $alarm->objectConfigs()->sync($object_id);
        }
        //assign communication
        //communication send as the ids of them
        $communications=request('communications');
        foreach ($communications as $communication) {
            $alarm->communications()->sync($communication);
        }
        //assign cameraGroup
        //cameraGroups send as the ids of them
        $cameraGroups=request('cameraGroups');
        foreach ($cameraGroups as $cameraGroup) {
            $alarm->cameraGroups()->sync($cameraGroup);
        }
        //assign users
        //users send as the ids of them
        $users=request('users');
        foreach ($users as $user) {
            $alarm->users()->sync($user);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alarm $alarm)
    {
        $alarm->delete();
        return "alarm deleted successfully";
    }



}
