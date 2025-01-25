<?php

namespace App\Repository;

use App\Entity\Pet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pet>
 *
 * @method Pet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pet[]    findAll()
 * @method Pet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pet::class);
    }

    /**
     * Save a Pet entity to the database.
     *
     * @param Pet $pet
     * @param bool $flush Whether to immediately flush changes to the database.
     */
    public function save(Pet $pet, bool $flush = true): void
    {
        $this->getEntityManager()->persist($pet);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a Pet entity from the database.
     *
     * @param Pet $pet
     * @param bool $flush Whether to immediately flush changes to the database.
     */
    public function remove(Pet $pet, bool $flush = true): void
    {
        $this->getEntityManager()->remove($pet);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
