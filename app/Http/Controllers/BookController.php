<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;

class BookController
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'isbn' => 'required|numeric|unique:books',
            'value' => 'required|numeric',
        ]);

        $book = $this->bookService->createBook($validatedData);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = $this->bookService->getBookById($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'isbn' => 'required|numeric|unique:books,isbn,' . $id,
            'value' => 'required|numeric',
        ]);

        $book = $this->bookService->updateBook($id, $validatedData);
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $this->bookService->deleteBook($id);
        return response()->json(null, 204);
    }
}
