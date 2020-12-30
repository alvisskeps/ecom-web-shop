<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     */
    public function getAllProducts()
    {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);

        return response($products, 200);
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    public function syncProducts()
    {
        $response = Http::get('https://ecom-storage-system-b5qi2.ondigitalocean.app/api/products');
        $products = collect(json_decode($response->getBody()->getContents(), true));

        foreach ($products as $product) {
                Product::updateOrCreate(
                    [
                        'id' => $product['id']
                    ],
                    [
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'amount' => $product['amount'],
                    ]
                );
        }

        return response($products, 200);
    }

    public function deleteAllProducts()
    {
        Product::truncate();

        return response()->json([
            'message' => 'Products have been deleted'
        ], 202);
    }
}
