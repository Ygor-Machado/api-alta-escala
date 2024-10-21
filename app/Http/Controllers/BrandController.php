<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BrandController extends Controller
{

    public function __construct(protected BrandServices $brandServices)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Brand::class);

        $brands = $this->brandServices->list();

        return response()->json($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        Gate::authorize('create', Brand::class);

        $brand = $this->brandServices->store($request);

        return response()->json(['message' => 'Brand created successfully', 'brand' => $brand]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        Gate::authorize('view', $brand);

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        Gate::authorize('update', $brand);

        $brand = $this->brandServices->update($request, $brand);

        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        Gate::authorize('delete', $brand);

        $brand->delete();

        return response()->json(['message' => 'Brand deleted successfully']);
    }
}
