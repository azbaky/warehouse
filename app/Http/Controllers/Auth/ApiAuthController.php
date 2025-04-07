<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
// use Illuminate\Support\Facades\User;
use App\Models\User;

class ApiAuthController extends Controller
{
    //
    public function  login(Request $request){
              $validator=Validator($request->all(),
                 [
                  'email'=>'required|email|exists:users,email',
                  'password'=>'required|string|min:3'
                ]    
            );
        if(! $validator->fails() ){
        $user=User::where('email','=',$request->input('email'))->first();
            if(Hash::check($request->input('password'),$user->password)){
             $token=$user->createToken('login');
             $user->setAttribute('token',$token->accessToken);
            // return  $token;
             return response()->json([
                  'status'=>true,
                  'message'=>'Login successfuly',
                  'object'=>$user,
                  'token'=>$token
                //'token' => $user->createToken('user-api')->plainTextToken


              ]);
        }
            else{
            return response()->json(['message'=>'Erorr'],Response::HTTP_BAD_REQUEST);
        }
     }
        else {
        return response()->json([
            'message'=>$validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
     }
    }

    public function register(Request $request){  
        $validator=Validator($request->all(),
        [   
            'name'=>'required|string|min:3|max:45',
            'email'=>'required|email|unique:users,email',
            'mobile'=>'required|numeric|unique:users,mobile',
            'password'=>'required|string|min:3'
        ]    
     );
     if(! $validator->fails() ){
        $user=new User ();
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->mobile=$request->input('mobile');
        $user->password=Hash::make($request->input('password'));
        $isSaveed=$user->save();
        return response()->json([
            'message'=>$isSaveed?'CREATED ACCOUNT DONR':'ERORR TRY AGINE',
            
            'status' => true,
        ],$isSaveed?Response::HTTP_CREATED:Response::HTTP_BAD_REQUEST);
        
        }
    
     else {
        return response()->json([
            'message'=>$validator->getMessageBag()->first()
        ],Response::HTTP_BAD_REQUEST);
    }
    }

    public function logout(Request $request){
        $token=$request->user('user-api')->token;
        dd($token);
        $revoked=$token->revoked();
        return response()->json([
            'status'=>$revoked,
            'message'=>$revoked ? 'logout success': 'logout Failed'
        ]);
    }
}
