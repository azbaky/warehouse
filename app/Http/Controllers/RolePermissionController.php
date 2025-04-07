<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\permission;




class RolePermissionController extends Controller
{
    
    public function update(Request $request, Role $role)
    {
        //
        $validator=Validator($request->all(),[
            'permission_id'=>'required|integer|exists:permissions,id'
        ]);
        if(! $validator->fails()){
            // $permission=permission::findById($request->input('permission_id'),$role->guard_name);
            $permission=permission::findOrFail($request->input('permission_id'));
            $message='';
             
            if($role->hasPermissionTO($permission)){
                $role->revokePermissionTo($permission);
                $message='Permission revoked successfuly ';
            }
            else{
                $role->givePermissionTo($permission);
                $message='Permission assigned successfuly';
            }
            return response()->json($message,Response::HTTP_OK );
        }
        else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    } 

    
    
}
