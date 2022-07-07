<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddNewPaymentMethodRequest;
use App\Http\Resources\PaymentMethodResourceCollection;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function getAllPaymentMethods()
    {
        $data = PaymentMethod::paginate();

        return new PaymentMethodResourceCollection($data);
    }

    public function addNewPaymentMethods(AddNewPaymentMethodRequest $request)
    {
        PaymentMethod::create($request->all());

        return response()->json(['message' => "New payment method has been added."]);
    }
}
