<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\SitesClient;
use App\Form\SitesClientType;
use App\Repository\SitesClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/sites/client')]
final class SitesClientController extends AbstractController
{
    #[Route(name: 'app_sites_client_index', methods: ['GET'])]
    public function index(SitesClientRepository $sitesClientRepository): Response
    {
        return $this->render('sites_client/index.html.twig', [
            'sites_clients' => $sitesClientRepository->findAll(),
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new/{client_id}', name: 'app_sites_client_new', methods: ['GET', 'POST'], defaults: ['client_id' => null])]
    public function new(Request $request, EntityManagerInterface $entityManager, ?int $client_id = null): Response
    {
        $sitesClient = new SitesClient();

        if ($client_id) {
            $client = $entityManager->getRepository(Client::class)->find($client_id);
            if ($client) {
                $sitesClient->setClient($client);
            }
        }

        $form = $this->createForm(SitesClientType::class, $sitesClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sitesClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_client_show', ['id' => $sitesClient->getClient()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sites_client/new.html.twig', [
            'sites_client' => $sitesClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sites_client_show', methods: ['GET'])]
    public function show(SitesClient $sitesClient): Response
    {
        return $this->render('sites_client/show.html.twig', [
            'sites_client' => $sitesClient,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_sites_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SitesClient $sitesClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SitesClientType::class, $sitesClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_client_show', ['id' => $sitesClient->getClient()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sites_client/edit.html.twig', [
            'sites_client' => $sitesClient,
            'form' => $form,
        ]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_sites_client_delete', methods: ['POST'])]
    public function delete(Request $request, SitesClient $sitesClient, EntityManagerInterface $entityManager): Response
    {
        $clientId = $sitesClient->getClient()->getId();
        if ($this->isCsrfTokenValid('delete' . $sitesClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($sitesClient);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_client_show', ['id' => $clientId], Response::HTTP_SEE_OTHER);
    }
}
