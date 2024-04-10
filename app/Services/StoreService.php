<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->all();
    }

    public function createStore(array $data)
    {
        return $this->storeRepository->create($data);
    }

    public function getStoreById($id)
    {
        return $this->storeRepository->find($id);
    }

    public function updateStore($id, array $data)
    {
        $store = $this->storeRepository->find($id);
        return $this->storeRepository->update($store, $data);
    }

    public function deleteStore($id)
    {
        $store = $this->storeRepository->find($id);
        $this->storeRepository->delete($store);
    }

    public function addBookToStore($storeId, $bookId)
    {
        $store = $this->storeRepository->find($storeId);

        if (!$store->books()->where('book_id', $bookId)->exists()) {
            $store->books()->attach($bookId);
        }
    }

    public function removeBookFromStore($storeId, $bookId)
    {
        $store = $this->storeRepository->find($storeId);

        $store->books()->detach($bookId);
    }
}
