<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name:'idProduct')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nameProduct;

    #[ORM\Column(type: 'float')]
    private $priceProduct;

    #[ORM\Column(type: 'json', nullable: true)]
    private $keyWord = [];

    #[ORM\Column(type: 'json')]
    private $sizes = [];

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name:'category', referencedColumnName:'idCateg')]
    private $category;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descProduct;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): self
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getPriceProduct(): ?float
    {
        return $this->priceProduct;
    }

    public function setPriceProduct(float $priceProduct): self
    {
        $this->priceProduct = $priceProduct;

        return $this;
    }

    public function getKeyWord(): ?array
    {
        return $this->keyWord;
    }

    public function setKeyWord(?array $keyWord): self
    {
        $this->keyWord = $keyWord;

        return $this;
    }

    public function getSize(): array
    {
        return $this->sizes;
    }

    public function setSize(array $sizes): self
    {
        $this->sizes = $sizes;
        
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescProduct(): ?string
    {
        return $this->descProduct;
    }

    public function setDescProduct(?string $descProduct): self
    {
        $this->descProduct = $descProduct;

        return $this;
    }
}
