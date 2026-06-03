<?php

namespace App\Controller;

use App\Entity\DateIntervenationIntervenant;
use App\Form\DateIntervenationIntervenantType;
use App\Repository\DateIntervenationIntervenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/date/intervenation/intervenant')]
final class DateIntervenationIntervenantController extends AbstractController
{
    #[Route(name: 'app_date_intervenation_intervenant_index', methods: ['GET'])]
    public function index(DateIntervenationIntervenantRepository $dateIntervenationIntervenantRepository): Response
    {
        return $this->render('date_intervenation_intervenant/index.html.twig', [
            'date_intervenation_intervenants' => $dateIntervenationIntervenantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_date_intervenation_intervenant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dateIntervenationIntervenant = new DateIntervenationIntervenant();
        $form = $this->createForm(DateIntervenationIntervenantType::class, $dateIntervenationIntervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dateIntervenationIntervenant);
            $entityManager->flush();

            return $this->redirectToRoute('app_date_intervenation_intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('date_intervenation_intervenant/new.html.twig', [
            'date_intervenation_intervenant' => $dateIntervenationIntervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_intervenation_intervenant_show', methods: ['GET'])]
    public function show(DateIntervenationIntervenant $dateIntervenationIntervenant): Response
    {
        return $this->render('date_intervenation_intervenant/show.html.twig', [
            'date_intervenation_intervenant' => $dateIntervenationIntervenant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_date_intervenation_intervenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DateIntervenationIntervenant $dateIntervenationIntervenant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DateIntervenationIntervenantType::class, $dateIntervenationIntervenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_date_intervenation_intervenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('date_intervenation_intervenant/edit.html.twig', [
            'date_intervenation_intervenant' => $dateIntervenationIntervenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_intervenation_intervenant_delete', methods: ['POST'])]
    public function delete(Request $request, DateIntervenationIntervenant $dateIntervenationIntervenant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateIntervenationIntervenant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dateIntervenationIntervenant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_date_intervenation_intervenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
