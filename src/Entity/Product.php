<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name:'type', type:'string')]
#[DiscriminatorMap(['shoes'=>'Shoes','tshirt'=>'TShirt'])]
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

    #[ORM\Column(type: 'array', nullable: true)]
    private $keyWord = [];

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name:'category', referencedColumnName:'idCateg')]
    private $category;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
