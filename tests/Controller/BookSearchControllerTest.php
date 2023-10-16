<?php

namespace App\Tests\Controller;

use Exception;
use PHPUnit\Framework\TestCase;
use App\Controller\BookSearchController;
use App\Services\BookHandler;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\BookRepository;

class BookSearchControllerTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testInvoke(): void
    {
        $bookHandlerMock = $this->createMock(BookHandler::class);
        $bookHandlerMock->method('handle')->willReturn(['book1', 'book2']);

        $controller = new BookSearchController($bookHandlerMock);
        $request = new Request();
        $request->query->set('name', 'test');

        $result = $controller($request);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    public function testInvokeWithNoSearchTerm(): void
    {
        $bookRepositoryMock = $this->createMock(BookRepository::class);
        $bookHandler = new BookHandler($bookRepositoryMock);
        $controller = new BookSearchController($bookHandler);
        $request = new Request();

        $this->expectException(Exception::class);

        $controller($request);
    }

    /**
     * @throws Exception
     */
    public function testInvokeWithEmptyResult(): void
    {
        $bookHandlerMock = $this->createMock(BookHandler::class);
        $bookHandlerMock->method('handle')->willReturn([]);

        $controller = new BookSearchController($bookHandlerMock);
        $request = new Request();
        $request->query->set('name', 'test');

        $this->assertEmpty($controller($request));
    }

    public function testInvokeWithExceptionFromHandler(): void
    {
        $bookHandlerMock = $this->createMock(BookHandler::class);
        $bookHandlerMock->method('handle')
            ->willThrowException(new Exception('Error from handler'));

        $controller = new BookSearchController($bookHandlerMock);
        $request = new Request();
        $request->query->set('name', 'test');

        $this->expectException(Exception::class);

        $controller($request);
    }
}