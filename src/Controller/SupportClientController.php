<?php

namespace App\Controller;

use App\Entity\SupportClient;
use App\Form\SupportClientType;
use App\Repository\SupportClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/support/client')]
final class SupportClientController extends AbstractController
{
    #[Route(name: 'app_support_client_index', methods: ['GET'])]
    public function index(SupportClientRepository $supportClientRepository): Response
    {
        return $this->render('support_client/index.html.twig', [
            'support_clients' => $supportClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_support_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $supportClient = new SupportClient();
        $form = $this->createForm(SupportClientType::class, $supportClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($supportClient);
            $entityManager->flush();

            return $this->redirectToRoute('app_support_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('support_client/new.html.twig', [
            'support_client' => $supportClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_support_client_show', methods: ['GET'])]
    public function show(SupportClient $supportClient): Response
    {
        return $this->render('support_client/show.html.twig', [
            'support_client' => $supportClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_support_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SupportClient $supportClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SupportClientType::class, $supportClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_support_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('support_client/edit.html.twig', [
            'support_client' => $supportClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_support_client_delete', methods: ['POST'])]
    public function delete(Request $request, SupportClient $supportClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supportClient->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($supportClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_support_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
