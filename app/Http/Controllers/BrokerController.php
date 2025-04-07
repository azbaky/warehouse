<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class BrokerController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Broker::class,'broker');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


        $data=Broker::withCount('permissions','orders')->get();
        return response()->view('cms.brokers.index',['brokers'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.brokers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=validator($request->all(),[
            'email'=>'required|string|email|unique:admins,email',
            'name'=>'required|string|max:45|min:3',
            'phone_number'=>'required',
            'address'=>'required',
        ]);
        if(! $validator->fails()){
            $broker =new broker();
            $broker->name=$request->input('name');
            $broker->email=$request->input('email');
            $broker->phone_number=$request->input('phone_number');
            $broker->address=$request->input('address');
            $broker->customer_type='member_customer';
            $broker->password=Hash::make(12345);
            $isSaved=$broker->save();


            return response()->json([
                'message'=>$isSaved ? 'Create Done' : 'Create Failed',
            ],$isSaved ? Response::HTTP_CREATED :Response::HTTP_BAD_REQUEST);


        }
        else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ] ,Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Broker $broker)
    {
        //
        $orders = order::where('broker_id',$broker->id)->get();   

        return response()->view('cms.brokers.orders',['orders'=>$orders,'broker'=>$broker]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Broker $broker)
    {
        //
        return response()->view('cms.brokers.edit',['broker'=>$broker]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Broker $broker)
    {
        //
        $validator=validator($request->all(),[
            'email'=>'required|string|email|unique:admins,email',
            'name'=>'required|string|max:45|min:3',
            'phone_number'=>'required',
            'address'=>'required',
        ]);
        if(! $validator->fails()){
            $broker->name=$request->input('name');
            $broker->email=$request->input('email');
            $broker->phone_number=$request->input('phone_number');
            $broker->address=$request->input('address');
            $isSaved=$broker->save();
            


            return response()->json([
                'message'=>$isSaved ? 'Updated Done' : 'Update Failed',
            ],$isSaved ? Response::HTTP_OK :Response::HTTP_BAD_REQUEST);


        }
        else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ] ,Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Broker $broker)
    {
        //
        $deleted=$broker->delete();
        return response()->json([
            'title'=>$deleted ?'Delete successsfuly':'Delete failled',
            'icon'=>$deleted ?'success':'erorr'
        ]);
    }
}
