<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use ApiResponseTrait;
    public function addOrder(OrderRequest $request)
    {
        $shopProduct = ShopProduct::where('id', $request->input('shop_product_id'))->first();

        $order = new Order();
        $order->shop_product_id = $request->input('shop_product_id');
        $order->order_number = 'ORD-'.uniqid();
        $order->quantity = $shopProduct->quantity;
        $order->unit_price = $shopProduct->unit_price;
        $order->total_price = $order->quantity * $order->unit_price;
        $order->save();

        return $this->successResponse('Order added successfully.', $order);
    }
}
