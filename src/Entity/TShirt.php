<?php

namespace App\Entity;

use App\Repository\TShirtRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TShirtRepository::class)]
class TShirt extends Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name:'idTShirt')]
    private $id;

    #[ORM\Column(type: 'string', length: 5)]
    private $size;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }
}
