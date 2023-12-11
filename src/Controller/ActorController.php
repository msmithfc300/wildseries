<?php

namespace App\Controller;


use App\Repository\ActorRepository;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgrammeRepository;
use App\Form\ProgrammeType;
use App\Entity\Programme;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/actor', name: 'actor_')]
Class ActorController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index(ActorRepository $actorRepository): Response

    {
        $actors = $actorRepository->findAll();

        return $this->render('actor/index.html.twig', [

            'actors' => $actors,

        ]);

    }
    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id, ActorRepository $actorRepository,): Response
    {
        $actor = $actorRepository->findOneBy(['id' => $id]);

        if (!$actor) {
            throw $this->createNotFoundException(
                'No actor with id : '.$id.' found in actor\'s table.'
            );
        }

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);

    }

}