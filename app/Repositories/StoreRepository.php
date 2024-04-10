<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository
{
    public function all()
    {
        return Store::with('books')->get();
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function find($id)
    {
        return Store::with('books')->findOrFail($id);
    }

    public function update(Store $store, array $data)
    {
        $store->update($data);
        return $store;
    }

    public function delete(Store $store)
    {
        $store->delete();
    }
}
