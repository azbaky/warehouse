<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\permission;
use Symfony\Component\HttpFoundation\Response;
class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=permission::all();
        return response()->view('cms.spatie.permissions.index',['permissions'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.spatie.permissions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator =Validator($request->all(),[
            'name' =>'required|string|min:3|max:45'   ,
            'guard'=>'required|string|in:admin,broker',
        ]);
        if(! $validator->fails()){
            $permission            =new permission();
            $permission->name      =$request->input('name');
            $permission->guard_name=$request->input('guard');
            $isSaved               =$permission->save();

            return response()->json([
                'message'=>$isSaved ?'CREATED SUCCESSSFULLY':'CREATED fAILED'
            ],$isSaved ?Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        //
        $deleted=$permission->delete();
        return response()->json([
            'title'=>$deleted ?'Delete successsfuly':'Delete failled',
            'icon'=>$deleted ?'success':'erorr'
        ]);
    }
}
