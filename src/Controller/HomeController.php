<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeFormType::class, $theme);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();

            // Ajoutez ici une redirection ou un message de succès si nécessaire
        }

        $form = $this->createForm(ThemeFormType::class);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'themeForm' => $form->createView()
        ]);
    }
}
