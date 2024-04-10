<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        $stores = $this->storeService->getAllStores();
        return response()->json($stores);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'active' => 'boolean',
        ]);

        $store = $this->storeService->createStore($validatedData);
        return response()->json($store, 201);
    }

    public function show($id)
    {
        $store = $this->storeService->getStoreById($id);
        return response()->json($store);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'active' => 'boolean',
        ]);

        $store = $this->storeService->updateStore($id, $validatedData);
        return response()->json($store, 200);
    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);
        return response()->json(null, 204);
    }

    public function addBook($storeId, $bookId)
    {
        $this->storeService->addBookToStore($storeId, $bookId);
        return response()->json([
            'success' => true,
            'message' => 'Book added to store'
        ], 200);
    }

    public function removeBook($storeId, $bookId)
    {
        $this->storeService->removeBookFromStore($storeId, $bookId);
        return response()->json([
            'success' => true,
            'message' => 'Book removed from store'
        ], 200);
    }
}
