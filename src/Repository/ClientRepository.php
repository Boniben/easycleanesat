<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function searchByNom(string $query): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM client WHERE nom LIKE :q ORDER BY nom ASC';
        $result = $conn->executeQuery($sql, ['q' => '%' . $query . '%']);

        return $this->findBy(['id' => array_column($result->fetchAllAssociative(), 'id')]);
    }
}
