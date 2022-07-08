<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Http\Requests\Api\GetAllOrderProductRequest;
use App\Http\Requests\Api\GetAllOrderRequest;
use App\Http\Resources\OrderProductResourceCollection;
use App\Http\Resources\OrderResource;
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

    public function createOrder(CreateOrderRequest $request)
    {
        $data = $this->mapNewOrder($request);

        return new OrderResource($data);
    }

    private function mapNewOrder($request)
    {
        \DB::beginTransaction();

        try {
            $order = new Order();
            $order->fill($request->all());
            $order->save();

            $total_price = 0;
            foreach ($request->products as $key => $value) {
                $total_price = (int)$total_price + ((int)$value['quantity'] * (int)$value['price']);
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $value['id'],
                    'quantity' => $value['quantity'],
                    'price' => $value['price'],
                ]);
            }
            $order->update(['total_price' => $total_price]);

            \DB::commit();

            return $order;
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['message' => "Server error."], 400);
        }
    }
}
