<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;

use Symfony\Component\HttpFoundation\Response;



class OrderStatusController extends Controller
{
    //
    public function update(Request $request,$orderId)

    {
        // $validator=validator($request->all(),[
        // ]);

        $order =Order::findOrFail($orderId);
        $order->status='completed';
        $order->supplier=auth()->user()->UserName;
        $isUdated=$order->save();
        return response()->json([
            'message'=>$isUdated ? 'Order Completed !' : 'some Thing erorr',
        ],$isUdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
    // public function updateQun (Request $request){
    //     $item=Item::find($request->id);
    //     $newQun=$request->quantity + $item->quantity;
    //     $item->quantity=$newQun;
    //     $item->save();
    //     return response()->json([
    //         'message'=>'Quntity Updated successfully'],200);
        

    // }
    // public function updateQun(Request $request, $id) {
    //     $item = Item::find($id);
        
    //     if (!$item) {
    //         return response()->json(['message' => 'Item not found'], 404);
    //     }
    
    //     $newQun = $request->quantity + $item->quantity;
    //     $item->quantity = $newQun;
    //     $item->save();
    
    //     return response()->json(['message' => 'Quantity updated successfully'], 200);
    // }
    public function updateQun(Request $request, $id) {
        $item = Item::find($id);
        
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
    
        $newQun = $request->quantity + $item->quantity;
        $item->quantity = $newQun;
        $item->save();
    
        return response()->json(['message' => 'Quantity updated successfully'], 200);
    }


    }

