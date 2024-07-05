<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    #[Route('/theme', name: 'app_theme')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeFormType::class, $theme);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde du formulaire dans la base de données
            $entityManager->persist($theme);
            $entityManager->flush();

            // Redirection vers la page des détails du thème qui vient d'être initiée
            return $this->redirectToRoute('theme_id', ['id' => $theme->getId()]);
        }

        return $this->render('theme/theme.html.twig', [
            'controller_name' => 'ThemeController',
            'themeForm' => $form->createView(),
        ]);
    }

    #[Route('/theme/{id}', name: 'theme_id')]
    public function theme(Theme $theme): Response
    {
        return $this->render('theme/theme_id.html.twig', [
            'controller_name' => 'ThemeController',
            'theme' => $theme,
        ]);
    }
}

