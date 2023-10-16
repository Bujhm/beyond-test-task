<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use App\Entity\Publisher;
use PHPUnit\Framework\TestCase;

class PublisherTest extends TestCase
{
    public function testGetId(): void
    {
        $publisher = new Publisher();

        // Use reflection to set private id
        $reflection = new \ReflectionClass($publisher);
        $property = $reflection->getProperty('id');
        $property->setValue($publisher, 123);

        $this->assertEquals(123, $publisher->getId());
    }

    public function testGetName(): void
    {
        $publisher = (new Publisher())->setName('World Wide Web');

        $name = $publisher->getName();
        $this->assertEquals('World Wide Web', $name);
    }

    public function testGetBooks(): void
    {
        $publisher = (new Publisher())
            ->addBook(new Book())
            ->addBook(new Book());

        $this->assertIsIterable($publisher->getBooks());
        $this->assertCount(2, $publisher->getBooks());
    }

    public function testRemoveBook(): void
    {
        $publisher = new Publisher();
        $book1 = new Book();
        $book2 = new Book();

        $publisher
            ->addBook($book1)
            ->addBook($book2);

        $this->assertIsIterable($publisher->getBooks());
        $this->assertCount(2, $publisher->getBooks());

        $publisher->removeBook($book1);

        $this->assertNotContains($book1, $publisher->getBooks());
        $this->assertContains($book2, $publisher->getBooks());
        $this->assertCount(1, $publisher->getBooks());
    }
}