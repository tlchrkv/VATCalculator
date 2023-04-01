<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT;

use App\Domain\VATRateResolver\CountryCode\CountryCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VAT>
 *
 * @method VAT|null find($id, $lockMode = null, $lockVersion = null)
 * @method VAT|null findOneBy(array $criteria, array $orderBy = null)
 * @method VAT[]    findAll()
 * @method VAT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class VATRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VAT::class);
    }

    public function save(VAT $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByCountryCode(CountryCode $countryCode): ?VAT
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.countryCode = :val')
            ->setParameter('val', $countryCode->getValue())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
