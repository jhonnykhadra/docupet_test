<?php

namespace App\Factory;

use App\Entity\Breed;
use App\Entity\Pet;
use App\Utility\Result;

class PetFactory
{
    public function createPet(
        string $name,
        string $gender,
        ?Breed $breed,
        ?string $dateOfBirth,
        ?int $approximateAge,
        ?string $otherBreed,
        ?string $otherBreedDetails
    ): Result {
        if (empty($name)) {
            return Result::failure("The name cannot be empty.");
        }

        if (empty($gender)) {
            return Result::failure("The name cannot be empty.");
        }

        if (empty($breed) && (empty($otherBreedDetails))) {
            return Result::failure("The breed cannot be empty.");
        }

        if (empty($dateOfBirth) && (empty($approximateAge))) {
            return Result::failure("approximate age or date of birth should be filled ");
        }

        try {
            $pet = new Pet();
            $pet->setName($name);
            $pet->setBreed($breed);
            $pet->setGender($gender);

            if (!empty($dateOfBirth)) {
                $pet->setDateOfBirth(new \DateTime($dateOfBirth));
                $pet->setApproximateAge(null);
            } else {
                $pet->setDateOfBirth(null);
                $pet->setApproximateAge($approximateAge);
            }

            $pet->setOtherBreedDetails($otherBreed === 'mix' ? $otherBreedDetails : $otherBreed);
            return Result::success($pet);
        } catch (\Exception $e) {
            return Result::failure("An error occurred while creating the pet: " . $e->getMessage());
        }
    }
}