<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function showLogin(Request $request,$guard){
        return response()->view('cms.auth.login',['guard'=>$guard]);

    }
    public function login (Request $request ) {
        $validator = Validator($request->all(),[
            'guard'=>'required|string|in:admin,broker',
            'email'=>'required|email',
            'password'=>'required|string|min:1|max:20',
            // 'remember_me'=>'required|boolean'
        ],[
            'guard.in'=>'url is not correct'
        ]);
        if(! $validator->fails()){
            $credentials=['email'   =>$request->input('email'),
                          'password'=>$request->input('password')
                         ];

             if(Auth::guard($request->input('guard'))->attempt($credentials,$request->input('remember'))){
                return response()->json([
                    'message'=>'logged in successfully'
                ],Response::HTTP_OK); 
             }  
             else{
                return response()->json([
                    'message'=>'Erorr Information' 
                ],Response::HTTP_BAD_REQUEST);
             }           

        }
        else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
        
    }

    public function editPassword(){

        return response()->view('cms.auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $guard=auth('admin')->check() ? 'admin' :'broker'; 
        $validator= Validator($request->all(),
        [
           'password' => 'required|string|current_password:admin',
           'new_password' => 'required|string|max:25|min:3|confirmed', 
           'new_password_confirmation' => 'required|string|max:25|min:3 ', 

        ]);
        if(! $validator->fails() ){
            $user=auth($guard)->user();
            $user->password =Hash::make($request->input('new_password'));
            $isSaved=$user->save();

            return response()->json(['message'=>$isSaved ? 'password  change successfully':'password  change failed'],
            $isSaved ?  Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function editprofile(Request $req){
        $guard=auth('admin')->check()?'admin' :'broker';
        $user =auth($guard)->user();
        return response()->view('cms.auth.edit-profile',['user'=>$user]);
    }

    public function updateprofile(Request $req){
        $guard=auth('admin')->check()?'admin' :'broker';
        $x=auth($guard)->id();
        $table=$guard=='admin' ? 'admins':'brokers';
        $validator = validator($req->all(),[
            'name'=>'required|string|min:3|max:45',
            'email'=>"required|string|email|unique:$table,email,$x"
        ]);

        if(! $validator->fails()){
            $user=auth($guard)->user();
            $user->name=$req->input('name');
            $user->email=$req->input('email');
            $isSaved=$user->save();

            return response()->json(['message'=>$isSaved ? 'update Profile  successfully':'update Profile failed'],
            $isSaved ?  Response::HTTP_OK :Response::HTTP_BAD_REQUEST);
        }
    }




    public function logout(Request $request){
        // auth('admin')->logout();
        $guard= auth('admin')->check() ? 'admin' : 'broker';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        return redirect()->route('auth.login-view',$guard);
    }
}
