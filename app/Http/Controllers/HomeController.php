<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Define time periods
        $today = Carbon::today();
        $yesterday = Carbon::now()->subDay();

        // Fetch data from the database
        $newOrdersCount = Order::where('created_at', '>=', $yesterday)->count();
        $sumOfOrders = Order::where('created_at', '>=', $yesterday)->sum('total');
        $newCustomersCount = Customer::where('created_at', '>=', $yesterday)->count();
        $newItemsCount = Item::where('created_at', '>=', $yesterday)->count();

        $orders = DB::table('orders')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('brokers', 'orders.broker_id', '=', 'brokers.id')
            ->select(
                'orders.*',
                'customers.name as customer_name',
                'brokers.name as broker_name',
                DB::raw("CASE 
                    WHEN orders.customer_id IS NOT NULL THEN 'customer' 
                    WHEN orders.broker_id IS NOT NULL THEN 'member' 
                    ELSE 'unknown' 
                END as customer_type")
            )
            ->whereDate('orders.date', $today)
            ->orderBy('orders.id', 'desc')
            ->limit(6)
            ->get();

        // Fetch items with specific conditions directly from the database
        $lowStockItems = Item::whereColumn('quantity', '<=', 'reorder_level')->get();
        $expiredItems = Item::whereNotNull('expiry_date')->where('expiry_date', '<', Carbon::now())->get();
        $soonExpiringItems = Item::whereNotNull('expiry_date')->where('expiry_date', '<=', Carbon::now()->addDays(6))->get();
        $itemsWithoutExpiration = Item::whereNull('expiry_date')->get();

        // Pass data to the view
        return view('cms.temp', [
            'newOrdersCount' => $newOrdersCount,
            'sumOfOrders' => $sumOfOrders,
            'newItemsCount' => $newItemsCount,
            'newCustomersCount' => $newCustomersCount,
            'lastOrders' => $orders,
            'lowStockItems' => $lowStockItems,
            'expiredItems' => $expiredItems,
            'soonExpiringItems' => $soonExpiringItems,
            'itemsWithoutExpiration' => $itemsWithoutExpiration
        ]);
    }
}