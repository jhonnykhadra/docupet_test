<?php

namespace App\Repository;

use App\Entity\Breed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Breed>
 *
 * @method Breed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Breed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Breed[]    findAll()
 * @method Breed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Breed::class);
    }

    /**
     * Save a Breed entity to the database.
     *
     * @param Breed $Breed
     * @param bool $flush Whether to immediately flush changes to the database.
     */
    public function save(Breed $Breed, bool $flush = true): void
    {
        $this->getEntityManager()->persist($Breed);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Remove a Breed entity from the database.
     *
     * @param Breed $Breed
     * @param bool $flush Whether to immediately flush changes to the database.
     */
    public function remove(Breed $Breed, bool $flush = true): void
    {
        $this->getEntityManager()->remove($Breed);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
