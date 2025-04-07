<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{


    // public function __construct(){

    //     $this->authorizeResource(category::class, 'category');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data=category::all();

        return response()->view('cms.categories.index',['categories'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator=validator($request->all(),
        [
            'name'=>'required|string|min:3|max:45',
            'description'=>'nullable|string|min:5|max:100',
            'status'=>'boolean|required'
        ]);
        if(! $validator->fails()){
        $category = new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->status=$request->input('status');
        $isSaved=$category->save();
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
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
        return response()->view('cms.categories.edit',["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
        $validator= Validator($request->all(),[
            'name' =>'string|required|min:3|max:45',
            'description' =>'string|min:5',
            'status' =>'required|boolean',
        ]);
        if(! $validator->fails()){
            $category->name=$request->input('name');
            $category->description=$request->input('description');
            $category->status=$request->input('status');
            $isUdated=$category->save();

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
    public function destroy(category $category)
    {
        //
        $isDeleted=$category->delete();
        return response()->json([
        'icon'=>$isDeleted ?'success': 'error' ,
        'title'=>$isDeleted ?'delete success': ' delete error'
        ],$isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
