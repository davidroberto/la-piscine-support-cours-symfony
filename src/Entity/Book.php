<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $author;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inStock;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor( $author ): void
    {
        $this->author = $author;
    }


    public function getInStock(): ?bool
    {
        return $this->inStock;
    }

    public function setInStock(bool $inStock): self
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbPages()
    {
        return $this->nbPages;
    }

    /**
     * @param mixed $nbPages
     */
    public function setNbPages( $nbPages ): void
    {
        $this->nbPages = $nbPages;
    }

}
