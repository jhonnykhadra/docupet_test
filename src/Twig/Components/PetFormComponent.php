<?php

namespace App\Twig\Components;


use App\Entity\Breed;
use App\Entity\Pet;
use App\Factory\PetFactory;
use App\Repository\BreedRepository;
use App\Repository\PetRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class PetFormComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $name = '';

    #[LiveProp(writable: true, onUpdated: 'updateBreeds')]
    public string $type = ''; // Cat or Dog

    #[LiveProp(writable: true)]
    public string $breed = '';

    #[LiveProp(writable: true)]
    public string $gender = '';

    #[LiveProp(writable: true)]
    public string $formErrors = '';

    #[LiveProp(writable: true)]
    public string $otherBreed = '';
    #[LiveProp(writable: true)]
    public string $otherBreedDetails = '';

    #[LiveProp(writable: true)]
    public bool $knowDateOfBirth = true; // Defaults to "Yes"

    #[LiveProp(writable: true)]
    public ?string $dateOfBirth = null;

    #[LiveProp(writable: true)]
    public ?int $approximateAge = null;

    #[LiveProp(writable: true)]
    public array $breeds = [];
    #[LiveProp(writable: true)]
    public ?Pet $savedPet = null;

    #[LiveProp(writable: true)]
    public bool $formVisible = true;


    public function __construct(
        private readonly PetRepository $petRepository,
        private readonly BreedRepository $breedRepository,
        private readonly PetFactory $petFactory
    ) {
    }

    #[LiveAction]
    public function updateBreeds(): array
    {
        if (!empty($this->type)) {
            $breeds = $this->breedRepository->findBy(['type' => $this->type]);
            $this->breeds = array_map(fn(Breed $breed) => [
                'id' => $breed->getId(),
                'name' => $breed->getName(),
                'isDangerous' => $breed->IsDangerous(),
            ], $breeds);
        } else {
            $this->breeds = [];
        }
        return $this->breeds;
    }

    #[LiveAction]
    public function toggleKnowDateOfBirth(bool $value): void
    {
        $this->knowDateOfBirth = $value;
        if ($value) {
            $this->approximateAge = null;
        } else {
            $this->dateOfBirth = null;
        }
    }


    /**
     * @throws \DateMalformedStringException
     */
    #[LiveAction]
    public function save(): void
    {
        if (empty($this->name) || empty($this->type)) {
            throw new \RuntimeException('Please fill in all required fields.');
        }

        $selectedBreed = $this->breedRepository->find($this->breed);
        $petResult = $this->petFactory->createPet(
            $this->name,
            $this->gender,
            $selectedBreed,
            $this->dateOfBirth,
            $this->approximateAge,
            $this->otherBreed,
            $this->otherBreedDetails
        );

        if ($petResult->isSuccess()) {
            $this->savedPet = $petResult->getData();
            $this->petRepository->save($this->savedPet);
            $this->formVisible = false;
        } else {
            $this->formErrors = $petResult->getError();
        }
    }
}
