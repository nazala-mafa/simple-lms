<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $limit = request()->input('limit', 10);
        $order = request()->input('order', 'desc');
        $orderBy = request()->input('orderBy', 'id');

        $products = Product::orderBy($orderBy, $order)->select(['id', 'name'])->paginate($limit);

        return response()->json(['data' => $products], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $productId = Product::insertGetId([
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product = Product::find($productId);

        return response()->json([
            'message' => "Produk $product->name berhasil disimpan",
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        dd($this->authorize('view'));

        return response()->json([
            'data' => $product
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->input('name');

        return response()->json([
            'message' => "Produk $product->name berhasil diupdate",
            'data' => $product
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => "Produk $product->name berhasil dihapus",
            'data' => $product
        ], 201);
    }
}