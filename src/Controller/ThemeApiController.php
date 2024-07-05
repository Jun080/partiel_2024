<?php

namespace App\Controller;

use App\Entity\Theme;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/api/theme")
 */
class ThemeApiController extends AbstractController
{
    /**
     * @Route("/submit", methods={"POST"})
     */
    public function submit(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $themeName = $data['theme'] ?? null;
        $nombrePlacesGagnants = $data['nombrePlacesGagnants'] ?? null;
        $propositions = $data['propositions'] ?? [];

        if (empty($themeName) || !is_string($themeName)) {
            return $this->json(['error' => 'Invalid theme name'], Response::HTTP_BAD_REQUEST);
        }

        if (empty($nombrePlacesGagnants) || !is_int($nombrePlacesGagnants)) {
            return $this->json(['error' => 'Invalid number of winning places'], Response::HTTP_BAD_REQUEST);
        }

        if (!is_array($propositions) || empty($propositions)) {
            return $this->json(['error' => 'Invalid propositions'], Response::HTTP_BAD_REQUEST);
        }

        $theme = new Theme();
        $theme->setTheme($themeName);
        $theme->setNombrePlacesGagnants($nombrePlacesGagnants);
        $theme->setPropositions($propositions);

        $errors = $validator->validate($theme);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($theme);
        $entityManager->flush();

        return $this->json([
            'message' => 'Données soumises avec succès',
            'theme' => $theme->getTheme(),
            'nombrePlacesGagnants' => $theme->getNombrePlacesGagnants(),
            'propositions' => $theme->getPropositions(),
        ]);
    }

    /**
     * @Route("/get-data", methods={"GET"})
     */
    public function getData(): Response
    {
        // Exemple : récupération de données pour une API GET
        $formData = [
            'theme' => 'test symfony',
            'nombrePlacesGagnants' => 2,
            'propositions' => ['jaune', 'vert', 'bleu'],
        ];

        // Renvoyer les données sous forme de réponse JSON
        return $this->json($formData);
    }
}
