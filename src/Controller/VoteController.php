<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Theme;

class VoteController extends AbstractController
{
    #[Route('/vote/{id}', name: 'app_vote_space')]
    public function voteSpace(Theme $theme): Response
    {
        // Assuming you have a template to display voting space
        return $this->render('vote/index.html.twig', [
            'theme' => $theme,
        ]);
    }
}
