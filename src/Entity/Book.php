<?php

namespace App\Entity;

use App\Controller\BookSearchController;
use App\Repository\BookRepository;
use Doctrine\{Common\Collections\ArrayCollection, Common\Collections\Collection, DBAL\Types\Types, ORM\Mapping as ORM};
use ApiPlatform\{Metadata\ApiResource,
    Metadata\Get,
    Metadata\Post,
    Metadata\Put,
    Metadata\Patch,
    Metadata\Delete,
    Metadata\GetCollection};
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Index(columns: ['name'], name: 'name_idx', flags: ['fulltext'])]
#[ApiResource(operations: [
    new Get(
        uriTemplate: '/books/search',
        controller: BookSearchController::class,
        read: false,
        name: 'search',
    ),
    new Get(),
    new GetCollection(),
    new Post(),
    new Put(),
    new Patch(),
    new Delete(),
])]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[ORM\Column(type: Types::TEXT, length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Publisher $publisher = null;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Assert\Length(
        min: 10,
        max: 13,
        minMessage: 'ISBN should be 10 digits min',
        maxMessage: 'ISBN should be 13 digits min'
    )]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'ISBN should contain only numbers',
    ),
        // TODO: or we can use something like that (but we can only chose one format):
        //        new Assert\Isbn(
        //            type: Assert\Isbn::ISBN_13,
        //            message: 'This value is not valid.',
        //        ),
    ]
    #[ORM\Column(length: 13)]
    private ?string $isbn = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    private Collection $author;

    public function __construct()
    {
        $this->author = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    public function setPublisher(?Publisher $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->author->removeElement($author);

        return $this;
    }
}
