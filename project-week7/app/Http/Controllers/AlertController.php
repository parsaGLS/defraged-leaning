<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Camera;
use App\Models\CameraGroup;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Alert::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make(request()->all(),[
            'camera'=>'required',
            'objects.conf'=>'required',
            'objects.object'=>'required',
            'description'=>'required',
            'image'=>'required|string',
            'orginalImage'=>'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $validated_data=$validator->validated();
        $cameraGroup=Camera::query()->where('camera_code',$validated_data['camera'])->get()->first();
        if ($cameraGroup!=null){
            $alarms=$cameraGroup->alarms();
//            $alarm=CameraGroup::query()->find($cameraGroupId)->alarm()->get()->first();
            foreach ($alarms as $alarm){
                $objects=$alarm->objectConfigs()->get();
                $checkObject=false;

                foreach ($objects as $object){
                    if ($object->name==$validated_data['objects']['object']){
                        $checkObject=true;
                        break;
                    }
                }
                if ((double)$validated_data['objects']['conf']>=$alarm->treshold && $checkObject){
                    $alert=new Alert();
                    if (preg_match('/^data:image\/(\w+);base64,/', request()->image)) {
                        $data = substr(request()->image, strpos(request()->image, ',') + 1);

                        $data = base64_decode($data);
                        $media=Media::make(
                            $alert,
                            $data,
                            'image',
                            "alerts/{$alert->id}",
                            'alert'
                        );
                    }

                    if (preg_match('/^data:image\/(\w+);base64,/', request()->orginalImage)) {
                        $data = substr(request()->orginalImage, strpos(request()->orginalImage, ',') + 1);

                        $data = base64_decode($data);
                        $media=Media::make(
                            $alert,
                            $data,
                            'orginalImage',
                            "alerts/{$alert->id}",
                            'alert'
                        );
                    }
                    $alert->cameraCode=$validated_data['camera'];
                    $alert->conf=$validated_data['objects']['conf'];
                    $alert->object=$validated_data['objects']['object'];
                    $alert->description=$validated_data['description'];
                    $alert->orginalImagePath="alerts/{$alert->id}/orginalImage";
                    $alert->imagePath="alerts/{$alert->id}/image";
                    $alert->save();
                    return response()->json([
                        "message"=>"alert saved successfully",
                    ]);










                    break;
                }

            }



        }else{
            return 'camera does not assign to any group';
        }

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setStatus(Request $request, Alert $alert)
    {
        if (request('status')=='rejected' || request('status')=='confirmed'){
            $alert->update(['status'=>request('status')]);
            return 'status changed successfully ';
        }else{
            return 'incorrect status';
        }
    }

    public function showPendings()
    {
        return Alert::all()->where('status','pending');
    }
}
