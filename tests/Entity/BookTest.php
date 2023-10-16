<?php

namespace App\Tests\Entity;

use App\Entity\Publisher;
use App\Entity\Book;
use App\Entity\Author;
use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BookTest extends KernelTestCase
{
    private ValidatorInterface $validator;

    public function testGetId(): void
    {
        $book = new Book();

        // Use reflection to set private id
        $reflection = new ReflectionClass($book);
        $property = $reflection->getProperty('id');
        $property->setValue($book, 123);

        $this->assertEquals(123, $book->getId());
    }

    public function testSetName(): void
    {
        $book = (new Book())->setName('My Book');

        $this->assertEquals('My Book', $book->getName());
    }

    public function testAddAuthor(): void
    {
        $book = new Book();
        $author1 = new Author();
        $author2 = new Author();

        $book
            ->addAuthor($author1)
            ->addAuthor($author2);

        $this->assertContains($author1, $book->getAuthor());
        $this->assertContains($author2, $book->getAuthor());
    }

    public function testSetPublisher(): void
    {
        $book = new Book();
        $publisher = new Publisher();

        $book->setPublisher($publisher);
        $this->assertSame($publisher, $book->getPublisher());
    }

    public function testSetDescription(): void
    {
        $book = (new Book())->setDescription('Test description');

        $this->assertSame('Test description', $book->getDescription());
    }

    public function testSetIsbn(): void
    {
        $book = new Book();
        $book->setIsbn('978316148410');
        $this->assertSame('978316148410', $book->getIsbn());

    }

    public function testValidationBook(): void
    {
        $errorMessages = [];
        $book = new Book();
        $book->setName('Abraham Lincoln');
        $book->setDescription('Abraham Lincoln - book description');
        $book->setIsbn('978316148410');
        $errorList = $this->validator->validate($book);
        $this->assertCount(0, $errorList);

        $book = new Book();
        $book->setName('Abraham Lincoln');
        $book->setDescription('');
        $book->setIsbn('978316dddddddddddddd');
        $errorList = $this->validator->validate($book);

        foreach ($errorList as $constranis) {
            $errorMessages[] = $constranis->getMessage();
        }
        $this->assertCount(3, $errorMessages);
        $this->assertContains('ISBN should contain only numbers', $errorMessages);
        $this->assertContains('ISBN should be 13 digits min', $errorMessages);
        $this->assertContains('This value should not be blank.', $errorMessages);
    }

    public function testRemoveAuthor(): void
    {
        $book = new Book();
        $author = new Author();

        $book->addAuthor($author);
        $book->removeAuthor($author);
        $this->assertNotContains($author, $book->getAuthor());
    }

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = self::getContainer()->get('validator');
    }
}