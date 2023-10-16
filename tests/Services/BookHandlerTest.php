<?php

namespace App\Tests\Services;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;
use App\Services\BookHandler;
use App\Repository\BookRepository;

class BookHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $book1 = new Book();
        $book2 = new Book();

        $bookRepositoryMock = $this->createMock(BookRepository::class);
        $bookRepositoryMock->method('findByExampleSearchTerm')
            ->willReturn([$book1, $book2]);

        $bookHandler = new BookHandler($bookRepositoryMock);

        $result = $bookHandler->handle('test');

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContains($book1, $result);
        $this->assertContains($book2, $result);
    }
}