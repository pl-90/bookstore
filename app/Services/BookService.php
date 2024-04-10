<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks()
    {
        return $this->bookRepository->all();
    }

    public function createBook(array $data)
    {
        return $this->bookRepository->create($data);
    }

    public function getBookById($id)
    {
        return $this->bookRepository->find($id);
    }

    public function updateBook($id, array $data)
    {
        $book = $this->bookRepository->find($id);
        return $this->bookRepository->update($book, $data);
    }

    public function deleteBook($id)
    {
        $book = $this->bookRepository->find($id);
        $this->bookRepository->delete($book);
    }
}
