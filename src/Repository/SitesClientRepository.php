<?php

namespace App\Repository;

use App\Entity\SitesClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SitesClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitesClient::class);
    }

    public function searchByNom(string $query): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM sites_client WHERE nom LIKE :q ORDER BY nom ASC';
        $result = $conn->executeQuery($sql, ['q' => '%' . $query . '%']);

        return $this->findBy(['id' => array_column($result->fetchAllAssociative(), 'id')]);
    }
}
