<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\category;
use Symfony\Component\HttpFoundation\Response;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=Item::all();
        
        return response()->view('cms.items.index',['items'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=category::all();
        return response()->view('cms.items.create',['categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=validator($request->all(),
        ['item_name'=>'required',
        'description'=>'required',
         'location'=>'required',
         'category'=>'required',
         'unit_price'=>'required',
         'reorder_level'=>'required',
         'barcode'=>'required',
         'expiry_date'=>'required',





         ]
    );
    if(!$validator->fails()){
        $item = new Item();
        $item->name=$request->input('item_name');
        $item->description=$request->input('description');
        $item->location=$request->input('location');
        $item->category_id=$request->input('category');
        $item->quantity=$request->input('quantity');
        $item->unit_price=$request->input('unit_price');
        $item->reorder_level=$request->input('reorder_level');
        $item->barcode=$request->input('barcode');
        $item->expiry_date=$request->input('expiry_date');

        // 




        $isSaved=$item->save();
        return response()->json([
            'message'=>$isSaved ? 'New Item Added' : 'Add Failed',
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
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
        $categories=category::all();

        return response()->view('cms.items.edit',['item'=>$item,'categories'=> $categories]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
        $deleted=$item->delete();
        return response()->json([
            'title'=>$deleted ?'Delete successsfuly':'Delete failled',
            'icon'=>$deleted ?'success':'erorr'
        ]);
    }
    
}
