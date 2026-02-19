<?php

namespace App\Controller;

use App\Repository\SitesClientRepository;
use App\Repository\ContratRepository;
use App\Repository\ZonesClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Contrôleur API pour fournir des données JSON au formulaire d'intervention.
 * Ces routes sont appelées en AJAX par le JavaScript pour charger dynamiquement
 * les options des listes déroulantes en fonction des sélections précédentes.
 */
#[Route('/api')]
class ApiController extends AbstractController
{
    /**
     * Récupère tous les sites d'un client donné.
     * 
     * Cette route est appelée quand l'utilisateur sélectionne un client dans le formulaire.
     * Elle retourne la liste des sites appartenant à ce client pour remplir la liste déroulante "site".
     * 
     * @param int $clientId L'ID du client sélectionné
     * @param SitesClientRepository $sitesClientRepository Repository pour accéder aux sites
     * @return JsonResponse Tableau JSON contenant [{id: 1, nom: "Site A"}, {id: 2, nom: "Site B"}, ...]
     */
    #[Route('/sites-by-client/{clientId}', name: 'api_sites_by_client', methods: ['GET'])]
    public function getSitesByClient(
        int $clientId,
        SitesClientRepository $sitesClientRepository
    ): JsonResponse {
        // Requête Doctrine pour récupérer tous les sites du client
        $sites = $sitesClientRepository->createQueryBuilder('s')
            ->where('s.client = :clientId')  // Filtre : seulement les sites de ce client
            ->setParameter('clientId', $clientId)
            ->orderBy('s.nom', 'ASC')  // Tri alphabétique par nom
            ->getQuery()
            ->getResult();

        // Transformation des entités Site en tableau simple pour le JSON
        // On n'envoie que les données nécessaires (id et nom)
        $data = array_map(function ($site) {
            return [
                'id' => $site->getId(),
                'nom' => $site->getNom(),
            ];
        }, $sites);

        // Retourne les données au format JSON
        return $this->json($data);
    }

    /**
     * Récupère tous les contrats d'un site donné.
     * 
     * Cette route est appelée quand l'utilisateur sélectionne un site dans le formulaire.
     * Elle retourne la liste des contrats appartenant à ce site pour remplir la liste déroulante "contrat".
     * 
     * @param int $siteId L'ID du site sélectionné
     * @param ContratRepository $contratRepository Repository pour accéder aux contrats
     * @return JsonResponse Tableau JSON contenant [{id: 1, numero: "C001"}, {id: 2, numero: "C002"}, ...]
     */
    #[Route('/contrats-by-site/{siteId}', name: 'api_contrats_by_site', methods: ['GET'])]
    public function getContratsBySite(
        int $siteId,
        ContratRepository $contratRepository
    ): JsonResponse {
        // Requête Doctrine pour récupérer tous les contrats du site
        $contrats = $contratRepository->createQueryBuilder('c')
            ->where('c.sitesClient = :siteId')  // Filtre : seulement les contrats de ce site
            ->setParameter('siteId', $siteId)
            ->orderBy('c.numero', 'ASC')  // Tri alphabétique par numéro
            ->getQuery()
            ->getResult();

        // Transformation des entités Contrat en tableau simple pour le JSON
        $data = array_map(function ($contrat) {
            return [
                'id' => $contrat->getId(),
                'numero' => $contrat->getNumero(),
            ];
        }, $contrats);

        // Retourne les données au format JSON
        return $this->json($data);
    }

    /**
     * Récupère toutes les zones d'un site donné.
     * 
     * Cette route est appelée quand l'utilisateur sélectionne un site dans le formulaire.
     * Elle retourne la liste des zones appartenant à ce site pour remplir la liste déroulante "zone".
     * 
     * @param int $siteId L'ID du site sélectionné
     * @param ZonesClientRepository $zonesClientRepository Repository pour accéder aux zones
     * @return JsonResponse Tableau JSON contenant [{id: 1, nom: "Bureau 101"}, {id: 2, nom: "Entrepôt"}, ...]
     */
    #[Route('/zones-by-site/{siteId}', name: 'api_zones_by_site', methods: ['GET'])]
    public function getZonesBySite(
        int $siteId,
        ZonesClientRepository $zonesClientRepository
    ): JsonResponse {
        // Requête Doctrine pour récupérer toutes les zones du site
        $zones = $zonesClientRepository->createQueryBuilder('z')
            ->where('z.sitesClient = :siteId')  // Filtre : seulement les zones de ce site
            ->setParameter('siteId', $siteId)
            ->orderBy('z.nom', 'ASC')  // Tri alphabétique par nom
            ->getQuery()
            ->getResult();

        // Transformation des entités ZonesClient en tableau simple pour le JSON
        $data = array_map(function ($zone) {
            return [
                'id' => $zone->getId(),
                'nom' => $zone->getNom(),
            ];
        }, $zones);

        // Retourne les données au format JSON
        return $this->json($data);
    }
}
