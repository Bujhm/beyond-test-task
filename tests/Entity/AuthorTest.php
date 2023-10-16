<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use PHPUnit\Framework\TestCase;
use App\Entity\Author;

class AuthorTest extends TestCase
{
    public function testGetId(): void
    {
        $author = new Author();

        // Use reflection to set private id
        $reflection = new \ReflectionClass($author);
        $property = $reflection->getProperty('id');
        $property->setValue($author, 123);

        $this->assertEquals(123, $author->getId());
    }

  public function testSetName(): void
  {
    $author = (new Author())->setName('John Doe');
    
    $name = $author->getName();
    $this->assertEquals('John Doe', $name);
  }

  public function testGetBooks(): void
  {
      $author = (new Author())
          ->addBook(new Book())
          ->addBook(new Book());

      $this->assertIsIterable($author->getBooks());
      $this->assertCount(2, $author->getBooks());
  }
  
  public function testRemoveBook(): void
  {
      $author = new Author();
      $book1  = new Book();
      $book2  = new Book();

      $author
          ->addBook($book1)
          ->addBook($book2);

      $this->assertIsIterable($author->getBooks());
      $this->assertCount(2, $author->getBooks());

      $author->removeBook($book1);

      $this->assertNotContains($book1, $author->getBooks());
      $this->assertContains($book2, $author->getBooks());
      $this->assertCount(1, $author->getBooks());
  }
}