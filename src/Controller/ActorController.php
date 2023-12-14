<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actor;
use App\Entity\Program;




#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/{id}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show(Actor $actor): Response
    {

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actors found in actor\'s table.'
            );
        }
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}
