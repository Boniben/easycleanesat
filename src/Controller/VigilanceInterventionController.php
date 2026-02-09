<?php

namespace App\Controller;

use App\Entity\VigilanceIntervention;
use App\Form\VigilanceInterventionType;
use App\Repository\VigilanceInterventionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vigilance/intervention')]
final class VigilanceInterventionController extends AbstractController
{
    #[Route(name: 'app_vigilance_intervention_index', methods: ['GET'])]
    public function index(VigilanceInterventionRepository $vigilanceInterventionRepository): Response
    {
        return $this->render('vigilance_intervention/index.html.twig', [
            'vigilance_interventions' => $vigilanceInterventionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vigilance_intervention_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vigilanceIntervention = new VigilanceIntervention();
        $form = $this->createForm(VigilanceInterventionType::class, $vigilanceIntervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vigilanceIntervention);
            $entityManager->flush();

            return $this->redirectToRoute('app_vigilance_intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vigilance_intervention/new.html.twig', [
            'vigilance_intervention' => $vigilanceIntervention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vigilance_intervention_show', methods: ['GET'])]
    public function show(VigilanceIntervention $vigilanceIntervention): Response
    {
        return $this->render('vigilance_intervention/show.html.twig', [
            'vigilance_intervention' => $vigilanceIntervention,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vigilance_intervention_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VigilanceIntervention $vigilanceIntervention, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VigilanceInterventionType::class, $vigilanceIntervention);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vigilance_intervention_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vigilance_intervention/edit.html.twig', [
            'vigilance_intervention' => $vigilanceIntervention,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vigilance_intervention_delete', methods: ['POST'])]
    public function delete(Request $request, VigilanceIntervention $vigilanceIntervention, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vigilanceIntervention->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vigilanceIntervention);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vigilance_intervention_index', [], Response::HTTP_SEE_OTHER);
    }
}
