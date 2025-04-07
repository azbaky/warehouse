<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';

    // Specify the fillable fields
    protected $fillable = [
        'item_id',
        'order_id',
        'quantity',
        'price',
        'total',
    ];

    // Define the relationship to the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship to the Item model
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
