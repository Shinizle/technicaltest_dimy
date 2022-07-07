<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getAllCustomer()
    {
        $data = Customer::paginate();

        return new CustomerResourceCollection($data);
    }

    public function createCustomer(CreateCustomerRequest $request)
    {
        $data = $this->mapNewCustomer($request);

        return new CustomerResource($data);
    }

    private function mapNewCustomer($request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();

        return $customer;
    }
}
