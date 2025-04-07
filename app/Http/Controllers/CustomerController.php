<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Customer::withCount('orders')->get();


        return response()->view('cms.customers.index',['customers'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        return response()->view('cms.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                //
                //
                $validator=validator($request->all(),
                ['customer_name'=>'required',
                'email'=>'required|string|email|unique:customers,email',
                'phone_number'=>'required',
                 'address'=>'required',
                 'customer_status'=>'boolean|required']
            );
            if(!$validator->fails()){
                $customer = new Customer();
                $customer->name=$request->input('customer_name');
                $customer->email=$request->input('email');
                $customer->phone_number=$request->input('phone_number');
                $customer->address=$request->input('address');
                $customer->customer_status=$request->input('customer_status');
                $customer->customer_type='customer';
                $isSaved=$customer->save();
                return response()->json([
                    'message'=>$isSaved ? 'New Customer Added' : 'Add Failed',
                ]);
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
    public function show(Customer $customer)
    {
        //
        $orders = order::where('customer_id',$customer->id)->get();   

        return response()->view('cms.customers.orders',['orders'=>$orders,'customer'=>$customer]);
        //  dd( $orders );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        return response()->view('cms.customers.edit',['customer'=>$customer]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
     {
    //     //
        $validator= Validator($request->all(),[
                 'customer_name'=>'required',
                 'email'=>'required|string|email|unique:customers,email,'.$customer->id,
                 'phone_number'=>'required',
                 'address'=>'required',
                 'customer_status'=>'boolean|required'
        ]);
        if(! $validator->fails()){
            $customer->name=$request->input('customer_name');
            $customer->email=$request->input('email');
            $customer->phone_number=$request->input('phone_number');
            $customer->address=$request->input('address');
            $customer->customer_status=$request->input('customer_status');
            $isUdated=$customer->save();
            return response()->json([
                'message'=>$isUdated ? 'Updated Done' : 'Update Failed',
            ],$isUdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);

        }else{
            return response()->json([
                'message'=>$validator->getMessageBag()->first()
            ],Response::HTTP_BAD_REQUEST);
        }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $deleted=$customer->delete();
        return response()->json([
            'title'=>$deleted ?'Delete successsfuly':'Delete failled',
            'icon'=>$deleted ?'success':'erorr'
        ]);
    }
    }

