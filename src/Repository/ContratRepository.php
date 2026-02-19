<?php

namespace App\Repository;

use App\Entity\Contrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contrat::class);
    }

    public function searchByNumero(string $query): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM contrat WHERE numero LIKE :q ORDER BY numero ASC';
        $result = $conn->executeQuery($sql, ['q' => '%' . $query . '%']);

        return $this->findBy(['id' => array_column($result->fetchAllAssociative(), 'id')]);
    }
}
