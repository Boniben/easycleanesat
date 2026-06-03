<?php

namespace App\Controller;

use App\Entity\Handicap;
use App\Form\HandicapType;
use App\Repository\HandicapRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/handicap')]
final class HandicapController extends AbstractController
{
    #[Route(name: 'app_handicap_index', methods: ['GET'])]
    public function index(HandicapRepository $handicapRepository): Response
    {
        return $this->render('handicap/index.html.twig', [
            'handicaps' => $handicapRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_handicap_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $handicap = new Handicap();
        $form = $this->createForm(HandicapType::class, $handicap);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($handicap);
            $entityManager->flush();

            return $this->redirectToRoute('app_handicap_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('handicap/new.html.twig', [
            'handicap' => $handicap,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_handicap_show', methods: ['GET'])]
    public function show(Handicap $handicap): Response
    {
        return $this->render('handicap/show.html.twig', [
            'handicap' => $handicap,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_handicap_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Handicap $handicap, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HandicapType::class, $handicap);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_handicap_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('handicap/edit.html.twig', [
            'handicap' => $handicap,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_handicap_delete', methods: ['POST'])]
    public function delete(Request $request, Handicap $handicap, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$handicap->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($handicap);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_handicap_index', [], Response::HTTP_SEE_OTHER);
    }
}
