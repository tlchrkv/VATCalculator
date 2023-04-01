<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Shared\CountryCode;
use App\Entity\Taxes\CountryTax;
use App\Exceptions\CountryTaxNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CountryTax>
 *
 * @method CountryTax|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountryTax|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountryTax[]    findAll()
 * @method CountryTax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class CountryTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryTax::class);
    }

    public function save(CountryTax $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByCountryCode(CountryCode $countryCode): CountryTax
    {
        $countryTax = $this->createQueryBuilder('c')
            ->andWhere('c.countryCode = :val')
            ->setParameter('val', $countryCode->getValue())
            ->getQuery()
            ->getOneOrNullResult();

        if ($countryTax === null) {
            throw new CountryTaxNotFound($countryCode);
        }

        return $countryTax;
    }
}
