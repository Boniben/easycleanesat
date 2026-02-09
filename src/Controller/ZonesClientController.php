<?php

namespace App\Controller;

use App\Entity\ZonesClient;
use App\Form\ZonesClientType;
use App\Repository\ZonesClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/zones/client')]
final class ZonesClientController extends AbstractController
{
    #[Route(name: 'app_zones_client_index', methods: ['GET'])]
    public function index(ZonesClientRepository $zonesClientRepository): Response
    {
        return $this->render('zones_client/index.html.twig', [
            'zones_clients' => $zonesClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_zones_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zonesClient = new ZonesClient();
        $form = $this->createForm(ZonesClientType::class, $zonesClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zonesClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_zones_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zones_client/new.html.twig', [
            'zones_client' => $zonesClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zones_client_show', methods: ['GET'])]
    public function show(ZonesClient $zonesClient): Response
    {
        return $this->render('zones_client/show.html.twig', [
            'zones_client' => $zonesClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_zones_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ZonesClient $zonesClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZonesClientType::class, $zonesClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_zones_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zones_client/edit.html.twig', [
            'zones_client' => $zonesClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zones_client_delete', methods: ['POST'])]
    public function delete(Request $request, ZonesClient $zonesClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zonesClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($zonesClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zones_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
