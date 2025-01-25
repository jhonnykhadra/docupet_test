<?php

namespace App\DataFixtures;

use App\Entity\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;

class BreedFixtures extends Fixture
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function load(ObjectManager $manager): void
    {
        $breeds = [
            // Dogs
            ['name' => 'Golden Retriever', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Pitbull', 'type' => 'dog', 'isDangerous' => true],
            ['name' => 'Mastiff', 'type' => 'dog', 'isDangerous' => true],
            ['name' => 'Labrador Retriever', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'German Shepherd', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Bulldog', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Beagle', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Chihuahua', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Poodle', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Rottweiler', 'type' => 'dog', 'isDangerous' => true],
            ['name' => 'Doberman Pinscher', 'type' => 'dog', 'isDangerous' => true],
            ['name' => 'Boxer', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Siberian Husky', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Dalmatian', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Shih Tzu', 'type' => 'dog', 'isDangerous' => false],
            ['name' => 'Akita', 'type' => 'dog', 'isDangerous' => true],

            // Cats
            ['name' => 'Persian', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Siamese', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Maine Coon', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Ragdoll', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Bengal', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'British Shorthair', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Sphynx', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Scottish Fold', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Abyssinian', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Russian Blue', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'American Shorthair', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Birman', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Oriental', 'type' => 'cat', 'isDangerous' => false],
            ['name' => 'Turkish Angora', 'type' => 'cat', 'isDangerous' => false],
        ];

        $breedRepository = $this->doctrine->getRepository(Breed::class);

        foreach ($breeds as $breedData) {
            // Check if the breed already exists
            $existingBreed = $breedRepository->findOneBy([
                'name' => $breedData['name'],
                'type' => $breedData['type'],
            ]);

            if (!$existingBreed) {
                $breed = new Breed();
                $breed->setName($breedData['name']);
                $breed->setType($breedData['type']);
                $breed->setIsDangerous($breedData['isDangerous']);
                $manager->persist($breed);
            }
        }

        $manager->flush();
    }
}
