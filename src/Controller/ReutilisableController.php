<?php

namespace App\Controller;

use App\Entity\Reutilisable;
use App\Form\ReutilisableType;
use App\Repository\ReutilisableRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reutilisable')]
final class ReutilisableController extends AbstractController
{
    #[Route(name: 'app_reutilisable_index', methods: ['GET'])]
    public function index(ReutilisableRepository $reutilisableRepository): Response
    {
        return $this->render('reutilisable/index.html.twig', [
            'reutilisables' => $reutilisableRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reutilisable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reutilisable = new Reutilisable();
        $form = $this->createForm(ReutilisableType::class, $reutilisable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reutilisable);
            $entityManager->flush();

            return $this->redirectToRoute('app_reutilisable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reutilisable/new.html.twig', [
            'reutilisable' => $reutilisable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reutilisable_show', methods: ['GET'])]
    public function show(Reutilisable $reutilisable): Response
    {
        return $this->render('reutilisable/show.html.twig', [
            'reutilisable' => $reutilisable,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reutilisable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reutilisable $reutilisable, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReutilisableType::class, $reutilisable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reutilisable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reutilisable/edit.html.twig', [
            'reutilisable' => $reutilisable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reutilisable_delete', methods: ['POST'])]
    public function delete(Request $request, Reutilisable $reutilisable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reutilisable->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reutilisable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reutilisable_index', [], Response::HTTP_SEE_OTHER);
    }
}
