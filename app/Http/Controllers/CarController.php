<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Car::all();
        return response()->view('cms.cars.index',['cars'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=validator($request->all(),
        ['car_num'=>'required|min:7|max:7',
         'car_name'=>'required|string|max:25|min:3',
         'car_city'=>'required|string|max:25|min:3',
         'car_status'=>'boolean|required']
    );
    if(!$validator->fails()){
        $car = new Car();
        $car->car_num=$request->input('car_num');
        $car->car_name=$request->input('car_name');
        $car->made_in=$request->input('car_city');
        $car->car_status=$request->input('car_status');
        $isSaved=$car->save();
        return response()->json([
            'message'=>$isSaved ? 'Create Done' : 'Create Failed',
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
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
