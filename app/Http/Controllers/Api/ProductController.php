<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->list());
    }

    public function store(StoreProductRequest $request)
    {
        return response()->json(
            $this->service->store($request->validated()),
            201
        );
    }

    public function show($id)
    {
        return response()->json($this->service->show($id));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        return response()->json(
            $this->service->update($id, $request->validated())
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Product deleted']);
    }
}

