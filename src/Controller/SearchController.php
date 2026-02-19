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
            $results['clients'] = $clientRepository->searchByNom($query);
            $results['sites'] = $sitesClientRepository->searchByNom($query);
            $results['zones'] = $zonesClientRepository->searchByNom($query);
            $results['contrats'] = $contratRepository->searchByNumero($query);
        }

        return $this->render('search/index.html.twig', [
            'query' => $query,
            'results' => $results,
        ]);
    }
}
