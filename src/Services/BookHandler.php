<?php

namespace App\Services;

use App\Entity\Book;
use App\Repository\BookRepository;

class BookHandler
{
    public function __construct(
        private readonly BookRepository $repository,
    ) {}
    
    /** 
     * returns an array of Book entities 
     * @return Book[]
    */
    public function handle(string $searchTerm): array
    {
        return $this->repository->findByExampleSearchTerm($searchTerm);
    }
}