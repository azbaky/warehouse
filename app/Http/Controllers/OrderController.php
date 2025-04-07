<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\Customer;
use App\Models\OrderItem;



use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    $data = Order::orderBy('date', 'desc')->get(); 
    return response()->view('cms.orders.index', ['orders' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items=Item::all();
        $customers=Customer::all();
    return view('cms.orders.create',['customers'=>$customers,'items'=>$items]);
    // );
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'customer_id' => 'nullable|exists:customers,id', // Make customer_id nullable
             'payment_type' => 'required|in:paypal,credit_card,bank_transfer',
             'items' => 'required|array|min:1',
             'items.*.item_id' => 'required|exists:items,id',
             'items.*.quantity' => 'required|integer|min:1',
         ]);
     
         // Calculate the total price of the order
         $total = 0;
         $items = $validatedData['items'];
     
         foreach ($items as $item) {
             $itemData = Item::find($item['item_id']);
     
             if (!$itemData) {
                 return response()->json(['error' => "Invalid item with ID: {$item['item_id']}"], 400);
             }
     
             // Check if enough quantity is available
             if ($itemData->quantity < $item['quantity']) {
                 return response()->json(['error' => "Not enough quantity for item ID: {$item['item_id']}"], 400);
             }
     
             $price = $itemData->unit_price; // Fetch the unit price from the items table
             $itemTotal = $price * $item['quantity']; // Calculate total for each item
     
             $total += $itemTotal; // Sum up the total price
         }
     
         try {
             // Begin transaction
             DB::beginTransaction();
     
             // Determine if the user is an admin or a broker
             $isAdmin = auth('admin')->check();
             $status = $isAdmin ? 'completed' : 'pending';
             $supplier = $isAdmin ? auth()->user()->UserName : '';
             
             // Set broker_id based on the logged-in user
             $brokerID = auth('broker')->check() ? auth('broker')->user()->id : null; // Get broker ID if logged in as broker
     
             // Create the order
             $order = Order::create([
                 'customer_id' => $isAdmin ? $validatedData['customer_id'] : null, // Set customer_id if admin
                 'broker_id' => $brokerID, // Set broker_id if broker
                 'status' => $status,
                 'payment_type' => $validatedData['payment_type'],
                 'total' => $total,
                 'supplier' => $supplier,
                 'date' => now(),
             ]);
     
             // Insert each item into the order_items table and update item quantities
             foreach ($validatedData['items'] as $item) {
                 $itemData = Item::find($item['item_id']);
                 $price = $itemData->unit_price;
                 $itemTotal = $price * $item['quantity'];
     
                 // Create order item
                 OrderItem::create([
                     'order_id' => $order->id,
                     'item_id' => $item['item_id'],
                     'quantity' => $item['quantity'],
                     'price' => $price,
                     'total' => $itemTotal,
                 ]);
     
                 // Update the item's quantity
                 $itemData->decrement('quantity', $item['quantity']);
             }
     
             // Commit transaction
             DB::commit();
     
             return response()->json(['message' => 'Order created successfully', 'order_id' => $order->id], 201);
         } catch (Exception $e) {
             // Rollback transaction in case of error
             DB::rollBack();
             return response()->json(['error' => 'Failed to create order', 'details' => $e->getMessage()], 500);
         }
     }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
 
                // Fetch Order Items
        $orderItems = DB::table('order_items')
        ->join('items', 'order_items.item_id', '=', 'items.id')
        ->join('orders', 'order_items.order_id', '=', 'orders.id') 
        ->where('order_items.order_id', $order->id)
        ->select(
            'order_items.id AS order_item_id',
            'order_items.order_id',
            'order_items.item_id',
            'items.name AS item_name',
            // 'order.status AS order_status',
            'items.description AS item_description',
            'order_items.quantity',
            'order_items.price'
        )
        ->get();

        // Fetch Customer Data
        // $customer = DB::table('customers')
        // ->join('orders', 'customers.id', '=', 'orders.customer_id')
        // ->where('orders.id', $order->id)
        // ->select(
        //     'customers.id AS customer_id',
        //     'customers.name AS customer_name',
        //     'customers.email AS customer_email',
        //     'customers.phone_number AS customer_phone',
        //     'customers.address AS customer_address'
        // )
        // ->first();
        $customer = DB::table('customers')
        ->join('orders', 'customers.id', '=', 'orders.customer_id')
        ->where('orders.id', $order->id)
        ->select(
            'customers.id AS customer_id',
            'customers.name AS customer_name',
            'customers.email AS customer_email',
            'customers.phone_number AS customer_phone',
            'customers.address AS customer_address'
        )
        ->first();

    // If customer is null, retrieve broker information
        if (!$customer) {
            $customer = DB::table('brokers')
                ->join('orders', 'brokers.id', '=', 'orders.broker_id')
                ->where('orders.id', $order->id)
                ->select(
                    'brokers.id AS broker_id',
                    'brokers.name AS broker_name',
                    'brokers.email AS broker_email',
                    'brokers.phone_number AS broker_phone',
                    'brokers.address AS broker_address'
                )
                ->first();
    }

        // Passing data to the view
        return view('cms.orders.view', [
        'orderItems' => $orderItems,
        'order' => $order,
        'customer' => $customer
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
        $deleted=$order->delete();
        return response()->json([
            'title'=>$deleted ?'Delete successsfuly':'Delete failled',
            'icon'=>$deleted ?'success':'erorr'
        ]);
    
    }
}
