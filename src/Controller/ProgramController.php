<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
Class ProgramController extends AbstractController
{

    public function index(): Response

    {

        return $this->render('program/index.html.twig', [

            'website' => 'Wild Series',

        ]);

    }
    #[Route('/program/{id}', methods: ['GET'], name: 'program_show')]
    public function show(int $id): Response
    {
        return $this->render('program/show.html.twig', [
            'id' => $id,
        ]);
    }
}
