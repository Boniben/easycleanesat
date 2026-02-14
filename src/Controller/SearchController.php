<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\SitesClientRepository;
use App\Repository\ZonesClientRepository;
use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    #[Route('/recherche', name: 'app_search', methods: ['GET'])]
    public function search(
        Request $request,
        ClientRepository $clientRepository,
        SitesClientRepository $sitesClientRepository,
        ZonesClientRepository $zonesClientRepository,
        ContratRepository $contratRepository
    ): Response {
        $query = trim($request->query->get('q', ''));
        $results = [];

        if ($query !== '') {
            $results['clients'] = $clientRepository->createQueryBuilder('c')
                ->where('c.nom LIKE :q')
                ->setParameter('q', '%' . $query . '%')
                ->getQuery()
                ->getResult();

            $results['sites'] = $sitesClientRepository->createQueryBuilder('s')
                ->leftJoin('s.client', 'c')
                ->where('s.nom LIKE :q')
                ->setParameter('q', '%' . $query . '%')
                ->getQuery()
                ->getResult();

            $results['zones'] = $zonesClientRepository->createQueryBuilder('z')
                ->leftJoin('z.sitesClient', 's')
                ->leftJoin('s.client', 'c')
                ->where('z.nom LIKE :q')
                ->setParameter('q', '%' . $query . '%')
                ->getQuery()
                ->getResult();

            $results['contrats'] = $contratRepository->createQueryBuilder('co')
                ->leftJoin('co.sitesClient', 's')
                ->leftJoin('s.client', 'c')
                ->where('co.numero LIKE :q')
                ->setParameter('q', '%' . $query . '%')
                ->getQuery()
                ->getResult();
        }

        return $this->render('search/index.html.twig', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
