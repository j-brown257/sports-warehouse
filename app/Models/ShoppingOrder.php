<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingOrder extends Model
{
    protected $table = 'shoppingorder';
    protected $primaryKey = 'shoppingOrderId';
    public $timestamps = false;

    protected $fillable = [
        'orderDate', 'firstName', 'lastName', 'address', 'contactNumber',
        'email', 'creditCardNumber', 'expiryDate', 'nameOnCard', 'csv',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'shoppingOrderId', 'shoppingOrderId');
    }
}