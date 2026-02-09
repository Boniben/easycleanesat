<?php

namespace App\Controller;

use App\Entity\Vigilance;
use App\Form\VigilanceType;
use App\Repository\VigilanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vigilance')]
final class VigilanceController extends AbstractController
{
    #[Route(name: 'app_vigilance_index', methods: ['GET'])]
    public function index(VigilanceRepository $vigilanceRepository): Response
    {
        return $this->render('vigilance/index.html.twig', [
            'vigilances' => $vigilanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vigilance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vigilance = new Vigilance();
        $form = $this->createForm(VigilanceType::class, $vigilance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vigilance);
            $entityManager->flush();

            return $this->redirectToRoute('app_vigilance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vigilance/new.html.twig', [
            'vigilance' => $vigilance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vigilance_show', methods: ['GET'])]
    public function show(Vigilance $vigilance): Response
    {
        return $this->render('vigilance/show.html.twig', [
            'vigilance' => $vigilance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vigilance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vigilance $vigilance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VigilanceType::class, $vigilance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vigilance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vigilance/edit.html.twig', [
            'vigilance' => $vigilance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vigilance_delete', methods: ['POST'])]
    public function delete(Request $request, Vigilance $vigilance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vigilance->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vigilance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vigilance_index', [], Response::HTTP_SEE_OTHER);
    }
}
