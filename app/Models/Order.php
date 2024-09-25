<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_product_id',
        'order_number',
        'quantity',
        'unit_price',
        'total_price',
    ];
    
    public function shopProduct()
    {
        return $this->belongsTo(ShopProduct::class);
    }
}
