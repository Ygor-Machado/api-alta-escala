<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandServices;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct(protected BrandServices $brandServices)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandServices->list();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        $brand = $this->brandServices->store($request);

        return response()->json(['message' => 'Brand created successfully', 'brand' => $brand]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $brand = $this->brandServices->update($request, $brand);

        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
