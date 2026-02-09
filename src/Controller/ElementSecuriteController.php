<?php

namespace App\Controller;

use App\Entity\ElementSecurite;
use App\Form\ElementSecuriteType;
use App\Repository\ElementSecuriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/element/securite')]
final class ElementSecuriteController extends AbstractController
{
    #[Route(name: 'app_element_securite_index', methods: ['GET'])]
    public function index(ElementSecuriteRepository $elementSecuriteRepository): Response
    {
        return $this->render('element_securite/index.html.twig', [
            'element_securites' => $elementSecuriteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_element_securite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $elementSecurite = new ElementSecurite();
        $form = $this->createForm(ElementSecuriteType::class, $elementSecurite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($elementSecurite);
            $entityManager->flush();

            return $this->redirectToRoute('app_element_securite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('element_securite/new.html.twig', [
            'element_securite' => $elementSecurite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_element_securite_show', methods: ['GET'])]
    public function show(ElementSecurite $elementSecurite): Response
    {
        return $this->render('element_securite/show.html.twig', [
            'element_securite' => $elementSecurite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_element_securite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ElementSecurite $elementSecurite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ElementSecuriteType::class, $elementSecurite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_element_securite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('element_securite/edit.html.twig', [
            'element_securite' => $elementSecurite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_element_securite_delete', methods: ['POST'])]
    public function delete(Request $request, ElementSecurite $elementSecurite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$elementSecurite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($elementSecurite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_element_securite_index', [], Response::HTTP_SEE_OTHER);
    }
}
