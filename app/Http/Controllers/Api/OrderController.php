<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetAllOrderProductRequest;
use App\Http\Requests\Api\GetAllOrderRequest;
use App\Http\Resources\OrderProductResourceCollection;
use App\Http\Resources\OrderResourceCollection;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAllOrders(GetAllOrderRequest $request)
    {
        $data = Order::whereCustomerId($request->customer_id)->paginate();

        return new OrderResourceCollection($data);
    }

    public function getAllOrderProducts(GetAllOrderProductRequest $request)
    {
        $data = OrderProduct::whereOrderId($request->order_id)->paginate();

        return new OrderProductResourceCollection($data);
    }
}
