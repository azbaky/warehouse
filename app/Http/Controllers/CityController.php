<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // echo "mohammed";
        $data=City::all(); 
       return response()->view('cms.cities.index',['cities'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(['name'=>'string|max:45|min:3|required'],[
            'name.required'=>'Enter City Name',
            'name.string'=>'Must be string Value'
    ]);
       $city=new city();
       $city->name= $request->input('name');
       $isSaved=$city->save();
       session()->flash('alert-type',$isSaved ?'success' :'danger');
       session()->flash('message',$isSaved ? 'Created Succcesfully' :'Created Failed');
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
        echo "osdhf";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
         return response()->view('cms.cities.edit',['city'=>$city]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
        $request->validate(['name'=>'string|max:45|min:3|required'],[
            'name.required'=>'Enter City Name',
            'name.string'=>'Must be string Value']);

            $city->name= $request->input('name');
            $isUpdateed=$city->save();

            session()->flash('alert-type',$isUpdateed ?'success' :'danger');
            session()->flash('message',$isUpdateed ? 'Created Updateed' :'Updateed Failed');
            
            return redirect()->back();
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
        $isDeleted = $city->delete();
        return redirect()->back();
         
    }
}
