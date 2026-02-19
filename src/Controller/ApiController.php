<?php

namespace App\Controller;

use App\Repository\TypeZoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/type-zone/search', name: 'api_type_zone_search', methods: ['GET'])]
    public function searchTypeZone(Request $request, TypeZoneRepository $typeZoneRepository): JsonResponse
    {
        $query = trim($request->query->get('q', ''));

        if ($query === '') {
            $results = [];
        } else {
            $results = $typeZoneRepository->searchByNomOrDescription($query);
        }

        return $this->json($results);
    }
}
