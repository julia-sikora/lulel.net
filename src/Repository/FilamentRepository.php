<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Filament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<Filament>
 *
 * @method Filament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filament[]    findAll()
 * @method Filament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filament::class);
    }

    public function search(string $text, UserInterface $user): array
    {
        return $this
            ->createQueryBuilder('filament')
            ->where("filament.user = :user")
            ->andWhere("filament.producer LIKE :text OR 
            filament.name LIKE :text OR 
            filament.material LIKE :text  OR
            filament.color LIKE :text OR
            filament.id LIKE :text")
            ->setParameter("text", "%$text%")
            ->setParameter("user", $user)
            ->getQuery()
            ->execute();
    }

    public function save(Filament $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Filament $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
