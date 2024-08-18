<?php


namespace App\Services;


use App\Interfaces\Productable;
use App\Models\Product;
use App\Responses\ProductResponse;

class ProductService implements Productable
{

    public function getAllProduct(): ProductResponse
    {
        $products = Product::all();
        $productRes = new ProductResponse();
        $productRes->setMessage("Products Fetched Successfully");
        $productRes->setIsSuccess(true);
        $productRes->setCollection($products);

        return $productRes;
    }


    public function removeProduct(Product $product) : ProductResponse
    {
        $product->forceDelete();
        $productRes = new ProductResponse();
        $productRes->setMessage("Products Removed");
        $productRes->setIsSuccess(true);
        return $productRes;
    }

    public function getSingleProductDetail(Product $product) : ProductResponse
    {
        $productRes = new ProductResponse();
        $productRes->setMessage("Product Fetched Successfully");
        $productRes->setIsSuccess(true);
        $productRes->setModel($product);
        return $productRes;
    }
}
