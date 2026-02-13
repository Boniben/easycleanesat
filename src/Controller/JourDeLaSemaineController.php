<?php

namespace App\Controller;

use App\Entity\JourDeLaSemaine;
use App\Form\JourDeLaSemaineType;
use App\Repository\JourDeLaSemaineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jour/de/la/semaine')]
final class JourDeLaSemaineController extends AbstractController
{
    #[Route(name: 'app_jour_de_la_semaine_index', methods: ['GET'])]
    public function index(JourDeLaSemaineRepository $jourDeLaSemaineRepository): Response
    {
        return $this->render('jour_de_la_semaine/index.html.twig', [
            'jour_de_la_semaines' => $jourDeLaSemaineRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jour_de_la_semaine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jourDeLaSemaine = new JourDeLaSemaine();
        $form = $this->createForm(JourDeLaSemaineType::class, $jourDeLaSemaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jourDeLaSemaine);
            $entityManager->flush();

            return $this->redirectToRoute('app_jour_de_la_semaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jour_de_la_semaine/new.html.twig', [
            'jour_de_la_semaine' => $jourDeLaSemaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jour_de_la_semaine_show', methods: ['GET'])]
    public function show(JourDeLaSemaine $jourDeLaSemaine): Response
    {
        return $this->render('jour_de_la_semaine/show.html.twig', [
            'jour_de_la_semaine' => $jourDeLaSemaine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jour_de_la_semaine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JourDeLaSemaine $jourDeLaSemaine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JourDeLaSemaineType::class, $jourDeLaSemaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jour_de_la_semaine_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jour_de_la_semaine/edit.html.twig', [
            'jour_de_la_semaine' => $jourDeLaSemaine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jour_de_la_semaine_delete', methods: ['POST'])]
    public function delete(Request $request, JourDeLaSemaine $jourDeLaSemaine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jourDeLaSemaine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($jourDeLaSemaine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jour_de_la_semaine_index', [], Response::HTTP_SEE_OTHER);
    }
}
