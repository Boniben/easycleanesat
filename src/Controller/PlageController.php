<?php

namespace App\Controller;

use App\Entity\Plage;
use App\Form\PlageType;
use App\Repository\PlageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/plage')]
final class PlageController extends AbstractController
{
    #[Route(name: 'app_plage_index', methods: ['GET'])]
    public function index(PlageRepository $plageRepository): Response
    {
        return $this->render('plage/index.html.twig', [
            'plages' => $plageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plage = new Plage();
        $form = $this->createForm(PlageType::class, $plage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plage);
            $entityManager->flush();

            return $this->redirectToRoute('app_plage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plage/new.html.twig', [
            'plage' => $plage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plage_show', methods: ['GET'])]
    public function show(Plage $plage): Response
    {
        return $this->render('plage/show.html.twig', [
            'plage' => $plage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Plage $plage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlageType::class, $plage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plage/edit.html.twig', [
            'plage' => $plage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plage_delete', methods: ['POST'])]
    public function delete(Request $request, Plage $plage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plage_index', [], Response::HTTP_SEE_OTHER);
    }
}
