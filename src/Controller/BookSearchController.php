<?php

namespace App\Controller;

use App\Services\BookHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class BookSearchController extends AbstractController
{
    public function __construct(
        private readonly BookHandler $bookHandler,
    ) {}

    public function __invoke(Request $request): array
    {
        $searchTerm = $request->query->get('name');

        if (empty($searchTerm)) {
            throw new \RuntimeException('Search term is required');
        }

        return $this->bookHandler->handle($searchTerm);
    }
}