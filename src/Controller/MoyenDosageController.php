<?php

namespace App\Controller;

use App\Entity\MoyenDosage;
use App\Form\MoyenDosageType;
use App\Repository\MoyenDosageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/moyen/dosage')]
final class MoyenDosageController extends AbstractController
{
    #[Route(name: 'app_moyen_dosage_index', methods: ['GET'])]
    public function index(MoyenDosageRepository $moyenDosageRepository): Response
    {
        return $this->render('moyen_dosage/index.html.twig', [
            'moyen_dosages' => $moyenDosageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_moyen_dosage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $moyenDosage = new MoyenDosage();
        $form = $this->createForm(MoyenDosageType::class, $moyenDosage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($moyenDosage);
            $entityManager->flush();

            return $this->redirectToRoute('app_moyen_dosage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_dosage/new.html.twig', [
            'moyen_dosage' => $moyenDosage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moyen_dosage_show', methods: ['GET'])]
    public function show(MoyenDosage $moyenDosage): Response
    {
        return $this->render('moyen_dosage/show.html.twig', [
            'moyen_dosage' => $moyenDosage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_moyen_dosage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MoyenDosage $moyenDosage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MoyenDosageType::class, $moyenDosage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_moyen_dosage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('moyen_dosage/edit.html.twig', [
            'moyen_dosage' => $moyenDosage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_moyen_dosage_delete', methods: ['POST'])]
    public function delete(Request $request, MoyenDosage $moyenDosage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moyenDosage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($moyenDosage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_moyen_dosage_index', [], Response::HTTP_SEE_OTHER);
    }
}
