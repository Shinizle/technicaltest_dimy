<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddNewProductRequest;
use App\Http\Requests\Api\GetProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAllProducts()
    {
        $data = Product::paginate();

        return new ProductResourceCollection($data);
    }

    public function getProduct(GetProductRequest $request)
    {
        $data = Product::find($request->id);

        return new ProductResource($data);
    }

    public function addNewProduct(AddNewProductRequest $request)
    {
        $data = $this->mapNewProduct($request);

        return new ProductResource($data);
    }

    private function mapNewProduct($request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();

        return $product;
    }
}
