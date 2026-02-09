<?php

namespace App\Controller;

use App\Entity\Redacteur;
use App\Form\RedacteurType;
use App\Repository\RedacteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/redacteur')]
final class RedacteurController extends AbstractController
{
    #[Route(name: 'app_redacteur_index', methods: ['GET'])]
    public function index(RedacteurRepository $redacteurRepository): Response
    {
        return $this->render('redacteur/index.html.twig', [
            'redacteurs' => $redacteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_redacteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $redacteur = new Redacteur();
        $form = $this->createForm(RedacteurType::class, $redacteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($redacteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_redacteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('redacteur/new.html.twig', [
            'redacteur' => $redacteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_redacteur_show', methods: ['GET'])]
    public function show(Redacteur $redacteur): Response
    {
        return $this->render('redacteur/show.html.twig', [
            'redacteur' => $redacteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_redacteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Redacteur $redacteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RedacteurType::class, $redacteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_redacteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('redacteur/edit.html.twig', [
            'redacteur' => $redacteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_redacteur_delete', methods: ['POST'])]
    public function delete(Request $request, Redacteur $redacteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$redacteur->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($redacteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_redacteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
