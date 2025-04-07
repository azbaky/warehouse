<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'status',
        'payment_type',
        'date',
        'customer_id',
        'supplier',
        'broker_id'
    ];
    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }
    
    public function customer()
{
    return $this->belongsTo(Customer::class);
}  
public function broker()
{
    return $this->belongsTo(Broker::class);
}                     
}
