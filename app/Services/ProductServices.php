<?php

namespace App\Services;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductServices
{

    public function list()
    {
        $products = Product::paginate(10);

        return $products;
    }

    public function store(ProductStoreRequest $request) {
        $product = DB::transaction(function () use ($request) {

            $product_data = $request->except("sku");
            $product_data['slug'] = Str::slug($product_data['name']);

            $product = Product::create($product_data);

            $skus = $product->skus()->createMany($request->get('sku'));

            foreach ($skus as $key => $sku) {
                foreach ($request->sku[$key]['images'] as $index => $image) {
                    $path = $image['url']->store('products', 'public');

                    $sku->images()->create([
                        'url' => $path,
                        'cover' => $index == 0
                    ]);
                }
            }

            return $product->load('skus.images');
        });

        return $product;
    }


    public function update(ProductUpdateRequest $request, Product $category)
    {
        $category->update($request->validated());

        return $category;
    }

}
