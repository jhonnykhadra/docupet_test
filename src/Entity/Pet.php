<?php

namespace App\Entity;

use App\Repository\PetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetRepository::class)]
class Pet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 100)]
    private string $otherBreedDetails;

    #[ORM\ManyToOne(targetEntity: Breed::class, inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Breed $breed;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateOfBirth;

    #[ORM\Column(type: 'string', length: 10)]
    private string $gender;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $approximateAge = null;

    public function getApproximateAge(): ?int
    {
        return $this->approximateAge;
    }

    public function setApproximateAge(?int $approximateAge): void
    {
        $this->approximateAge = $approximateAge;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getBreed(): Breed|null
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): void
    {
        $this->breed = $breed;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOtherBreedDetails(): string
    {
        return $this->otherBreedDetails;
    }

    public function setOtherBreedDetails(string $otherBreedDetails): void
    {
        $this->otherBreedDetails = $otherBreedDetails;
    }


}
