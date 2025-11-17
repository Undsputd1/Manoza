<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // ✅ Save a product
    public function save(Product $product, bool $flush = false): void
    {
        $em = $this->getEntityManager();
        $em->persist($product);

        if ($flush) {
            $em->flush();
        }
    }

    // ✅ Remove a product
    public function remove(Product $product, bool $flush = false): void
    {
        $em = $this->getEntityManager();
        $em->remove($product);

        if ($flush) {
            $em->flush();
        }
    }

    // Example of custom query methods (optional)
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    // public function findByExampleField($value): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('p.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

    // public function findOneBySomeField($value): ?Product
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }
}
