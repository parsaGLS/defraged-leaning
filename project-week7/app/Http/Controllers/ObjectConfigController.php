<?php

namespace App\Http\Controllers;

use App\Models\ObjectConfig;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ObjectConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ObjectConfig::query()->select(['name','id','description'])->paginate(2);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(),[
//            'title'=>['required','string'],
//            'description'=>['required','string'],
//        ]);


//        if($validator->fails()){
//
//            return response()->json([
//                'message' => 'Validation Error',
//                'errors' => $validator->errors(),
//            ], 422);
//
//        }
//        $validatedData = $validator->validated();
//            $data=$request->validated();
//        $task = Task::query()->create($data);
//
//        // Return a success response
//        return response()->json([
//            'message' => 'Task created successfully',
//            'task' => $task
//        ], 201);


        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'object_code'=>'required|unique:object_configs',
            'description'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $validatedData = $validator->validated();
        $objectConfig=ObjectConfig::query()->create($validatedData);
        return response()->json([
            'message' => 'Object Config Created Successfully',
            'data' => $objectConfig,
        ],201);



    }

    /**
     * Display the specified resource.
     */
    public function show(ObjectConfig $objectConfig)
    {
        return $objectConfig;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ObjectConfig $objectConfig)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'object_code'=>'required',
            'description'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $validatedData = $validator->validated();
        $objectConfig->update($validatedData);
        return response()->json([
            'message' => 'Object Config Updated Successfully',
            'data' => $objectConfig,
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ObjectConfig $objectConfig)
    {
        objectConfig::destroy($objectConfig);
        return response()->json([
            'message' => 'Object Config Deleted Successfully',
        ]);

    }
}
