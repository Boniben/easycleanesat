<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


final class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard', methods: ['GET'])]
    public function index(): Response
    {
        if($this->isGranted('ROLE_USER')) {
            return $this->render('dashboard/admin_index.html.twig');
        }
        return $this->render('dashboard/index.html.twig');
    }
}
