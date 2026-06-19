<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'orderitem';
    public $timestamps = false;
    public $incrementing = false;   // composite key (itemId + shoppingOrderId), no auto-id

    protected $fillable = ['itemId', 'shoppingOrderId', 'quantity', 'price'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'itemId', 'itemId');
    }
}