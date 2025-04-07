<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broker;
use Spatie\Permission\Models\permission;
use Symfony\Component\HttpFoundation\Response;

class BrokerPermissionController extends Controller
{
    
    public function edit(string $id)
    {
        //
        $broker=Broker::findOrFail($id);
        
        $brokerPermissions=$broker->permissions;
        $permissions=Permission::where('guard_name','=','broker')->get();

        foreach($permissions as $Permission ){
            $Permission->setAttribute('Assigned',false);

            foreach($brokerPermissions as $brokerPermission ){
                
                if ($brokerPermission->id == $Permission->id ){
                     $Permission->SetAttribute('assigned',true);
                }

            }
        }
        return response()->view('cms.brokers.broker-permissions',['broker'=>$broker,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator=Validator($request->all(),[
            'permission_id'=>'required|integer|exists:permissions,id'
        ]);
        if(! $validator->fails()){
            $permission=permission::findById($request->input('permission_id'),'broker');
            $broker=Broker::findOrFail($id);
            $message='';
             
            if($broker->hasPermissionTO($permission)){
                $broker->revokePermissionTo($permission);
                $message='Permission revoked successfuly ';
            }
            else{
                $broker->givePermissionTo($permission);
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


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
