<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;

class ProductService
{
    protected $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->getAll();
    }

    public function show($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->repo->find($id);
        return $this->repo->update($product, $data);
    }

    public function delete($id)
    {
        $product = $this->repo->find($id);
        return $this->repo->delete($product);
    }
}
