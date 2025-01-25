<?php

namespace App\Entity;

use App\Repository\BreedRepository;
use App\Repository\PetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 50)]
    private string $type; // e.g., Cat, Dog

    #[ORM\Column(type: 'boolean')]
    private bool $isDangerousAnimal = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }


    public function isDangerous(): bool
    {
        return $this->isDangerousAnimal;
    }

    public function setIsDangerous(bool $isDangerousAnimal): self
    {
        $this->isDangerousAnimal = $isDangerousAnimal;
        return $this;
    }

}
