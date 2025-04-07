<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\permission;

use Symfony\Component\HttpFoundation\Response;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Role::withCount('permissions')->get();
        return response()->view('cms.spatie.roles.index',['roles'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       // $guard=['admin'=>'Admin',''=>''];
        return response()->view('cms.spatie.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator($request->all(),[
            'name' =>'required|string|min:3|max:45'   ,
            'guard'=>'required|string|in:admin,broker',
        ]);
        if(! $validator->fails()){
            $role            =new Role();
            $role->name      =$request->input('name');
            $role->guard_name=$request->input('guard');
            $isSaved         =$role->save();

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
    public function show(Role $role)
    {
        //
        $permissions=permission::where('guard_name',$role->guard_name)->get();
        
        $rolePermissions=$role->permissions;
        // foreach($rolePermissions as $k=>$v){
        //     echo $k ."===>".$v."<br>";

        // }
        foreach($permissions as $Permission ){
            $Permission->setAttribute('Assigned',false);
            foreach($rolePermissions as $rolePermission ){
                
                if ($rolePermission->id == $Permission->id ){
                     $Permission->SetAttribute('assigned',true);
                }

            }
        }
        return view('cms.spatie.roles.role-permissions',['role'=>$role,'permissions'=>$permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        return response()->view('cms.spatie.roles.edit',["role"=>$role]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $isDeleted=$role->delete();
        return response()->json([
        'icon'=>$isDeleted ?'success': 'error' ,
        'title'=>$isDeleted ?'delete success': ' delete error'
        ],$isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    
    }
}