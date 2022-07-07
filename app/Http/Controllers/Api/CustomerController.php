<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddCustomerAddressRequest;
use App\Http\Requests\Api\CreateCustomerRequest;
use App\Http\Requests\Api\GetCustomerAddressesRequest;
use App\Http\Resources\CustomerAddressResource;
use App\Http\Resources\CustomerAddressResourceCollection;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\Customer;
use App\Models\CustomerAddress;
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

    public function getCustomerAddresses(GetCustomerAddressesRequest $request)
    {
        $data = CustomerAddress::whereCustomerId($request->customer_id)->paginate();

        return new CustomerAddressResourceCollection($data);
    }

    public function addCustomerAddress(AddCustomerAddressRequest $request)
    {
        if($request->is_default) CustomerAddress::whereCustomerId($request->customer_id)->update(['is_default' => false]);
        $data = CustomerAddress::create($request->all());

        return new CustomerAddressResource($data);
    }

    private function mapNewCustomer($request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();

        return $customer;
    }
}
